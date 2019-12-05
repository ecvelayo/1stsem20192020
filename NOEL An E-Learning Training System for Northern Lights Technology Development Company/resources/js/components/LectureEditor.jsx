import React from 'react';
import {
    // Editor,
    EditorState,
    RichUtils,
    convertToRaw,
    convertFromRaw,
    getDefaultKeyBinding,
    KeyBindingUtil
} from 'draft-js';
// import './LectureStyle.css';
import Axios from 'axios';
import debounce from 'lodash/debounce';
import styled from 'styled-components';
import BlockStyleControls from './Editor/BlockStyleControls';
import getBlockStyle from './Editor/GetBlockStyle';
import InlineStyleControls from './Editor/InlineStyles';
import styleMap from './Editor/StyleMap';
import PublishRoundedIcon from '@material-ui/icons/PublishRounded';
import { Modal, ModalBody } from 'reactstrap';
import LinearProgress from '@material-ui/core/LinearProgress';

import 'draft-js-image-plugin/lib/plugin.css';
import 'draft-js-alignment-plugin/lib/plugin.css';

import Editor, { composeDecorators } from 'draft-js-plugins-editor';
import createAlignmentPlugin from 'draft-js-alignment-plugin';
import createFocusPlugin from 'draft-js-focus-plugin';
import createResizeablePlugin from 'draft-js-resizeable-plugin';
import createBlockDndPlugin from 'draft-js-drag-n-drop-plugin';
import createImagePlugin from 'draft-js-image-plugin';

const focusPlugin = createFocusPlugin();
const resizeablePlugin = createResizeablePlugin();
const blockDndPlugin = createBlockDndPlugin();
const alignmentPlugin = createAlignmentPlugin();
const { AlignmentTool } = alignmentPlugin;

const decorator = composeDecorators(
    resizeablePlugin.decorator,
    alignmentPlugin.decorator,
    focusPlugin.decorator,
    blockDndPlugin.decorator
);
const imagePlugin = createImagePlugin({ decorator });

const plugins = [
    blockDndPlugin,
    focusPlugin,
    alignmentPlugin,
    resizeablePlugin,
    imagePlugin
];

const StatusBar = styled.div`
    background-color: #f7f7f7 !important;
    border: 1px solid #dee2e6 !important;
    padding-left: 1rem !important;
    span {
        font-size: 80%;
        font-weight: 400;
    }
    position: fixed;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1030;
`;

const StickyContainer = styled.div`
    position: sticky;
    top: 0;
    z-index: 1020;
    background: white;
    padding: 1rem;
    border-bottom: 1px solid #ddd;
`;

const { hasCommandModifier } = KeyBindingUtil;

export default class LectureEditor extends React.Component {
    addFile;
    constructor(props) {
        super(props);
        this.state = {
            saved: 'No changes',
            progress: 0,
            modal: false
        };

        const content = this.props.content;

        if (content) {
            this.state.editorState = EditorState.createWithContent(
                convertFromRaw(JSON.parse(content))
            );
        } else {
            this.state.editorState = EditorState.createEmpty();
        }

        this.focus = () => this.refs.editor.focus();
        // this.onChange = editorState => this.onChange(editorState);

        this.handleKeyCommand = command => this._handleKeyCommand(command);
        // this.onTab = e => this._onTab(e);
        this.toggleBlockType = type => this._toggleBlockType(type);
        this.toggleInlineStyle = style => this._toggleInlineStyle(style);
        // this.myKeyBindingFn = this.myKeyBindingFn.bind(this);
    }

    componentWillUnmount = () => {
        this.saveContent.cancel();
    };

    onChange = editorState => {
        const contentState = editorState.getCurrentContent();
        this.saveContent(contentState);
        this.setState({ editorState, saved: 'processing...' });
    };

    saveContent = debounce(content => {
        this.updateContent(content);
    }, 3000);

    updateContent = content => {
        this.setState({
            saved: 'All changes saved!'
        });
        let body = {
            content: JSON.stringify(convertToRaw(content))
        };
        let header = {
            'Content-Type': 'application/json'
        };
        Axios.post(`/api/lecture/content/${this.props.id}`, body, {
            header: header
        })
            .then(response => {
                this.props.updateContent(response);
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

    myKeyBindingFn = e => {
        // if (e.keyCode === 49 && hasCommandModifier(e)) {
        if (e.keyCode === 83 && hasCommandModifier(e)) {
            return 'myeditor-save';
            // return 'header-one';
        }
        return getDefaultKeyBinding(e);
    };

    _handleKeyCommand(command) {
        const { editorState } = this.state;
        const newState = RichUtils.handleKeyCommand(editorState, command);
        if (command === 'myeditor-save') {
            const contentState = editorState.getCurrentContent();
            this.updateContent(contentState);
        }
        if (newState) {
            this.onChange(newState);
            return true;
        }
        return false;
    }

    // _onTab(e) {
    //     const maxDepth = 4;
    //     this.onChange(RichUtils.onTab(e, this.state.editorState, maxDepth));
    // }

    _toggleBlockType(blockType) {
        this.onChange(
            RichUtils.toggleBlockType(this.state.editorState, blockType)
        );
    }

    _toggleInlineStyle(inlineStyle) {
        this.onChange(
            RichUtils.toggleInlineStyle(this.state.editorState, inlineStyle)
        );
    }

    handleAddMedia = event => {
        if (event.target.files[0].type.includes('image')) {
            console.log('image');
            if (event.target.files[0].size > 5000000) {
                console.log('Big size');
            } else {
                console.log('Accepted');
                console.log(event.target.files[0]);
                const image = new FormData();
                image.append(
                    'image',
                    event.target.files[0],
                    event.target.files[0].name
                );
                Axios.post('/api/add/image', image, {
                    onUploadProgress: progressEvent => {
                        let progress = Math.round(
                            (progressEvent.loaded / progressEvent.total) * 100
                        );
                        this.setState({
                            modal: true,
                            progress: progress
                        });
                    }
                })
                    .then(({ data }) => {
                        console.log(data);
                        this.onChange(
                            imagePlugin.addImage(this.state.editorState, data)
                        );
                        this.setState({
                            modal: false,
                            progress: 0
                        });
                    })
                    .catch(error => console.log(error.response));
                // const contentState = this.state.editorState.getCurrentContent();
                // const contentStateWithEntity = contentState.createEntity(
                //     'image',
                //     'IMMUTABLE',
                //     { src: base64 },
                //     );
                // console.log(contentStateWithEntity);
            }
        } else {
            console.log('video');
            if (event.target.files[0].size > 20000000) {
                console.log('Big size');
            } else {
                console.log('Accepted');
                console.log(event.target.files[0]);
            }
        }
    };

    render() {
        const { editorState } = this.state;

        // If the user changes block type before entering any text, we can
        // either style the placeholder or hide it. Let's just hide it now.
        let className = 'RichEditor-editor';
        var contentState = editorState.getCurrentContent();
        if (!contentState.hasText()) {
            if (
                contentState
                    .getBlockMap()
                    .first()
                    .getType() !== 'unstyled'
            ) {
                className += ' RichEditor-hidePlaceholder';
            }
        }

        return (
            <div className='mb-5'>
                <Modal
                    isOpen={this.state.modal}
                    backdrop='static'
                    centered={true}
                >
                    <ModalBody>
                        <LinearProgress
                            color='primary'
                            variant='determinate'
                            value={this.state.progress}
                        ></LinearProgress>
                        <div className='text-center'>
                            <h5>Uploading</h5>
                        </div>
                    </ModalBody>
                </Modal>
                <div className='RichEditor-root'>
                    <StickyContainer>
                        <div className='d-flex flex-row align-items-center justify-content-between'>
                            <div>
                                <BlockStyleControls
                                    editorState={editorState}
                                    onToggle={this.toggleBlockType}
                                />
                                <InlineStyleControls
                                    editorState={editorState}
                                    onToggle={this.toggleInlineStyle}
                                />
                            </div>
                            <div>
                                <button
                                    className='btn btn-light'
                                    onClick={() => {
                                        this.addFile.click();
                                    }}
                                >
                                    <PublishRoundedIcon /> Insert file
                                </button>
                                <input
                                    type='file'
                                    name='media'
                                    id='media'
                                    ref={c => (this.addFile = c)}
                                    className='d-none'
                                    onChange={event => {
                                        this.handleAddMedia(event);
                                    }}
                                />
                            </div>
                        </div>
                    </StickyContainer>
                    <div className={className} onClick={this.focus}>
                        <Editor
                            blockStyleFn={getBlockStyle}
                            customStyleMap={styleMap}
                            editorState={editorState}
                            handleKeyCommand={this.handleKeyCommand}
                            onChange={this.onChange}
                            plugins={plugins}
                            // onTab={this.onTab}
                            placeholder='Text goes here...'
                            ref='editor'
                            spellCheck={true}
                            // style={{ overflowY: 'scroll', maxHeight: '528px' }}
                            keyBindingFn={this.myKeyBindingFn}
                        />
                        <AlignmentTool />
                    </div>
                </div>
                <StatusBar>
                    <div className='container'>
                        <span>{this.state.saved}</span>
                    </div>
                </StatusBar>
                <div className='mt-3'>
                    <div className='bg-light w-50 small'>
                        Press
                        <kbd className='mx-2'>
                            <kbd>ctrl</kbd>/<kbd>cmd</kbd> + <kbd>S</kbd>
                        </kbd>
                        to save changes
                    </div>
                </div>
            </div>
        );
    }
}
