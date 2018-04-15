import { InstancePool } from '../umb-client-react';
import { Tester } from '../model/Tester';
import { Api } from '../model/Api';

import TesterInstanceArray from './Tester.data';
import ApiInstanceArray from './Api.data';

InstancePool.getInstance().registerInstanceManager( 'Tester' );
InstancePool.getInstance().registerInstanceManager( 'Api' );

//加载Tester数据
TesterInstanceArray.forEach( tester_data => {
    let tester_instance = new Tester();
    tester_instance.setProps( tester_data );
    tester_instance.registerToInstancePool();
} );

//加载Api数据
ApiInstanceArray.forEach( api_data => {
    let api_instance = new Api();
    api_instance.setProps( api_data );
    api_instance.registerToInstancePool();
} );
