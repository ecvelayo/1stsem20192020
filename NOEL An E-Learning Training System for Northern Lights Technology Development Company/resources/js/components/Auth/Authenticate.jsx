import Axios from 'axios';
import Cookie from 'js-cookie';
import { Route, Redirect } from 'react-router-dom';

class Authenticate {
    constructor() {
        this.isAuthenticated = false;
    }

    login = (cb, token) => {
        // Get the token from the cookie
        Cookie.set('noel_auth', token);
        let header = {
            headers: { Authorization: 'Bearer ' + token }
        };
        // Pass the token as an authorization header
        Axios.get('/api/user', header)
            .then(response => {
                this.isAuthenticated = true;
                let { data } = response;
                // Call the callback func
                cb(data);
            })
            .catch(error => {
                console.log(error.response);
            });
    };

    logout = cb => {
        this.isAuthenticated = false;
        // Remove the cookie
        Cookie.remove('noel_auth');
        cb();
    };

    isLoggedIn = () => {
        let auth = Cookie.get('noel_auth');
        if (!auth) {
            this.isAuthenticated = false;
            return this.isAuthenticated;
        }
        this.isAuthenticated = true;
        return this.isAuthenticated;
    };

    getCurrentUser = cb => {
        // const fetchUser = async () => {
        //     let header = {
        //         headers: { Authorization: 'Bearer ' + token }
        //     };
        //     const result = await Axios.get('/api/user', header).catch(error => {
        //         console.log(error.response);
        //         cb(null);
        //     });
        //     let { data } = result;
        //     cb(data);
        // };
        // let token = Cookie.get('noel_auth');
        // if (token) {
        //     fetchUser();
        // }
        let token = Cookie.get('noel_auth');
        if (token) {
            let header = {
                headers: { Authorization: 'Bearer ' + token }
            };
            Axios.get('/api/user', header)
                .then(response => {
                    let { data } = response;
                    cb(data);
                })
                .catch(error => {
                    console.log(error.response);
                    cb(null);
                });
        }
    };
}

export default new Authenticate();
