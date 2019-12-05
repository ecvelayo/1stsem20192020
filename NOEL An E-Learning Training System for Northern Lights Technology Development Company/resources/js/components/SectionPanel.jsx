import React from 'react';
import styled from 'styled-components';
import {
    Form,
    FormGroup,
    Input,
    Button,
    Card,
    Modal,
    ModalBody,
    ModalHeader
} from 'reactstrap';
import Axios from 'axios';
import { Link } from 'react-router-dom';
import { lightBlue, green } from '@material-ui/core/colors';
import CloseRoundedIcon from '@material-ui/icons/CloseRounded';
import IconButton from '@material-ui/core/IconButton';
import { DragDropContext, Droppable, Draggable } from 'react-beautiful-dnd';
import EditRoundedIcon from '@material-ui/icons/EditRounded';
import { withStyles } from '@material-ui/core/styles';
import VisibilityRoundedIcon from '@material-ui/icons/VisibilityRounded';
import { blue } from '@material-ui/core/colors';

const PanelContainer = styled.div`
    margin-bottom: 2.75rem;
`;

const EmptyTrainingSection = styled.div`
    text-align: center;
    margin: 1rem 3rem;
`;

export default class SectionPanel extends React.Component {
    state = {
        title: '',
        errors: [],
        sections: [],
        failedToFetch: false,
        toggle: false,
        editTitle: '',
        sectionId: null
    };
    componentDidMount = () => {
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
    handleDelete = (event, id) => {
        event.preventDefault();
        Axios.delete(`/api/section/delete/${id}`)
            .then(({ data }) => {
                console.log(data);
                this.setState({
                    sections: data
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
    handleToggle = title => {
        this.setState({
            editTitle: title,
            toggle: !this.state.toggle
        });
    };
    editSection = event => {
        event.preventDefault();
        const data = {
            id: this.state.sectionId,
            title: this.state.editTitle
        };
        this.setState({
            editTitle: '',
            toggle: !this.state.toggle,
            sectionId: null
        });
        Axios.put(`/api/change/section/${data.id}`, data).then(({ data }) => {
            this.setState({
                sections: data
            });
        });
    };
    onDragEnd = result => {
        const { source, destination, draggableId } = result;
        if (!destination) {
            return;
        }
        if (
            destination.droppableId === source.droppableId &&
            destination.index + 1 === source.index
        ) {
            return;
        }
        Axios.put(
            `/api/training/${this.props.id}/section/${draggableId}/${
                source.index
            }/${destination.index + 1}`
        ).then(({ data }) => {
            this.setState({
                sections: data
            });
        });
    };
    render() {
        if (this.state.failedToFetch) {
            return (
                <FailedToFetchData message='Sorry! We are unable to fetch data from the server.' />
            );
        }
        return (
            <PanelContainer>
                <div className='d-flex flex-row justify-content-between align-items-center'>
                    <div className='h4 mb-0'>Topics</div>
                    <div>
                        <Link
                            to={`/preview/training/${this.props.id}`}
                            target='_blank'
                            className='my-2 btn btn-outline-secondary btn-sm'
                        >
                            {' '}
                            <VisibilityRoundedIcon fontSize='small' /> Preview
                        </Link>
                    </div>
                </div>
                <Form onSubmit={this.handleSubmit}>
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
                    <DragDropContext onDragEnd={this.onDragEnd}>
                        <Droppable droppableId={this.props.id}>
                            {(provided, snapshot) => (
                                <div
                                    ref={provided.innerRef}
                                    {...provided.droppableProps}
                                    style={{
                                        backgroundColor: snapshot.isDraggingOver
                                            ? green['A100']
                                            : 'white'
                                    }}
                                >
                                    <div>
                                        {this.state.sections.map(section => (
                                            <Draggable
                                                draggableId={section.id}
                                                index={section.index}
                                                key={section.id}
                                            >
                                                {provided => (
                                                    <div
                                                        {...provided.draggableProps}
                                                        {...provided.dragHandleProps}
                                                        ref={provided.innerRef}
                                                    >
                                                        <Modal
                                                            isOpen={
                                                                this.state
                                                                    .toggle
                                                            }
                                                            toggle={
                                                                this
                                                                    .handleToggle
                                                            }
                                                        >
                                                            <ModalHeader
                                                                toggle={
                                                                    this
                                                                        .handleToggle
                                                                }
                                                            >
                                                                Edit Section
                                                            </ModalHeader>
                                                            <ModalBody>
                                                                <Form
                                                                    onSubmit={
                                                                        this
                                                                            .editSection
                                                                    }
                                                                >
                                                                    <FormGroup>
                                                                        <Input
                                                                            autoFocus
                                                                            type='text'
                                                                            name='editTitle'
                                                                            value={
                                                                                this
                                                                                    .state
                                                                                    .editTitle
                                                                            }
                                                                            onChange={
                                                                                this
                                                                                    .handleFieldChange
                                                                            }
                                                                            required
                                                                            className='form-control'
                                                                        />
                                                                    </FormGroup>
                                                                    <Button
                                                                        type='submit'
                                                                        color='success'
                                                                    >
                                                                        Change
                                                                    </Button>
                                                                </Form>
                                                            </ModalBody>
                                                        </Modal>
                                                        <StyledLink
                                                            to={`/edit/training/${this.props.id}/section/${section.id}`}
                                                            className='text-decoration-none'
                                                        >
                                                            <Card className='p-3 mb-2'>
                                                                <div className='d-flex flex-row justify-content-between'>
                                                                    <div>
                                                                        <h5 className='mb-0'>
                                                                            {
                                                                                section.title
                                                                            }
                                                                        </h5>
                                                                    </div>
                                                                    <div>
                                                                        <IconButton
                                                                            onClick={event => {
                                                                                event.preventDefault();
                                                                                this.handleToggle(
                                                                                    section.title
                                                                                );
                                                                                this.setState(
                                                                                    {
                                                                                        sectionId:
                                                                                            section.id
                                                                                    }
                                                                                );
                                                                            }}
                                                                            size='small'
                                                                            className='mr-2'
                                                                        >
                                                                            <EditRoundedIcon fontSize='inherit' />
                                                                        </IconButton>
                                                                        <IconButton
                                                                            onClick={event => {
                                                                                this.handleDelete(
                                                                                    event,
                                                                                    section.id
                                                                                );
                                                                            }}
                                                                            size='small'
                                                                        >
                                                                            <CloseRoundedIcon fontSize='inherit' />
                                                                        </IconButton>
                                                                    </div>
                                                                </div>
                                                            </Card>
                                                        </StyledLink>
                                                    </div>
                                                )}
                                            </Draggable>
                                        ))}
                                    </div>
                                    {provided.placeholder}
                                </div>
                            )}
                        </Droppable>
                    </DragDropContext>
                )}
            </PanelContainer>
        );
    }
}

const StyledLink = styled(Link)`
    color: rgba(0, 0, 0, 0.5);
    &:hover div {
        background-color: ${lightBlue[600]};
        transition: background-color 80ms ease-in-out;
        border-color: ${lightBlue[800]};
        color: white;
    }
`;
