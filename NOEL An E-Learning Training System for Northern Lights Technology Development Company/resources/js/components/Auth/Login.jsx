import React from 'react';
import { Link } from 'react-router-dom';
import Authenticate from './Authenticate';
// import CircularProgress from '@material-ui/core/CircularProgress';
import Logo from '../../../logos/nltd_logo.png';
import {
    Button,
    Container,
    Row,
    Col,
    Form,
    FormGroup,
    Input,
    Label
} from 'reactstrap';
import Axios from 'axios';
import styled from 'styled-components';
import lighthouse from '../../../img/undraw_lighthouse.svg';

const LoginBg = styled.div`
    background-image: url(${lighthouse});
    height: 100vh;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: right;
`;

export default class Login extends React.Component {
    state = {
        hasSubmitted: false,
        email: '',
        password: '',
        errors: []
    };

    componentDidMount = () => {
        // Check if user is logged in?
        if (Authenticate.isLoggedIn()) {
            let { history } = this.props;

            // redirect the user back to the page
            history.push('/dashboard');
        }
    };

    redirectUser = () => {
        let { history } = this.props;
        history.push('/dashboard');
    };

    handleOnSubmit = event => {
        event.preventDefault();
        let credentials = {
            email: this.state.email,
            password: this.state.password
        };
        this.setState({
            hasSubmitted: true
        });
        Axios.post('/api/login', credentials)
            .then(response => {
                if (response.status === 200) {
                    let token = response.data;
                    Authenticate.login(data => {
                        // USER WILL BE RETURNED BY data
                        this.props.updateState(data);
                        // Redirect the user to the intended route;
                        this.redirectUser();
                    }, token);
                }
            })
            .catch(error => {
                this.setState({
                    errors: error.response.data.errors,
                    hasSubmitted: false,
                    password: ''
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
            <LoginBg className='d-flex'>
                <Container className='align-self-center'>
                    <Row>
                        <Col
                            lg={6}
                            style={{ background: '#ffffff47' }}
                            className='p-5 shadow-sm rounded-lg'>
                            <div className='d-flex flex-row'>
                                <div>
                                    <img
                                        src={Logo}
                                        alt='logo'
                                        width='50'
                                        height='50'
                                    />
                                </div>
                                <div>
                                    <h5 className='lead ml-3'>
                                        Welcome to Northern Lights Technology
                                        Development Philippines Corp.
                                    </h5>
                                </div>
                            </div>
                            <div className='font-weight-bold lead mb-3 mt-4'>
                                Login Page
                            </div>
                            <div>
                                <Form onSubmit={this.handleOnSubmit}>
                                    <FormGroup>
                                        <Label className='small font-weight-bold'>
                                            Email
                                        </Label>
                                        <Input
                                            type='email'
                                            name='email'
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
                                        <Label className='small font-weight-bold'>
                                            Password
                                        </Label>
                                        <Input
                                            type='password'
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
                                    <Button
                                        color='primary'
                                        className='px-3'
                                        type='submit'
                                        disabled={this.state.hasSubmitted}>
                                        <div className='d-flex flex-row align-items-center justify-content-center'>
                                            Sign in
                                            {this.state.hasSubmitted ? (
                                                // <CircularProgress
                                                //     size={'1rem'}
                                                //     color='inherit'
                                                //     className='ml-2'
                                                // />
                                                <div
                                                    className='ml-2 spinner-border spinner-border-sm text-light'
                                                    role='status'>
                                                    <span className='sr-only'>
                                                        Loading...
                                                    </span>
                                                </div>
                                            ) : (
                                                ''
                                            )}
                                        </div>
                                    </Button>
                                </Form>
                                <div className='mt-4'>
                                    <span className='h6 text-muted'>
                                        Don't have an account?
                                        <Link to='/register'> Register </Link>
                                        instead
                                    </span>
                                </div>
                            </div>
                        </Col>
                    </Row>
                </Container>
            </LoginBg>
        );
    }
}
