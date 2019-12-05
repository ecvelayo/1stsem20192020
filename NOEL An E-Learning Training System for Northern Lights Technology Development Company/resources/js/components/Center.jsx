import React from 'react';
import styled from 'styled-components';

const CenterContainer = styled.div`
    position: fixed;
    z-index: 1031;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
`;

export default props => <CenterContainer>{props.children}</CenterContainer>;
