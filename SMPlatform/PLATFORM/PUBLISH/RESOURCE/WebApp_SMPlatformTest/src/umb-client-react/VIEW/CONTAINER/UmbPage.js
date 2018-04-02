import React, { Component } from 'react';
import { observer } from 'mobx-react';

/**
 * 页面容器
 */
@observer
export class UmbPage extends Component {
    render() {
        return (
            <div style={ [ {
                width: '100%',
                height: '100%',
            }, this.props.style ] }>
                { this.props.children }
            </div>
        )
    }
}
