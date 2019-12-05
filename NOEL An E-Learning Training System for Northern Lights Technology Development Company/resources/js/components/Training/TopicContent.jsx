import React from 'react';
import getBlockStyle from '../Editor/GetBlockStyle';
import styleMap from '../Editor/StyleMap';
import { Editor, EditorState, convertFromRaw } from 'draft-js';
import Axios from 'axios';
import { Container } from 'reactstrap';
import { MdArrowBack, MdArrowForward } from 'react-icons/md';
import Skeleton from 'react-loading-skeleton';
import TopicTestComponent from './TopicTestComponent';
import EmptyTraining from './EmptyTraining';
import { Link } from 'react-router-dom';

export default class TopicContent extends React.Component {
    state = {
        editorState: EditorState.createEmpty(),
        isTest: false,
        isChecked: false,
        questions: [],
        answers: [],
        title: '',
        noSections: false
    };
    // static getDerivedStateFromProps(props, state) {
    //     console.log(props, 'gds from props');
    //     console.log(state, 'gds from props');
    //     return null;
    // }
    componentDidMount = () => {
        let { enrolled } = this.props;
        // console.log(enrolled);
        if (enrolled.training.sections.length === 0) {
            this.setState({
                noSections: true
            });
        } else if (!enrolled.current) {
            let current = {
                id: enrolled.id,
                finished: {
                    sections: []
                },
                current: {
                    section: enrolled.training.sections[0].id,
                    lecture: enrolled.training.sections[0].lectures[0].id
                }
            };
            console.log('current is null');
            this.props.updateCurrent(current);
        } else {
            this.getContent();
        }
    };
    getContent = () => {
        let { enrolled } = this.props;
        let { current } = enrolled;
        current = JSON.parse(current);
        // console.log(current, 'get content in topicContent');
        Axios.get(
            `/api/training/${enrolled.training_id}/section/${current.current.section}/lecture/${current.current.lecture}`
        )
            .then(response => {
                // console.log(response.data, 'get content in topicContent');
                if (response.data.isTest) {
                    this.setState({
                        isTest: true,
                        title: response.data.title
                    });
                    this.getTest(response.data.id);
                } else {
                    let { content } = response.data;
                    this.setState({
                        isTest: false,
                        title: response.data.title,
                        editorState: EditorState.createWithContent(
                            convertFromRaw(JSON.parse(content))
                        )
                    });
                }
            })
            .catch(error => {
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
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
    getTest = lecture_id => {
        Axios.get(`/api/lecture/${lecture_id}/test`)
            .then(response => {
                // Returns the questions
                let items = response.data;
                this.setState({
                    isTest: true,
                    questions: items
                });
            })
            .catch(error => console.log(error.response));
    };
    checkAnswers = () => {
        this.setState({
            isChecked: !this.state.isChecked
        });
    };
    handleNextLesson = () => {
        alert('next lesson');
        let {
            enrolled: {
                current,
                training: { sections }
            }
        } = this.props;
        let currentLectureIndex, currentSection, next;
        current = JSON.parse(current);

        const handleNextLecture = index => {
            let { lectures } = currentSection;
            let id;
            lectures.find((lecture, i) => {
                if (i > index) {
                    id = lecture.id;
                }
            });
            // console.log(lectures, 'in nextLecture');
            // console.log(id, 'in nextLecture');
            let updateCurrent = {
                ...current,
                current: {
                    lecture: id,
                    section: current.current.section
                }
            };
            console.log(updateCurrent, 'updated current');
            this.props.updateCurrent(updateCurrent);
            // this.getContent();
        };

        // console.log(current);
        sections.find(section => {
            let { lectures } = section;
            lectures.find((lecture, i) => {
                if (lecture.id === current.current.lecture) {
                    currentSection = section;
                    let length = lecture.index + 1;
                    if (length <= lectures.length) {
                        // proceed to next lecture
                        console.log('maka proceed sa lecture');
                        currentLectureIndex = i;
                        next = true;
                    } else {
                        console.log('go to next section');
                        // tells it go to next section
                        next = false;
                    }
                }
            });
        });

        if (next) {
            // next lecture logic
            console.log('next lecture logic');
            handleNextLecture(currentLectureIndex);
        } else {
            // next section logic
            console.log('next section logic');
        }
    };
    render() {
        // console.log(this.state.title);
        let { enrolled } = this.props;
        if (this.state.noSections) {
            return (
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
        if (!this.state.isTest) {
            const { editorState } = this.state;
            const LectureBody = () => (
                <Container className='pb-5'>
                    <div className='display-3 font-weight-bold mt-3 mb-5'>
                        {this.state.title || <Skeleton />}
                    </div>
                    <div
                        className='RichEditor-root'
                        style={{ border: 0, paddingTop: 0, paddingBottom: 0 }}
                    >
                        <div
                            className='RichEditor-editor'
                            style={{ border: 0, margin: 0 }}
                        >
                            <Editor
                                blockStyleFn={getBlockStyle}
                                customStyleMap={styleMap}
                                editorState={editorState}
                                readOnly
                            />
                        </div>
                    </div>
                </Container>
            );

            return (
                <div>
                    <LectureBody />
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
                </div>
            );
        }

        let items = this.state.questions.map(question => {
            let { answers } = question;
            answers = JSON.parse(answers);
            // let choices = answers.map((answer, index) => (
            //     <div key={index}>{answer}</div>
            // ));
            return (
                <div key={question.id}>
                    <p className='lead'>{question.question}</p>
                    <TopicTestComponent
                        options={answers}
                        check={this.state.isChecked}
                        correct={question.correct}
                    />
                </div>
            );
        });

        // check items
        console.log(items);

        return (
            <Container>
                <div className='display-3 font-weight-bold mt-3 mb-5'>
                    {this.state.title || <Skeleton />}
                </div>
                <div>{items}</div>
                <div>
                    <button
                        className='btn btn-primary'
                        onClick={this.checkAnswers}
                    >
                        Check
                    </button>
                </div>
            </Container>
        );
    }
}
