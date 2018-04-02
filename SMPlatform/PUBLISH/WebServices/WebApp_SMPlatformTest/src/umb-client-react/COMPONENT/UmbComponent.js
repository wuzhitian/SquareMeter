import { Component } from 'react';

/**
 * 基础容器封装
 */
export class UmbComponent extends Component {
    render() {
        return (
            this.props.children()
        )
    }
}
