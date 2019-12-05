import React from 'react';
import Axios from 'axios';
import { Link } from 'react-router-dom';
import ArchiveRoundedIcon from '@material-ui/icons/ArchiveRounded';
import EditRoundedIcon from '@material-ui/icons/EditRounded';
import DeleteRoundedIcon from '@material-ui/icons/DeleteRounded';
import UnarchiveRoundedIcon from '@material-ui/icons/UnarchiveRounded';
import MoreVertRoundedIcon from '@material-ui/icons/MoreVertRounded';
import PersonAddRoundedIcon from '@material-ui/icons/PersonAddRounded';
import MenuRoundedIcon from '@material-ui/icons/MenuRounded';
import IconButton from '@material-ui/core/IconButton';
import Button from '@material-ui/core/Button';
import Tooltip from '@material-ui/core/Tooltip';
import { makeStyles, withStyles } from '@material-ui/core/styles';
import styled from 'styled-components';
import { green, blue, red, orange } from '@material-ui/core/colors';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Switch from '@material-ui/core/Switch';

const useStyles = makeStyles(theme => ({
    button: {
        margin: theme.spacing(0, 0.25)
    },
    archive: {
        '&:hover': {
            backgroundColor: orange[800],
            color: theme.palette.getContrastText(orange[800])
        }
    },
    unarchive: {
        '&:hover': {
            backgroundColor: green[600],
            color: theme.palette.getContrastText(green[600])
        }
    },
    delete: {
        '&:hover': {
            backgroundColor: red[500],
            color: theme.palette.getContrastText(red[400])
        }
    }
}));

const CreateButton = withStyles(theme => ({
    root: {
        margin: theme.spacing(2, 1),
        color: theme.palette.getContrastText(green[600]),
        backgroundColor: green[600],
        '&:hover': {
            backgroundColor: green[700],
            color: theme.palette.getContrastText(green[600])
        }
    }
}))(Button);

const EditLink = React.forwardRef((props, ref) => (
    <Link innerRef={ref} {...props} />
));

const CreateLink = React.forwardRef((props, ref) => (
    <Link innerRef={ref} {...props} />
));

const HiddenButtons = styled.div`
    display: none;
    justify-content: center;
    tr:hover & {
        display: flex;
    }
`;

const StyledCell = styled.td`
    padding: 1rem 0.75rem !important;
    vertical-align: inherit !important;
`;

const UsersList = props => {
    const classes = useStyles();
    const userlist = props.users
        .filter(user => {
            return user.id !== props.currentUser.id;
        })
        .map(user => {
            const role = () => {
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
            return (
                <tr key={user.id} className='position-relative'>
                    <td
                        style={{
                            padding: '0.375rem',
                            width: '8%',
                            verticalAlign: 'middle'
                        }}
                    >
                        <div className='d-flex align-items-center justify-content-center'>
                            <img
                                src={
                                    user.profile_image
                                        ? `/storage/user/${user.profile_image}`
                                        : `/storage/user/user.jpg`
                                }
                                alt={
                                    user.profile_image
                                        ? user.profile_image
                                        : 'profile image'
                                }
                                className='rounded-circle'
                                width='40'
                            />
                        </div>
                    </td>
                    <StyledCell>{`${user.fname} ${
                        user.mname != null ? user.mname : ''
                    } ${user.lname}`}</StyledCell>
                    <StyledCell>{role()}</StyledCell>
                    <StyledCell>
                        {user.active ? 'Active' : 'Inactive'}
                    </StyledCell>
                    <td
                        style={{
                            padding: '0.375rem 0',
                            width: '20%'
                        }}
                    >
                        {user.active ? (
                            <HiddenButtons>
                                <Tooltip title='Archive'>
                                    <IconButton
                                        aria-label='Archive'
                                        className={`${classes.button} ${classes.archive}`}
                                        onClick={() => {
                                            props.handleArchive(user.id);
                                        }}
                                    >
                                        <ArchiveRoundedIcon fontSize='small' />
                                    </IconButton>
                                </Tooltip>
                                <Tooltip title='View user'>
                                    <IconButton
                                        aria-label='View user'
                                        className={classes.button}
                                        component={EditLink}
                                        to={`/user/${user.id}`}
                                    >
                                        <MenuRoundedIcon fontSize='small' />
                                    </IconButton>
                                </Tooltip>
                            </HiddenButtons>
                        ) : (
                            <HiddenButtons>
                                <Tooltip title='Unarchive'>
                                    <IconButton
                                        aria-label='Unarchive'
                                        className={`${classes.button} ${classes.unarchive}`}
                                        onClick={() => {
                                            props.handleUnarchive(user.id);
                                        }}
                                    >
                                        <UnarchiveRoundedIcon fontSize='small' />
                                    </IconButton>
                                </Tooltip>
                                <Tooltip title='Delete'>
                                <IconButton
                                        aria-label='Delete'
                                        className={classes.button}
                                        onClick={() => {
                                            props.handleDelete(user.id);
                                        }}
                                        className={`${classes.button} ${classes.delete}`}
                                    >
                                        <DeleteRoundedIcon fontSize='small' />
                                    </IconButton>
                                </Tooltip>
                            </HiddenButtons>
                        )}
                    </td>
                </tr>
            );
        });
    return (
        <>
            <div className='d-flex flex-row justify-content-between align-items-center'>
                <div className='h4'>User list</div>
                <div>
                    <CreateButton
                        variant='contained'
                        color='primary'
                        className='mx-3'
                        component={CreateLink}
                        to={`/createuser`}
                    >
                        <PersonAddRoundedIcon className='mr-2' /> Add new user
                    </CreateButton>
                </div>
            </div>
            <div>
                <div className='table-responsive-md'>
                    <table className='table table-hover'>
                        <thead>
                            <tr
                                style={{
                                    textTransform: 'uppercase',
                                    fontSize: '14px'
                                }}
                            >
                                <th>&nbsp;</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>{userlist}</tbody>
                    </table>
                </div>
            </div>
        </>
    );
};

export default UsersList;
