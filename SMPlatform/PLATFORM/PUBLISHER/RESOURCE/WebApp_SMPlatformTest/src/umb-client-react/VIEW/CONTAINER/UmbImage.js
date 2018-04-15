import React from 'react';
import { observable, action } from 'mobx';
import { observer } from 'mobx-react';
import { UmbComponent } from '../../COMPONENT/UmbComponent';

/**
 * 图片
 */
@observer
export class UmbImage extends UmbComponent {

    @observable width;
    @observable height;

    static defaultProps = {
        alt: 'image',
    };

    @observable file;

    constructor( props ) {
        super( props );
        this.setFile();
        this.setSize();
    }

    @action
    setFile() {
        this.file = this.props.file;
    }

    @action
    setSize() {
        this.width = this.props.width;
        this.height = this.props.height;
    }

    render() {
        return (
            <img width={ this.width } height={ this.height } alt={ this.props.alt } src={ this.file }/>
        )
    }
}