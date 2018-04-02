import React from 'react';
import { observer } from 'mobx-react';
import { UmbComponent, UmbContainer, UmbImage } from '../../umb-client-react';
import { Link } from 'react-router-dom';
import SMPlatformLogo from '../../resources/pictures/smplatform_logo.png';

@observer
export class MainNavigation extends UmbComponent {
    render() {
        return (
            <UmbContainer style={ {
                flexDirection: 'column',
                ...this.props.style
            } }>
                <UmbContainer style={ {
                    height: '200px',
                    justifyContent: 'center',
                    alignItems: 'center',
                } }>
                    <UmbImage file={ SMPlatformLogo } width={ 70 }/>
                </UmbContainer>
                <UmbContainer style={ {
                    marginLeft: '40px',
                } }>
                    <ul>
                        <li><Link to='/user'>用户生命周期测试</Link></li>
                        <li><Link to='/project'>项目生命周期测试</Link></li>
                        <li><Link to='/third_party'>第三方功能测试</Link></li>
                        <li><Link to='/smplatform_core'>平台核心功能测试</Link></li>
                        <li><Link to='/smplatform_admin'>平台管理功能测试</Link></li>
                        <li><Link to='/smbc_contract'>私链合约调用测试</Link></li>
                    </ul>
                </UmbContainer>
            </UmbContainer>
        )
    }
}