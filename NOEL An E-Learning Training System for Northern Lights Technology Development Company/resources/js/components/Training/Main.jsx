import React from 'react';
import Content from './Content';
import Left from './Left';
import Authenticate from '../Auth/Authenticate';
import Axios from 'axios';
import styled from 'styled-components';
import { Link } from 'react-router-dom';
import { Container, Button } from 'reactstrap';
import { ViewPortContainer } from '../Enrolled/Enrolled';
import Skeleton from 'react-loading-skeleton';
import { MdArrowBack, MdArrowForward } from 'react-icons/md';
import PageNotFound from '../PageNotFound';

export default class MainComponent extends React.Component {
    constructor(props) {
        super(props);
        this.myRef = React.createRef();
        this.state = {
            user: {},
            enrolled: null,
            lecture: null,
            loading: true,
            notFound: false,
            noSections: false,
            lastLecture: false,
            firstLecture: false,
            checkTest: false,
        };
    }
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
        const { id } = this.state.user;
        const { enrolled } = this.props.match.params;
        Axios.get(`/api/progress/enrolled/${enrolled}/user/${id}`)
            .then(response => {
                this.setState({
                    enrolled: response.data,
                    loading: false
                });
                this.getCurrentTopic();
            })
            .catch(error => {
                this.setState({
                    notFound: true,
                    loading: false
                });
            });
    };
    getCurrentTopic = () => {
        const { enrolled } = this.state;
        if (enrolled.training.sections.length === 0) {
            this.setState({
                noSections: true
            });
        } else if (!enrolled.current) {
            let current = {
                id: enrolled.id,
                finished: [],
                current: {
                    section: enrolled.training.sections[0].id,
                    lecture: enrolled.training.sections[0].lectures[0].id
                }
            };
            console.log('current is null');
            this.updateCurrent(current, false);
        } else {
            this.getLecture();
        }
    };
    updateCurrent = (current, isCompleted) => {
        console.log('Updating progress...');
        if (isCompleted) {
            const fetchData = async () => {
                const result = await Axios.post(
                    '/api/progress/update',
                    current
                ).catch(error => {
                    if (error.response.status === 404) {
                        this.setState({
                            notFound: true
                        });
                    }
                });
            };
            fetchData();
            console.log('completed');
            Axios.put(`/api/finished/${current.id}`)
                .then(() => {
                    this.props.history.push(`/enrolled/training/${current.id}`);
                })
                .catch(error => {
                    console.log(error.response);
                });
        } else {
            Axios.post('/api/progress/update', current)
                .then(response => {
                    this.setState({
                        enrolled: response.data
                    });
                    this.getLecture();
                })
                .catch(error => {
                    if (error.response.status === 404) {
                        this.setState({
                            notFound: true
                        });
                    }
                });
        }
    };
    getLecture = () => {
        let {
            enrolled,
            enrolled: { current }
        } = this.state;
        current = JSON.parse(current);
        console.log(current, 'in getLecture');
        Axios.get(
            `/api/training/${enrolled.training_id}/section/${current.current.section}/lecture/${current.current.lecture}`
        )
            .then(response => {
                this.setState({
                    lecture: response.data
                });
                this.myRef.current.scrollTop = 0;
            })
            .catch(error => {
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                    location.reload();
                } else if (error.request) {
                    // The request was made but no response was received
                    // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                    // http.ClientRequest in node.js
                    console.log(error.request);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
                console.log(error.config);
            });
    };
    handleNextLesson = () => {
        let {
            enrolled: {
                current,
                training: { sections }
            },
            enrolled
        } = this.state;
        let currentLectureIndex,
            currentSection,
            currentSectionIndex,
            finishedLectures,
            next;
        current = JSON.parse(current);
        sections.find(section => {
            let { lectures } = section;
            lectures.find((lecture, i) => {
                if (lecture.id === current.current.lecture) {
                    currentSection = section;
                    let index = lecture.index + 1;
                    if (index <= lectures.length) {
                        // proceed to next lecture
                        console.log('maka proceed sa lecture');
                        currentLectureIndex = i;
                        next = true;
                        finishedLectures = current.finished;
                        finishedLectures.includes(lecture.id)
                            ? null
                            : finishedLectures.push(lecture.id);
                    } else {
                        console.log('go to next section');
                        // tells it go to next section
                        next = false;
                        finishedLectures = current.finished;
                        console.log(finishedLectures, 'finished lectures');
                        finishedLectures.includes(lecture.id)
                            ? null
                            : finishedLectures.push(lecture.id);
                    }
                }
            });
        });
        if (next) {
            // next lecture logic
            console.log('next lecture logic');
            let { lectures } = currentSection;
            let id;
            lectures.find((lecture, i) => {
                if (i === currentLectureIndex + 1) {
                    id = lecture.id;
                }
            });
            console.log(current);
            let updateCurrent = {
                ...current,
                current: {
                    lecture: id,
                    section: current.current.section
                },
                finished: finishedLectures
            };
            console.log(updateCurrent, 'updated current');
            this.updateCurrent(updateCurrent, false);
        } else {
            // next section logic
            console.log('next section logic');
            console.log(currentSection);
            currentSectionIndex = sections.findIndex(section => {
                return section.id === currentSection.id;
            });
            if (++currentSectionIndex < sections.length) {
                let newSectionId, newLectureId;
                sections.find((section, i) => {
                    if (i === currentSectionIndex) {
                        newSectionId = section.id;
                        newLectureId = section.lectures[0].id;

                        // if (section.lectures.length == 0) {
                        //     newLectureId = null;
                        // } else {
                        // }
                    }
                });
                if (newLectureId !== null) {
                    let updateCurrent = {
                        ...current,
                        current: {
                            lecture: newLectureId,
                            section: newSectionId
                        }
                    };
                    this.updateCurrent(updateCurrent, false);
                } else {
                    return null;
                }
            } else {
                console.log('this is the last section');
                if (!enrolled.is_completed) {
                    let updateCurrent = {
                        ...current,
                        finished: finishedLectures
                    };
                    console.log(updateCurrent, 'the updated current');
                    this.updateCurrent(updateCurrent, true);
                } else {
                    this.props.history.push(
                        `/enrolled/training/${enrolled.id}`
                    );
                }
            }
        }
    };
    handlePreviousLesson = () => {
        let {
            enrolled: {
                current,
                training: { sections }
            }
        } = this.state;
        let currentLectureIndex, currentSection, currentSectionIndex, prev;
        current = JSON.parse(current);
        sections.find(section => {
            let { lectures } = section;
            lectures.find((lecture, i) => {
                if (lecture.id === current.current.lecture) {
                    currentSection = section;
                    let index = lecture.index - 1;
                    if (index >= 1) {
                        // go back one lecture
                        console.log('go back 1 lecture');
                        currentLectureIndex = i;
                        prev = true;
                    } else {
                        console.log('go to prev section');
                        // tells it go to prev section
                        prev = false;
                    }
                }
            });
        });
        if (prev) {
            // prev lecture logic
            console.log('prev lecture logic');
            let { lectures } = currentSection;
            let id;

            console.log(lectures, 'in handle');
            lectures.find((lecture, i) => {
                if (i < currentLectureIndex) {
                    id = lecture.id;
                }
            });
            let updateCurrent = {
                ...current,
                current: {
                    lecture: id,
                    section: current.current.section
                }
            };
            console.log(updateCurrent, 'updated current');
            this.updateCurrent(updateCurrent, false);
        } else {
            // prev section logic
            console.log('prev section logic');
            currentSectionIndex = sections.findIndex(section => {
                return section.id === currentSection.id;
            });
            if (--currentSectionIndex >= 0) {
                let newSectionId, newLectureId;
                sections.find((section, i) => {
                    if (i === currentSectionIndex) {
                        newSectionId = section.id;
                        // get the last element of the array
                        newLectureId =
                            section.lectures[section.lectures.length - 1].id;
                    }
                });
                let updateCurrent = {
                    ...current,
                    current: {
                        lecture: newLectureId,
                        section: newSectionId
                    }
                };
                this.updateCurrent(updateCurrent, false);
            } else {
                console.log('this is the first section');
            }
        }
    };
    handleCheckTest = (status) => {
        this.setState({
            checkTest: status
        })
    }
    render() {
        if (this.state.noSections) {
            noSection = (
                <EmptyTraining message={'This training is still empty'}>
                    <Link
                        to={`/enrolled/training/${enrolled.id}`}
                        className='btn btn-secondary'
                    >
                        Go back
                    </Link>
                </EmptyTraining>
            );
        }
        return (
            <TrainingProgressContainer className='mt-n4'>
                <Container className='d-flex flex-row'>
                    <LeftPane className='d-flex flex-column'>
                        <div className='p-3 border-bottom'>
                            <h4 className='text-center'>
                                {this.state.loading ? (
                                    <Skeleton height={30} />
                                ) : (
                                    this.state.enrolled.training.title
                                )}
                            </h4>
                        </div>
                        {this.state.loading ? (
                            <Skeleton count={12} height={30} />
                        ) : (
                            <Left enrolled={this.state.enrolled} />
                        )}
                        <div className='mt-auto border-top'>
                            {this.state.loading ? (
                                <Skeleton />
                            ) : (
                                <Link
                                    to={`/enrolled/training/${this.state.enrolled.id}`}
                                    className='btn btn-block btn-light mb-1'
                                >
                                    Finish later
                                </Link>
                            )}
                        </div>
                    </LeftPane>
                    <RightPane
                        className='d-flex flex-column overflow-auto flex-fill'
                        ref={this.myRef}
                    >
                        {this.state.lecture === null ? (
                            <Container>
                                <div className='mb-5'>
                                    <Skeleton height={40} />
                                </div>
                                <Skeleton count={16} />
                            </Container>
                        ) : (
                            <Content
                                lecture={this.state.lecture}
                                enrolledId={this.state.enrolled.id}
                                checkTest={this.handleCheckTest}
                            >
                                <div className='d-flex justify-content-between border-top p-3'>
                                    <div>
                                        <Button
                                            color='secondary'
                                            outline
                                            onClick={this.handlePreviousLesson}
                                        >
                                            <MdArrowBack /> Previous
                                        </Button>
                                    </div>
                                    <div>
                                        <Button
                                            onClick={this.handleNextLesson}
                                            outline
                                            color='primary'
                                            disabled={this.state.checkTest}
                                        >
                                            Next lesson <MdArrowForward />
                                        </Button>
                                    </div>
                                </div>
                            </Content>
                        )}
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
    padding-top: 0.5rem !important;
    background: white;
    max-width: 292px;
`;

const RightPane = styled(ViewPortContainer)`
    border-right: 1px solid #dee2e6 !important;
    background: white;
    width: 70%;
`;
