import React from 'react';
import Axios from 'axios';
import {
    Container,
    Row,
    Col,
    FormGroup,
    Input,
    Card,
    Modal,
    ModalBody
} from 'reactstrap';
import LinearProgress from '@material-ui/core/LinearProgress';
import Button from '@material-ui/core/Button';
import { withStyles } from '@material-ui/core/styles';
import { blue } from '@material-ui/core/colors';
import VpnKeyRoundedIcon from '@material-ui/icons/VpnKeyRounded';
import { Link } from 'react-router-dom';
import UserEnrolledTrainings from './UserEnrolledTrainings';

export default class EditUser extends React.Component {
    state = {
        id: null,
        fname: '',
        lname: '',
        mname: '',
        contact: '',
        profile_image: '',
        email: '',
        role: '',
        isManager: '',
        isAdmin: '',
        isHR: '',
        unChanged: true,
        errors: [],
        progress: 0,
        modal: false,
        passModal: false,
        password: '',
        password_confirmation: ''
    };
    componentDidMount = () => {
        Axios.get(`/api/get/user/${this.props.match.params.user}`).then(
            response => {
                let user = response.data;
                const roles = () => {
                    if (user.isAdmin) {
                        return 'Administrator';
                    } else if (user.isHR) {
                        return 'HR';
                    } else if (user.isManager) {
                        return 'Manager';
                    } else {
                        return 'Employee';
                    }
                };
                const userRole = roles();
                this.setState({
                    id: user.id,
                    fname: user.fname,
                    lname: user.lname,
                    mname: user.mname,
                    contact: user.contact,
                    email: user.email,
                    role: userRole,
                    profile_image: user.profile_image
                });
            }
        );
    };
    handleUpdate = event => {
        event.preventDefault();
        let data = {
            fname: this.state.fname,
            lname: this.state.lname,
            mname: this.state.mname,
            contact: this.state.contact,
            email: this.state.email,
            role: this.state.role
        };
        Axios.put(`/api/update/user/${this.state.id}/admin`, data).then(
            ({ data }) => {
                const roles = () => {
                    if (data.isAdmin) {
                        return 'Administrator';
                    } else if (data.isHR) {
                        return 'HR';
                    } else if (data.isManager) {
                        return 'Manager';
                    } else {
                        return 'Employee';
                    }
                };
                const userRole = roles();
                this.setState({
                    id: data.id,
                    fname: data.fname,
                    lname: data.lname,
                    mname: data.mname,
                    contact: data.contact,
                    email: data.email,
                    role: userRole,
                    unChanged: !this.state.unChanged
                });
                alert('User profile updated');
                // let { history } = this.props;
                // history.push('/dashboard');
            }
        );
    };
    handleChange = event => {
        this.setState({
            [event.target.name]: event.target.value,
            unChanged: false
        });
    };
    toggle = () => {
        this.setState(prevState => ({
            modal: !prevState.modal,
            progress: 0
        }));
    };
    togglePassword = () => {
        this.setState(prevState => ({
            passModal: !prevState.passModal
        }));
    };
    handleImgChange = event => {
        const file = event.target.files[0];
        let picture = new FormData();
        picture.append('profile_image', file, file.name);
        Axios.post(`/api/update/user/image/${this.state.id}`, picture, {
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
            .then(({ data }) => {
                this.setState({
                    profile_image: data
                });
                this.toggle();
                alert('User profile updated');
            })
            .catch(error => {
                this.setState({
                    modal: false,
                    progress: 0,
                    errors: error.response.data.errors
                });
                console.log(error);
            });
    };
    handleChangePass = event => {
        this.setState({
            [event.target.name]: event.target.value
        });
    };
    handleResetPass = event => {
        event.preventDefault();
        const data = {
            password: this.state.password,
            password_confirmation: this.state.password_confirmation
        };
        Axios.put(`/api/update/user/password/${this.state.id}/admin`, data)
            .then(({ data }) => {
                this.setState({
                    id: data.id,
                    fname: data.fname,
                    lname: data.lname,
                    mname: data.mname,
                    contact: data.contact,
                    email: data.email,
                    errors: [],
                    password: '',
                    password_confirmation: ''
                });
                this.togglePassword();
                alert('User profile updated');
            })
            .catch(error => {
                this.setState({
                    errors: error.response.data.errors,
                    password: '',
                    password_confirmation: ''
                });
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
        const roles = ['Administrator', 'HR', 'Manager', 'Employee'];
        return (
            <>
                <Container>
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
                    <Modal
                        isOpen={this.state.passModal}
                        centered={true}
                        toggle={this.togglePassword}
                    >
                        <ModalBody>
                            <div className='p-3'>
                                <div className='mb-3 h4'>Change password</div>
                                <form onSubmit={this.handleResetPass}>
                                    <FormGroup>
                                        <label className='small font-weight-bold'>
                                            New Password
                                        </label>
                                        <Input
                                            type='password'
                                            name='password'
                                            required
                                            value={this.state.password}
                                            onChange={this.handleChangePass}
                                            className={`form-control ${
                                                this.hasErrorFor('password')
                                                    ? 'is-invalid'
                                                    : ''
                                            }`}
                                        />
                                        {this.renderErrorFor('password')}
                                    </FormGroup>
                                    <FormGroup>
                                        <label className='small font-weight-bold'>
                                            Confirm password
                                        </label>
                                        <Input
                                            type='password'
                                            required
                                            name='password_confirmation'
                                            value={
                                                this.state.password_confirmation
                                            }
                                            onChange={this.handleChangePass}
                                            className={`form-control ${
                                                this.hasErrorFor(
                                                    'password_confirmation'
                                                )
                                                    ? 'is-invalid'
                                                    : ''
                                            }`}
                                        />
                                        {this.renderErrorFor(
                                            'password_confirmation'
                                        )}
                                    </FormGroup>
                                    <ChangePassButton
                                        type='submit'
                                        variant='contained'
                                        color='primary'
                                    >
                                        Reset password
                                    </ChangePassButton>
                                </form>
                            </div>
                        </ModalBody>
                    </Modal>
                    <div className='mb-3'>
                        <Link to='/dashboard'>Back to dashboard</Link>
                    </div>
                    <div className='text-center display-4 mb-3'>
                        User profile
                    </div>
                    <Card body className='my-3'>
                        <Row className='d-flex my-4'>
                            <Col
                                md={4}
                                lg={3}
                                className='d-flex flex-column justify-content-center align-self-center'
                            >
                                <div className='w-100 d-flex justify-content-center'>
                                    <img
                                        src={
                                            this.state.profile_image
                                                ? `/storage/user/${this.state.profile_image}`
                                                : `/storage/user/user.jpg`
                                        }
                                        alt={
                                            this.state.profile_image
                                                ? this.state.profile_image
                                                : 'profile image'
                                        }
                                        className='img-thumbnail shadow'
                                    />
                                </div>
                                <ChangeImgButton
                                    onClick={() => {
                                        document
                                            .getElementById('image')
                                            .click();
                                    }}
                                >
                                    Change Profile Image
                                </ChangeImgButton>
                                {this.state.errors.profile_image ? (
                                    <div className='small text-danger my-2'>
                                        {this.state.errors.profile_image[0]}
                                    </div>
                                ) : (
                                    <small className='text-muted my-2'>
                                        Image must not be greater than 4MB
                                    </small>
                                )}
                                <div>
                                    <Input
                                        type='file'
                                        name='image'
                                        id='image'
                                        style={{ display: 'none' }}
                                        onChange={this.handleImgChange}
                                    />
                                </div>
                            </Col>
                            <Col>
                                <form
                                    method='post'
                                    onSubmit={this.handleUpdate}
                                >
                                    <Row>
                                        <Col>
                                            <FormGroup>
                                                <label className='small font-weight-bold'>
                                                    First Name{' '}
                                                </label>
                                                <Input
                                                    type='text'
                                                    required
                                                    value={this.state.fname}
                                                    onChange={this.handleChange}
                                                    name='fname'
                                                />
                                            </FormGroup>
                                        </Col>
                                        <Col>
                                            <FormGroup>
                                                <label className='small font-weight-bold'>
                                                    Middle Name{' '}
                                                </label>
                                                <Input
                                                    type='text'
                                                    value={
                                                        this.state.mname
                                                            ? this.state.mname
                                                            : ''
                                                    }
                                                    onChange={this.handleChange}
                                                    name='mname'
                                                />
                                            </FormGroup>
                                        </Col>
                                        <Col>
                                            <FormGroup>
                                                <label className='small font-weight-bold'>
                                                    Last Name{' '}
                                                </label>
                                                <Input
                                                    type='text'
                                                    required
                                                    value={this.state.lname}
                                                    onChange={this.handleChange}
                                                    name='lname'
                                                />
                                            </FormGroup>
                                        </Col>
                                    </Row>
                                    <Row>
                                        <Col>
                                            <FormGroup>
                                                <label className='small font-weight-bold'>
                                                    Contact Number
                                                </label>
                                                <Input
                                                    type='text'
                                                    required
                                                    value={this.state.contact}
                                                    onChange={this.handleChange}
                                                    name='contact'
                                                />
                                            </FormGroup>
                                        </Col>
                                        <Col>
                                            <FormGroup>
                                                <label className='small font-weight-bold'>
                                                    Email{' '}
                                                </label>
                                                <Input
                                                    type='email'
                                                    required
                                                    value={this.state.email}
                                                    onChange={this.handleChange}
                                                    name='email'
                                                />
                                            </FormGroup>
                                        </Col>
                                    </Row>
                                    <Row>
                                        <Col lg={4}>
                                            <FormGroup>
                                                <label className='small font-weight-bold'>
                                                    Position
                                                </label>
                                                <Input
                                                    type='select'
                                                    name='role'
                                                    onChange={this.handleChange}
                                                    value={this.state.role}
                                                >
                                                    {roles.map(role => (
                                                        <option
                                                            value={role}
                                                            key={role}
                                                        >
                                                            {role}
                                                        </option>
                                                    ))}
                                                </Input>
                                            </FormGroup>
                                        </Col>
                                    </Row>
                                    <div className='d-flex flex-row justify-content-between align-items-center'>
                                        <div>
                                            <Button
                                                variant='contained'
                                                color='default'
                                                onClick={() => {
                                                    this.togglePassword();
                                                }}
                                                disableFocusRipple={true}
                                                disableRipple={true}
                                            >
                                                <VpnKeyRoundedIcon className='mr-2' />
                                                Reset Password
                                            </Button>
                                        </div>
                                        <div>
                                            <CreateButton
                                                type='submit'
                                                variant='contained'
                                                color='primary'
                                                disabled={this.state.unChanged}
                                            >
                                                Save Changes
                                            </CreateButton>
                                        </div>
                                    </div>
                                </form>
                            </Col>
                        </Row>
                    </Card>
                </Container>
                {this.state.id != null ? (
                    <UserEnrolledTrainings id={this.state.id} />
                ) : null}
            </>
        );
    }
}

const CreateButton = withStyles(theme => ({
    root: {
        margin: theme.spacing(2, 1),
        color: theme.palette.getContrastText(blue[500]),
        backgroundColor: blue[500],
        '&:hover': {
            backgroundColor: blue[700],
            color: theme.palette.getContrastText(blue[700])
        }
    }
}))(Button);

const ChangePassButton = withStyles(theme => ({
    root: {
        color: theme.palette.getContrastText(blue[500]),
        backgroundColor: blue[500],
        '&:hover': {
            backgroundColor: blue[700],
            color: theme.palette.getContrastText(blue[700])
        }
    }
}))(Button);

const ChangeImgButton = withStyles(theme => ({
    root: {
        margin: theme.spacing(2, 0, 0, 0),
        color: blue[500],
        backgroundColor: 'transparent',
        border: `1px solid ${blue[500]}`,
        '&:hover': {
            backgroundColor: blue[700],
            color: theme.palette.getContrastText(blue[700])
        }
    }
}))(Button);
