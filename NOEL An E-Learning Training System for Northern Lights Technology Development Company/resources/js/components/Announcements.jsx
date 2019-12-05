import React from 'react';
import Axios from 'axios';
import {
    Container,
    Row,
    Col,
    Button,
    Card,
    CardTitle,
    CardText
} from 'reactstrap';

export default class Announcements extends React.Component {
    state = {
        title: '',
        description: '',
        errors: [],
        announcements: [],
        failedToFetch: false
    };
    componentDidMount = () => {
        Axios.get(`/api/announcements`)
            .then(response => {
                this.setState({
                    announcements: response.data
                });
            })
            .catch(error => {
                if (response.status === 500) {
                    this.setState({
                        failedToFetch: true
                    });
                }
            });
    };
    render() {
        if (this.state.failedToFetch) {
            return (
                <FailedToFetchData message='Sorry! We are unable to fetch data from the server.' />
            );
        }
        let { announcements } = this.state;
        const items = announcements.map(announcement => (
            <Card
                body
                inverse
                className='my-2'
                key={announcement.id}
                style={{ background: '#385466' }}
            >
                <CardTitle>
                    <h5>{announcement.title}</h5>
                </CardTitle>
                <CardText>{announcement.description}</CardText>
                <CardText>
                    <small>{announcement.created_at}</small>
                </CardText>
            </Card>
        ));
        return <div>{items}</div>;
    }
}
