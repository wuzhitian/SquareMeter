import React from 'react';
import { observable, action } from 'mobx';
import { observer } from 'mobx-react';
import { UmbComponent } from '../../COMPONENT/UmbComponent';
import { UmbContainer } from './UmbContainer';
import { UmbText } from './UmbText';

/**
 * 标签
 */
@observer
export class UmbLabel extends UmbComponent {

    @observable size;
    @observable color;
    @observable background_color;

    constructor( props ) {
        super( props );
        this.setSize();
        this.setColor();
        this.setBackgroundColor();
    }

    @action
    setSize() {
        this.size = this.props.size;
    }

    @action
    setColor() {
        this.color = this.props.color;
    }

    @action
    setBackgroundColor() {
        this.background_color = this.props.background_color;
    }

    render() {
        return (
            <UmbContainer style={ {
                padding: 2,
                borderRadius: 3,
                backgroundColor: this.background_color,
                ...this.props.style,
            } }>
                <UmbText size={ this.size - 8 } color={ this.color }>
                    &nbsp;{ this.props.children }&nbsp;
                </UmbText>
            </UmbContainer>
        )
    }
}