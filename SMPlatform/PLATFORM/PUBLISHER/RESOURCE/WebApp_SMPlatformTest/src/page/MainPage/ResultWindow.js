import React from 'react';
import { observable, action } from 'mobx';
import { observer } from 'mobx-react';
import { UmbComponent, UmbContainer, UmbText, UmbHtml, DataHandler } from '../../umb-client-react';
import { Base } from '../../theme/Base';

@observer
export class ResultWindow extends UmbComponent {

    @observable expect;
    @observable result;
    @observable response_time_span;

    @action
    setExpect( expect_json ) {
        let res = DataHandler.jsonToHtml( expect_json );
        this.expect = res;
    }

    @action
    setResult( result_json ) {
        let res = DataHandler.jsonToHtml( result_json );
        this.result = res;
    }

    @action
    setResponseTimeSpan( response_time_span ) {
        this.response_time_span = response_time_span;
    }

    @action
    clear() {
        this.expect = '';
        this.result = '';
        this.response_time_span = null;
    }

    render() {
        return (
            <UmbContainer style={ {
                flexDirection: 'row',
                ...this.props.style,
            } }>

                <UmbContainer style={ {
                    flex: 1,
                } }>

                    <UmbContainer style={ {
                        height: 30,
                        backgroundColor: Base.color.dark,
                        justifyContent: 'center',
                    } }>

                        <UmbText size={ 12 } color={ Base.color.light } style={ {
                            marginLeft: Base.distance.base * 1.5,
                        } }>
                            Expect Window
                        </UmbText>

                    </UmbContainer>

                    <UmbContainer style={ {
                        flex: 'auto',
                        borderRightWidth: 1,
                        borderRightStyle: 'solid',
                        borderRightColor: Base.color.grey,
                    } }>

                        <UmbContainer style={ {
                            flex: 1,
                            margin: Base.distance.base * 1.5,
                        } }>

                            <UmbHtml size={ 12 } color={ Base.color.dark }>
                                { this.expect }
                            </UmbHtml>

                        </UmbContainer>

                    </UmbContainer>

                </UmbContainer>

                <UmbContainer style={ {
                    flex: 1,
                } }>

                    <UmbContainer style={ {
                        height: 30,
                        backgroundColor: Base.color.dark,
                        justifyContent: 'center',
                    } }>

                        <UmbText size={ 12 } color={ Base.color.light } style={ {
                            marginLeft: Base.distance.base * 1.5,
                        } }>
                            Result Window
                        </UmbText>

                        <UmbText size={ 12 } color={ Base.color.grey } style={ {
                            position: 'absolute',
                            right: Base.distance.base * 1.5,
                        } }>
                            { this.response_time_span ? this.response_time_span + 'ms' : null }
                        </UmbText>

                    </UmbContainer>

                    <UmbContainer style={ {
                        flex: 'auto',
                    } }>

                        <UmbContainer style={ {
                            flex: 1,
                            margin: Base.distance.base * 1.5,
                        } }>

                            <UmbHtml size={ 12 } color={ Base.color.dark }>
                                { this.result }
                            </UmbHtml>

                        </UmbContainer>

                    </UmbContainer>

                </UmbContainer>

            </UmbContainer>
        )
    }
}