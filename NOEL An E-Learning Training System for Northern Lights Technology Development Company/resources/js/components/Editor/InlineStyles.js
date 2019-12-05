import React from 'react';
import StyleButton from './StyleButton';
import FormatBoldRoundedIcon from '@material-ui/icons/FormatBoldRounded';
import FormatItalicRoundedIcon from '@material-ui/icons/FormatItalicRounded';
import FormatUnderlinedRoundedIcon from '@material-ui/icons/FormatUnderlinedRounded';

export var INLINE_STYLES = [
    { label: 'Bold', style: 'BOLD', icon: <FormatBoldRoundedIcon /> },
    { label: 'Italic', style: 'ITALIC', icon: <FormatItalicRoundedIcon /> },
    {
        label: 'Underline',
        style: 'UNDERLINE',
        icon: <FormatUnderlinedRoundedIcon />
    },
    { label: 'Monospace', style: 'CODE' }
];

const InlineStyleControls = props => {
    var currentStyle = props.editorState.getCurrentInlineStyle();
    return (
        <div className='RichEditor-controls'>
            {INLINE_STYLES.map(type => (
                <StyleButton
                    key={type.label}
                    active={currentStyle.has(type.style)}
                    label={type.icon || type.label}
                    onToggle={props.onToggle}
                    style={type.style}
                />
            ))}
        </div>
    );
};
export default InlineStyleControls;
