import React from 'react';
import styled from 'styled-components';
import Skeleton from 'react-loading-skeleton';
import DoneRoundedIcon from '@material-ui/icons/DoneRounded';
import { green } from '@material-ui/core/colors';
import { makeStyles } from '@material-ui/core/styles';

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

const useStyles = makeStyles(theme => ({
    root: {
        color: green[600],
        position: 'absolute',
        left: '-8px'
    },
    text: {
        color: green[600]
    }
}));

export default function Left(props) {
    const classes = useStyles();
    const { sections } = props.enrolled.training;
    let SectionItems = sections.map(section => {
        const { lectures } = section;
        let { current } = props.enrolled;
        current = JSON.parse(current);
        if (current) {
            let items = lectures.map(lecture => {
                if (current.current.lecture === lecture.id) {
                    return (
                        <CurrentTopic key={lecture.id} className='pl-4 py-2'>
                            {lecture.title}
                        </CurrentTopic>
                    );
                } else {
                    return (
                        <div
                            key={lecture.id}
                            className='pl-4 py-2 position-relative'
                        >
                            {current.finished.includes(lecture.id) ? (
                                <DoneRoundedIcon className={classes.root} />
                            ) : null}
                            <span
                                className={
                                    current.finished.includes(lecture.id)
                                        ? classes.text
                                        : null
                                }
                            >
                                {lecture.title}
                            </span>
                        </div>
                    );
                }
            });

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
    return (
        <div className='overflow-auto style-3'>
            {SectionItems || <Skeleton />}
        </div>
    );
}
