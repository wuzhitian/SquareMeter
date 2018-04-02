import React from 'react';
import { observable, action } from 'mobx';
import { observer } from 'mobx-react';
import { UmbComponent } from '../../COMPONENT/UmbComponent';

/**
 * 图片
 */
@observer
export class UmbImage extends UmbComponent {

    static defaultProps = {
        alt: 'image',
    };

    @observable file;

    constructor( props ) {
        super( props );
        this.setFile( this.props.file );
    }

    @action
    setFile( file ) {
        this.file = file;
    }

    render() {
        return (
            <img alt={ this.props.alt } src={ this.file }/>
        )
    }
}