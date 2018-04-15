import { observer } from 'mobx-react';
import { UmbBaseClass } from '../LIBRARY/BASE/UmbBaseClass';

/**
 * 基础容器封装
 */
@observer
export class UmbComponent extends UmbBaseClass {

    render() {
        return (
            this.props.children
        )
    }

}
