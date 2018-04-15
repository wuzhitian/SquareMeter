import React from 'react';
import { observer } from 'mobx-react';
import { UmbComponent } from '../../COMPONENT/UmbComponent';

/**
 * 基础视图
 */
@observer
export class UmbContainer extends UmbComponent {

    render() {
        return (
            <div onClick={ this.props.onClick }
                 style={ {
                     display: 'flex',
                     flexDirection: 'column',
                     ...this.props.style,
                 } }>
                { this.props.children }
            </div>
        )
    }
}