import React, { Component } from 'react';
import { observer } from 'mobx-react';
import { UmbContainer } from './UmbContainer';
import { UmbComponent } from '../../COMPONENT/UmbComponent';

/**
 * 页面容器
 */
@observer
export class UmbPage extends UmbComponent {
    render() {
        return (
            <UmbContainer style={ [ {
                width: '100%',
                height: '100%',
            }, this.props.style ] }>
                { this.props.children }
            </UmbContainer>
        )
    }
}
