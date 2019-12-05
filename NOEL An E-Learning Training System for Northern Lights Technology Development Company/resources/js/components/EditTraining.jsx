import React, { useEffect } from 'react';
import { makeStyles, withStyles } from '@material-ui/core/styles';
import Stepper from '@material-ui/core/Stepper';
import Step from '@material-ui/core/Step';
import StepLabel from '@material-ui/core/StepLabel';
import StepContent from '@material-ui/core/StepContent';
import Button from '@material-ui/core/Button';
import BlankImg from '../../img/undraw_blank_canvas.svg';
import Authenticate from './Auth/Authenticate';
import { ToastContainer, toast } from 'react-toastify';
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
    Button as BSButton,
    Card
} from 'reactstrap';
import styled from 'styled-components';
import PageNotFound from './PageNotFound';
import Loading from './Loading';
import ImageOutlinedIcon from '@material-ui/icons/ImageOutlined';
import LinearProgress from '@material-ui/core/LinearProgress';
import CloseRoundedIcon from '@material-ui/icons/CloseRounded';
import IconButton from '@material-ui/core/IconButton';
import SectionPanel from './SectionPanel';
import EditCertificate from './Certificate/EditCertificate';
import PostEditTraining from './PostEditTraining';

const useStyles = makeStyles(theme => ({
    root: {
        width: '90%'
    },
    button: {
        marginTop: theme.spacing(1),
        marginRight: theme.spacing(1)
    },
    actionsContainer: {
        marginBottom: theme.spacing(2)
    },
    resetContainer: {
        padding: theme.spacing(3)
    }
}));

function getSteps() {
    return [
        'Edit training details',
        'Create training topic content',
        'Customize certificate'
    ];
}

export const notifyA = () => {
    toast.dismiss();
    toast(
        ({ closeToast }) => (
            <div className='d-flex flex-row h6 bg-success text-white rounded p-3 m-2 justify-content-between align-items-center shadow-sm'>
                <div>Training Saved!</div>
                <div>
                    <IconButton
                        onClick={closeToast}
                        className='text-white'
                        size='small'>
                        <CloseRoundedIcon fontSize='inherit' />
                    </IconButton>
                </div>
            </div>
        ),
        { containerId: 'A' }
    );
};

function getStepContent(step, props) {
    switch (step) {
        case 0:
            return <TrainingInfoPanel {...props} notify={notifyA} />;
        case 1:
            const trainingId = props.match.params.id;
            return <SectionPanel id={trainingId} />;
        case 2:
            return <EditCertificate {...props} />;
        default:
            return 'Unknown step';
    }
}

export default function EditTraining(props) {
    const classes = useStyles();
    const [activeStep, setActiveStep] = React.useState(0);
    const [trainingID, setTrainingID] = React.useState(null);
    const [isLectureTest, setIsLectureTest] = React.useState(false);
    const [error, setError] = React.useState(null);
    const [willEdit, setWillEdit] = React.useState(false);
    const [user, setUser] = React.useState({});
    const [loading, setLoading] = React.useState(false);
    const [notFound, setNotFound] = React.useState(false);
    const steps = getSteps();
    const trainingId = props.match.params.id;
    const getQuestions = id => {
        const fetchData = async () => {
            const result = await Axios.get(`/api/lecture/${id}/test`).catch(
                error => console.log(error.response)
            );
            // May content ang iyang test
            result.data.length > 0 ? setIsLectureTest(true) : null;
        };
        fetchData();
    };
    useEffect(() => {
        Authenticate.getCurrentUser(user => {
            if (user.isAdmin || user.isHR) {
                setLoading(true);
                setUser(user);
                Axios.get(`/api/edit/training/${trainingId}`)
                    .then(({ data }) => {
                        if (!data.isFinal) {
                            setActiveStep(data.step);
                            setTrainingID(data.id);
                            data.sections.length > 0
                                ? data.sections[0].lectures.length > 0
                                    ? data.sections[0].lectures[0].isTest
                                        ? getQuestions(
                                              data.sections[0].lectures[0].id
                                          )
                                        : setIsLectureTest(false)
                                    : null
                                : null;
                        } else {
                            setWillEdit(true);
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 404) {
                            setNotFound(true);
                        }
                    });
            }
        });
    }, [trainingId]);
    const handleNext = () => {
        if (activeStep === 1) {
            handleCheckLecture(trainingID);
        } else if (activeStep === steps.length - 1) {
            handleFinalize();
        } else {
            Axios.put(`/api/update/training/add/step/${trainingId}`);
            setActiveStep(prevActiveStep => prevActiveStep + 1);
        }
    };
    const handleBack = () => {
        Axios.put(`/api/update/training/sub/step/${trainingId}`);
        setActiveStep(prevActiveStep => prevActiveStep - 1);
    };
    const handleFinalize = () => {
        Axios.put(`/api/update/training/finalize/${trainingId}`);
        alert('Training Saved!');
        props.history.push('/dashboard');
    };
    const handleCheckLecture = trainingId => {
        var status = false;
        var fillSec = true;
        const proceed = () => {
            setError(null);
            setActiveStep(prevActiveStep => prevActiveStep + 1);
            Axios.put(`/api/update/training/add/step/${trainingId}`);
        };
        const checkData = sections => {
            if (sections.length !== 0) {
                fillSec = false;
                const hasLecture =
                    sections[0].lectures.length > 0 ? true : false;
                if (hasLecture) {
                    const lecture = sections[0].lectures[0];
                    if (lecture.isTest) {
                        status = isLectureTest ? true : false;
                    } else {
                        status = lecture.content !== null ? true : false;
                    }
                } else {
                    status = false;
                }
            }
            status
                ? proceed()
                : fillSec
                ? alert('Please create a topic for the training')
                : setError(
                      'Please fill at least one topic with lecture or test contents'
                  );

            // status
            //     ? proceed()
            //     : fillSec
            //     ? alert('Please create a topic for the training')
            //     : alert('Please fill the topic with lecture or test contents');
        };
        const fetchData = async () => {
            const result = await Axios.get(`/api/training/${trainingId}`).catch(
                error => console.log(error.response)
            );
            const { data } = result;
            checkData(data.sections);
        };
        fetchData();
    };
    if (!loading) {
        return <div>&nbsp;</div>;
    }
    if (notFound) {
        return <PageNotFound />;
    }
    if (willEdit) {
        return <PostEditTraining {...props} />;
    } else {
        return (
            <Container className='d-flex flex-column justify-content-center'>
                <div className='display-4 mb-3'>Create Training</div>
                <div className={`${classes.root} m-auto mt-3`}>
                    <Stepper activeStep={activeStep} orientation='vertical'>
                        {steps.map((label, index) => (
                            <Step key={label}>
                                <StepLabel>{label}</StepLabel>
                                <StepContent>
                                    {!error ? null : (
                                        <div className='d-flex flex-row justify-content-between align-items-center h6 bg-danger text-white mb-3 p-3 rounded'>
                                            <div>{error}</div>
                                            <div>
                                                <IconButton
                                                    size='small'
                                                    onClick={() => {
                                                        setError(null);
                                                    }}
                                                    color='inherit'>
                                                    <CloseRoundedIcon fontSize='inherit' />
                                                </IconButton>
                                            </div>
                                        </div>
                                    )}
                                    {getStepContent(index, props)}
                                    <div className={classes.actionsContainer}>
                                        <div>
                                            <Button
                                                disabled={activeStep === 0}
                                                onClick={handleBack}
                                                className={classes.button}>
                                                Back
                                            </Button>
                                            <Button
                                                variant='contained'
                                                color='primary'
                                                onClick={handleNext}
                                                className={classes.button}>
                                                {activeStep === steps.length - 1
                                                    ? 'Finish'
                                                    : 'Next'}
                                            </Button>
                                        </div>
                                    </div>
                                </StepContent>
                            </Step>
                        ))}
                    </Stepper>
                </div>
            </Container>
        );
    }
}

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

export class TrainingInfoPanel extends React.Component {
    add;
    state = {
        training: {},
        id: '',
        title: '',
        description: '',
        duration: null,
        completion: null,
        skill: '',
        skill_list: [],
        image: null,
        loading: true,
        errors: [],
        failedToFetch: false,
        notFound: false,
        modal: false,
        progress: 0,
        canEdit: false,
        hasEdited: false
    };
    componentDidMount = () => {
        const trainingId = this.props.match.params.id;
        Authenticate.getCurrentUser(user => {
            if (user.isAdmin || user.isHR) {
                this.setState({
                    canEdit: true
                });
            } else {
                this.props.history.push('/');
            }
        });
        Axios.get(`/api/training/${trainingId}`).then(response => {
            this.setState({
                training: response.data,
                id: response.data.id,
                title: response.data.title,
                description: response.data.description,
                duration: response.data.duration,
                completion: response.data.completion,
                image: response.data.image,
                skill_list: JSON.parse(response.data.skills),
                loading: false
            });
        });
    };
    toggle = () => {
        this.setState(prevState => ({
            modal: !prevState.modal,
            progress: 0
        }));
    };
    handleSubmit = event => {
        event.preventDefault();
        let training = this.getTrainingState();
        this.submitTraining(training);
        this.setState({
            hasEdited: false
        });
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
                this.submitTraining(training, true);
            }
        }
    };
    getTrainingState = image => {
        let training = new FormData();
        training.append('title', this.state.title);
        training.append('duration', this.state.duration);
        training.append('completion', this.state.completion);
        training.append('skills', JSON.stringify(this.state.skill_list));

        if (this.state.description !== null) {
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
    submitTraining = (training, hasFile) => {
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
                    // this.notifyA();
                    this.props.notify();
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
                    // this.notifyA();
                    this.props.notify();
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
    handleFieldChange = event => {
        this.setState({
            [event.target.name]: event.target.value,
            hasEdited: true
        });
    };
    handleAddSkill = () => {
        this.setState({
            skill_list: [...this.state.skill_list, this.state.skill],
            skill: ''
        });
    };
    handleAdd = event => {
        if (event.keyCode == 13) {
            event.preventDefault();
            if (this.state.skill != '') {
                this.handleAddSkill();
            }
        }
    };
    handleDeleteSkill = deleteSkill => {
        const result = this.state.skill_list.filter(skill => {
            return skill != deleteSkill;
        });
        this.setState({
            skill_list: result
        });
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
            <>
                <ToastContainer
                    enableMultiContainer
                    containerId={'A'}
                    closeButton={false}
                />
                {/* <ToastContainer
                    closeButton={false}
                    position='top-right'
                    hideProgressBar={true}
                    closeOnClick={false}
                    pauseOnHover={false}
                    draggable={false}
                    autoClose={5000}
                /> */}
                <Modal
                    isOpen={this.state.modal}
                    backdrop='static'
                    centered={true}>
                    <ModalBody>
                        <LinearProgress
                            color='primary'
                            variant='determinate'
                            value={this.state.progress}></LinearProgress>
                        <div className='text-center'>
                            <h5>Uploading</h5>
                        </div>
                    </ModalBody>
                </Modal>
                <PanelContainer>
                    <Card body className='border-0 shadow-sm'>
                        <Form
                            onSubmit={this.handleSubmit}
                            encType='multipart/form-data'
                            method='post'>
                            <Row>
                                <div className='col-4'>
                                    <div className='d-flex flex-column'>
                                        <img
                                            src={
                                                this.state.image
                                                    ? `/storage/trainings/${this.state.image}`
                                                    : BlankImg
                                            }
                                            alt={
                                                this.state.image
                                                    ? this.state.image
                                                    : 'no image'
                                            }
                                            className='img-thumbnail'
                                        />
                                        <div className='my-2'>
                                            <small className='text-muted'>
                                                Image must not be greater than
                                                4MB
                                            </small>
                                        </div>
                                        <Button
                                            variant='outlined'
                                            color='default'
                                            onClick={() => {
                                                document
                                                    .getElementById('image')
                                                    .click();
                                            }}>
                                            <ImageOutlinedIcon className='mr-2' />
                                            Choose an image
                                        </Button>
                                        {this.state.errors.image ? (
                                            <div className='small text-danger my-2'>
                                                {this.state.errors.image[0]}
                                            </div>
                                        ) : null}
                                        <Input
                                            type='file'
                                            name='image'
                                            id='image'
                                            style={{ display: 'none' }}
                                            onChange={event =>
                                                this.handleImgChange(event)
                                            }
                                        />
                                    </div>
                                </div>
                                <Col>
                                    <FormGroup>
                                        <SmallLabel className='h6 small'>
                                            Training title
                                        </SmallLabel>
                                        <Input
                                            type='text'
                                            name='title'
                                            id='title'
                                            value={this.state.title}
                                            onChange={this.handleFieldChange}
                                            required
                                        />
                                    </FormGroup>
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
                                                    value={this.state.duration}
                                                    onChange={
                                                        this.handleFieldChange
                                                    }
                                                    min={1}
                                                    max={30}
                                                    placeholder='(max: 30)'></Input>
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
                                                    value={
                                                        this.state.completion
                                                    }
                                                    onChange={
                                                        this.handleFieldChange
                                                    }
                                                    min={1}
                                                    max={24}
                                                    placeholder='(max: 24)'></Input>
                                            </FormGroup>
                                        </Col>
                                    </Row>
                                    <FormGroup>
                                        <SmallLabel className='h6 small'>
                                            Training Description
                                        </SmallLabel>
                                        <textarea
                                            name='description'
                                            id='description'
                                            rows='3'
                                            placeholder=''
                                            value={this.state.description || ''}
                                            onChange={this.handleFieldChange}
                                            className='form-control'></textarea>
                                    </FormGroup>
                                </Col>
                            </Row>
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
                                        value={this.state.skill}
                                        onChange={this.handleFieldChange}
                                        className={'form-control'}
                                        onKeyDown={event =>
                                            this.handleAdd(event)
                                        }
                                    />
                                    <InputGroupAddon addonType='append'>
                                        <Button
                                            color='default'
                                            variant='outlined'
                                            onClick={() => {
                                                this.handleAddSkill();
                                            }}
                                            ref={b => (this.add = b)}
                                            type='button'>
                                            Add
                                        </Button>
                                    </InputGroupAddon>
                                </InputGroup>
                                <div className='d-flex flex-row my-2'>
                                    <div>
                                        {this.state.skill_list.map(skill => (
                                            <span
                                                className='badge badge-pill badge-primary shadow-sm small mt-2 mr-2'
                                                key={skill}>
                                                {skill}
                                                <IconButton
                                                    size='small'
                                                    onClick={() =>
                                                        this.handleDeleteSkill(
                                                            skill
                                                        )
                                                    }>
                                                    <CloseRoundedIcon fontSize='inherit' />
                                                </IconButton>
                                            </span>
                                        ))}
                                    </div>
                                </div>
                            </div>
                            <div className='d-flex justify-content-end mt-3'>
                                <Button
                                    type='submit'
                                    color='default'
                                    variant='contained'
                                    disabled={!this.state.hasEdited}>
                                    Save changes
                                </Button>
                            </div>
                        </Form>
                    </Card>
                </PanelContainer>
            </>
        );
    }
}
