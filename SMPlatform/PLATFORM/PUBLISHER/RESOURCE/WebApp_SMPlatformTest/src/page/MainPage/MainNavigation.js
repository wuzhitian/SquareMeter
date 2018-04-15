import React from 'react';
import { observable, action } from 'mobx';
import { observer } from 'mobx-react';
import { UmbComponent, UmbContainer, UmbImage, UmbText, UmbList, UmbLink } from '../../umb-client-react';
import SMPlatformLogo from '../../resource/pictures/smplatform_logo.png';
import { Base } from '../../theme/Base';

@observer
export class MainNavigation extends UmbComponent {

    @observable navigation_item_map = new Map();

    @action
    addNavigationItem( navigation_item ) {
        this.navigation_item_map.set( this.navigation_item_map.size + 1, navigation_item );
    }

    componentWillMount() {

        this.addNavigationItem( {
            name: 'UserLifecycleTester',
            path: '/user',
        } );

        this.addNavigationItem( {
            name: 'ProjectLifecycleTester',
            path: '/project',
        } );

        this.addNavigationItem( {
            name: 'ThirdPartyTester',
            path: '/third_party',
        } );

        this.addNavigationItem( {
            name: 'SMPlatformCoreTester',
            path: '/smplatform_core',
        } );

        this.addNavigationItem( {
            name: 'SMPlatformAdminTester',
            path: '/smplatform_admin',
        } );

        this.addNavigationItem( {
            name: 'SMBCContractTester',
            path: '/smbc_contract',
        } );

        this.addNavigationItem( {
            name: 'AutoTest',
            path: '/auto_test',
        } );

    }

    render() {
        return (

            <UmbContainer style={ this.props.style }>

                <UmbContainer style={ {
                    height: 200,
                    justifyContent: 'center',
                    alignItems: 'center',
                } }>

                    <UmbImage file={ SMPlatformLogo } width={ 60 }/>

                    <UmbText size={ 20 } color={ Base.color.light }
                             style={ { marginTop: Base.distance.base * 2 } }>
                        SquareMeter
                    </UmbText>

                    <UmbText size={ 12 } color={ Base.color.grey }>
                        Test Center
                    </UmbText>

                </UmbContainer>

                <UmbContainer style={ {
                    marginLeft: Base.distance.base * 4,
                } }>

                    <UmbList data_map={ this.navigation_item_map }
                             distance={ Base.distance.base * .5 }
                             list_item_component={ data =>
                                 <UmbLink path={ data.path } onActive={ ( match, location ) => {
                                     data.is_active = true;
                                     console.log( match, location )
                                 } }>
                                     <UmbText size={ 14 } color={ data.is_active ? Base.color.light : Base.color.grey }>
                                         { data.name }
                                     </UmbText>
                                 </UmbLink>
                             }/>

                </UmbContainer>

                <UmbContainer style={ {
                    position: 'absolute',
                    bottom: 15,
                    width: 250,
                    textAlign: 'center',
                } }>

                    <UmbText size={ 12 } color={ Base.color.grey }>
                        © 2018 SMBC Inc.
                    </UmbText>

                </UmbContainer>

            </UmbContainer>
        )
    }
}