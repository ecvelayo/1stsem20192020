import React from 'react';
import FailedLoadImg from '../../../img/undraw_in_progress.svg';

export default props => (
    <div className='d-flex justify-content-center align-items-center flex-column'>
        <img
            src={FailedLoadImg}
            alt='Unable to fetch data'
            className='h-50 w-50'
        />
        <h5 className='mt-3 text-muted'>{props.message}</h5>
        {props.children}
    </div>
);
