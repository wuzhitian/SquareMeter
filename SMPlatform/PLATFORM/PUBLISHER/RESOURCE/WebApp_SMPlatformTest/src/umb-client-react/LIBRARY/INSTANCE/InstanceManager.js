import { observable, computed, action } from 'mobx';
import { UmbBaseClass } from '../../LIBRARY/BASE/UmbBaseClass';

export class InstanceManager extends UmbBaseClass {

    @observable class_name;
    @observable instance_container = new Map();

    @computed
    get size() {
        return this.instance_container.size;
    }

    @action
    setClassName() {
        this.class_name = this.props.class_name;
    }

    constructor( props ) {
        super( props );
        this.setClassName();
    }

    @action
    registerInstance( instance ) {
        let res = false;
        if ( !this.isExistInstanceById( instance.id ) ) {
            this.instance_container.set( instance.id, instance );
            res = true;
        }
        return res;
    }

    @action
    unRegisterInstanceById( id ) {
        let res = false;
        if ( this.isExistInstanceById( id ) ) {
            this.instance_container.delete( id );
            res = true;
        }
        return res;
    }

    isExistInstanceById( id ) {
        let res = this.instance_container.has( id );
        return res;
    }

    getInstanceById( id ) {
        let res = null;
        if ( this.instance_container.has( id ) ) {
            res = this.instance_container.get( id );
        }
        return res;
    }

}