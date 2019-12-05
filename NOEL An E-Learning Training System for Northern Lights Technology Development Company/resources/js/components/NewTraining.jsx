import React from 'react';
import Axios from 'axios';
import {
    Button,
    Modal,
    ModalBody,
    Tooltip,
    InputGroup,
    Input,
    InputGroupAddon
} from 'reactstrap';
import LinearProgress from '@material-ui/core/LinearProgress';
import Slider from '@material-ui/core/Slider';
import { FaQuestionCircle } from 'react-icons/fa';
import IconButton from '@material-ui/core/IconButton';
import CloseRoundedIcon from '@material-ui/icons/CloseRounded';
import Authenticate from './Auth/Authenticate';

const sliderLabelDuration = () => {
    let data = [];
    for (let i = 1; i <= 30; i++) {
        data.push({
            value: i,
            label: `${i}`
        });
    }
    return data;
};

const sliderLabelCompletion = () => {
    let data = [];
    for (let i = 1; i <= 24; i++) {
        data.push({
            value: i,
            label: `${i}`
        });
    }
    return data;
};

const durationMarks = sliderLabelDuration();
const completionMarks = sliderLabelCompletion();

export default class NewTraining extends React.Component {
    add;
    constructor(props) {
        super(props);
        this.state = {
            title: '',
            description: '',
            duration: 1,
            completion: 1,
            image: null,
            errors: [],
            modal: false,
            progress: 0,
            tooltipSkills: false,
            tooltipDuration: false,
            skill: '',
            skill_list: [],
            user_id: ''
        };

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleFieldChange = this.handleFieldChange.bind(this);
        this.hasErrorFor = this.hasErrorFor.bind(this);
        this.renderErrorFor = this.renderErrorFor.bind(this);
        this.redirectUser = this.redirectUser.bind(this);
        this.toggleDuration = this.toggleDuration.bind(this);
        this.toggleSkill = this.toggleSkill.bind(this);
    }

    componentDidMount = () => {
        if (
            this.props.location.state !== undefined &&
            this.props.location.state.title !== null
        ) {
            const { location } = this.props;
            this.setState({
                title: location.state.title
            });
        }
        Authenticate.getCurrentUser(user => {
            this.setState({
                user_id: user.id
            });
        });
    };

    handleSubmit = event => {
        event.preventDefault();
        let errors = 0;
        const training = new FormData();
        training.append('title', this.state.title);
        training.append('user', this.state.user_id);
        training.append('duration', this.state.duration);
        training.append('completion', this.state.completion);
        training.append('skills', JSON.stringify(this.state.skill_list));

        if (this.state.description !== '') {
            training.append('description', this.state.description);
        } else {
            training.append('description', '');
        }

        if(this.props.location.state !== undefined) {
            training.append('suggested', this.props.location.state.id);
        }

        if (this.state.image) {
            if (this.state.image.size > 4000000) {
                let uploadError = {
                    image: ['The image file must not be greater than 4 MB']
                };
                errors++;
                this.setState({
                    errors: uploadError
                });
            } else {
                this.setState({
                    errors: []
                });
                training.append(
                    'image',
                    this.state.image,
                    this.state.image.name
                );
            }
        }

        if (errors != 1) {
            Axios.post('/api/trainings', training, {
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
                    this.redirectUser(response.data.id);
                })
                .catch(error => {
                    if (error.response) {
                        // Populate the errors state
                        this.setState({
                            errors: error.response.data.errors,
                            modal: false
                        });
                    }
                });
        }
    };

    redirectUser = id => {
        const { history } = this.props;
        history.push(`/edit/training/${id}`);
    };

    handleFieldChange = (event, hasFile) => {
        this.setState({
            [event.target.name]: hasFile
                ? event.target.files[0]
                : event.target.value
        });
    };

    handleSliderChange = name => (event, value) => {
        this.setState({
            [name]: value
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

    valuetext = value => {
        return `${value}`;
    };

    valueLabelFormat = value => {
        return marks.findIndex(mark => mark.value === value) + 1;
    };

    toggleSkill = () => {
        this.setState({
            tooltipSkills: !this.state.tooltipSkills
        });
    };

    toggleDuration = () => {
        this.setState({
            tooltipDuration: !this.state.tooltipDuration
        });
    };

    handleAddSkill = () => {
        if (this.state.skill != '') {
            this.setState({
                skill_list: [...this.state.skill_list, this.state.skill],
                skill: ''
            });
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

    handleAdd = event => {
        if (event.keyCode == 13) {
            event.preventDefault();
            this.add.onClick();
        }
    };

    render() {
        const classes = 'tooltip-inner';
        return (
            <div className='container my-3'>
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
                <div className='row justify-content-center align-items-center'>
                    <div className='col-lg-7'>
                        <h4 className='mb-3'>New Training</h4>
                        <form
                            method='post'
                            encType='multipart/form-data'
                            onSubmit={this.handleSubmit}>
                            <div className='form-group'>
                                <label htmlFor='' className='h6'>
                                    Training Title{' '}
                                    <small className='text-muted'>
                                        (Required)
                                    </small>
                                </label>
                                <input
                                    type='text'
                                    name='title'
                                    id='title'
                                    placeholder=''
                                    value={this.state.title}
                                    onChange={this.handleFieldChange}
                                    className={`form-control ${
                                        this.hasErrorFor('title')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('title')}
                            </div>
                            <div className='form-group'>
                                <label htmlFor='' className='h6'>
                                    Training Description{' '}
                                    <small className='text-muted'>
                                        (Optional)
                                    </small>
                                </label>
                                <textarea
                                    name='description'
                                    id='description'
                                    rows='5'
                                    placeholder=''
                                    value={this.state.description}
                                    onChange={this.handleFieldChange}
                                    className={`form-control ${
                                        this.hasErrorFor('description')
                                            ? 'is-invalid'
                                            : ''
                                    }`}></textarea>
                                {this.renderErrorFor('description')}
                            </div>
                            <div className='form-group'>
                                <label htmlFor='image'>
                                    Training Image{' '}
                                    <small className='text-muted'>
                                        (Maximum image file size of 4MB)
                                        (Optional)
                                    </small>
                                </label>
                                <input
                                    type='file'
                                    name='image'
                                    id='image'
                                    onChange={event =>
                                        this.handleFieldChange(event, true)
                                    }
                                    className={`form-control-file ${
                                        this.hasErrorFor('image')
                                            ? 'is-invalid'
                                            : ''
                                    }`}
                                />
                                {this.renderErrorFor('image')}
                            </div>

                            <div className='form-group'>
                                <label htmlFor='' className='h6'>
                                    Skills{' '}
                                    <small className='text-muted'>
                                        (Optional){' '}
                                    </small>
                                    <span
                                        style={{
                                            color: 'gray'
                                        }}
                                        id='SkillsTooltip'>
                                        <FaQuestionCircle />
                                    </span>
                                    <Tooltip
                                        placement='top'
                                        isOpen={this.state.tooltipSkills}
                                        target='SkillsTooltip'
                                        toggle={this.toggleSkill}
                                        className={classes}>
                                        What are the skills to be acquired by
                                        the enrollee
                                    </Tooltip>
                                </label>
                                <InputGroup>
                                    <Input
                                        type='text'
                                        name='skill'
                                        id='skill'
                                        placeholder='Enter skill'
                                        value={this.state.skill}
                                        onChange={this.handleFieldChange}
                                        className={'form-control'}
                                        onKeyDown={event => {
                                            this.handleAdd(event);
                                        }}
                                    />
                                    <InputGroupAddon addonType='append'>
                                        <Button
                                            color='primary'
                                            onClick={this.handleAddSkill}
                                            ref={b => (this.add = b)}>
                                            Add
                                        </Button>
                                    </InputGroupAddon>
                                </InputGroup>
                                <div className='d-flex flex-row my-2'>
                                    <div>
                                        {this.state.skill_list.map(skill => (
                                            <span
                                                key={skill}
                                                className='badge badge-pill badge-primary shadow-sm small mt-2 mr-2'>
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
                                {this.renderErrorFor('description')}
                            </div>

                            <div className='form-group'>
                                <label
                                    htmlFor='duration'
                                    id='duration-slider'
                                    className='h6'>
                                    Training Period{' '}
                                    <small className='text-muted'>
                                        (Days) (Optional){' '}
                                    </small>
                                    <span
                                        style={{
                                            color: 'gray'
                                        }}
                                        id='DurationTooltip'>
                                        <FaQuestionCircle />
                                    </span>
                                    <Tooltip
                                        placement='top'
                                        isOpen={this.state.tooltipDuration}
                                        target='DurationTooltip'
                                        toggle={this.toggleDuration}
                                        className={classes}>
                                        The number of days given to the employee
                                        to finish the training
                                    </Tooltip>
                                </label>
                                <div className='mt-4 pt-2'>
                                    <Slider
                                        defaultValue={1}
                                        aria-labelledby='duration-slider'
                                        valueLabelDisplay='on'
                                        getAriaValueText={this.valuetext}
                                        marks={durationMarks}
                                        onChange={this.handleSliderChange(
                                            'duration'
                                        )}
                                        min={1}
                                        max={30}
                                        value={this.state.duration}
                                    />
                                </div>
                            </div>
                            <div className='form-group'>
                                <label
                                    htmlFor='duration'
                                    id='completion-slider'
                                    className='h6'>
                                    Approximate Completion Time
                                    <small className='text-muted'>
                                        {' '}
                                        (Hours) (Required)
                                    </small>
                                </label>
                                <div className='mt-4 pt-2'>
                                    <Slider
                                        defaultValue={1}
                                        aria-labelledby='completion-slider'
                                        valueLabelDisplay='on'
                                        getAriaValueText={this.valuetext}
                                        marks={completionMarks}
                                        onChange={this.handleSliderChange(
                                            'completion'
                                        )}
                                        min={1}
                                        max={24}
                                        value={this.state.completion}
                                    />
                                </div>
                            </div>
                            <Button color='primary' type='submit'>
                                Create
                            </Button>
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}
