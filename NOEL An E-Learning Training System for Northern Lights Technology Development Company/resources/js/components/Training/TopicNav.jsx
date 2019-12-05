import React from 'react';
import styled from 'styled-components';

const CurrentSection = styled.div`
    background: aliceblue;
    border-bottom: 1px solid #bbdefb;
    border-top: 1px solid #bbdefb;
    &:first-child {
        border-top: 0;
    }
`;

const CurrentTopic = styled.div`
    background-color: #4b8df8;
    color: white;
    border-radius: 25px 0 0 25px;
`;

const TopicNav = props => {
    let { sections } = props.enrolled.training;
    // console.log(props.enrolled);
    let SectionItems = sections.map(section => {
        let { lectures } = section;
        let { current } = props.enrolled;
        current = JSON.parse(current);
        let items = lectures.map(lecture => {
            if (current) {
                if (current.current.lecture === lecture.id) {
                    return (
                        <CurrentTopic key={lecture.id} className='pl-4 py-2'>
                            {lecture.title}
                        </CurrentTopic>
                    );
                } else {
                    return (
                        <div key={lecture.id} className='pl-4 py-2'>
                            {lecture.title}
                        </div>
                    );
                }
            }
        });
        if (current) {
            if (current.current.section === section.id) {
                return (
                    <CurrentSection key={section.id} className='pl-4 py-2'>
                        <h6 className='text-uppercase font-weight-bold text-truncate'>
                            {section.title}
                        </h6>
                        <div>{items}</div>
                    </CurrentSection>
                );
            } else {
                return (
                    <div key={section.id} className='pl-4 py-2'>
                        <h6 className='text-uppercase font-weight-bold text-truncate'>
                            {section.title}
                        </h6>
                        <div>{items}</div>
                    </div>
                );
            }
        }
    });

    return <div className='overflow-auto style-3'>{SectionItems}</div>;
};

export default TopicNav;
