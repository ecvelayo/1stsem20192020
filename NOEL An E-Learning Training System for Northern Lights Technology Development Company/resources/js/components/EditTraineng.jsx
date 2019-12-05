import React from 'react';
import Axios from 'axios';
import {
    Container,
    Row,
    Col,
    Form,
    FormGroup,
    Input,
    InputGroup,
    InputGroupAddon,
    Modal,
    ModalBody,
    Button,
    Card
} from 'reactstrap';
import styled from 'styled-components';
import LinearProgress from '@material-ui/core/LinearProgress';
import PageNotFound from './PageNotFound';
import Loading from './Loading';
import { Link } from 'react-router-dom';
import BlankImg from '../../img/undraw_blank_canvas.svg';
import Authenticate from './Auth/Authenticate';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.min.css';
import CloseRoundedIcon from '@material-ui/icons/CloseRounded';
import IconButton from '@material-ui/core/IconButton';

export default class EditTraining extends React.Component {
    state = {
        loading: true,
        id: null,
        title: '',
        description: '',
        duration: 0,
        completion: 0,
        image: null,
        errors: [],
        failedToFetch: false,
        notFound: false,
        modal: false,
        progress: 0,
        canEdit: false,
        skill: '',
        skill_list: []
    };

    componentDidMount = () => {
        Authenticate.getCurrentUser(user => {
            if (user.isAdmin || user.isHR) {
                this.setState({
                    canEdit: true
                });
            } else {
                this.props.history.goBack();
            }
        });
        let trainingId = this.props.match.params.id;
        Axios.get(`/api/edit/training/${trainingId}`)
            .then(response => {
                let { data } = response;
                this.setState({
                    loading: false,
                    id: data.id,
                    title: data.title,
                    description: data.description ? data.description : '',
                    duration: data.duration,
                    completion: data.completion,
                    image: data.image,
                    skill_list: JSON.parse(data.skills)
                });
            })
            .catch(error => {
                let response = error.response;
                if (response.status === 500) {
                    this.setState({
                        failedToFetch: true
                    });
                } else if (response.status === 404) {
                    this.setState({
                        notFound: true
                    });
                }
            });
    };

    handleFieldChange = event => {
        this.setState({
            [event.target.name]: event.target.value
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

    handleTrainingSubmit = event => {
        event.preventDefault();
        let training = this.getTrainingState();
        this.handleSubmit(training);
    };

    handleImgChange = event => {
        if (event.target.files[0]) {
            let image = event.target.files[0];

            if (image.size > 4000000) {
                let uploadError = {
                    image: ['The image file must not be greater than 4 MB']
                };
                this.setState({
                    errors: uploadError
                });
            } else {
                this.setState({
                    errors: []
                });
                let training = this.getTrainingState(image);
                this.handleSubmit(training, true);
            }
        }
    };

    getTrainingState = image => {
        console.log(this.state.skill_list);
        let training = new FormData();
        training.append('title', this.state.title);
        training.append('duration', this.state.duration);
        training.append('completion', this.state.completion);
        training.append('skills', JSON.stringify(this.state.skill_list));

        if (this.state.description !== '') {
            training.append('description', this.state.description);
        } else {
            training.append('description', '');
        }

        if (image) {
            training.append('image', image, image.name);
        } else {
            training.append('image', null);
        }
        return training;
    };

    handleSubmit = (training, hasFile) => {
        if (hasFile) {
            Axios.post(`/api/edit/training/${this.state.id}`, training, {
                onUploadProgress: progressEvent => {
                    let progress = Math.round(
                        (progressEvent.loaded / progressEvent.total) * 100
                    );
                    this.setState({
                        modal: true,
                        progress: progress
                    });
                }
            })
                .then(response => {
                    let { data } = response;
                    this.setState({
                        loading: false,
                        id: data.id,
                        title: data.title,
                        description: data.description ? data.description : '',
                        duration: data.duration,
                        completion: data.completion,
                        image: data.image,
                        skill_list: JSON.parse(data.skills)
                    });
                    this.toggle();
                    this.notify();
                })
                .catch(error => {
                    this.setState({
                        errors: error.response.data.errors,
                        modal: false,
                        progress: 0
                    });
                    console.log(error);
                });
        } else {
            Axios.post(`/api/edit/training/${this.state.id}`, training)
                .then(response => {
                    let { data } = response;
                    this.setState({
                        loading: false,
                        id: data.id,
                        title: data.title,
                        description: data.description ? data.description : '',
                        duration: data.duration,
                        completion: data.completion,
                        image: data.image
                    });
                    this.notify();
                })
                .catch(error => {
                    this.setState({
                        errors: error.response.data.errors,
                        modal: false,
                        progress: 0
                    });
                    console.log(error);
                });
        }
    };

    toggle = () => {
        this.setState(prevState => ({
            modal: !prevState.modal,
            progress: 0
        }));
    };

    notify = () =>
        toast.success('Training saved!', {
            className: 'pl-3'
        });

    handleAddSkill = () => {
        this.setState({
            skill_list: [...this.state.skill_list, this.state.skill],
            skill: ''
        });
    };

    handleDeleteSkill = deleteSkill => {
        const result = this.state.skill_list.filter(skill => {
            return skill != deleteSkill;
        });
        this.setState({
            skill_list: result
        });
    };

    checkTrainingContent = id => {
        const finalizeMsg =
            'Are you sure you want finalize the training? \n NOTE: You cannot edit';
        // if(confirm(''))
        // console.log()
        // {`/edit/certificate/${this.props.id}`}
    };

    render() {
        if (this.state.failedToFetch) {
            return (
                <FailedToFetchData message='Sorry! We are unable to fetch data from the server.' />
            );
        }

        if (this.state.notFound) {
            return <PageNotFound />;
        }

        if (this.state.loading) {
            return <Loading />;
        }
        return (
            <Container>
                <StyledToast
                    position='top-right'
                    autoClose={2500}
                    hideProgressBar
                    newestOnTop
                    closeOnClick
                    rtl={false}
                    pauseOnVisibilityChange={false}
                    draggable={false}
                    pauseOnHover={false}
                />
                <Modal
                    isOpen={this.state.modal}
                    backdrop='static'
                    centered={true}
                >
                    <ModalBody>
                        <LinearProgress
                            color='primary'
                            variant='determinate'
                            value={this.state.progress}
                        ></LinearProgress>
                        <div className='text-center'>
                            <h5>Uploading</h5>
                        </div>
                    </ModalBody>
                </Modal>
                <TrainingInfoPanel
                    id={this.state.id}
                    title={this.state.title}
                    description={this.state.description}
                    duration={this.state.duration}
                    completion={this.state.completion}
                    image={this.state.image}
                    formHandler={this.handleFieldChange}
                    imageHandler={this.handleImgChange}
                    skill={this.state.skill}
                    skill_list={this.state.skill_list}
                    handleAddSkill={this.handleAddSkill}
                    handleAdd={this.handleAdd}
                    handleDeleteSkill={this.handleDeleteSkill}
                    submit={this.handleTrainingSubmit}
                    renderError={this.renderErrorFor}
                    hasError={this.hasErrorFor}
                    checkTrainingContent={this.checkTrainingContent}
                ></TrainingInfoPanel>
                <SectionPanel id={this.state.id}></SectionPanel>
            </Container>
        );
    }
}

const StyledToast = styled(ToastContainer)``;

const PanelContainer = styled.div`
    margin-bottom: 2.75rem;
`;

const TrainingImgContainer = styled.div`
    position: relative;
`;

const EmptyTrainingSection = styled.div`
    text-align: center;
    margin: 1rem 3rem;
`;

const SmallLabel = styled.label`
    margin-bottom: 0.5rem;
    display: inline-block;
    font-weight: bold;
`;

class TrainingInfoPanel extends React.Component {
    add;
    handleAdd = event => {
        if (event.keyCode == 13) {
            event.preventDefault();
            this.add.onClick();
        }
    };
    render() {
        return (
            <PanelContainer>
                <h4>Training</h4>
                <Card body className='border-0 shadow-sm'>
                    <Form
                        onSubmit={this.props.submit}
                        encType='multipart/form-data'
                        method='post'
                    >
                        <Row>
                            <Col lg={5} className='order-2 order-lg-1'>
                                <TrainingImgContainer>
                                    <img
                                        src={
                                            this.props.image
                                                ? `/storage/trainings/${this.props.image}`
                                                : BlankImg
                                        }
                                        alt={
                                            this.props.image
                                                ? this.props.image
                                                : 'No training image'
                                        }
                                        className='img-fluid mb-2'
                                    />
                                    <small className='text-muted'>
                                        The image must not be greater than 4MB
                                    </small>
                                    <Input
                                        type='file'
                                        name='image'
                                        onChange={event =>
                                            this.props.imageHandler(event)
                                        }
                                        invalid={
                                            this.props.hasError('image')
                                                ? true
                                                : false
                                        }
                                    />
                                    {this.props.renderError('image')}
                                </TrainingImgContainer>
                            </Col>
                            <Col className='order-1'>
                                {/* <div className='text-right'>
                                    <Link
                                        className='btn btn-outline-primary'
                                        to={`/edit/certificate/${this.props.id}`}
                                    >
                                        Edit Certificate
                                    </Link>
                                </div> */}
                                <FormGroup>
                                    <SmallLabel className='h6 small'>
                                        Training Title
                                    </SmallLabel>
                                    <Input
                                        type='text'
                                        name='title'
                                        value={this.props.title}
                                        onChange={this.props.formHandler}
                                        required
                                    />
                                </FormGroup>
                                <div className='form-group'>
                                    <SmallLabel className='h6 small'>
                                        Skills
                                    </SmallLabel>
                                    <InputGroup>
                                        <Input
                                            type='text'
                                            name='skill'
                                            id='skill'
                                            placeholder='Enter skill'
                                            value={this.props.skill}
                                            onChange={this.props.formHandler}
                                            className={'form-control'}
                                            onKeyDown={event => {
                                                this.handleAdd(event);
                                            }}
                                        />
                                        <InputGroupAddon addonType='append'>
                                            <Button
                                                color='primary'
                                                onClick={
                                                    this.props.handleAddSkill
                                                }
                                                ref={b => (this.add = b)}
                                            >
                                                Add
                                            </Button>
                                        </InputGroupAddon>
                                    </InputGroup>
                                    <div className='d-flex flex-row my-2'>
                                        <div>
                                            {this.props.skill_list.map(
                                                skill => (
                                                    <span
                                                        className='badge badge-pill badge-primary shadow-sm small mt-2 mr-2'
                                                        key={skill}
                                                    >
                                                        {skill}
                                                        <IconButton
                                                            size='small'
                                                            onClick={() =>
                                                                this.props.handleDeleteSkill(
                                                                    skill
                                                                )
                                                            }
                                                        >
                                                            <CloseRoundedIcon fontSize='inherit' />
                                                        </IconButton>
                                                    </span>
                                                )
                                            )}
                                        </div>
                                    </div>
                                </div>
                                <Row form>
                                    <Col>
                                        <FormGroup>
                                            <SmallLabel className='h6 small'>
                                                Training Period{' '}
                                                <small className='text-muted'>
                                                    (Days)
                                                </small>
                                            </SmallLabel>
                                            <Input
                                                type='number'
                                                name='duration'
                                                value={this.props.duration}
                                                onChange={
                                                    this.props.formHandler
                                                }
                                                min={1}
                                                max={30}
                                                placeholder='(max: 30)'
                                            ></Input>
                                        </FormGroup>
                                    </Col>
                                    <Col>
                                        <FormGroup>
                                            <SmallLabel className='h6 small'>
                                                Training Completion{' '}
                                                <small className='text-muted'>
                                                    (Hours)
                                                </small>
                                            </SmallLabel>
                                            <Input
                                                type='number'
                                                name='completion'
                                                value={this.props.completion}
                                                onChange={
                                                    this.props.formHandler
                                                }
                                                min={1}
                                                max={24}
                                                placeholder='(max: 24)'
                                            ></Input>
                                        </FormGroup>
                                    </Col>
                                </Row>
                                <FormGroup>
                                    <SmallLabel className='h6 small'>
                                        Training Description
                                    </SmallLabel>
                                    <Input
                                        type='textarea'
                                        name='description'
                                        value={this.props.description}
                                        onChange={this.props.formHandler}
                                        rows={6}
                                    ></Input>
                                </FormGroup>
                            </Col>
                        </Row>
                        <div className='d-flex justify-content-end mt-3'>
                            <Button
                                color='primary'
                                outline
                                onClick={() =>
                                    this.props.checkTrainingContent(
                                        this.props.id
                                    )
                                }
                                className='mx-3'
                            >
                                Finalize Training
                            </Button>
                            <Button type='submit' color='success'>
                                Save changes
                            </Button>
                        </div>
                    </Form>
                </Card>
            </PanelContainer>
        );
    }
}

class SectionPanel extends React.Component {
    state = {
        title: '',
        errors: [],
        sections: [],
        failedToFetch: false
    };

    componentDidMount = () => {
        // console.log(this.props);
        Axios.get(`/api/training/${this.props.id}/sections`)
            .then(response => {
                this.setState({
                    sections: response.data
                });
            })
            .catch(error => {
                if (response.status === 500) {
                    this.setState({
                        failedToFetch: true
                    });
                }
            });
    };

    handleSubmit = event => {
        event.preventDefault();
        let section = {
            title: this.state.title,
            training_id: this.props.id
        };
        // Clear form input
        this.setState({
            title: ''
        });

        Axios.post('/api/sections', section)
            .then(response => {
                this.setState({
                    sections: response.data
                });
            })
            .catch(error => {
                this.setState({
                    errors: error.response.data.errors
                });
            });
    };

    handleFieldChange = event => {
        this.setState({
            [event.target.name]: event.target.value
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
        if (this.state.failedToFetch) {
            return (
                <FailedToFetchData message='Sorry! We are unable to fetch data from the server.' />
            );
        }

        return (
            <PanelContainer>
                <h4>Topics</h4>
                <Form onSubmit={this.handleSubmit} className='mb-3'>
                    <div className='d-flex flex-row'>
                        <div className='flex-grow-1'>
                            <FormGroup>
                                <Input
                                    type='text'
                                    name='title'
                                    value={this.state.title}
                                    onChange={this.handleFieldChange}
                                    placeholder='Topic title'
                                    className={`form-control ${
                                        this.hasErrorFor('title')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('title')}
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
                {this.state.sections.length === 0 ? (
                    <EmptyTrainingSection>
                        <span className='my-3 text-muted h5'>No Topics</span>
                    </EmptyTrainingSection>
                ) : (
                    this.state.sections.map(section => (
                        <Link
                            to={`/edit/training/${this.props.id}/section/${section.id}`}
                            className='text-decoration-none'
                            key={section.id}
                        >
                            <Card body className='my-2'>
                                <div className='d-flex flex-row justify-content-between'>
                                    <h5 className='mb-0'>{section.title}</h5>
                                    {/* <Button close></Button> */}
                                </div>
                            </Card>
                        </Link>
                    ))
                )}
            </PanelContainer>
        );
    }
}
