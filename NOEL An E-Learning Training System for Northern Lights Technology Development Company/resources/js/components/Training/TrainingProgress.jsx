import React from 'react';
import Authenticate from '../Auth/Authenticate';
import { Container } from 'reactstrap';
import { ViewPortContainer } from '../Enrolled/Enrolled';
import styled from 'styled-components';
import TopicNav from './TopicNav';
import Loading from '../Loading';
import PageNotFound from '../PageNotFound';
import Axios from 'axios';
import TopicContent from './TopicContent';
import { Link } from 'react-router-dom';
import Skeleton from 'react-loading-skeleton';
import Content from './Content';
import getBlockStyle from '../Editor/GetBlockStyle';
import styleMap from '../Editor/StyleMap';
import { Editor, EditorState, convertFromRaw } from 'draft-js';
import { MdArrowBack, MdArrowForward } from 'react-icons/md';

export default class TrainingProgress extends React.Component {
    state = {
        user: {},
        enrolled: {},
        loading: true,
        notFound: false,
        noSections: false,
        title: '',
        editorState: EditorState.createEmpty(),
        isTest: false,
        isChecked: false,
        questions: [],
        answers: []
    };
    componentDidMount = () => {
        Authenticate.getCurrentUser(user => {
            if (user.isHR || user.isAdmin) {
                let { history } = this.props;
                history.push('/dashboard');
            }
            this.setState({
                user: user
            });
            this.getProgress();
        });
    };
    getProgress = () => {
        let { id } = this.state.user;
        let { enrolled } = this.props.match.params;
        Axios.get(`/api/progress/enrolled/${enrolled}/user/${id}`)
            .then(response => {
                this.setState({
                    enrolled: response.data,
                    loading: false
                });
            })
            .catch(error => {
                this.setState({
                    notFound: true,
                    loading: false
                });
            });
    };
    updateProgress = current => {
        // let { enrolled } = this.props.match.params;
        // current = JSON.stringify(current);
        console.log('Updating progress...');
        Axios.post('/api/progress/update', current)
            .then(response => {
                this.setState({
                    enrolled: response.data,
                    loading: false
                });
            })
            .catch(error => {
                if (error.response.status === 404) {
                    this.setState({
                        notFound: true,
                        loading: false
                    });
                }
            });
    };
    handleNextLesson = () => {
        alert('next lesson');
    };
    render() {
        if (this.state.loading) {
            return <Loading />;
        }
        if (this.state.notFound) {
            return <PageNotFound />;
        }
        console.log(this.state.enrolled, 'in trainingprogress');
        return (
            <TrainingProgressContainer className='mt-n4'>
                <Container className='d-flex flex-row'>
                    <LeftPane className='d-flex flex-column'>
                        <div className='p-3 border-bottom'>
                            <h4 className='text-center'>
                                {this.state.enrolled.training.title || (
                                    <Skeleton />
                                )}
                            </h4>
                        </div>
                        <TopicNav enrolled={this.state.enrolled} />
                        <div className='mt-auto border-top'>
                            <Link
                                to={`/enrolled/training/${this.state.enrolled.id}`}
                                className='btn btn-block btn-light mb-1'
                            >
                                Finish later
                            </Link>
                        </div>
                    </LeftPane>
                    <RightPane className='d-flex flex-column overflow-auto'>
                        {/* <TopicContent
                            enrolled={this.state.enrolled}
                            updateCurrent={this.updateProgress}
                        /> */}
                        <Content enrolled={this.state.enrolled}>
                            <div className='d-flex justify-content-between border-top p-3'>
                                <div>
                                    <button className='btn btn- btn-outline-secondary mb-1'>
                                        <MdArrowBack /> Previous
                                    </button>
                                </div>
                                <div>
                                    <button
                                        onClick={this.handleNextLesson}
                                        className='btn btn- btn-primary mb-1'
                                    >
                                        Next lesson <MdArrowForward />
                                    </button>
                                </div>
                            </div>
                        </Content>
                    </RightPane>
                </Container>
            </TrainingProgressContainer>
        );
    }
}

const TrainingProgressContainer = styled.div`
    width: 100%;
`;

const LeftPane = styled(ViewPortContainer)`
    border: 1px solid #dee2e6 !important;
    border-top: 0 !important;
    border-bottom: 0 !important;
    width: 30%;
    padding-top: 1rem !important;
    background: white;
`;

const RightPane = styled(ViewPortContainer)`
    border-right: 1px solid #dee2e6 !important;
    background: white;
    width: 70%;
`;
