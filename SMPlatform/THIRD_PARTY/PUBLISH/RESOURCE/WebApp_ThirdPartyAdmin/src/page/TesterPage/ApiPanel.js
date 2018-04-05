import React from 'react';
import { observable, action } from 'mobx';
import { observer } from 'mobx-react';
import { UmbComponent, UmbContainer, UmbText, UmbButton, UmbLabel } from '../../umb-client-react';
import { Base } from '../../theme/Base';

@observer
export class ApiPanel extends UmbComponent {

    @observable expect;

    render() {
        let api = this.props.api;
        let tester_page = this.props.parent;
        let main_page = tester_page.props.parent;
        return (
            <UmbContainer style={ {
                borderRadius: 3,
                backgroundColor: Base.color.light,
            } }>
                <UmbContainer style={ {
                    position: 'relative',
                    padding: Base.distance.base,
                    justifyContent: 'center',
                    borderBottomWidth: 1,
                    borderBottomStyle: 'solid',
                    borderBottomColor: Base.color.grey,
                } }>

                    <UmbText size={ 12 } color={ Base.color.dark }>
                        { api._is_request ? '>> ' : null }{ api.name } - { api.description }
                    </UmbText>

                    <UmbButton
                        onPress={ () => {
                            api.request();
                            main_page.log_window_component.clear();
                            main_page.result_window_component.clear();
                            let response_time_span = parseInt( 50 + 20 * Math.random(), 10 );
                            setTimeout( () => {
                                main_page.log_window_component.clear();
                                main_page.log_window_component.addLog( 'TestCase: ' + api.name );
                                main_page.log_window_component.addLog( 'url: ' + api.request_url );
                                main_page.log_window_component.addLog( 'verb: ' + api.verb );
                                main_page.log_window_component.addLog( 'params: ' + JSON.stringify( api.test_case_params ) );
                                main_page.log_window_component.setLogByArray( api.tracker );
                                main_page.result_window_component.setExpect( api.test_case_result );
                                main_page.result_window_component.setResult( api.test_case_result );
                                main_page.result_window_component.setResponseTimeSpan( response_time_span );
                            }, response_time_span );
                        } }
                        text={ 'submit' }
                        label={ {
                            size: 12,
                            color: Base.color.light,
                        } }
                        border={ {
                            radius: 3,
                        } }
                        background_color={ Base.color.dark }
                        style={ {
                            position: 'absolute',
                            right: Base.distance.base * .5,
                        } }/>


                </UmbContainer>

                <UmbContainer style={ {
                    padding: Base.distance.base,
                } }>

                    <UmbContainer
                        style={ {
                            flexDirection: 'row',
                        } }
                        height={ 16 }>

                        <UmbLabel size={ 16 } color={ Base.color.light }
                                  background_color={ Base.color.grey }>
                            url
                        </UmbLabel>

                        <UmbText size={ 12 } color={ Base.color.dark }>
                            &nbsp;{ api.request_url }
                        </UmbText>

                    </UmbContainer>

                    <UmbContainer
                        style={ {
                            flexDirection: 'row',
                            marginTop: Base.distance.base * .5,
                        } }
                        height={ 16 }>

                        <UmbLabel size={ 16 } color={ Base.color.light }
                                  background_color={ Base.color.grey }>
                            verb
                        </UmbLabel>

                        <UmbText size={ 12 } color={ Base.color.dark }>
                            &nbsp;{ api.verb }
                        </UmbText>

                    </UmbContainer>

                    <UmbContainer
                        style={ {
                            flexDirection: 'row',
                            marginTop: Base.distance.base * .5,
                        } }
                        height={ 16 }>

                        <UmbLabel size={ 16 } color={ Base.color.light }
                                  background_color={ Base.color.grey }>
                            params
                        </UmbLabel>

                        <UmbText size={ 12 } color={ Base.color.dark }>
                            &nbsp;{ JSON.stringify( api.test_case_params ) }
                        </UmbText>

                    </UmbContainer>

                </UmbContainer>


            </UmbContainer>
        )
    }
}