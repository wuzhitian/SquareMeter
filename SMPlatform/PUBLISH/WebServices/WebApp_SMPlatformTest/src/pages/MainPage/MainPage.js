import React from 'react';
import { observer } from 'mobx-react';

import { Container } from './Container';
import { MainNavigation } from './MainNavigation';
import { UmbPage, UmbComponent } from '../../umb-client-react';

@observer
export class MainPage extends UmbComponent {
    render() {
        return (
            <UmbPage>
                <MainNavigation style={ {
                    position: 'absolute',
                    top: 0,
                    bottom: 0,
                    left: 0,
                    width: '250px',
                } }/>
                <Container style={ {
                    position: 'absolute',
                    top: 0,
                    bottom: 0,
                    left: '250px',
                    right: 0,
                    backgroundColor: '#eeeeee',
                    overflow: 'auto',
                } }/>
            </UmbPage>
        );
    }
}