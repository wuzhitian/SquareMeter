import React from 'react';
import { observer } from 'mobx-react';
import { BrowserRouter as Router, Route } from 'react-router-dom'
import { UmbComponent, UmbContainer } from '../../umb-client-react';

import { UserPage } from '../UserPage/UserPage';

@observer
export class Container extends UmbComponent {
    render() {
        return (
            <UmbContainer style={ this.props.style }>
                <Router>
                    <Route path="/user" component={ UserPage }/>
                </Router>
            </UmbContainer>
        )
    }
}