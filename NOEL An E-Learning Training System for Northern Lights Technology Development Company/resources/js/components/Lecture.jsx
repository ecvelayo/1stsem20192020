import React from 'react';
import LectureEditor from './LectureEditor';
import Loading from './Loading';
import PageNotFound from './PageNotFound';
import FailedToFetchData from './FailedToFetchData';
import Axios from 'axios';
import { Container } from 'reactstrap';
import styled from 'styled-components';
import Skeleton from 'react-loading-skeleton';
import { MdArrowBack } from 'react-icons/md';

const ViewPreview = styled.div`
    padding: 0.15rem 0.25rem;
    small {
        color: dodgerblue;
    }
`;

export default class Lecture extends React.Component {
    state = {
        id: null,
        section_id: null,
        title: '',
        content: '',
        isTest: false,
        errors: [],
        loading: true,
        failedToFetch: false,
        notFound: false
    };

    componentDidMount = () => {
        this.getLectureData();
    };

    getLectureData = () => {
        let data = this.props.match.params;
        Axios.get(
            `/api/training/${data.training}/section/${data.section}/lecture/${data.lecture}`
        )
            .then(response => {
                let lecture = response.data;
                this.setState({
                    id: lecture.id,
                    section_id: lecture.section_id,
                    title: lecture.title,
                    content: lecture.content,
                    isTest: lecture.isTest,
                    loading: false
                });
            })
            .catch(error => {
                let response = error.response;
                if (response.status === 500) {
                    this.setState({
                        failedToFetch: true
                    });
                } else if (response.status === 404) {
                    this.setState({
                        notFound: true
                    });
                }

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

    updateLectureContentData = content => {
        this.setState({
            content: content
        });
    };

    togglePreview = () => {
        let { history } = this.props;
        let { lecture, section, training } = this.props.match.params;
        history.push(
            `/view/training/${training}/section/${section}/lecture/${lecture}`
        );
    };

    goToSection = () => {
        let { section, training } = this.props.match.params;
        this.props.history.push(
            `/edit/training/${training}/section/${section}`
        );
    };

    render() {
        if (this.state.failedToFetch) {
            return (
                <FailedToFetchData message='We are unable to fetch data from the server.' />
            );
        }

        if (this.state.notFound) {
            return <PageNotFound />;
        }

        if (this.state.loading) {
            return <Loading />;
        }

        return (
            <Container>
                <div className='my-4 h1'>
                    {this.state.title || <Skeleton />}
                </div>
                <ViewPreview className='d-flex flex-row justify-content-between align-items-center'>
                    <div>
                        <button
                            onClick={this.goToSection}
                            className='btn btn-light btn-sm'
                        >
                            <span className='small'>
                                <MdArrowBack /> Back to Sections
                            </span>
                        </button>
                    </div>
                    <div>
                        <button
                            onClick={this.togglePreview}
                            className='btn btn-light btn-sm'
                        >
                            <small>Preview</small>
                        </button>
                    </div>
                </ViewPreview>
                <LectureEditor
                    content={this.state.content}
                    id={this.state.id}
                    updateContent={this.updateLectureContentData}
                />
            </Container>
        );
    }
}
