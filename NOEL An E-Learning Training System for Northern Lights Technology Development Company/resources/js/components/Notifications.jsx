import React from 'react';
import Axios from 'axios';
import Authenticate from './Auth/Authenticate';
import { Container, Row, Col } from 'reactstrap';

export default class Notifications extends React.Component {
    state = {
        notifications: [],
        id: null
    };
    componentDidMount = () => {
        Authenticate.getCurrentUser(user => {
            Axios.get(`/api/all/notifications/${user.id}`)
                .then(({ data }) => {
                    this.setState({
                        notifications: data,
                        id: user.id
                    });
                })
                .catch(error => {
                    console.log(error.response);
                });
        });
    };
    handleReadNotif = (notifId, type) => {
        const { id } = this.state;
        Axios.get(`/api/read/notification/${notifId}/user/${id}`)
            .then(({ data }) => {
                this.setState({
                    notifications: data
                });
                if (type === 'App\\Notifications\\RequestTraining') {
                    this.props.history.push('/requests');
                } else {
                    this.props.history.push('/trainings');
                }
            })
            .catch(error => {
                console.log(error.response);
            });
    };
    render() {
        const { notifications } = this.state;
        const items = notifications.map(notif => (
            <div
                className={`list-group-item list-group-item-action ${
                    notif.read_at != null ? '' : 'list-group-item-info'
                }`}
                style={{ cursor: 'pointer' }}
                onClick={() => {
                    notif.read_at !== null
                        ? null
                        : this.handleReadNotif(notif.id, notif.type);
                }}
                key={notif.id}>
                <div className='d-flex flex-row align-items-center'>
                    {notif.type !== 'App\\Notifications\\CreatedTraining' ? (
                        <>
                            <div className='flex-shrink-1 mr-2'>
                                <img
                                    src={`/storage/user/${
                                        notif.data.sender.profile_image
                                            ? notif.data.sender.profile_image
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
                                        requested for a training entitled:{' '}
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
        ));
        return (
            <Container>
                <Row className='d-flex justify-content-center flex-row'>
                    <Col md={8} lg={6}>
                        <div className='h4 mb-3'>Notifications</div>
                        <hr />
                        {notifications.length == 0 ? (
                            <div className='h5 text-center text-muted'>
                                No Notifications
                            </div>
                        ) : (
                            <div className='list-group'>{items}</div>
                        )}
                    </Col>
                </Row>
            </Container>
        );
    }
}
