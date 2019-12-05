import React from 'react';
import {
    // Editor,
    EditorState,
    convertFromRaw,
    convertToRaw,
    RichUtils
} from 'draft-js';
// import './LectureStyle.css';
import Axios from 'axios';
import styled from 'styled-components';
import getBlockStyle from './Editor/GetBlockStyle';
import styleMap from './Editor/StyleMap';
import { Container, Button } from 'reactstrap';
import { Link } from 'react-router-dom';
import { MdArrowBack } from 'react-icons/md';

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

export default class ViewLecture extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            editorState: EditorState.createEmpty()
        };
    }

    componentDidMount = () => {
        let { lecture, section, training } = this.props.match.params;
        Axios.get(
            `/api/training/${training}/section/${section}/lecture/${lecture}`
        )
            .then(response => {
                let { content } = response.data;
                this.setState({
                    editorState: EditorState.createWithContent(
                        convertFromRaw(JSON.parse(content))
                    )
                });
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

    goBack = () => {
        let { history } = this.props;
        let { lecture, section, training } = this.props.match.params;
        history.push(
            `/edit/training/${training}/section/${section}/lecture/${lecture}`
        );
    };

    render() {
        const { editorState } = this.state;

        const LectureBody = () => (
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
        );

        return (
            <div>
                <LectureContainer>
                    <Container>
                        <div>
                            <Button color='light' onClick={this.goBack}>
                                <MdArrowBack /> Back to lecture
                            </Button>
                        </div>
                        <LectureBody />
                    </Container>
                </LectureContainer>
                {/* <Link to='/' className='btn btn-secondary'>
                    Go back to sections
                </Link> */}
            </div>
        );
    }
}

const LectureContainer = styled.div`
    background-color: white;
`;

const BodyContainer = styled.div`
    border-top: none !important;
    margin-top: 0 !important;
`;
