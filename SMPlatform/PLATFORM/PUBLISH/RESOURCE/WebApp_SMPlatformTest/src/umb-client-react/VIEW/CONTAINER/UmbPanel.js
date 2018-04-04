import React from 'react';
import { observer } from 'mobx-react';
import { UmbComponent } from '../../COMPONENT/UmbComponent';

/**
 * 面板视图
 */
@observer
export class UmbPanel extends UmbComponent {

    render() {
        return (
            <div onClick={ this.props.onClick }
                 style={ {
                     display: 'block',
                     ...this.props.style,
                 } }>
                { this.props.children }
            </div>
        )
    }
}