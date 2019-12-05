import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Drawer from '@material-ui/core/Drawer';
import MenuRoundedIcon from '@material-ui/icons/MenuRounded';
import CloseRoundedIcon from '@material-ui/icons/CloseRounded';
import IconButton from '@material-ui/core/IconButton';

const useStyles = makeStyles(theme => ({
    list: {
        width: 250
    },
    fullList: {
        width: 'auto'
    },
    button: {
        margin: theme.spacing(1),
        outline: 'none!important'
    },
    close: {
        height: 64,
        textAlign: 'right'
    }
}));

export default function TemporaryDrawer({ children }) {
    const classes = useStyles();
    const [state, setState] = React.useState({
        right: false
    });

    const toggleDrawer = (side, open) => event => {
        if (
            event.type === 'keydown' &&
            (event.key === 'Tab' || event.key === 'Shift')
        ) {
            return;
        }

        setState({ ...state, [side]: open });
    };

    const sideList = side => (
        <div
            className={classes.list}
            role='presentation'
            onClick={toggleDrawer(side, false)}
            onKeyDown={toggleDrawer(side, false)}>
            <div className={classes.close}>
                <IconButton
                    className={classes.button}
                    onClick={toggleDrawer('right', false)}>
                    <CloseRoundedIcon />
                </IconButton>
            </div>
            {children}
        </div>
    );

    return (
        <>
            <IconButton
                className={classes.button}
                aria-label='delete'
                onClick={toggleDrawer('right', true)}>
                <MenuRoundedIcon />
            </IconButton>

            <Drawer
                anchor='right'
                open={state.right}
                onClose={toggleDrawer('right', false)}>
                {sideList('right')}
            </Drawer>
        </>
    );
}
