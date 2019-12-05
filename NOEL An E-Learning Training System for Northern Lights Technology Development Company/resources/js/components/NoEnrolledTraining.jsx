import React from 'react';
import NoTraining from '../../img/undraw_empty.svg';

export default props => (
    <div className='d-flex justify-content-center align-items-center flex-column mt-5'>
        <img
            src={NoTraining}
            alt='You are not currently enrolled to a training'
            className='img-fluid w-25'
        />
        <h5 className='my-3'>No trainings found</h5>
        {props.children}
    </div>
);
