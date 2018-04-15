import React from 'react';
import { observable, action, computed } from 'mobx';
import { observer } from 'mobx-react';
import { UmbComponent, UmbContainer, UmbList, UmbText, UmbButton } from '../../umb-client-react';
import { Base } from '../../theme/Base';

@observer
export class LogWindow extends UmbComponent {

    @observable log_map = new Map();

    @action
    addLog( log_text ) {
        let log = {
            index: this.log_map.size + 1,
            value: log_text,
        };
        this.log_map.set( log.index, log );
    }

    @action
    setLogByArray( log_array ) {
        log_array.forEach( value => {
            this.addLog( value );
        } )
    }

    @action
    clear() {
        this.log_map.clear();
    }

    render() {
        return (
            <UmbContainer style={ this.props.style }>

                <UmbContainer style={ {
                    height: 30,
                    justifyContent: 'center',
                } }>

                    <UmbText size={ 12 } color={ Base.color.light } style={ {
                        marginLeft: Base.distance.base * 1.5,
                    } }>
                        Log Window
                    </UmbText>

                    <UmbButton
                        onPress={ () => {
                            this.clear();
                        } }
                        text={ 'CLS' }
                        label={ {
                            size: 12,
                            color: Base.color.grey,
                        } }
                        border={ {
                            radius: 3,
                        } }
                        width={ 'auto' }
                        background_color={ Base.color.dark }
                        style={ {
                            position: 'absolute',
                            right: Base.distance.base * 1.5,
                        } }/>

                </UmbContainer>

                <UmbContainer style={ {
                    height: '100%',
                } }>

                    <UmbContainer style={ {
                        flex: 1,
                        margin: Base.distance.base * 1.5,
                        overflow: 'auto',
                    } }>

                        <UmbList data_map={ this.log_map }
                                 list_item_component={ log =>
                                     <UmbText size={ 12 } color={ Base.color.grey }>
                                         { log.value }
                                     </UmbText>
                                 }/>


                    </UmbContainer>

                </UmbContainer>

            </UmbContainer>
        )
    }
}