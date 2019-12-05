import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import ExpansionPanel from '@material-ui/core/ExpansionPanel';
import ExpansionPanelDetails from '@material-ui/core/ExpansionPanelDetails';
import ExpansionPanelSummary from '@material-ui/core/ExpansionPanelSummary';
import Typography from '@material-ui/core/Typography';
import ExpandMoreIcon from '@material-ui/icons/ExpandMore';
import Chip from '@material-ui/core/Chip';
import Skeleton from 'react-loading-skeleton';

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
    },
    chip: {
        margin: theme.spacing(0.5)
    },
    paper: {
        padding: theme.spacing(3, 2)
    }
}));

const TrainingDetails = props => {
    const classes = useStyles();
    const [expanded, setExpanded] = React.useState(false);
    const chipData = JSON.parse(props.enrolled.training.skills);

    const handleChange = panel => (event, isExpanded) => {
        setExpanded(isExpanded ? panel : false);
    };

    let { enrolled } = props;

    return (
        <div>
            <div className={`${classes.root} mt-3`}>
                <ExpansionPanel
                    expanded={expanded === 'panel1'}
                    onChange={handleChange('panel1')}
                >
                    <ExpansionPanelSummary
                        expandIcon={<ExpandMoreIcon />}
                        aria-controls='panel1bh-content'
                        id='panel1bh-header'
                    >
                        <Typography className={classes.heading}>
                            Training Description
                        </Typography>
                        {/* <Typography className={classes.secondaryHeading}>
                        Training Description
                    </Typography> */}
                    </ExpansionPanelSummary>
                    <ExpansionPanelDetails>
                        <Typography>
                            {enrolled.training &&
                            enrolled.training.description ? (
                                enrolled.training.description
                            ) : (
                                <Skeleton />
                            )}
                        </Typography>
                    </ExpansionPanelDetails>
                </ExpansionPanel>
                <ExpansionPanel
                    expanded={expanded === 'panel2'}
                    onChange={handleChange('panel2')}
                >
                    <ExpansionPanelSummary
                        expandIcon={<ExpandMoreIcon />}
                        aria-controls='panel2bh-content'
                        id='panel2bh-header'
                    >
                        <Typography className={classes.heading}>
                            Skills to be acquired
                        </Typography>
                    </ExpansionPanelSummary>
                    <ExpansionPanelDetails>
                        {chipData.map(data => (
                            <Chip
                                key={data}
                                label={data}
                                className={classes.chip}
                            />
                        ))}
                    </ExpansionPanelDetails>
                </ExpansionPanel>
            </div>
        </div>
    );
};

export default TrainingDetails;
