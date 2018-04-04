import { Component } from 'react';
import { observable, action } from 'mobx';
import { observer } from 'mobx-react';

/**
 * Umb基础类封装
 */
@observer
export class UmbBaseClass extends Component {

    @action
    setProps( props ) {
        for ( let key in props ) {
            if ( props.hasOwnProperty( key ) ) {
                let value = props[ key ];
                this[ key ] = value;
            }
        }
    }

    render() {
        return (
            this.props.children()
        )
    }
}
