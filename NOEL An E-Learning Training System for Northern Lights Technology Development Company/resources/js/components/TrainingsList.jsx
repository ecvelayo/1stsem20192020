import React from 'react';
import Axios from 'axios';
import { Button } from 'reactstrap';
import { Redirect, Link } from 'react-router-dom';
import BlankImg from '../../img/undraw_blank_canvas.svg';
import FailedToFetchData from './FailedToFetchData';
import Loading from './Loading';
import NoTrainingFound from './NoTrainingFound';
import Authenticate from './Auth/Authenticate';
import CardContainer from './Training/CardContainer';

const CreateButton = () => (
    <Link to='/create'>
        <Button color='primary'>New Training</Button>
    </Link>
);

export default class TrainingsList extends React.Component {
    _isMounted = false;
    constructor(props) {
        super(props);
        this.state = {
            loading: true,
            trainings: [],
            failedToFetch: false,
            canAddTraining: false,
            user: {},
            enrolledTrainings: []
        };
    }

    componentDidMount = async () => {
        this._isMounted = true;
        Axios.get('/api/trainings')
            .then(response => {
                let { data } = response;
                if (this._isMounted) {
                    this.setState({
                        trainings: data
                    });
                }
            })
            .catch(error => {
                let response = error.response;
                if (response.status === 500) {
                    this.setState({
                        failedToFetch: true
                    });
                }
            });
        Authenticate.getCurrentUser(user => {
            if (user.isAdmin || user.isHR) {
                this.setState({
                    canAddTraining: true,
                    loading: false,
                    user: user
                });
            } else {
                this.setState({
                    user: user
                });
                this.getEnrolledTrainings();
            }
        });
    };

    getEnrolledTrainings = () => {
        let { id } = this.state.user;
        Axios.get(`/api/enrolled/trainings/${id}`)
            .then(response => {
                this.setState({
                    enrolledTrainings: response.data,
                    loading: false
                });
            })
            .catch(error => console.log(error.response));
    };

    componentWillUnmount() {
        this._isMounted = false;
    }

    render() {
        let { trainings, enrolledTrainings, user } = this.state;
        if (this.state.failedToFetch) {
            return (
                <FailedToFetchData message='We are unable to fetch data from the server.' />
            );
        }
        if (this.state.loading) {
            return <Loading />;
        }
        if (trainings.length === 0) {
            return (
                <NoTrainingFound>
                    <div className='d-flex flex-row mt-3'>
                        {this.state.canAddTraining ? (
                            <>
                                <CreateButton />
                                <Link
                                    to='/requests'
                                    className='btn btn-outline-secondary ml-2'>
                                    Training Requests
                                </Link>
                            </>
                        ) : (
                            ''
                        )}
                    </div>
                </NoTrainingFound>
            );
        }
        const trainingItems = trainings
            .filter(training => {
                if (!(user.isAdmin || user.isHR)) {
                    // console.log(training.id);
                    const length = enrolledTrainings.length;
                    const result = enrolledTrainings.some((enrolled, i) => {
                        let status = true;
                        // false = the same id
                        // console.log(enrolled.training_id, 'e');
                        while (status && length > i) {
                            if (enrolled.training_id !== training.id) {
                                status = false;
                                // console.log(status, 'status-a');
                                break;
                            }
                            i++;
                        }
                        // console.log(status, 'status-b');
                        return status;
                    });
                    // console.log(result, 'result');
                    return training.isFinal && !result;
                } else {
                    return training.isFinal;
                }
            })
            .map(training => (
                <div
                    className='col-md-6 col-xl-4 d-flex align-items-stretch'
                    key={training.id}>
                    <CardContainer
                        className='card'
                        style={{ opacity: training.archived ? '0.7' : '1' }}>
                        <Link
                            to={`/training/${training.id}`}
                            className='text-decoration-none'>
                            <div
                                className={`d-flex justify-content-center ${
                                    !training.image ? 'border-bottom' : ''
                                }`}>
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
                                    {training.title}
                                </h5>
                            </div>
                        </Link>
                    </CardContainer>
                </div>
            ));
        return (
            <div>
                <div className='container my-3'>
                    <div className='row my-4'>
                        <div className='col'>
                            {this.state.canAddTraining ? (
                                <div className='d-flex flex-row mt-3'>
                                    <CreateButton />
                                    <Link
                                        to='/requests'
                                        className='btn btn-outline-secondary ml-2'>
                                        Training Requests
                                    </Link>
                                </div>
                            ) : (
                                <h4>List of available trainings</h4>
                            )}
                        </div>
                    </div>
                    <div className='row'>{trainingItems}</div>
                </div>
            </div>
        );
    }
}
