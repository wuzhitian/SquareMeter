import React from 'react';
import { observer } from 'mobx-react';
import { Route, Redirect } from 'react-router-dom';
import { UmbComponent, UmbContainer } from '../../umb-client-react';

import { UserPage } from '../UserPage/UserPage';
import { ProjectPage } from '../ProjectPage/ProjectPage';
import { SMPlatformCorePage } from '../SMPlatformCorePage/SMPlatformCorePage';
import { SMPlatformAdminPage } from '../SMPlatformAdminPage/SMPlatformAdminPage';
import { SMBCContractPage } from '../SMBCContractPage/SMBCContractPage';
import { ThirdPartyPage } from '../ThirdPartyPage/ThirdPartyPage';
import { AutoTestPage } from '../AutoTestPage/AutoTestPage';

@observer
export class Container extends UmbComponent {
    render() {
        return (
            <UmbContainer style={ this.props.style }>
                <Route exact path="/" render={ () => <Redirect to="/user"/> }/>
                <Route path="/user" render={ () => <UserPage parent={ this.props.parent }/> }/>
                <Route path="/project" render={ () => <ProjectPage parent={ this.props.parent }/> }/>
                <Route path="/third_party" render={ () => <ThirdPartyPage parent={ this.props.parent }/> }/>
                <Route path="/smplatform_core" render={ () => <SMPlatformCorePage parent={ this.props.parent }/> }/>
                <Route path="/smplatform_admin" render={ () => <SMPlatformAdminPage parent={ this.props.parent }/> }/>
                <Route path="/smbc_contract" render={ () => <SMBCContractPage parent={ this.props.parent }/> }/>
                <Route path="/auto_test" render={ () => <AutoTestPage parent={ this.props.parent }/> }/>
            </UmbContainer>
        )
    }
}