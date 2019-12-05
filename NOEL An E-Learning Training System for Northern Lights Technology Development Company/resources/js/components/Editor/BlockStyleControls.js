import React from 'react';
import StyleButton from './StyleButton';
import FormatQuoteRoundedIcon from '@material-ui/icons/FormatQuoteRounded';
import FormatListBulletedRoundedIcon from '@material-ui/icons/FormatListBulletedRounded';
import FormatListNumberedRoundedIcon from '@material-ui/icons/FormatListNumberedRounded';
import CodeRoundedIcon from '@material-ui/icons/CodeRounded';

export const BLOCK_TYPES = [
    { label: 'H1', style: 'header-one' },
    { label: 'H2', style: 'header-two' },
    { label: 'H3', style: 'header-three' },
    { label: 'H4', style: 'header-four' },
    { label: 'H5', style: 'header-five' },
    { label: 'H6', style: 'header-six' },
    {
        label: 'Blockquote',
        style: 'blockquote',
        icon: <FormatQuoteRoundedIcon />
    },
    {
        label: 'UL',
        style: 'unordered-list-item',
        icon: <FormatListBulletedRoundedIcon />
    },
    {
        label: 'OL',
        style: 'ordered-list-item',
        icon: <FormatListNumberedRoundedIcon />
    },
    { label: 'Code Block', style: 'code-block', icon: <CodeRoundedIcon /> }
];

const BlockStyleControls = props => {
    const { editorState } = props;
    const selection = editorState.getSelection();
    const blockType = editorState
        .getCurrentContent()
        .getBlockForKey(selection.getStartKey())
        .getType();

    return (
        <div className='RichEditor-controls'>
            {BLOCK_TYPES.map(type => (
                <StyleButton
                    key={type.label}
                    active={type.style === blockType}
                    label={type.icon || type.label}
                    onToggle={props.onToggle}
                    style={type.style}
                />
            ))}
        </div>
    );
};
export default BlockStyleControls;
