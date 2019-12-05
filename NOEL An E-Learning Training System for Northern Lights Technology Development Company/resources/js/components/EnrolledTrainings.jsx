import React from 'react';
import Axios from 'axios';
import NoEnrolledTraining from './NoEnrolledTraining';
import { Link } from 'react-router-dom';
import { Row, Col, Button, Form, FormGroup, Input } from 'reactstrap';
import CardContainer from './Training/CardContainer';
import BlankImg from '../../img/undraw_blank_canvas.svg';
import Loading from './Loading';
import Authenticate from './Auth/Authenticate';
import { makeStyles } from '@material-ui/core/styles';
import Modal from '@material-ui/core/Modal';
import Backdrop from '@material-ui/core/Backdrop';
import Fade from '@material-ui/core/Fade';
import IconButton from '@material-ui/core/IconButton';
import ErrorIcon from '@material-ui/icons/Error';
import CloseRoundedIcon from '@material-ui/icons/CloseRounded';
import Snackbar from '@material-ui/core/Snackbar';
import SnackbarContent from '@material-ui/core/SnackbarContent';
import CheckCircleIcon from '@material-ui/icons/CheckCircle';
import { green } from '@material-ui/core/colors';

export default class EnrolledTrainings extends React.Component {
    state = {
        enrolledTrainings: [],
        loading: true,
        errors: [],
        canSuggest: false,
        showSnackbar: false,
        success: false,
        id: null
    };
    componentDidMount = () => {
        // get all enrolled trainings of the current user
        // console.log(this.props);
        Authenticate.getCurrentUser(user => {
            if (user.isManager) {
                this.setState({
                    canSuggest: true,
                    id: user.id
                });
            }
        });
        this.getEnrolledTrainings(this.props.user.id);
    };
    getEnrolledTrainings = id => {
        Axios.get(`/api/enrolled/trainings/${id}`)
            .then(response => {
                this.setState({
                    enrolledTrainings: response.data,
                    loading: false
                });
            })
            .catch(error => console.log(error.response));
    };
    handleRequestTraining = title => {
        const data = {
            title: title,
            user_id: this.state.id
        };
        Axios.post('/api/suggested', data)
            .then(response => {
                this.setState({
                    success: true,
                    showSnackbar: true
                });
            })
            .catch(error => {
                console.log(error.response);
                this.setState({
                    success: false,
                    showSnackbar: true
                });
            });
    };
    toggleSnackbar = status => {
        this.setState({
            showSnackbar: status
        });
    };
    render() {
        const { enrolledTrainings } = this.state;
        let allFinished = true;
        enrolledTrainings.filter(training => {
            training.is_completed ? null : (allFinished = false);
        });
        if (this.state.loading) {
            return <Loading />;
        }
        if (enrolledTrainings.length === 0 || allFinished) {
            let result;
            if (this.props.showFinished) {
                result = this.state.enrolledTrainings.filter(training => {
                    return training.is_completed == true;
                });
            } else {
                result = this.state.enrolledTrainings.filter(training => {
                    return training.is_completed == false;
                });
            }
            return (
                <>
                    <div>
                        <NoEnrolledTraining>
                            <p>You don't have any active trainings right now</p>
                        </NoEnrolledTraining>
                        <div className='d-flex justify-content-center my-3'>
                            <ExploreTrainingsBtn />
                            {this.state.canSuggest ? (
                                <RequestTrainingModal
                                    submit={this.handleRequestTraining}
                                />
                            ) : null}
                        </div>
                    </div>
                    {this.props.showFinished ? (
                        <div className='mt-5'>
                            <div>
                                <h4>Finished trainings</h4>
                            </div>
                            <Row>
                                <TrainingItem trainings={result} />
                            </Row>
                        </div>
                    ) : null}
                    <SuccessSnackBar
                        open={this.state.showSnackbar}
                        status={this.state.success}
                        toggle={this.toggleSnackbar}
                    />
                </>
            );
        }
        const result = this.state.enrolledTrainings.filter(training => {
            return training.is_completed == false;
        });
        return (
            <>
                <div>
                    <Row>
                        <TrainingItem trainings={result} />
                    </Row>
                    <div className='d-flex flex-row mt-4'>
                        <ExploreTrainingsBtn />
                        {this.state.canSuggest ? (
                            <RequestTrainingModal
                                className='ml-3'
                                submit={this.handleRequestTraining}
                            />
                        ) : null}
                    </div>
                </div>
                <SuccessSnackBar
                    open={this.state.showSnackbar}
                    status={this.state.success}
                    toggle={this.toggleSnackbar}
                />
            </>
        );
    }
}

const ExploreTrainingsBtn = () => (
    <Link to='/trainings' className='btn btn-primary'>
        Explore Trainings
    </Link>
);

const TrainingItem = props => {
    let { trainings } = props;
    const items = trainings.map(enrolled => (
        <div
            className='col-md-6 col-lg-6 d-flex align-items-stretch'
            key={enrolled.id}>
            <CardContainer className='card'>
                <Link
                    to={`enrolled/training/${enrolled.id}`}
                    className='text-decoration-none'>
                    <div
                        className={`d-flex justify-content-center ${
                            !enrolled.training.image ? 'border-bottom' : ''
                        }`}>
                        <img
                            src={
                                enrolled.training.image
                                    ? `/storage/trainings/${enrolled.training.image}`
                                    : BlankImg
                            }
                            alt='image'
                            className='card-img-top'
                        />
                    </div>
                    <div className='card-body text-truncate'>
                        <h5 className='mb-0 text-truncate'>
                            {enrolled.training.title}
                        </h5>
                    </div>
                </Link>
            </CardContainer>
        </div>
    ));
    return items;
    // return null;
};

const useStyles = makeStyles(theme => ({
    modal: {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center'
    },
    paper: {
        backgroundColor: theme.palette.background.paper,
        border: '2px solid #000',
        boxShadow: theme.shadows[5],
        width: '100%',
        overflow: 'auto',
        maxHeight: 356,
        margin: theme.spacing(0, 1),
        [theme.breakpoints.up('sm')]: {
            margin: theme.spacing(0),
            width: 600
        }
    },
    title: {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
        marginBottom: theme.spacing(2),
        padding: theme.spacing(2, 4)
    },
    content: {
        padding: theme.spacing(3, 4)
    }
}));

const useSnackBarStyles = makeStyles(theme => ({
    success: {
        backgroundColor: green[600]
    },
    error: {
        backgroundColor: theme.palette.error.dark
    },
    margin: {
        margin: theme.spacing(1)
    },
    message: {
        display: 'flex',
        alignItems: 'center'
    },
    icon: {
        fontSize: 20
    },
    iconVariant: {
        opacity: 0.9,
        marginRight: theme.spacing(1)
    }
}));

const RequestTrainingModal = ({ submit }) => {
    const classes = useStyles();
    const [open, setOpen] = React.useState(false);
    const [title, setTitle] = React.useState('');

    const handleOpen = () => {
        setOpen(true);
    };
    const handleClose = () => {
        setOpen(false);
    };
    const handleSubmit = event => {
        event.preventDefault();
        const data = title;
        setTitle('');
        setOpen(false);
        submit(data);
    };
    return (
        <div>
            <Button
                color='secondary'
                outline
                onClick={handleOpen}
                className='ml-2'>
                Request a training
            </Button>
            <Modal
                aria-labelledby='transition-modal-title'
                aria-describedby='transition-modal-description'
                className={classes.modal}
                open={open}
                onClose={handleClose}
                closeAfterTransition
                BackdropComponent={Backdrop}
                BackdropProps={{
                    timeout: 500
                }}>
                <Fade in={open}>
                    <div className={classes.paper}>
                        <div
                            className={`${classes.title} border-bottom bg-light`}>
                            <div className='h4 mb-0'>Request a training</div>
                            <div>
                                <IconButton onClick={handleClose}>
                                    <CloseRoundedIcon />
                                </IconButton>
                            </div>
                        </div>
                        <div className={classes.content}>
                            <Form onSubmit={handleSubmit}>
                                <FormGroup row>
                                    <Col sm={4}>
                                        <label className='h6 mb-0'>
                                            Training Title
                                        </label>
                                    </Col>
                                    <Col>
                                        <Input
                                            type='text'
                                            name='title'
                                            onChange={event => {
                                                setTitle(event.target.value);
                                            }}
                                            autoFocus
                                            value={title}
                                            required
                                        />
                                    </Col>
                                </FormGroup>
                                <div className='d-flex flex-row-reverse'>
                                    <Button color='primary' type='submit'>
                                        Send
                                    </Button>
                                </div>
                            </Form>
                        </div>
                    </div>
                </Fade>
            </Modal>
        </div>
    );
};

const SuccessSnackBar = ({ open, toggle, status }) => {
    const classes = useSnackBarStyles();
    const handleClose = (event, reason) => {
        if (reason === 'clickaway') {
            return;
        }
        toggle(false);
    };

    return (
        <Snackbar
            anchorOrigin={{
                vertical: 'bottom',
                horizontal: 'left'
            }}
            open={open}
            autoHideDuration={4000}
            onClose={handleClose}>
            <SnackbarContent
                className={status ? classes.success : classes.error}
                aria-describedby='client-snackbar'
                message={
                    status ? (
                        <span id='client-snackbar' className={classes.message}>
                            <CheckCircleIcon className={classes.iconVariant} />
                            Request sent successfully
                        </span>
                    ) : (
                        <span id='client-snackbar' className={classes.message}>
                            <ErrorIcon className={classes.iconVariant} />
                            An error occured
                        </span>
                    )
                }
                action={[
                    <IconButton
                        key='close'
                        aria-label='close'
                        color='inherit'
                        onClick={handleClose}>
                        <CloseRoundedIcon className={classes.icon} />
                    </IconButton>
                ]}
            />
        </Snackbar>
    );
};
