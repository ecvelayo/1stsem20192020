import React from 'react';
import Axios from 'axios';
import {
    Form,
    FormGroup,
    Input,
    Button,
    Container,
    Row,
    Col
} from 'reactstrap';

export default class AnnouncementForm extends React.Component {
    state = {
        title: '',
        description: '',
        errors: [],
        failedToFetch: false
    };
    handleSubmit = event => {
        event.preventDefault();
        let announcements = {
            title: this.state.title,
            description: this.state.description
        };
        // Clear form input
        this.setState({
            title: '',
            description: ''
        });
        Axios.post('/api/announcements', announcements)
            .then(response => {
                alert('Announcement created!');
                this.props.history.push('/dashboard');
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
        return (
            <Container>
                <Row className='d-flex justify-content-center'>
                    <Col lg={8}>
                        <div className='display-4 mb-4'>Add announcement</div>
                        <Form onSubmit={this.handleSubmit} className='mb-3'>
                            <FormGroup>
                                <Input
                                    type='text'
                                    name='title'
                                    value={this.state.title}
                                    onChange={this.handleFieldChange}
                                    placeholder='Title'
                                    className={`form-control ${
                                        this.hasErrorFor('title')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('title')}
                            </FormGroup>
                            <FormGroup>
                                <Input
                                    type='textarea'
                                    name='description'
                                    value={this.state.description}
                                    onChange={this.handleFieldChange}
                                    rows={7}
                                    placeholder='Announcement content'
                                    className={`form-control ${
                                        this.hasErrorFor('description')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('description')}
                            </FormGroup>
                            <div className='flex-shrink-1'>
                                <Button
                                    color='primary'
                                    type='submit'
                                    block
                                    className='px-5'
                                >
                                    Post announcement
                                </Button>
                            </div>
                        </Form>
                    </Col>
                </Row>
            </Container>
        );
    }
}
