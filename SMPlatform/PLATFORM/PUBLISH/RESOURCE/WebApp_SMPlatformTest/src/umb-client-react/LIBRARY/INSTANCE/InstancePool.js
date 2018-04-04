import { UmbBaseClass } from '../../LIBRARY/BASE/UmbBaseClass';
import { observable, action } from 'mobx';
import { InstanceManager } from './InstanceManager';

export class InstancePool extends UmbBaseClass {

    static instance = null;
    @observable instance_manager_container = new Map();

    static getInstance() {
        if ( !this.instance ) {
            this.instance = new this();
        }
        return this.instance;
    }

    @action
    registerInstanceManager( class_name ) {
        let res = false;
        if ( !this.isExistInstanceManagerByClassName( class_name ) ) {
            let new_instance_manager = new InstanceManager( { class_name: class_name } );
            this.instance_manager_container.set( class_name, new_instance_manager );
            res = true;
        }
        return res;
    }

    @action
    unRegisterInstanceManager( class_name ) {
        let res = false;
        if ( this.isExistInstanceManagerByClassName( class_name ) ) {
            this.instance_manager_container.delete( class_name );
            res = true;
        }
        return res;
    }

    isExistInstanceManagerByClassName( class_name ) {
        let res = this.instance_manager_container.has( class_name );
        return res;
    }

    getInstanceManagerByClassName( class_name ) {
        let res = null;
        if ( this.isExistInstanceManagerByClassName( class_name ) ) {
            res = this.instance_manager_container.get( class_name );
        }
        return res;
    }

    isExistInstanceByClassNameAndId( class_name, id ) {
        let res = false;
        try {
            let instance_manager = this.getInstanceManagerByClassName( class_name );
            res = instance_manager.isExistInstanceById( id );
        } catch ( e ) {
            console.error( e );
        }
        return res;
    }

    getInstanceByClassNameAndId( class_name, id ) {
        let instance_manager = this.getInstanceManagerByClassName( class_name );
        let res = instance_manager.getInstanceById( id );
        return res;
    }

}