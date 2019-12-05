import React from 'react';
import Center from './Center';
import FailedLoadImg from '../../img/undraw_server_down.svg';

export default props => (
    <Center>
        <div className='d-flex justify-content-center align-items-center flex-column'>
            <img
                src={FailedLoadImg}
                alt='Unable to fetch data'
                className='h-50 w-50'
            />
            <h5 className='mt-3 text-muted'>{props.message}</h5>
            {props.children}
        </div>
    </Center>
);
