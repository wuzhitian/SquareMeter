import { observable, action, computed } from 'mobx';
import { observer } from 'mobx-react';
import { Instance } from '../umb-client-react';
import { Api } from './Api';

/**
 * 测试类
 */
@observer
export class Tester extends Instance {

    @observable path;
    @observable name;
    @observable description;
    @observable api_id_array;

    @observable _api_map = new Map();

    @action
    setApiMap() {
        this.api_id_array.forEach( id => {
            this._api_map.set( id, Api.getById( id ) );
        } )
    }

    @action
    clear(){
        this._api_map.forEach(api=>{
            api._is_request = false;
        })
    }

}