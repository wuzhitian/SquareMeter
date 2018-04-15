import React from 'react';
import { observable, action, computed } from 'mobx';
import { observer } from 'mobx-react';
import { UmbComponent } from '../../COMPONENT/UmbComponent';
import { UmbContainer } from './UmbContainer';

/**
 * 列表
 */
@observer
export class UmbList extends UmbComponent {

    @observable data_map;
    @observable list_item_component;
    @observable distance = 0;

    constructor( props ) {
        super( props );
        this.setDataMap();
        this.setListItemComponent();
        this.setDistance();
    }

    @action
    setDataMap() {
        this.data_map = this.props.data_map;
    }

    @action
    setListItemComponent() {
        this.list_item_component = this.props.list_item_component;
    }

    @action
    setDistance() {
        this.distance = this.props.distance;
    }

    _renderListItem( data, index ) {
        return (
            <UmbListItem key={ 'ListItem#' + index }>
                { this.list_item_component( data ) }
            </UmbListItem>
        )
    };

    _renderDistance( index ) {
        return (
            <UmbContainer key={ 'Distance#' + index } style={ { height: this.distance } }/>
        )
    };

    renderList() {
        let res = [];
        let index = 0;
        this.data_map.forEach( ( data, id ) => {
            res.push( this._renderListItem( data, id ) );
            index++;
            if ( index < this.data_map.size ) {
                res.push( this._renderDistance( index ) );
            }
        } );
        return res;
    }

    render() {
        return (
            <ul>
                { this.renderList() }
            </ul>
        )
    }
}

/**
 * 列表项
 */
@observer
export class UmbListItem extends UmbComponent {

    @observable item;

    constructor( props ) {
        super( props );
        this.setItem();
    }

    @action
    setItem() {
        this.item = this.props.item;
    }

    render() {
        return (
            <li>{ this.props.children }</li>
        )
    }
}