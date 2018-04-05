import React from 'react';
import { observable, action } from 'mobx';
import { observer } from 'mobx-react';
import { UmbComponent } from '../../COMPONENT/UmbComponent';
import { UmbContainer } from './UmbContainer';

/**
 * 文字
 */
@observer
export class UmbText extends UmbComponent {

    @observable size;
    @observable color;

    constructor( props ) {
        super( props );
        this.setSize();
        this.setColor();
    }

    @action
    setSize() {
        this.size = this.props.size;
    }

    @action
    setColor() {
        this.color = this.props.color;
    }

    render() {
        return (
            <UmbContainer style={ {
                height: this.props.height,
                justifyContent: 'center',
                fontSize: this.size,
                color: this.color,
                ...this.props.style,
            } }>

                <UmbContainer>
                    { this.props.children }
                </UmbContainer>

            </UmbContainer>
        )
    }
}