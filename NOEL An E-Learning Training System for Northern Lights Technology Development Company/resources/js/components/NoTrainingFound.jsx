import React from 'react';
import Center from './Center';
import NoData from '../../img/undraw_no_data.svg';

export default props => (
    <div className='d-flex justify-content-center align-items-center flex-column mt-5'>
        <img src={NoData} alt='No trainings image' className='img-fluid w-25' />
        <h5 className='mt-3 text-muted'>No trainings found</h5>
        {props.children}
    </div>
);
