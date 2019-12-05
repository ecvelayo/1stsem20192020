import React from 'react';
import Logo from '../../logos/nltd_logo.png';
import Picture from '../../img/user.jpg';
import Authenticate from './Auth/Authenticate';
import Skeleton from 'react-loading-skeleton';
import TemporaryDrawer from './Menu/Drawer';
import List from '@material-ui/core/List';
import Divider from '@material-ui/core/Divider';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import ExitToAppRoundedIcon from '@material-ui/icons/ExitToAppRounded';
import DashboardRoundedIcon from '@material-ui/icons/DashboardRounded';
import AccountCircleRoundedIcon from '@material-ui/icons/AccountCircleRounded';
import NotificationsRoundedIcon from '@material-ui/icons/NotificationsRounded';
import MarkunreadMailboxRoundedIcon from '@material-ui/icons/MarkunreadMailboxRounded';
import PersonAddRoundedIcon from '@material-ui/icons/PersonAddRounded';
import AddBoxRoundedIcon from '@material-ui/icons/AddBoxRounded';
import Badge from '@material-ui/core/Badge';
import IconButton from '@material-ui/core/IconButton';
import styled from 'styled-components';
import Popover from '@material-ui/core/Popover';
import Axios from 'axios';
import { Link } from 'react-router-dom';

const StyledListItem = styled(ListItem)`
    &:hover {
        color: inherit;
    }
`;

const Header = props => {
    let { user } = props;
    const SideListContents = () => (
        <>
            <Divider />
            <List>
                <StyledListItem button component='a' href='/dashboard'>
                    <ListItemIcon>
                        <DashboardRoundedIcon />
                    </ListItemIcon>
                    <ListItemText primary={'Dashboard'} />
                </StyledListItem>
                <StyledListItem button component='a' href='/my-profile'>
                    <ListItemIcon>
                        <AccountCircleRoundedIcon />
                    </ListItemIcon>
                    <ListItemText primary={'My Profile'} />
                </StyledListItem>
            </List>
            {user && (user.isHR || user.isAdmin) ? (
                <>
                    <Divider />
                    <List>
                        {user.isAdmin ? (
                            <StyledListItem
                                button
                                component='a'
                                href='/requests'>
                                <ListItemIcon>
                                    <PersonAddRoundedIcon />
                                </ListItemIcon>
                                <ListItemText primary={'Add new user'} />
                            </StyledListItem>
                        ) : null}
                        <StyledListItem button component='a' href='/requests'>
                            <ListItemIcon>
                                <MarkunreadMailboxRoundedIcon />
                            </ListItemIcon>
                            <ListItemText primary={'Training Requests'} />
                        </StyledListItem>
                        <StyledListItem button component='a' href='/create'>
                            <ListItemIcon>
                                <AddBoxRoundedIcon />
                            </ListItemIcon>
                            <ListItemText primary={'Create New Training'} />
                        </StyledListItem>
                    </List>
                </>
            ) : null}
            <Divider />
            <List>
                <ListItem
                    button
                    onClick={() =>
                        Authenticate.logout(() => {
                            handleLogout(props);
                        })
                    }>
                    <ListItemIcon>
                        <ExitToAppRoundedIcon />
                    </ListItemIcon>
                    <ListItemText primary={'Logout'} />
                </ListItem>
            </List>
        </>
    );

    return (
        <>
            <div className='navbar navbar-light bg-white shadow-sm mb-4 p-0'>
                <div className='container'>
                    <a className='navbar-brand' href='/'>
                        <img
                            src={Logo}
                            width='50'
                            height='50'
                            className='d-inline-block align-top'
                            alt='logo'
                        />
                    </a>
                    <div className='ml-auto'>
                        <div className='d-flex flex-row align-items-center'>
                            <div>
                                <NotificationPanel
                                    id={user && user.id}
                                    {...props}
                                />
                            </div>
                            {user && user.fname ? (
                                <LoggedUser>{user.fname}</LoggedUser>
                            ) : (
                                <Skeleton height={20} classname='mx-2' />
                            )}
                            {user && user.profile_image ? (
                                <img
                                    src={`/storage/user/${user.profile_image}`}
                                    alt={user.profile_image}
                                    className='rounded-circle'
                                    width='50'
                                    height='50'
                                />
                            ) : (
                                <img
                                    src='/storage/user/user.jpg'
                                    alt='profile image'
                                    className='img-fluid rounded-circle'
                                    width='50'
                                    height='50'
                                />
                            )}
                            {/* <Skeleton circle={true} height={50} width={50} /> */}
                            <div>
                                <TemporaryDrawer>
                                    <SideListContents />
                                </TemporaryDrawer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};
export default Header;

const handleLogout = props => {
    let { history } = props;
    setTimeout(() => {
        history.push('/login');
    }, 1000);
};

const LoggedUser = props => {
    return (
        <div
            className='mx-3 text-right text-truncate'
            style={{ width: '96px' }}>
            {props.children}
        </div>
    );
};

const NotificationPanel = props => {
    const [anchorEl, setAnchorEl] = React.useState(null);
    const [notifs, setNotifs] = React.useState([]);
    const handleClick = event => {
        setAnchorEl(event.currentTarget);
    };
    const handleClose = () => {
        setAnchorEl(null);
    };
    const handleReadNotif = (notifId, type) => {
        const readNotif = async () => {
            const result = await Axios.get(
                `/api/read/notification/${notifId}/user/${props.id}`
            ).catch(error => {
                console.log(error.response);
            });
            setNotifs(result.data);
        };
        readNotif();
        if (type === 'App\\Notifications\\RequestTraining') {
            handleClose();
            props.history.push('/requests');
        } else {
            props.history.push('/trainings');
        }
    };

    React.useEffect(() => {
        const fetchNotifs = async () => {
            const result = await Axios.get(
                `/api/notifications/${props.id}`
            ).catch(error => {
                console.log(error.response);
            });
            setNotifs(result.data);
        };
        props.id ? fetchNotifs() : null;
    }, [props.id]);
    const items =
        notifs.length > 0 ? (
            notifs.map(notif => {
                return (
                    <div
                        className='list-group-item list-group-item-action list-group-item-info'
                        onClick={() => {
                            handleReadNotif(notif.id, notif.type);
                        }}
                        style={{ cursor: 'pointer' }}
                        key={notif.id}>
                        <div className='d-flex flex-row align-items-center'>
                            {notif.type !==
                            'App\\Notifications\\CreatedTraining' ? (
                                <>
                                    <div className='flex-shrink-1 mr-2'>
                                        <img
                                            src={`/storage/user/${
                                                notif.data.sender.profile_image
                                                    ? notif.data.sender
                                                          .profile_image
                                                    : 'user.jpg'
                                            }`}
                                            alt=''
                                            className='rounded-circle'
                                            width='30'
                                            height='30'
                                        />
                                    </div>
                                    <div className='d-flex flex-column'>
                                        <div>
                                            <span className='small'>
                                                <b>{`${notif.data.sender.fname} ${notif.data.sender.lname} `}</b>
                                                requested for a training
                                                entitled:{' '}
                                                <b>{notif.data.title}</b>
                                            </span>
                                        </div>
                                    </div>
                                </>
                            ) : (
                                <div>
                                    <span className='small'>{notif.data}</span>
                                </div>
                            )}
                        </div>
                    </div>
                );
            })
        ) : (
            <div className='text-muted text-center lead p-2 small font-weight-bold border-bottom'>
                No notifications
            </div>
        );
    return (
        <div>
            <IconButton
                aria-controls='simple-menu'
                aria-haspopup='true'
                onClick={handleClick}>
                <Badge color='secondary' badgeContent={notifs.length} max={9}>
                    <NotificationsRoundedIcon />
                </Badge>
            </IconButton>
            <Popover
                id='simple-menu'
                open={Boolean(anchorEl)}
                anchorEl={anchorEl}
                onClose={handleClose}
                anchorOrigin={{
                    vertical: 'bottom',
                    horizontal: 'center'
                }}
                transformOrigin={{
                    vertical: 'top',
                    horizontal: 'center'
                }}
                style={{ maxHeight: '348px' }}>
                <div
                    className='list-group list-group-flush'
                    style={{ width: '264px' }}>
                    {items}
                    <div
                        className='p-2 bg-white w-100 d-flex flex-row-reverse justify-content-between small'
                        style={{
                            position: 'sticky',
                            bottom: '0',
                            zIndex: '1'
                        }}>
                        <div>
                            <Link to='/notifications' onClick={handleClose}>
                                View all
                            </Link>
                        </div>
                    </div>
                </div>
            </Popover>
        </div>
    );
};
