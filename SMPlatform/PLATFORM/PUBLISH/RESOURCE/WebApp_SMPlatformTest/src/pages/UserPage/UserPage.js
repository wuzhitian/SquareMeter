import React from 'react';
import { observer } from 'mobx-react';

import { UmbPage, UmbComponent } from '../../umb-client-react';

@observer
export class UserPage extends UmbComponent {
    render() {
        return (
            <UmbPage style={ {
                backgroundColor: 'blue',
            } }>
            </UmbPage>
        );
    }
}