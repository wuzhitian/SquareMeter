import React from 'react';
import { observer } from 'mobx-react';
import { UmbComponent } from './UmbComponent';
import { NavLink } from 'react-router-dom';

/**
 * 链接
 */
@observer
export class UmbLink extends UmbComponent {

    static defaultProps = {
        onActive: ( match, location ) => {
            console.log( 'active', match, location );
        }
    };

    render() {
        return (
            <NavLink to={ this.props.path } isActive={ ( match, location ) => {
                this.props.onActive( match, location );
            } }>
                { this.props.children }
            </NavLink>
        )
    }
}