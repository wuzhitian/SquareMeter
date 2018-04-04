import React from 'react';
import { observable, action } from 'mobx';
import { observer } from 'mobx-react';
import { UmbComponent } from '../../COMPONENT/UmbComponent';

/**
 * html渲染
 */
@observer
export class UmbHtml extends UmbComponent {

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
            <div
                dangerouslySetInnerHTML={ { __html: this.props.children } }
                style={ {
                    fontSize: this.size,
                    color: this.color,
                    ...this.props.style,
                } }>
            </div>
        )
    }
}