import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Header from './Header';
import {
    BrowserRouter as Router,
    Route,
    Redirect,
    Switch
} from 'react-router-dom';
import Cookie from 'js-cookie';
import TrainingsList from './TrainingsList';
import Dashboard from './Dashboard';
import NewTraining from './NewTraining';
import Training from './Training';
import PageNotFound from './PageNotFound';
import EditTraining from './EditTraining';
import Section from './Section';
import Lecture from './Lecture';
import ViewLecture from './ViewLecture';
import Login from './Auth/Login';
import Register from './Auth/Register';
import { ProtectedRoute } from './Auth/ProtectedRoute';
import AnnouncementForm from './AnnouncementForm';
import Authenticate from './Auth/Authenticate';
import Test from './Test';
import Enrolled from './Enrolled/Enrolled';
import EditUser from './EditUser';
import SendRequest from './SendRequest';
import AdminCreateUser from './AdminCreateUser';
import ViewUsers from './ViewUsers';
import MainComponent from './Training/Main';
import EditProfile from './EditProfile';
import EditCertificate from './Certificate/EditCertificate';
import Axios from 'axios';
import PreviewTraining from './PreviewTraining';
import Notifications from './Notifications';
import Requests from './Requests';

export default class App extends Component {
    state = {
        user: null
    };

    componentDidMount = () => {
        // Call getCurrentUser function from Authenticate
        Authenticate.getCurrentUser(data => {
            if (!data) {
                // console.log(this.props);
                Cookie.remove('noel_auth');
            }
            this.setState({
                user: data
            });
        });
    };

    updateState = user => {
        Axios.put(`/api/update/user/${user.id}`, user).then(response => {
            this.setState({
                user: response.data
            });
        });
    };

    updateProfileImage = id => {
        Axios.get(`/api/get/user/${id}`).then(response => {
            this.setState({
                user: response.data
            });
        });
    };

    render() {
        return (
            <Router>
                <ProtectedRoute
                    user={this.state.user}
                    updateState={this.updateState}
                    component={Header}
                />
                <Route exact path='/' render={() => <Redirect to='/login' />} />
                <Route
                    path='/login'
                    render={props => (
                        <Login updateState={this.updateState} {...props} />
                    )}
                />
                <Route
                    path='/register'
                    render={props => (
                        <Register updateState={this.updateState} {...props} />
                    )}
                />
                <Switch>
                    <ProtectedRoute path='/dashboard' component={Dashboard} />
                    <ProtectedRoute
                        exact
                        path='/create'
                        component={NewTraining}
                    />
                    <ProtectedRoute
                        exact
                        path='/create/announcement'
                        component={AnnouncementForm}
                    />
                    <ProtectedRoute
                        exact
                        path='/my-profile'
                        component={EditProfile}
                        updateState={this.updateState}
                        updateProfileImage={this.updateProfileImage}
                    />
                    <ProtectedRoute path='/dashboard' component={Dashboard} />
                    <ProtectedRoute path='/create' component={NewTraining} />
                    <ProtectedRoute path='/user/:user' component={EditUser} />
                    <ProtectedRoute
                        path='/createuser'
                        component={AdminCreateUser}
                    />
                    <ProtectedRoute path='/requests' component={Requests} />
                    <ProtectedRoute
                        path='/notifications'
                        component={Notifications}
                    />
                    <ProtectedRoute
                        path='/usertrainings'
                        component={ViewUsers}
                    />
                    <ProtectedRoute
                        path='/createuser'
                        component={AdminCreateUser}
                    />
                    <ProtectedRoute
                        path='/trainings'
                        component={TrainingsList}
                    />
                    <ProtectedRoute
                        exact
                        path='/training/:id'
                        component={Training}
                    />
                    <ProtectedRoute
                        exact
                        path='/edit/training/:id'
                        component={EditTraining}
                    />
                    {/* <ProtectedRoute
                        exact
                        path='/edit/certificate/:id'
                        component={EditCertificate}
                    /> */}
                    <ProtectedRoute
                        exact
                        path='/edit/training/:training/section/:section'
                        component={Section}
                    />
                    <ProtectedRoute
                        exact
                        path='/edit/training/:training/section/:section/lecture/:lecture'
                        component={Lecture}
                    />
                    <ProtectedRoute
                        exact
                        path='/edit/training/:training/section/:section/lecture/:lecture/test/:test'
                        component={Test}
                    />
                    <ProtectedRoute
                        exact
                        path='/view/training/:training/section/:section/lecture/:lecture'
                        component={ViewLecture}
                    />
                    <ProtectedRoute
                        exact
                        path='/enrolled/training/:training'
                        component={Enrolled}
                    />
                    <ProtectedRoute
                        exact
                        path='/preview/training/:training'
                        component={PreviewTraining}
                    />
                    <ProtectedRoute
                        exact
                        path='/progress/:enrolled'
                        // component={TrainingProgress}
                        component={MainComponent}
                    />
                    <ProtectedRoute path='*' component={PageNotFound} />
                </Switch>
            </Router>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
