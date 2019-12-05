import React from 'react';
import Center from './Center';
import CircularProgress from '@material-ui/core/CircularProgress';

export default props => (
    <div className='d-flex justify-content-center position-relative'>
        <Center>
            <CircularProgress size={'5rem'} />
            {props.children}
        </Center>
    </div>
);
