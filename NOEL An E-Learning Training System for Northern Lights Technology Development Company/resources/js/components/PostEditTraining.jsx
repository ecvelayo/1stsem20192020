import React from 'react';
import Axios from 'axios';
import PageNotFound from './PageNotFound';
import { Container } from 'reactstrap';
import SectionPanel from './SectionPanel';
import Loading from './Loading';
import { TrainingInfoPanel, notifyA } from './EditTraining';
import EditCertificate from './Certificate/EditCertificate';
import { makeStyles } from '@material-ui/core/styles';
import ExpansionPanel from '@material-ui/core/ExpansionPanel';
import ExpansionPanelDetails from '@material-ui/core/ExpansionPanelDetails';
import ExpansionPanelSummary from '@material-ui/core/ExpansionPanelSummary';
import Typography from '@material-ui/core/Typography';
import ExpandMoreIcon from '@material-ui/icons/ExpandMore';
import UnarchiveRoundedIcon from '@material-ui/icons/UnarchiveRounded';
import ArchiveRoundedIcon from '@material-ui/icons/ArchiveRounded';
import Button from '@material-ui/core/Button';

const useStyles = makeStyles(theme => ({
    root: {
        width: '100%'
    },
    heading: {
        fontSize: theme.typography.pxToRem(15),
        flexBasis: '33.33%',
        flexShrink: 0
    },
    secondaryHeading: {
        fontSize: theme.typography.pxToRem(15),
        color: theme.palette.text.secondary
    }
}));

const Accordion = props => {
    const classes = useStyles();
    const [expanded, setExpanded] = React.useState(false);

    const handleChange = panel => (event, isExpanded) => {
        setExpanded(isExpanded ? panel : false);
    };

    const components = [
        {
            title: 'Training Details',
            component: <TrainingInfoPanel {...props} notify={notifyA} />
        },
        {
            title: 'Section Details',
            component: <SectionPanel id={props.training.id} />
        },
        { title: 'Certificate', component: <EditCertificate {...props} /> }
    ];
    return (
        <div className={classes.root}>
            {components.map((component, i) => (
                <ExpansionPanel
                    key={i}
                    expanded={expanded === `panel${i}`}
                    onChange={handleChange(`panel${i}`)}>
                    <ExpansionPanelSummary
                        expandIcon={<ExpandMoreIcon />}
                        aria-controls={`panel${i}bh-content`}
                        id={`panel${i}bh-header`}>
                        <Typography className={classes.heading}>
                            {component.title}
                        </Typography>
                    </ExpansionPanelSummary>
                    <ExpansionPanelDetails>
                        <div className='w-100'>{component.component}</div>
                    </ExpansionPanelDetails>
                </ExpansionPanel>
            ))}
        </div>
    );
};

export default class PostEditTraining extends React.Component {
    state = {
        notFound: false,
        training: {},
        loading: true
    };
    componentDidMount = () => {
        const { id } = this.props.match.params;
        Axios.get(`/api/edit/training/${id}`)
            .then(({ data }) => {
                this.setState({
                    training: data,
                    loading: false
                });
            })
            .catch(error => {
                this.setState({
                    notFound: true,
                    loading: false
                });
                console.log(error.response.data);
            });
    };
    handleArchive = () => {
        Axios.put(`/api/archive/training/${this.state.training.id}`).then(
            response => {
                this.props.history.push('/dashboard');
            }
        );
    };
    render() {
        const { training } = this.state;
        console.log(this.props);
        if (this.state.loading) {
            return <Loading />;
        }
        if (this.state.notFound) {
            return <PageNotFound />;
        }
        return (
            <Container>
                <div className='d-flex flex-row justify-content-between'>
                    <div className='display-4 mb-3'>Edit Training</div>
                    <div className='align-self-center'>
                        <Button
                            variant='outlined'
                            onClick={() => {
                                this.handleArchive();
                            }}>
                            {training.archived ? (
                                <>
                                    <UnarchiveRoundedIcon className='mr-2' />
                                    Unarchive
                                </>
                            ) : (
                                <>
                                    <ArchiveRoundedIcon className='mr-2' />
                                    Archive
                                </>
                            )}
                        </Button>
                    </div>
                </div>
                <div className='my-4'>
                    <Accordion training={training} {...this.props} />
                </div>
            </Container>
        );
    }
}
