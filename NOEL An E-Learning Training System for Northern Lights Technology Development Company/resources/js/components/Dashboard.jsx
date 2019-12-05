import React from 'react';
import Axios from 'axios';
import { Container, Row, Col, Card } from 'reactstrap';
import Announcements from './Announcements';
import EnrolledTrainings from './EnrolledTrainings';
import CircularProgress from '@material-ui/core/CircularProgress';
import Authenticate from './Auth/Authenticate';
import Loading from './Loading';
import AnnouncementForm from './AnnouncementForm';
import { Link } from 'react-router-dom';
import UsersList from './UsersList';
import TrainingsList from './TrainingsList';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Switch from '@material-ui/core/Switch';
import CardContainer from './Training/CardContainer';
import BlankImg from '../../img/undraw_blank_canvas.svg';
import Charts from './Chart/Charts';

export default class Dashboard extends React.Component {
    state = {
        user: {},
        usersList: [],
        loading: true,
        error: [],
        fname: '',
        lname: '',
        mname: '',
        contact: '',
        jobTitle: '',
        email: '',
        hasSubmitted: false,
        showFinished: false,
        unfinishedTrainings: [],
        toggleInactive: false
    };
    componentDidMount = () => {
        Authenticate.getCurrentUser(user => {
            this.setState({
                user: user,
                loading: false
            });
            if (this.state.user.isAdmin) {
                this.getUsers();
                this.getUnfinishedTrainings();
            } else if (this.state.user.isHR) {
                this.getUnfinishedTrainings();
            }
        });
    };
    getUnfinishedTrainings = () => {
        Axios.get('/api/trainings').then(response => {
            const trainings = response.data.filter(training => {
                return !training.isFinal;
            });
            this.setState({
                unfinishedTrainings: trainings
            });
        });
    };
    getUsers = () => {
        Axios.get(`/api/users`).then(response => {
            this.setState({
                usersList: response.data
            });
        });
    };
    handleDelete = id => {
        Axios.delete(`/api/user/delete/${id}`)
            .then(response => {
                console.log(response);
                this.setState({
                    usersList: response.data
                });
            })
            .catch(error => {
                console.log(error);
            });
    };
    handleToggle = () => {
        this.setState({
            showFinished: !this.state.showFinished
        });
    };
    handleInactive = () => {
        this.setState({
            toggleInactive: !this.state.toggleInactive
        });
        // if (!this.state.toggleInactive) {
        //     Axios.get(`/api/archive/users`).then(response => {
        //         this.setState({
        //             usersList: response.data,
        //             toggleInactive: !this.state.toggleInactive
        //         });
        //     });
        // } else {
        //     Axios.get(`/api/users`).then(response => {
        //         this.setState({
        //             usersList: response.data,
        //             toggleInactive: !this.state.toggleInactive
        //         });
        //     });
        // }
    };
    handleArchive = id => {
        Axios.put(`/api/archive/user/${id}`).then(response => {
            this.getUsers();
        });
    };
    handleUnarchive = id => {
        Axios.put(`/api/unarchive/user/${id}`).then(response => {
            this.getUsers();
        });
    };
    render() {
        const { usersList, user } = this.state;
        if (this.state.loading) {
            return <Loading />;
        }
        if (this.state.user.isAdmin) {
            return (
                <Container>
                    <Row className='mb-4'>
                        <Col>
                            <Card body>
                                <UsersList
                                    currentUser={user}
                                    users={usersList}
                                    updateList={this.getUsers}
                                    handleDelete={this.handleDelete}
                                    handleArchive={this.handleArchive}
                                    handleUnarchive={this.handleUnarchive}
                                    toggleInactive={this.state.toggleInactive}
                                >
                                    {/* <FormControlLabel
                                        control={
                                            <Switch
                                                size='small'
                                                checked={
                                                    this.state.toggleInactive
                                                }
                                                onChange={this.handleInactive}
                                                value='toggle'
                                                color='primary'
                                            />
                                        }
                                        label='Show Inactive'
                                    /> */}
                                </UsersList>
                            </Card>
                        </Col>
                    </Row>
                    <div className='mb-5'>
                        <Row>
                            <Col>
                                <h4>Trainings</h4>
                                <TrainingsList />
                            </Col>
                            <Col lg={3}>
                                <h6> Announcements</h6>
                                <Link to='/create/announcement'>
                                    Create Announcement
                                </Link>
                                <Announcements />
                            </Col>
                        </Row>
                    </div>
                    <Charts />
                </Container>
            );
        }
        if (this.state.user.isHR) {
            const { unfinishedTrainings } = this.state;
            return (
                <Container>
                    <Row>
                        <div className='col-lg order-2 order-lg-1'>
                            {unfinishedTrainings.length != 0 ? (
                                <>
                                    <h4>Unfinished trainings</h4>
                                    <Container>
                                        <Row>
                                            {unfinishedTrainings.map(
                                                training => (
                                                    <div
                                                        className='col-md-6 col-xl-4 d-flex align-items-stretch'
                                                        key={training.id}
                                                    >
                                                        <CardContainer className='card'>
                                                            <Link
                                                                to={`/training/${training.id}`}
                                                                className='text-decoration-none'
                                                            >
                                                                <div
                                                                    className={`d-flex justify-content-center ${
                                                                        !training.image
                                                                            ? 'border-bottom'
                                                                            : ''
                                                                    }`}
                                                                >
                                                                    <img
                                                                        src={
                                                                            training.image
                                                                                ? `/storage/trainings/${training.image}`
                                                                                : BlankImg
                                                                        }
                                                                        alt='image'
                                                                        className='card-img-top'
                                                                    />
                                                                </div>
                                                                <div className='card-body text-truncate'>
                                                                    <h5 className='mb-0 text-truncate'>
                                                                        {
                                                                            training.title
                                                                        }
                                                                    </h5>
                                                                </div>
                                                            </Link>
                                                        </CardContainer>
                                                    </div>
                                                )
                                            )}
                                        </Row>
                                    </Container>
                                </>
                            ) : null}
                            <div
                                className={
                                    unfinishedTrainings.length != 0
                                        ? 'my-3 mt-5'
                                        : ''
                                }
                            >
                                <h4>Trainings</h4>
                                <TrainingsList />
                            </div>
                        </div>
                        <div className='col-lg-3 order-1 order-lg-2 mb-3 border-left'>
                            <h6> Announcements</h6>
                            <Link to='/create/announcement'>
                                Create Announcement
                            </Link>
                            <Announcements />
                        </div>
                    </Row>
                    <Charts />
                </Container>
            );
        }
        return (
            <Container>
                <Row>
                    <div className='col-lg order-2 order-lg-1'>
                        <div className='d-flex flex-row justify-content-between align-items-center'>
                            <div>
                                <h4>My trainings</h4>
                            </div>
                            <div>
                                <FormControlLabel
                                    control={
                                        <Switch
                                            size='small'
                                            checked={this.state.showFinished}
                                            onChange={this.handleToggle}
                                            value='toggle'
                                            color='primary'
                                        />
                                    }
                                    label='Show finished'
                                />
                            </div>
                        </div>
                        {this.state.user.id ? (
                            <EnrolledTrainings
                                user={this.state.user}
                                showFinished={this.state.showFinished}
                            />
                        ) : null}
                    </div>
                    <div className='col-lg-3 order-1 order-lg-2 mb-3 border-left'>
                        <h6>Announcements</h6>
                        <Announcements />
                    </div>
                </Row>
            </Container>
        );
    }
}
