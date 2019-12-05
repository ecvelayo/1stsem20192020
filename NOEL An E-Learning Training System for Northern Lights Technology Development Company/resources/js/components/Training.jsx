import React from 'react';
import { Link } from 'react-router-dom';
import Axios from 'axios';
import styled from 'styled-components';
import {
    TabContent,
    TabPane,
    Nav,
    NavItem,
    NavLink,
    Row,
    Button
} from 'reactstrap';
import PageNotFound from './PageNotFound';
import Loading from './Loading';
import FailedToFetchData from './FailedToFetchData';
import Authenticate from './Auth/Authenticate';
import { makeStyles } from '@material-ui/core/styles';
import Typography from '@material-ui/core/Typography';
import ExpansionPanel from '@material-ui/core/ExpansionPanel';
import ExpansionPanelDetails from '@material-ui/core/ExpansionPanelDetails';
import ExpansionPanelSummary from '@material-ui/core/ExpansionPanelSummary';
import ExpandMoreIcon from '@material-ui/icons/ExpandMore';
import Chip from '@material-ui/core/Chip';
import { PDFExport } from '@progress/kendo-react-pdf';
import { MainContainer } from './Certificate/EditCertificate';
import { grey } from '@material-ui/core/colors';
import LinearProgress from '@material-ui/core/LinearProgress';

const GradientBg = styled.div`
    background-image: linear-gradient(135deg, #3c8ce7 30%, #4fc3f7 80%);
`;

const CenterContainer = styled.div`
    position: fixed;
    z-index: 1031;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
`;

export default class Training extends React.Component {
    _isMounted = false;
    state = {
        training: [],
        loading: true,
        failedToFetch: false,
        notFound: false
    };

    componentDidMount = () => {
        const trainingId = this.props.match.params.id;
        Axios.get(`/api/training/${trainingId}`)
            .then(response => {
                if (!response.data.isFinal) {
                    this.props.history.push(
                        `/edit/training/${response.data.id}`
                    );
                } else {
                    this.setState({
                        training: response.data,
                        loading: false
                    });
                }
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

    componentWillUnmount() {
        this._isMounted = false;
    }

    render() {
        const { training } = this.state;
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
            <div>
                <GradientBg className='text-white'>
                    <div className='container'>
                        <div className='row'>
                            <div className='col-lg'>
                                <div className='my-5'>
                                    <h1>{training.title}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </GradientBg>
                <TabComponent
                    training={training}
                    histo={this.props}></TabComponent>
            </div>
        );
    }
}

const ApproxHours = props => (
    <div className='row my-3'>
        <div className='col-sm d-flex align-items-center'>
            <svg
                version='1.1'
                xmlns='http://www.w3.org/2000/svg'
                width='20'
                height='20'
                viewBox='0 0 129 129'
                xmlnsXlink='http://www.w3.org/1999/xlink'
                enableBackground='new 0 0 129 129'>
                <path d='M64.5,122.3c32,0,57.9-26,57.9-57.9c0-32-26-57.9-57.9-57.9S6.6,32.4,6.6,64.4C6.6,96.3,32.5,122.3,64.5,122.3z     M64.5,14.6c27.5,0,49.8,22.3,49.8,49.8c0,27.5-22.3,49.8-49.8,49.8S14.7,91.8,14.7,64.4C14.7,36.9,37,14.6,64.5,14.6z' />
                <path d='m61.8,71.2h19.3c2.3,0 4.1-1.8 4.1-4.1 0-2.3-1.8-4.1-4.1-4.1h-15.2v-23.8c0-2.3-1.8-4.1-4.1-4.1s-4.1,1.8-4.1,4.1v27.9c0,2.3 1.8,4.1 4.1,4.1z' />
            </svg>
            <span className='ml-3 h4 mb-0 h6'>
                Approx. {props.completion} hours to complete
            </span>
        </div>
    </div>
);

const Duration = props => (
    <div className='row my-3'>
        <div className='col-md d-flex align-items-center'>
            <svg
                version='1.1'
                xmlns='http://www.w3.org/2000/svg'
                width='20'
                height='20'
                viewBox='0 0 129 129'
                xmlnsXlink='http://www.w3.org/1999/xlink'
                enableBackground='new 0 0 129 129'>
                <path d='m108.8,27.1c1.6-0.2 2.9-1.4 3.3-3 0.4-1.5-0.1-3.2-1.3-4.2-10.4-8.8-23.7-13.7-37.4-13.7-32.1,8.88178e-16-58.3,26.1-58.3,58.3s26.1,58.3 58.3,58.3c14.4,0 28.3-5.4 39.1-15.1 1.2-1.1 1.6-2.8 1.2-4.3s-1.8-2.6-3.4-2.8c-18.6-2.2-32.7-18-32.7-36.8-0.1-18.5 13.1-33.9 31.2-36.7zm-39.5,36.6c0,19.8 12.8,36.9 31,43-8,5.1-17.3,7.9-26.9,7.9-27.6,0-50-22.5-50-50s22.5-50 50-50c8.9,0 17.6,2.4 25.2,6.8-17.4,6.4-29.3,23-29.3,42.3z' />
            </svg>
            <span className='ml-3 h4 mb-0 h6'>
                Duration: {props.duration} days
            </span>
        </div>
    </div>
);

const TrainingInfo = props => (
    <div className='col-md order-1 position-relative'>
        <div className='mt-lg-5 sticky-top p-lg-3'>
            <ApproxHours completion={props.training.completion}></ApproxHours>
            <Duration duration={props.training.duration}></Duration>
        </div>
    </div>
);

const TrainingDesc = props => (
    <div className='col-md col-lg-8 order-2 order-md-1 mt-4 mt-md-3'>
        <h4>About this training</h4>
        <p className='lead mt-4'>{props.description}</p>
    </div>
);

class TabComponent extends React.Component {
    pdfExportComponent;
    constructor(props) {
        super(props);
        this.state = {
            activeTab: '1',
            canEdit: false,
            user: {},
            loading: true,
            PDFdata: {}
        };
        this.toggle = this.toggle.bind(this);
    }
    toggle = tab => {
        if (this.state.activeTab !== tab) {
            this.setState({
                activeTab: tab
            });
        }
    };
    componentDidMount = () => {
        Authenticate.getCurrentUser(user => {
            if (user.isAdmin || user.isHR) {
                this.setState({
                    canEdit: true,
                    loading: false
                });
            }
            this.setState({
                user: user,
                loading: false
            });
        });
        Axios.get(`/api/get/certificate/${this.props.training.id}`)
            .then(response => {
                const data = {
                    hr: response.data.hr,
                    admin: response.data.admin,
                    training: {
                        title: this.props.training.title
                    },
                    background: response.data.background
                };
                this.setState({
                    PDFdata: data
                });
            })
            .catch(error => {
                console.log(error);
            });
    };
    handleEnroll = () => {
        alert('Training Enrolled');
        let { user } = this.state;
        let trainingID = this.props.training.id;

        let data = {
            user_id: user.id,
            training_id: trainingID
        };

        Axios.post('/api/training/enroll', data)
            .then(response => {
                this.props.histo.history.push('/dashboard');
            })
            .catch(error => {
                console.log(error);
            });
    };
    render() {
        const { training } = this.props;
        const PDFPreview = () => {
            return (
                <div
                    style={{
                        position: 'absolute',
                        left: '-1000px',
                        top: '0'
                    }}>
                    {Object.keys(this.state.PDFdata).length !== 0 ? (
                        <PDFExport
                            paperSize={'Letter'}
                            fileName={`${training.title} Certificate.pdf`}
                            landscape={true}
                            imageResolution={72}
                            ref={c => (this.pdfExportComponent = c)}>
                            <MainContainer data={this.state.PDFdata} />
                        </PDFExport>
                    ) : null}
                </div>
            );
        };
        return (
            <div>
                {<PDFPreview /> || null}
                <div className='container d-flex justify-content-end mt-3'>
                    {this.state.loading ? null : this.state.canEdit ? (
                        <>
                            <Link
                                to={`/edit/training/${training.id}`}
                                className='btn btn-success mr-2'>
                                Edit Training
                            </Link>
                            <Button
                                outline
                                color='secondary'
                                onClick={() => {
                                    this.pdfExportComponent.save();
                                }}>
                                Export Sample PDF
                            </Button>
                        </>
                    ) : (
                        <Button color='primary' onClick={this.handleEnroll}>
                            Enroll Training
                        </Button>
                    )}
                </div>
                <div className='container mt-2'>
                    <Nav tabs>
                        <NavItem>
                            <NavLink
                                active={
                                    this.state.activeTab == 1 ? true : false
                                }
                                onClick={() => {
                                    this.toggle('1');
                                }}
                                href='#'
                                className='bg-white'>
                                About
                            </NavLink>
                        </NavItem>
                        <NavItem>
                            <NavLink
                                active={
                                    this.state.activeTab == 2 ? true : false
                                }
                                onClick={() => {
                                    this.toggle('2');
                                }}
                                href='#'
                                className='bg-white'>
                                Topics
                            </NavLink>
                        </NavItem>
                        <NavItem>
                            <NavLink
                                active={
                                    this.state.activeTab == 3 ? true : false
                                }
                                onClick={() => {
                                    this.toggle('3');
                                }}
                                href='#'
                                className='bg-white'>
                                Skills
                            </NavLink>
                        </NavItem>
                        {this.state.canEdit ? (
                            <NavItem>
                                <NavLink
                                    active={
                                        this.state.activeTab == 4 ? true : false
                                    }
                                    onClick={() => {
                                        this.toggle('4');
                                    }}
                                    href='#'
                                    className='bg-white'>
                                    Users
                                </NavLink>
                            </NavItem>
                        ) : null}
                    </Nav>
                </div>
                <div className='bg-white mb-5'>
                    <div className='container p-3'>
                        <TabContent
                            activeTab={this.state.activeTab}
                            className='py-4'>
                            <TabPane tabId='1'>
                                <Row>
                                    {training.description ? (
                                        <TrainingDesc
                                            description={
                                                training.description
                                            }></TrainingDesc>
                                    ) : (
                                        <TrainingDesc description='No Description'></TrainingDesc>
                                    )}
                                    <TrainingInfo
                                        training={training}></TrainingInfo>
                                </Row>
                            </TabPane>
                            <TabPane tabId='2'>
                                <Topics topics={training.sections} />
                            </TabPane>
                            <TabPane tabId='3'>
                                <Skills skills={training.skills} />
                            </TabPane>
                            <TabPane tabId='4'>
                                <ViewUserProgress id={training.id} />
                            </TabPane>
                        </TabContent>
                    </div>
                </div>
            </div>
        );
    }
}

const ViewUserProgress = ({ id }) => {
    const [data, setData] = React.useState([]);
    React.useEffect(() => {
        const fetchData = async () => {
            Axios.get(`/api/get/enrolled/${id}`).then(({ data }) => {
                // console.log(data);
                setData(data);
            });
        };
        fetchData();
    }, [id]);

    return (
        <div>
            <div className='row'>
                <div className='col-lg-6 h5 mb-3'>User Progress</div>
            </div>
            {data.map(item => {
                return (
                    <div className='row mt-4' key={item.id}>
                        <div className='col-lg-6'>
                            <div className='d-flex flex-row justify-content-between'>
                                <div>{`${item.user.fname} ${item.user.lname}`}</div>
                                <div>{item.progress ? item.progress : 0}%</div>
                            </div>
                            <div className='text-muted my-2'>
                                <LinearProgress
                                    color='primary'
                                    variant='determinate'
                                    value={item.progress ? item.progress : 0}
                                    size={'10rem'}
                                />
                            </div>
                        </div>
                    </div>
                );
            })}
        </div>
    );
};

const useStyles = makeStyles(theme => ({
    root: {
        padding: theme.spacing(3, 2)
    },
    heading: {
        fontSize: theme.typography.pxToRem(15),
        flexBasis: '33.33%',
        flexShrink: 0
    },
    secondaryHeading: {
        fontSize: theme.typography.pxToRem(15),
        color: theme.palette.text.secondary
    },
    chips: {
        display: 'flex',
        justifyContent: 'center',
        flexWrap: 'wrap',
        '& > *': {
            margin: theme.spacing(0.5)
        }
    },
    lectures: {
        color: grey[500]
    }
}));

function Topics({ topics }) {
    const classes = useStyles();
    const [expanded, setExpanded] = React.useState(false);

    const handleChange = panel => (event, isExpanded) => {
        setExpanded(isExpanded ? panel : false);
    };
    const content = topics.map((topic, i) => {
        return (
            <ExpansionPanel
                expanded={expanded === `panel${i}`}
                onChange={handleChange(`panel${i}`)}
                key={topic.id}>
                <ExpansionPanelSummary
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls={`panel${i}bh-content`}
                    id={`panel${i}bh-header`}>
                    <Typography className={classes.heading}>
                        {topic.title}
                    </Typography>
                </ExpansionPanelSummary>
                {topic.lectures.map(lecture => (
                    <ExpansionPanelDetails
                        key={lecture.id}
                        className={`${classes.lectures} pl-5`}>
                        <Typography component='p'>{lecture.title}</Typography>
                    </ExpansionPanelDetails>
                ))}
            </ExpansionPanel>
        );
    });

    return (
        <>
            <Typography variant='h5' gutterBottom>
                Topics
            </Typography>
            <div className={classes.root}>{content}</div>
        </>
    );
}

function Skills({ skills }) {
    const classes = useStyles();
    const showSkills = JSON.parse(skills);
    return (
        <>
            <Typography variant='h5' gutterBottom>
                Expected skills to be acquired
            </Typography>
            <div className={`${classes.chip} ${classes.root}`}>
                {showSkills.map(skill => (
                    <Chip label={skill} key={skill} className='mr-2' />
                ))}
            </div>
        </>
    );
}
