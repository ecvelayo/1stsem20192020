import React from 'react';
import NotFound from '../../img/undraw_page_not_found.svg';
import styled from 'styled-components';
import { Browser } from 'react-kawaii';

const CenterContainer = styled.div`
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
`;

export default props => (
    <CenterContainer>
        <div className='d-flex justify-content-center align-items-center flex-column'>
            <Browser size={200} mood='ko' color='#61ddbc' />
            {/* <img src={NotFound} alt='Page not found' className='h-50 w-50' /> */}
            <div className='display-4 mt-2'>404</div>
            <h5 className='mt-3 text-muted'>Page not found</h5>
            {props.children}
        </div>
    </CenterContainer>
);
