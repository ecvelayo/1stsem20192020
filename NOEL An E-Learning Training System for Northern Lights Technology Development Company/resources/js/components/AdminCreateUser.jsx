import React from 'react';
import {
    Container,
    Button,
    Form,
    FormGroup,
    Label,
    Input,
    InputGroupAddon,
    InputGroupText,
    InputGroup,
    Row,
    Col
} from 'reactstrap';
import Axios from 'axios';

export default class AdminCreateUser extends React.Component {
    state = {
        fname: '',
        lname: '',
        mname: '',
        contact: '',
        email: '',
        password: '',
        password_confirmation: '',
        errors: []
    };

    handleOnSubmit = event => {
        event.preventDefault();
        let data = {
            fname: this.state.fname,
            lname: this.state.lname,
            mname: this.state.mname,
            contact: this.state.contact,
            email: this.state.email,
            password: this.state.password,
            password_confirmation: this.state.password_confirmation
        };
        Axios.post(`/api/createuser`, data)
            .then(response => {
                if (response.status === 200) {
                    this.props.history.push('/dashboard');
                }
            })
            .catch(error => {
                this.setState({
                    errors: error.response.data.errors,
                    hasSubmitted: false,
                    password: '',
                    password_confirmation: ''
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
                <Row className='d-flex justify-content-center my-4'>
                    <Col lg={6}>
                        <h1>Create User</h1>
                        <Form onSubmit={this.handleOnSubmit}>
                            <FormGroup>
                                <Label>
                                    First Name{' '}
                                    <small className='text-muted'>
                                        (Required)
                                    </small>
                                </Label>
                                <Input
                                    name='fname'
                                    value={this.state.fname}
                                    onChange={this.handleFieldChange}
                                    className={`form-control ${
                                        this.hasErrorFor('fname')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('fname')}
                            </FormGroup>
                            <FormGroup>
                                <Label>
                                    Middle Name{' '}
                                    <small className='text-muted'>
                                        (Optional)
                                    </small>
                                </Label>
                                <Input
                                    name='mname'
                                    value={this.state.mname}
                                    onChange={this.handleFieldChange}
                                    className={`form-control ${
                                        this.hasErrorFor('mname')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('mname')}
                            </FormGroup>
                            <FormGroup>
                                <Label>
                                    Last Name{' '}
                                    <small className='text-muted'>
                                        (Required)
                                    </small>
                                </Label>
                                <Input
                                    name='lname'
                                    value={this.state.lname}
                                    onChange={this.handleFieldChange}
                                    className={`form-control ${
                                        this.hasErrorFor('lname')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('lname')}
                            </FormGroup>
                            <FormGroup>
                                <Label>
                                    Contact Number{' '}
                                    <small className='text-muted'>
                                        (Required)
                                    </small>
                                </Label>
                                <InputGroup>
                                    <InputGroupAddon addonType='prepend'>
                                        <InputGroupText>+63</InputGroupText>
                                    </InputGroupAddon>
                                    <Input
                                        name='contact'
                                        value={this.state.contact}
                                        onChange={this.handleFieldChange}
                                        placeholder='9123456789'
                                        className={`form-control ${
                                            this.hasErrorFor('contact')
                                                ? 'is-invalid'
                                                : ''
                                        }`}
                                    />
                                    {this.renderErrorFor('contact')}
                                </InputGroup>
                            </FormGroup>
                            <FormGroup>
                                <Label>
                                    Email{' '}
                                    <small className='text-muted'>
                                        (Required)
                                    </small>
                                </Label>
                                <Input
                                    name='email'
                                    type='email'
                                    value={this.state.email}
                                    onChange={this.handleFieldChange}
                                    className={`form-control ${
                                        this.hasErrorFor('email')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('email')}
                            </FormGroup>
                            <FormGroup>
                                <Label>
                                    Password{' '}
                                    <small className='text-muted'>
                                        (Minimum of 8 characters)
                                    </small>
                                </Label>
                                <Input
                                    name='password'
                                    value={this.state.password}
                                    onChange={this.handleFieldChange}
                                    type='password'
                                    className={`form-control ${
                                        this.hasErrorFor('password')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('password')}
                            </FormGroup>
                            <FormGroup>
                                <Label>
                                    Confirm Password{' '}
                                    <small className='text-muted'>
                                        (Required)
                                    </small>
                                </Label>
                                <Input
                                    name='password_confirmation'
                                    value={this.state.password_confirmation}
                                    onChange={this.handleFieldChange}
                                    type='password'
                                    className={`form-control ${
                                        this.hasErrorFor(
                                            'password_confirmation'
                                        )
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('password_confirmation')}
                            </FormGroup>
                            <Button type='submit' color='primary'>
                                Create
                            </Button>
                        </Form>
                    </Col>
                </Row>
            </Container>
        );
    }
}
