import React from 'react';
import {
    Container,
    Button,
    Col,
    Row,
    ListGroup,
    ListGroupItem
} from 'reactstrap';
import BlankImg from '../../../img/undraw_blank_canvas.svg';
import styled from 'styled-components';
import { MdArrowBack, MdBookmarkBorder, MdDone } from 'react-icons/md';
import Skeleton from 'react-loading-skeleton';
import { Link } from 'react-router-dom';

const InfoPanelContainer = styled.div`
    width: 30%;
`;

const ImageContainer = styled.img`
    max-width: 100%;
`;

const StyledListGroupItem = styled(ListGroupItem)`
    &:first-child {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    border-left: 0;
    border-right: 0;
`;

const InfoPanel = props => {
    let { training, enrolled } = props;
    let dateEnrolled = new Date(enrolled.created_at);
    let dateCompleted = enrolled.date_completed
        ? new Date(enrolled.date_completed)
        : null;
    let options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric'
    };
    return (
        <InfoPanelContainer className='d-flex flex-column align-self-stretch border-right border-left pt-3'>
            <Container className='overflow-auto mb-3'>
                <div className='d-flex justify-content-center'>
                    <ImageContainer
                        src={
                            training.image
                                ? `/storage/trainings/${training.image}`
                                : BlankImg
                        }
                    />
                </div>
            </Container>
            <ListGroup>
                <StyledListGroupItem>
                    <div className='mb-1'>
                        <MdBookmarkBorder className='mr-2' /> Date enrolled
                    </div>
                    <div className='text-center lead'>
                        {dateEnrolled.toLocaleDateString('en-US', options)}
                    </div>
                </StyledListGroupItem>
                <StyledListGroupItem>
                    <div className='mb-1'>
                        <MdDone className='mr-2' /> Date finished
                    </div>
                    <div className='text-center lead'>
                        {dateCompleted
                            ? dateCompleted.toLocaleDateString('en-US', options)
                            : 'Ongoing'}
                    </div>
                </StyledListGroupItem>
            </ListGroup>
            <div className='mt-auto mb-1 border-top'>
                <Link className='btn btn-light btn-block' to='/dashboard'>
                    <MdArrowBack className='mr-2' /> Back to Dashboard
                </Link>
            </div>
        </InfoPanelContainer>
    );
};

export default InfoPanel;
