import styled from 'styled-components';

const CardContainer = styled.div`
    margin: 0.75rem 0;
    transition: 0.5s;
    transform: translate3d(0, 0, 0);
    transition-timing-function: cubic-bezier(0.25, 0.1, 0.2, 1);

    a {
        color: black;
    }

    img {
        object-fit: cover;
        height: 250px;
    }

    &:hover {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
`;

export default CardContainer;
