import { observable, action } from 'mobx';
import { observer } from 'mobx-react';
import { Instance } from '../umb-client-react';
import { Tester } from './Tester';

/**
 * Api类
 */
@observer
export class Api extends Instance {

    @observable tester_id;
    @observable request_url;
    @observable require_params;
    @observable name;
    @observable description;
    @observable test_case_params;
    @observable test_case_result;

    @observable _request_tracker;

    @observable _is_request = false;

    @action
    request() {
        Tester.getById( this.tester_id ).clear();
        this._is_request = true;
    }

}