import React from 'react';
import Axios from 'axios';
import FailedToFetchData from './FailedToFetchData';
import Loading from './Loading';
import PageNotFound from './PageNotFound';
import {
    Button,
    Card,
    CardBody,
    CardHeader,
    Col,
    Container,
    Form,
    FormGroup,
    Input,
    Label,
    Modal,
    ModalHeader,
    ModalBody,
    ModalFooter,
    Row
} from 'reactstrap';
import styled from 'styled-components';
import { Link } from 'react-router-dom';
import ChevronRightIcon from '@material-ui/icons/ChevronRight';
import IconButton from '@material-ui/core/IconButton';
import EditRoundedIcon from '@material-ui/icons/EditRounded';
import CloseRoundedIcon from '@material-ui/icons/CloseRounded';

const LectureItem = styled.div`
    padding: 1rem;
    margin: 0.5rem 0;
    border: 1px solid lightgrey;
    border-radius: 2px;
    &: hover {
        background-color: #ececec;
    }
`;

const StyledLink = styled(Link)`
    text-decoration: none;
    color: black;

    &:focus,
    &:hover,
    &:visited,
    &:link,
    &:active {
        text-decoration: none;
    }
`;

export default class Section extends React.Component {
    state = {
        lecture_title: '',
        lectures: [],
        id: null,
        training_id: null,
        training: {},
        title: '',
        description: '',
        loading: true,
        failedToFetch: false,
        notFound: false,
        errors: [],
        toggle: false,
        editTitle: '',
        editId: null
    };

    componentDidMount = () => {
        let data = this.props.match.params;
        Axios.get(`/api/training/${data.training}/section/${data.section}`)
            .then(response => {
                let { section } = response.data;
                let { lectures } = response.data;
                let { training } = section;
                this.setState({
                    id: section.id,
                    training_id: section.training_id,
                    title: section.title,
                    description: section.description ? section.description : '',
                    lectures: lectures,
                    training: training,
                    loading: false
                });
            })
            .catch(error => {
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                    this.setState({
                        failedToFetch: true
                    });
                } else if (error.request) {
                    // The request was made but no response was received
                    // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                    // http.ClientRequest in node.js
                    console.log(error.request);
                    this.setState({
                        notFound: true
                    });
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
                console.log(error.config);
            });
    };

    updateLecture = lectures => {
        this.setState({
            lectures: lectures
        });
        const { section, training } = this.props.match.params;
        if (lectures[lectures.length - 1].isTest) {
            this.props.history.push(
                `/edit/training/${training}/section/${section}/lecture/${lectures[lectures.length - 1].id}/test/${lectures[lectures.length - 1].test.id}`
            );
        } else {
            this.props.history.push(
                `/edit/training/${training}/section/${section}/lecture/${lectures[lectures.length - 1].id}`
            );
        }
    };

    handleToggle = () => {
        this.setState({
            toggle: !this.state.toggle
        });
    };

    editLecture = () => {
        event.preventDefault();
        let data = {
            title: this.state.editTitle,
            id: this.state.editId
        };
        console.log(data);

        // Clear form input
        this.setState({
            editTitle: ''
        });

        this.handleToggle();

        Axios.put(`/api/change/lecture/${this.state.editId}`).then(
            ({ data }) => {
                this.setState({
                    lectures: data
                });
            }
        );
    };

    handleFieldChange = event => {
        this.setState({
            [event.target.name]: event.target.value
        });
    };

    render() {
        let section = {
            id: this.state.id,
            title: this.state.title,
            training_id: this.state.training_id,
            description: this.state.description
        };
        let { lectures, training } = this.state;
        if (this.state.failedToFetch) {
            return (
                <FailedToFetchData message='We are unable to fetch data from the server.' />
            );
        }
        if (this.state.notFound) {
            return <PageNotFound />;
        }
        if (this.state.loading) {
            return <Loading />;
        }
        const SectionInfo = () => (
            <Card className='my-3'>
                <CardHeader>
                    <div className='d-flex justify-content-between align-items-center'>
                        <div className='h5 mb-0'>{section.title}</div>
                        <div>
                            <Button color='success' size='sm'>
                                Edit
                            </Button>
                        </div>
                    </div>
                </CardHeader>
                <CardBody className='border-bottom'>
                    {section.description ? (
                        <div className='my-3'>
                            <p className='lead'>{section.description}</p>
                        </div>
                    ) : (
                        <div className='my-4 text-muted font-italic text-center bg-light p-3'>
                            No description
                        </div>
                    )}
                </CardBody>
            </Card>
        );

        const Lectures = () => {
            if (lectures.length === 0) {
                return (
                    <div className='text-muted font-italic text-center bg-light p-3'>
                        No lectures
                    </div>
                );
            }

            const items = lectures.map(lecture => {
                if (lecture.test) {
                    return (
                        <StyledLink
                            to={`${this.props.location.pathname}/lecture/${lecture.id}/test/${lecture.test.id}`}
                            key={lecture.id}
                        >
                            <LectureItem>
                                <div className='d-flex flex-row justify-content-between align-items-center'>
                                    <div>{lecture.title}</div>
                                    <div>
                                        {/* <IconButton
                                            onClick={event => {
                                                event.preventDefault();
                                                this.setState({
                                                    editTitle: lecture.title,
                                                    editId: lecture.id
                                                });
                                                this.handleToggle();
                                            }}
                                            size='small'
                                            className='mr-2'
                                        >
                                            <EditRoundedIcon fontSize='inherit' />
                                        </IconButton> */}
                                        {/* <IconButton
                                            onClick={event => {
                                                event.preventDefault();
                                                alert('Delete');
                                            }}
                                            size='small'
                                            className='mr-2'
                                        >
                                            <CloseRoundedIcon fontSize='inherit' />
                                        </IconButton> */}
                                    </div>
                                </div>
                            </LectureItem>
                        </StyledLink>
                    );
                } else {
                    return (
                        <StyledLink
                            to={`${this.props.location.pathname}/lecture/${lecture.id}`}
                            key={lecture.id}
                        >
                            <LectureItem>
                                <div className='d-flex flex-row justify-content-between align-items-center'>
                                    <div>{lecture.title}</div>
                                    <div>
                                        {/* <IconButton
                                            onClick={event => {
                                                event.preventDefault();
                                                this.setState({
                                                    editTitle: lecture.title,
                                                    editId: lecture.id
                                                });
                                                this.handleToggle();
                                            }}
                                            size='small'
                                            className='mr-2'
                                        >
                                            <EditRoundedIcon fontSize='inherit' />
                                        </IconButton> */}
                                        {/* <IconButton
                                            onClick={event => {
                                                event.preventDefault();
                                            }}
                                            size='small'
                                            className='mr-2'
                                        >
                                            <CloseRoundedIcon fontSize='inherit' />
                                        </IconButton> */}
                                    </div>
                                </div>
                            </LectureItem>
                        </StyledLink>
                    );
                }
            });

            return <div>{items}</div>;
        };
        return (
            <Container>
                <Modal isOpen={this.state.toggle} toggle={this.handleToggle}>
                    <ModalHeader toggle={this.handleToggle}>
                        Edit Lecture
                    </ModalHeader>
                    <ModalBody>
                        <Form onSubmit={this.editLecture}>
                            <FormGroup>
                                <Input
                                    autoFocus
                                    type='text'
                                    name='editTitle'
                                    value={this.state.editTitle}
                                    onChange={this.handleFieldChange}
                                    required
                                    className='form-control'
                                />
                            </FormGroup>
                            <Button type='submit' color='success'>
                                Change
                            </Button>
                        </Form>
                    </ModalBody>
                </Modal>
                <div className='my-3 h4'>
                    <Link
                        to={`/edit/training/${this.state.training_id}`}
                        className='font-weight-lighter text-dark'
                        style={{ textDecoration: 'underline' }}
                    >
                        {training.title}
                    </Link>
                    <ChevronRightIcon className='mx-1' /> {section.title}
                </div>

                {/* <SectionInfo /> */}
                <div className='mt-5'>
                    <h5>Lectures</h5>
                    <Card className='my-3 shadow-sm'>
                        <CardBody>
                            <CreateLectureComponent
                                sectionID={section.id}
                                updateLecture={this.updateLecture}
                            />
                            <Lectures />
                        </CardBody>
                    </Card>
                </div>
            </Container>
        );
    }
}

class CreateLectureComponent extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            section_id: null,
            title: '',
            isTest: false,
            errors: []
        };
    }

    componentDidMount = () => {
        this.setState({
            section_id: this.props.sectionID
        });
    };

    handleSubmit = event => {
        event.preventDefault();
        let lecture = {
            title: this.state.title,
            section_id: this.state.section_id,
            isTest: this.state.isTest
        };
        // Clear form input
        this.setState({
            title: '',
            isTest: false
        });

        Axios.post('/api/lectures', lecture)
            .then(response => {
                let { data } = response;
                this.props.updateLecture(data);
            })
            .catch(error => {
                this.setState({
                    errors: error.response.data.errors
                });
            });
    };

    handleFieldChange = (event, isChecked) => {
        this.setState({
            [event.target.name]: isChecked
                ? event.target.checked
                : event.target.value
        });
    };

    hasErrorFor = field => {
        return !!this.state.errors[field];
    };

    renderErrorFor = field => {
        if (this.hasErrorFor(field)) {
            return (
                <span className='invalid-feedback'>
                    <strong>{this.state.errors[field][0]}</strong>
                </span>
            );
        }
    };

    render() {
        return (
            <div>
                <Form onSubmit={this.handleSubmit} className='mt-3'>
                    <div className='d-flex flex-row'>
                        <div className='flex-grow-1'>
                            <FormGroup>
                                <Input
                                    type='text'
                                    name='title'
                                    value={this.state.title}
                                    onChange={event =>
                                        this.handleFieldChange(event)
                                    }
                                    placeholder='Lecture title'
                                    className={`form-control ${
                                        this.hasErrorFor('title')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('title')}
                            </FormGroup>
                            <FormGroup check>
                                <Label check>
                                    <Input
                                        type='checkbox'
                                        name='isTest'
                                        checked={this.state.isTest}
                                        onChange={event =>
                                            this.handleFieldChange(event, true)
                                        }
                                    />{' '}
                                    Create as test
                                </Label>
                            </FormGroup>
                        </div>
                        <div className='flex-shrink-1'>
                            <Button
                                color='primary'
                                type='submit'
                                block
                                className='px-5'
                            >
                                Add
                            </Button>
                        </div>
                    </div>
                </Form>
            </div>
        );
    }
}
