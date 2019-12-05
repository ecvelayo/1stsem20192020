import React from 'react';
import Axios from 'axios';

export default class ViewUsers extends React.Component {
    // state = {
    //     fname: '',
    //     lname: '',
    //     mname: '',
    //     contact: '',
    //     email: ''
    // };

    componentDidMount = () => {
        Axios.get(
            `/api/get/usertrainings/${this.props.match.params.user}`
        ).then(response => {
            let user = response.data;
            this.setState({
                id: user.id,
                fname: user.fname,
                lname: user.lname,
                mname: user.mname,
                contact: user.contact,
                email: user.email
            });
        });
    };

    render() {
        return (
            <div className="container">
                <div className="d-flex justify-content-center">
                    <div className="p-2">{user.id}</div>
                    <div className="p-2">{user.fname}</div>
                    <div className="p-2">{user.lname}</div>
                    <div className="p-2">{user.mname}</div>
                    <div className="p-2">{user.contact}</div>
                    <div className="p-2">{user.email}</div>
                </div>
            </div>
        );
    }
}
