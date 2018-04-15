import { observable, action } from 'mobx';
import { observer } from 'mobx-react';
import { UmbBaseClass } from '../../LIBRARY/BASE/UmbBaseClass';
import { InstancePool } from './InstancePool';

/**
 * 基础实例封装
 */
@observer
export class Instance extends UmbBaseClass {

    @observable id;

    //通过id获取实例
    static getById( id ) {
        let instance_manager = InstancePool.getInstance().getInstanceManagerByClassName( this.name );
        let res = instance_manager.getInstanceById( id );
        return res;
    }

    registerToInstancePool() {
        console.log( this.constructor.name );
        let instance_manager = InstancePool.getInstance().getInstanceManagerByClassName( this.constructor.name );
        instance_manager.registerInstance( this );
    }
}
