import React from 'react';
import { observer } from 'mobx-react';
import { UmbComponent } from '../../COMPONENT/UmbComponent';
import { UmbContainer } from '../CONTAINER/UmbContainer';
import { UmbText } from '../CONTAINER/UmbText';

/**
 * 按钮
 */
@observer
export class UmbButton extends UmbComponent {

    static defaultProps = {
        text: 'button',
        label: {
            size: 12,
            color: 'black',
        },
        border: {
            color: '#aaaaaa',
            style: 'solid',
            width: 1,
            radius: 3,
        },
        background_color: null,
        width: 60,
        height: 24,
        onPress: () => {
            console.log( 'press button' );
        },
    };

    render() {
        return (
            <UmbContainer
                onClick={ this.props.onPress }
                style={ {
                    borderWidth: this.props.border.width,
                    borderStyle: this.props.border.style,
                    borderRadius: this.props.border.radius,
                    borderColor: this.props.border.color,
                    backgroundColor: this.props.background_color,
                    justifyContent: 'center',
                    alignItems: 'center',
                    cursor: 'pointer',
                    userSelect: 'none',
                    width: this.props.width,
                    height: this.props.height,
                    ...this.props.style,
                } }
            >

                <UmbText size={ this.props.label.size } color={ this.props.label.color }>
                    { this.props.text }
                </UmbText>

            </UmbContainer>
        )
    }
}