import React from 'react';
import { observer } from 'mobx-react';

import { UmbComponent } from '../../umb-client-react';
import { TesterPage } from '../TesterPage/TesterPage';
import { Tester } from '../../model/Tester';

@observer
export class SMBCContractPage extends UmbComponent {

    render() {
        return (
            <TesterPage parent={ this.props.parent } tester={ Tester.getById( 5 ) }/>
        );
    }

}