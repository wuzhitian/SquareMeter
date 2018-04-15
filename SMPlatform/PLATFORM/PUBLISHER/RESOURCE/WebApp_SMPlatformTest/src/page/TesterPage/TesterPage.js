import React from 'react';
import { observable, action } from 'mobx';
import { observer } from 'mobx-react';

import { UmbContainer, UmbText, UmbComponent, UmbPage, UmbList, UmbPanel } from '../../umb-client-react/index';
import { Base } from '../../theme/Base';
import { ApiPanel } from './ApiPanel';
import { InstancePool } from '../../umb-client-react';

@observer
export class TesterPage extends UmbComponent {

    @observable tester;

    constructor( props ) {
        super( props );
        this.setTester( this.props.tester );
    }

    @action
    setTester( tester ) {
        this.tester = tester;
    }

    componentWillMount() {
        this.tester.setApiMap();
    }

    componentWillUnmount() {
        this.props.parent.result_window_component.clear();
        this.props.parent.log_window_component.clear();
        InstancePool.getInstance().getInstanceManagerByClassName( 'Tester' ).instance_container.forEach( tester => {
            tester.clear();
        } );
    }

    render() {

        return (
            <UmbPage>

                <UmbPanel style={ {
                    height: 60,
                    backgroundColor: Base.color.main,
                } }>

                    <UmbContainer style={ {
                        width: '100%',
                        height: '100%',
                        justifyContent: 'center',
                    } }>

                        <UmbText size={ 20 } color={ Base.color.light }
                                 style={ { marginLeft: Base.distance.base * 4 } }>
                            { this.tester.name } - { this.tester.description }
                        </UmbText>

                    </UmbContainer>

                </UmbPanel>

                <UmbPanel style={ {
                    height: '100%',
                    padding: Base.distance.base * 4,
                    overflow: 'auto',
                } }>

                    <UmbContainer>

                        <UmbList data_map={ this.tester._api_map }
                                 distance={ Base.distance.base * 2 }
                                 list_item_component={ api =>
                                     <ApiPanel parent={ this } api={ api }/>
                                 }/>

                    </UmbContainer>

                </UmbPanel>

            </UmbPage>
        );
    }
}