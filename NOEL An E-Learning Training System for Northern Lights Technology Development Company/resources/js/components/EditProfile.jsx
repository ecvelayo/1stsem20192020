import Axios from 'axios';
import React from 'react';
import Authenticate from './Auth/Authenticate';
import Button from '@material-ui/core/Button';
import { withStyles } from '@material-ui/core/styles';
import { blue } from '@material-ui/core/colors';
import { Input, Modal, ModalBody, FormGroup } from 'reactstrap';
import VpnKeyRoundedIcon from '@material-ui/icons/VpnKeyRounded';
import LinearProgress from '@material-ui/core/LinearProgress';

export default class EditProfile extends React.Component {
    state = {
        id: '',
        profile_image: null,
        fname: '',
        mname: '',
        lname: '',
        contact: '',
        email: '',
        unChanged: true,
        modal: false,
        old_password: '',
        password: '',
        password_confirmation: '',
        errors: [],
        progress: 0,
        loading: false
    };
    componentDidMount = () => {
        Authenticate.getCurrentUser(user => {
            this.setState({
                profile_image: user.profile_image,
                fname: user.fname,
                mname: user.mname,
                lname: user.lname,
                contact: user.contact,
                email: user.email,
                id: user.id
            });
        });
    };
    handleSubmit = event => {
        event.preventDefault();
        let data = {
            id: this.state.id,
            fname: this.state.fname,
            mname: this.state.mname,
            lname: this.state.lname,
            contact: this.state.contact,
            email: this.state.email
        };
        this.props.updateState(data);
        this.setState({
            unChanged: true
        });
        alert('Profile updated!');
        // this.props.history.push('/dashboard');
    };
    updateProfileImage = (data, id) => {
        Axios.post(`/api/update/user/image/${id}`, data, {
            onUploadProgress: progressEvent => {
                let progress = Math.round(
                    (progressEvent.loaded / progressEvent.total) * 100
                );
                this.setState({
                    loading: true,
                    progress: progress
                });
            }
        })
            .then(response => {
                this.setState({
                    profile_image: response.data,
                    errors: [],
                    loading: false,
                    progress: 0
                });
                this.props.updateProfileImage(this.state.id);
                alert('Profile saved!');
            })
            .catch(error => {
                console.log(error);
                this.setState({
                    errors: error.response.data.errors,
                    loading: false,
                    progress: 0
                });
            });
    };
    handleFieldChange = (event, hasFile) => {
        if (hasFile) {
            const image = event.target.files[0];
            if (image.size > 4000000) {
                let uploadError = {
                    profile_image: [
                        'The image file must not be greater than 4 MB'
                    ]
                };
                this.setState({
                    errors: uploadError
                });
            } else {
                const data = new FormData();
                data.append('profile_image', image, image.name);
                this.updateProfileImage(data, this.state.id);
            }
        } else {
            this.setState({
                [event.target.name]: event.target.value,
                unChanged: false
            });
        }
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
    toggle = () => {
        this.setState(prevState => ({
            modal: !prevState.modal
        }));
    };
    handleResetPass = event => {
        event.preventDefault();
        const data = {
            old_password: this.state.old_password,
            password: this.state.password,
            password_confirmation: this.state.password_confirmation
        };
        Axios.put(`/api/update/user/password/${this.state.id}`, data)
            .then(({ data }) => {
                alert(data);
                this.toggle();
            })
            .catch(error => {
                this.setState({
                    errors: error.response.data.errors,
                    old_password: '',
                    password: '',
                    password_confirmation: ''
                });
            });
    };
    render() {
        return (
            <>
                <Modal
                    isOpen={this.state.modal}
                    centered={true}
                    toggle={this.toggle}
                >
                    <ModalBody>
                        <div className='p-3'>
                            <div className='mb-3 h4'>Change password</div>
                            <form onSubmit={this.handleResetPass}>
                                <FormGroup>
                                    <label className='small font-weight-bold'>
                                        Old password
                                    </label>
                                    <Input
                                        type='password'
                                        name='old_password'
                                        required
                                        value={this.state.old_password}
                                        onChange={this.handleFieldChange}
                                        className={`form-control ${
                                            this.hasErrorFor('old_password')
                                                ? 'is-invalid'
                                                : ''
                                        }`}
                                    />
                                    {this.renderErrorFor('old_password')}
                                </FormGroup>
                                <FormGroup>
                                    <label className='small font-weight-bold'>
                                        New Password
                                    </label>
                                    <Input
                                        type='password'
                                        name='password'
                                        required
                                        value={this.state.password}
                                        onChange={this.handleFieldChange}
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
                                        value={this.state.password_confirmation}
                                        onChange={this.handleFieldChange}
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
                <Modal
                    isOpen={this.state.loading}
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
                <div className='container'>
                    <div className='display-4 mb-3 text-center'>My Profile</div>
                    <div
                        className='d-flex flex-row justify-content-center'
                        style={{ height: '100px' }}
                    >
                        <div style={{ marginTop: '1rem' }}>
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
                                width={160}
                                height={160}
                                className='rounded-circle'
                            />
                        </div>
                    </div>
                </div>
                <div className='bg-white' style={{ paddingTop: '4.75rem' }}>
                    <div className='container'>
                        <div className='row d-flex justify-content-center'>
                            <div className='col-md-6'>
                                <div>
                                    <form
                                        method='post'
                                        onSubmit={this.handleSubmit}
                                    >
                                        <div className='d-flex flex-row justify-content-center'>
                                            <div className='text-center'>
                                                <input
                                                    className='form-control'
                                                    type='file'
                                                    id='profile_image'
                                                    onChange={event => {
                                                        this.handleFieldChange(
                                                            event,
                                                            true
                                                        );
                                                    }}
                                                    name='profile_image'
                                                    style={{ display: 'none' }}
                                                />
                                                <ChangeImgButton
                                                    variant='contained'
                                                    color='primary'
                                                    onClick={() => {
                                                        document
                                                            .getElementById(
                                                                'profile_image'
                                                            )
                                                            .click();
                                                    }}
                                                >
                                                    Change picture
                                                </ChangeImgButton>
                                                {this.state.errors
                                                    .profile_image ? (
                                                    <div className='small text-danger my-2'>
                                                        {
                                                            this.state.errors
                                                                .profile_image[0]
                                                        }
                                                    </div>
                                                ) : (
                                                    <div className='small text-muted mb-4'>
                                                        Image must not be
                                                        greater than 4 MB
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                        <div className='form-group'>
                                            <label
                                                className='small font-weight-bold'
                                                htmlFor='fname'
                                            >
                                                First Name{' '}
                                            </label>
                                            <input
                                                type='text'
                                                value={this.state.fname}
                                                onChange={
                                                    this.handleFieldChange
                                                }
                                                name='fname'
                                                required
                                                className={`form-control ${
                                                    this.hasErrorFor('fname')
                                                        ? 'is-invalid'
                                                        : ''
                                                }`}
                                            />
                                            {this.renderErrorFor('fname')}
                                        </div>
                                        <div className='form-group'>
                                            <label
                                                className='small font-weight-bold'
                                                htmlFor='mname'
                                            >
                                                Middle Name{' '}
                                            </label>
                                            <input
                                                className='form-control'
                                                type='text'
                                                value={
                                                    this.state.mname != null
                                                        ? this.state.mname
                                                        : ''
                                                }
                                                onChange={
                                                    this.handleFieldChange
                                                }
                                                name='mname'
                                            />
                                        </div>
                                        <div className='form-group'>
                                            <label
                                                className='small font-weight-bold'
                                                htmlFor='lname'
                                            >
                                                Last Name{' '}
                                            </label>
                                            <input
                                                type='text'
                                                value={this.state.lname}
                                                onChange={
                                                    this.handleFieldChange
                                                }
                                                name='lname'
                                                required
                                                className={`form-control ${
                                                    this.hasErrorFor('lname')
                                                        ? 'is-invalid'
                                                        : ''
                                                }`}
                                            />
                                            {this.renderErrorFor('lname')}
                                        </div>
                                        <div className='form-group'>
                                            <label
                                                className='small font-weight-bold'
                                                htmlFor='contact'
                                            >
                                                Contact
                                            </label>
                                            <input
                                                type='text'
                                                value={this.state.contact}
                                                onChange={
                                                    this.handleFieldChange
                                                }
                                                name='contact'
                                                required
                                                className={`form-control ${
                                                    this.hasErrorFor('contact')
                                                        ? 'is-invalid'
                                                        : ''
                                                }`}
                                            />
                                            {this.renderErrorFor('contact')}
                                        </div>
                                        <div className='form-group'>
                                            <label
                                                className='small font-weight-bold'
                                                htmlFor='email'
                                            >
                                                Email{' '}
                                            </label>
                                            <input
                                                type='text'
                                                name='email'
                                                required
                                                value={this.state.email}
                                                onChange={
                                                    this.handleFieldChange
                                                }
                                                className={`form-control ${
                                                    this.hasErrorFor('email')
                                                        ? 'is-invalid'
                                                        : ''
                                                }`}
                                            />
                                            {this.renderErrorFor('email')}
                                        </div>
                                        <div className='form-group mt-4 d-flex flex-row justify-content-end'>
                                            <Button
                                                variant='contained'
                                                color='default'
                                                onClick={() => {
                                                    this.toggle();
                                                }}
                                                disableFocusRipple={true}
                                                disableRipple={true}
                                            >
                                                <VpnKeyRoundedIcon className='mr-2' />
                                                Change Password
                                            </Button>
                                        </div>
                                        <hr />
                                        <div className='d-flex flex-row justify-content-center'>
                                            <SaveButton
                                                type='submit'
                                                variant='contained'
                                                color='primary'
                                                disabled={this.state.unChanged}
                                            >
                                                Save Changes
                                            </SaveButton>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </>
        );
    }
}

const SaveButton = withStyles(theme => ({
    root: {
        margin: theme.spacing(1, 0),
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
        margin: theme.spacing(1, 1),
        color: theme.palette.getContrastText(blue[500]),
        backgroundColor: blue[500],
        '&:hover': {
            backgroundColor: blue[700],
            color: theme.palette.getContrastText(blue[700])
        }
    }
}))(Button);
