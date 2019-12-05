import React from 'react';
import { Container } from 'reactstrap';
import Authenticate from './Auth/Authenticate';
import Axios from 'axios';
import { Link } from 'react-router-dom';
import styled from 'styled-components';
import { withStyles } from '@material-ui/core/styles';
import Button from '@material-ui/core/Button';
import { blue } from '@material-ui/core/colors';

export default class Requests extends React.Component {
    state = {
        requests: []
    };
    componentDidMount = () => {
        Authenticate.getCurrentUser(user => {
            if (!(user.isHR || user.isAdmin)) {
                console.log('Unauthorized');
                this.props.history.push('/');
            }
        });
        Axios.get('/api/get/requests')
            .then(({ data }) => {
                this.setState({
                    requests: data
                });
            })
            .catch(error => {
                console.log(error.response);
            });
    };
    render() {
        const { requests } = this.state;
        console.log(requests);
        return (
            <Container>
                <div className='h4 mb-4'>Requested Trainings</div>
                <div className='table-responsive'>
                    <table className='table table-hover'>
                        <thead className='text-uppercase h6 small'>
                            <tr>
                                <th>Title</th>
                                <th>Requested by</th>
                                <th>Date</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <StyledBody>
                            {requests.length > 0 ? (
                                requests.map(request => {
                                    if (request.is_created) {
                                        return (
                                            <tr key={request.id}>
                                                <td>{request.title}</td>
                                                <td>{`${request.user.fname} ${request.user.lname}`}</td>
                                                <td>{request.created_at}</td>
                                                <td>
                                                    <div className='d-flex'>
                                                        <span className='badge badge-success'>
                                                            PUBLISHED
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        );
                                    } else {
                                        return (
                                            <tr
                                                key={request.id}
                                                className='table-primary'
                                            >
                                                <td>{request.title}</td>
                                                <td>{`${request.user.fname} ${request.user.lname}`}</td>
                                                <td>{request.created_at}</td>
                                                <td>
                                                    <div className='d-flex'>
                                                        <CreateButton
                                                            variant='contained'
                                                            color='primary'
                                                            size='small'
                                                            className='btn btn-primary btn-sm text-uppercase'
                                                            component={
                                                                CreateLink
                                                            }
                                                            to={{
                                                                pathname: `/create`,
                                                                state: {
                                                                    id:
                                                                        request.id,
                                                                    title:
                                                                        request.title
                                                                }
                                                            }}
                                                        >
                                                            Create
                                                        </CreateButton>
                                                    </div>
                                                </td>
                                            </tr>
                                        );
                                    }
                                })
                            ) : (
                                <tr>
                                    <td
                                        colSpan='4'
                                        className='text-muted h4 text-center'
                                    >
                                        No requests
                                    </td>
                                </tr>
                            )}
                        </StyledBody>
                    </table>
                </div>
            </Container>
        );
    }
}

const StyledBody = styled.tbody`
    tr > td {
        vertical-align: middle !important;
    }
`;

const CreateButton = withStyles(theme => ({
    root: {
        color: 'transparent',
        backgroundColor: 'transparent',
        boxShadow: 'none',
        display: 'inline',
        'tr:hover &': {
            color: theme.palette.getContrastText(blue[500]),
            backgroundColor: blue[500],
            '&:hover': {
                backgroundColor: blue[700]
            }
        }
    }
}))(Button);

const CreateLink = React.forwardRef((props, ref) => (
    <Link innerRef={ref} {...props} />
));
