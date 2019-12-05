import React from 'react';
import Authenticate from '../Auth/Authenticate';
import Loading from '../Loading';
import { Container, Row, Col, Button } from 'reactstrap';
import styled from 'styled-components';
import InfoPanel from './InfoPanel';
import Axios from 'axios';
import ProgressPanel from './ProgressPanel';
import PageNotFound from '../PageNotFound';
import TrainingDetails from './TrainingDetails';

export default class Enrolled extends React.Component {
    state = {
        user: {},
        loading: true,
        enrolled: {},
        training: {},
        notFound: false
    };
    componentDidMount = () => {
        Authenticate.getCurrentUser(user => {
            if (user.isAdmin || user.isHR) {
                let { history } = this.props;
                history.push('/dashboard');
            }
            this.setState({
                user: user,
                loading: false
            });
            this.getProgress();
        });
    };
    getProgress = () => {
        let { id } = this.state.user;
        let { training } = this.props.match.params;
        Axios.get(`/api/progress/enrolled/${training}/user/${id}`)
            .then(response => {
                let { training } = response.data;
                this.setState({
                    enrolled: response.data,
                    training: training
                });
                this.updateProgress(this.state.enrolled);
            })
            .catch(error => {
                this.setState({
                    notFound: true
                });
            });
    };
    updateProgress = enrolled => {
        if (enrolled.current) {
            let prog = JSON.parse(enrolled.current);
            Axios.put(
                `/api/enrolled/training/${enrolled.id}/total`,
                prog.finished
            )
                .then(response => {
                    this.setState({
                        enrolled: response.data
                    });
                })
                .catch(error => {
                    console.log(error);
                });
        }
    };
    render() {
        if (this.state.notFound) {
            return <PageNotFound />;
        }
        if (this.state.loading) {
            return <Loading />;
        }
        return (
            <Container className='mt-n4 bg-white px-0'>
                <ViewPortContainer className='d-flex flex-row'>
                    <InfoPanel
                        training={this.state.training}
                        enrolled={this.state.enrolled}
                    />
                    <div
                        className='border-right flex-grow-1 overflow-auto style-3'
                        style={{ width: '70%' }}
                    >
                        <Container>
                            {Object.keys(this.state.enrolled).length !== 0 ? (
                                <ProgressPanel enrolled={this.state.enrolled}>
                                    <TrainingDetails
                                        enrolled={this.state.enrolled}
                                    />
                                </ProgressPanel>
                            ) : null}
                        </Container>
                    </div>
                </ViewPortContainer>
            </Container>
        );
    }
}

export const ViewPortContainer = styled.div`
    height: calc(100vh - 64px);
`;
