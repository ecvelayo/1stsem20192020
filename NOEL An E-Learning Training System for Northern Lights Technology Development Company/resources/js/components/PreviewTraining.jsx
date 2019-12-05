import React from 'react';
import Axios from 'axios';
import { Container } from 'reactstrap';
import Loading from './Loading';
import PageNotFound from './PageNotFound';
import { EditorState, convertFromRaw } from 'draft-js';
import getBlockStyle from './Editor/GetBlockStyle';
import styleMap from './Editor/StyleMap';
import styled from 'styled-components';

import Editor, { composeDecorators } from 'draft-js-plugins-editor';
import createAlignmentPlugin from 'draft-js-alignment-plugin';
import createResizeablePlugin from 'draft-js-resizeable-plugin';
import createBlockDndPlugin from 'draft-js-drag-n-drop-plugin';
import createImagePlugin from 'draft-js-image-plugin';

const resizeablePlugin = createResizeablePlugin();
const blockDndPlugin = createBlockDndPlugin();
const alignmentPlugin = createAlignmentPlugin();

const decorator = composeDecorators(
    resizeablePlugin.decorator,
    alignmentPlugin.decorator,
    blockDndPlugin.decorator
);
const imagePlugin = createImagePlugin({ decorator });

const plugins = [
    blockDndPlugin,
    alignmentPlugin,
    resizeablePlugin,
    imagePlugin
];

const BodyContainer = styled.div`
    border-top: none !important;
    margin-top: 0 !important;
`;

const Navigation = ({ training, current }) => {
    return (
        <div
            className='flex-shrink-1 px-2 py-1'
            style={{
                maxHeight: '448px',
                overflowY: 'auto',
                overflowX: 'hidden'
            }}>
            {training.sections.map(section => {
                return (
                    <div
                        key={section.id}
                        className='d-flex flex-column'
                        style={{ minWidth: '248px' }}>
                        <div className='h6 mb-1'>{section.title}</div>
                        {section.lectures.map(lecture => (
                            <div
                                key={lecture.id}
                                className={`pl-3 p-1 ${
                                    current && current.id === lecture.id
                                        ? 'bg-primary text-white rounded'
                                        : ''
                                }`}>
                                {lecture.title}
                            </div>
                        ))}
                    </div>
                );
            })}
        </div>
    );
};
const Content = props => {
    const [editorState, setEditorState] = React.useState(
        EditorState.createEmpty()
    );
    const [questions, setQuestions] = React.useState([]);
    React.useEffect(() => {
        if (props.current && !props.current.isTest) {
            setEditorState(
                EditorState.createWithContent(
                    convertFromRaw(JSON.parse(props.current.content))
                )
            );
        }
        if (props.current && props.current.isTest) {
            const fetchData = async () => {
                const result = await Axios.get(
                    `/api/lecture/${props.current.id}/test`
                ).catch(error => console.log(error.response));
                setQuestions(result.data);
            };
            fetchData();
        }
    }, [props.current ? props.current.id : null]);
    if (props.current && !props.current.isTest) {
        return (
            <div
                className='d-flex flex-column border-left w-100 overflow-auto'
                style={{ maxHeight: '448px' }}>
                <div className='RichEditor-root' style={{ border: 0 }}>
                    <BodyContainer className='RichEditor-editor'>
                        <Editor
                            blockStyleFn={getBlockStyle}
                            customStyleMap={styleMap}
                            editorState={editorState}
                            plugins={plugins}
                            readOnly
                        />
                    </BodyContainer>
                </div>
                {props.children}
            </div>
        );
    }
    if (props.current && props.current.isTest) {
        return (
            <div
                className='d-flex flex-column border-left w-100 overflow-auto'
                style={{ maxHeight: '448px' }}>
                <div className='p-4'>
                    {questions &&
                        questions.map(question => {
                            console.log(question);
                            return (
                                <div className='card my-1' key={question.id}>
                                    <div className='card-body'>
                                        <div>
                                            <div className='h5 mb-1'>
                                                {question.question}
                                            </div>
                                            <div className='row'>
                                                {JSON.parse(
                                                    question.answers
                                                ).map(answer => (
                                                    <div
                                                        className='col text-muted'
                                                        key={answer}>
                                                        {answer}
                                                    </div>
                                                ))}
                                            </div>
                                            <div className='font-weight-bold text-success'>
                                                {question.correct}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            );
                        })}
                </div>
                {props.children}
            </div>
        );
    }
    return (
        <div
            className='d-flex flex-column h5 text-muted font-italic border-left w-100'
            style={{ maxHeight: '448px' }}>
            <div>This section is empty</div>
            {props.children}
        </div>
    );
};

export default class PreviewTraining extends React.Component {
    state = {
        training: {},
        loading: true,
        notFound: false,
        current: null
    };
    componentDidMount = () => {
        Axios.get(`/api/training/${this.props.match.params.training}`)
            .then(({ data }) => {
                this.setState({
                    training: data,
                    loading: false,
                    current: {
                        sections:
                            data.sections.length > 0 ? data.sections[0] : null,
                        lecture:
                            data.sections[0].lectures.length > 0
                                ? data.sections[0].lectures[0]
                                : null
                    }
                });
            })
            .catch(error => {
                console.log(error);
            });
    };
    next = () => {
        const {
            training: { sections },
            current
        } = this.state;
        let currentLectureIndex, currentSection, currentSectionIndex;
        let next = false;
        sections.find(section => {
            const { lectures } = section;
            lectures.find((lecture, i) => {
                if (lecture.id === current.lecture.id) {
                    // this is the current lecture
                    currentSection = section;
                    let index = lecture.index + 1;
                    if (index <= lectures.length) {
                        // index is not greater than length
                        currentLectureIndex = i;
                        next = true;
                    } else {
                        // go to next section instead
                        next = false;
                    }
                }
            });
        });
        if (next) {
            // next lecture
            let { lectures } = currentSection;
            let newLecture;
            lectures.find((lecture, i) => {
                if (i === currentLectureIndex + 1) {
                    newLecture = lecture;
                }
            });
            this.setState({
                current: {
                    ...this.state.current,
                    lecture: newLecture
                }
            });
        } else {
            // next section
            // pass the current section index
            currentSectionIndex = sections.findIndex(section => {
                return section.id === currentSection.id;
            });
            if (++currentSectionIndex < sections.length) {
                let newSection, newLecture;
                sections.find((section, i) => {
                    if (i === currentSectionIndex) {
                        newSection = section;
                        newLecture =
                            section.lectures.length > 0
                                ? section.lectures[0]
                                : null;
                    }
                });
                if (newLecture !== null) {
                    this.setState({
                        current: {
                            section: newSection,
                            lecture: newLecture
                        }
                    });
                } else {
                    alert('the next lecture is empty');
                }
            } else {
                console.log('final section');
            }
        }
    };
    prev = () => {
        const {
            training: { sections },
            current
        } = this.state;
        let currentLectureIndex, currentSection, currentSectionIndex;
        let prev;
        sections.find(section => {
            const { lectures } = section;
            lectures.find((lecture, i) => {
                if (lecture.id === current.lecture.id) {
                    // this is the current lecture
                    currentSection = section;
                    let index = lecture.index - 1;
                    if (index >= 1) {
                        // go back 1 lecture
                        currentLectureIndex = i;
                        prev = true;
                    } else {
                        prev = false;
                        // go to prev section instead
                    }
                }
            });
        });
        if (prev) {
            // prev lecture
            const { lectures } = currentSection;
            let newLecture;
            lectures.find((lecture, i) => {
                if (i < currentLectureIndex) {
                    newLecture = lecture;
                }
            });
            this.setState({
                current: {
                    ...this.state.current,
                    lecture: newLecture
                }
            });
        } else {
            currentSectionIndex = sections.findIndex(section => {
                return section.id === currentSection.id;
            });
            if (--currentSectionIndex >= 0) {
                let newSection, newLecture;
                sections.find((section, i) => {
                    if (i === currentSectionIndex) {
                        newSection = section;
                        // get the last element of the array
                        newLecture =
                            section.lectures[section.lectures.length - 1];
                    }
                });
                this.setState({
                    current: {
                        lecture: newLecture,
                        section: newSection
                    }
                });
            } else {
                console.log('this is the first section');
            }
        }
    };
    render() {
        if (this.state.loading) {
            return <Loading />;
        }
        if (this.state.notFound) {
            return <PageNotFound />;
        }
        return (
            <Container className='bg-white'>
                <div className='display-4 text-center'>
                    {this.state.training.title}
                </div>
                <div className='d-flex flex-row mt-5'>
                    <Navigation
                        training={this.state.training}
                        current={this.state.current.lecture}
                    />
                    <Content current={this.state.current.lecture}>
                        <div className='d-flex flex-row justify-content-between p-3 border-top mt-auto'>
                            <button
                                className='btn btn-secondary'
                                onClick={() => this.prev()}>
                                Previous
                            </button>
                            <button
                                className='btn btn-primary'
                                onClick={() => this.next()}>
                                Next
                            </button>
                        </div>
                    </Content>
                </div>
            </Container>
        );
    }
}
