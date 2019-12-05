import React from 'react';
import { Route, Redirect } from 'react-router-dom';
import Authenticate from './Authenticate';

export const ProtectedRoute = ({ component: Component, ...rest }) => {
    return (
        <Route
            {...rest}
            render={props =>
                Authenticate.isLoggedIn() ? (
                    <Component {...props} {...rest} />
                ) : (
                    <Redirect
                        to={{
                            pathname: '/login'
                        }}
                    />
                )
            }
        />
    );
};
