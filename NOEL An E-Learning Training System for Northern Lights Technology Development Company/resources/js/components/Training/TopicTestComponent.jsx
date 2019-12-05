import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormControl from '@material-ui/core/FormControl';
import FormLabel from '@material-ui/core/FormLabel';
import { green, deepOrange } from '@material-ui/core/colors';

const useStyles = makeStyles(theme => ({
    formControl: {
        margin: theme.spacing(3)
    },
    formControlLabel: {
        marginBottom: 0
    },
    checked: {
        background: green[400]
    }
}));

export default function TopicTestComponent(props) {
    const classes = useStyles();
    const [value, setValue] = React.useState('');
    const handleChange = (event, id) => {
        setValue(event.target.value);
        React.useEffect(() => {
            getAnswer(event.target.value, id);
        }, []);
    };
    let OptionItems = () => {
        let choices = props.options.map((option, index) => (
            <div key={index}>
                <FormControlLabel
                    className={classes.formControlLabel}
                    value={option}
                    control={<Radio color='primary' />}
                    label={option}
                />
            </div>
        ));
        return choices;
    };
    return (
        <div>
            <FormControl component='fieldset' className={classes.formControl}>
                <FormLabel component='legend'>{props.children}</FormLabel>
                <RadioGroup
                    aria-label='options'
                    name={`question${props.id}`}
                    value={value}
                    onChange={event => handleChange(event, props.id)}
                >
                    <OptionItems />
                </RadioGroup>
            </FormControl>
        </div>
    );
}
