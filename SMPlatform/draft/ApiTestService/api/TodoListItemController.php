<?php
/**
 * Project: SMPlatform
 * File: TodoListItemController.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace draft\ApiTestService\Controller;

use UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER\AuthController;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\POST;

use draft\ApiTestService\MODEL\TodoListItem;

/**
 * TodoListItem控制器类
 * Class TodoListItemController
 * @package draft\ApiTestServer\Controller
 */
class TodoListItemController extends AuthController
{
    public
    function read( POST $id )
    {
        $instance = TodoListItem::getById( $id );
        $res      = $instance->getData();
        return $res;
    }

    public
    function readByIdArray( POST $id_array )
    {
        $res = [];
        foreach ( $id_array() as $id ) {
            $instance = TodoListItem::getById( $id );
            $res[]    = $instance->getData();
        }
        return $res;
    }

    public
    function update( POST $id, POST $content )
    {
        $instance = TodoListItem::getById( $id );
        $res      = $instance->updateContent( $content );
        return $res;
    }
}