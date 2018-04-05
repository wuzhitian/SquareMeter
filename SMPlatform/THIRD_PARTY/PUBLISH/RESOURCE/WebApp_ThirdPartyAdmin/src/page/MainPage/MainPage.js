import React from 'react';
import { observer } from 'mobx-react';

import { Container } from './Container';
import { ResultWindow } from './ResultWindow';
import { LogWindow } from './LogWindow';
import { MainNavigation } from './MainNavigation';
import { UmbPage, UmbComponent, UmbContainer } from '../../umb-client-react';
import { Base } from '../../theme/Base';

@observer
export class MainPage extends UmbComponent {

    result_window_component;
    log_window_component;

    render() {
        return (
            <UmbPage>

                <UmbContainer
                    style={ {
                        position: 'absolute',
                        top: 0,
                        bottom: 0,
                        left: 0,
                        width: 250,
                        backgroundColor: Base.color.dark,
                    } }>

                    <MainNavigation/>

                </UmbContainer>

                <UmbContainer
                    style={ {
                        position: 'absolute',
                        top: 0,
                        bottom: 0,
                        left: 250,
                        right: 0,
                        flexDirection: 'row',
                    } }>

                    <Container
                        parent={ this }
                        style={ {
                            flex: 1,
                            backgroundColor: Base.color.white,
                            overflow: 'hidden',
                        } }/>

                    <UmbContainer
                        style={ {
                            flex: 1,
                        } }>

                        <ResultWindow
                            ref={ ref => this.result_window_component = ref }
                            parent={ this }
                            style={ {
                                flex: 2,
                                backgroundColor: Base.color.light,
                            } }/>

                        <LogWindow
                            ref={ ref => this.log_window_component = ref }
                            parent={ this }
                            style={ {
                                flex: 1,
                                backgroundColor: Base.color.dark,
                            } }/>

                    </UmbContainer>

                </UmbContainer>

            </UmbPage>
        );
    }
}