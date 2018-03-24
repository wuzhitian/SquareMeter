<?php
/**
 * Project: SMPlatform
 * File: TodoListController.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace draft\ApiTestService\Controller;

use UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER\AuthController;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\POST;

use draft\ApiTestService\MODEL\TodoListItem;
use draft\ApiTestService\MODEL\TodoList;

/**
 * TodoList控制器
 * Class TodoListController
 */
class TodoListController extends AuthController
{
    public
    function read( POST $id )
    {
        $instance = TodoList::getById( $id );
        $res      = $instance->getData();
        return $res;
    }

    public
    function readByIdArray( POST $id_array )
    {
        $res = [];
        foreach ( $id_array() as $id ) {
            $instance = TodoList::getById( $id );
            $res[]    = $instance->getData();
        }
        return $res;
    }

    /**
     * 添加新item
     * @param POST $todo_list_id
     * @param POST $content
     */
    public
    function addItem( POST $todo_list_id, POST $content )
    {
        $todo_list      = TodoList::getById( $todo_list_id );
        $todo_list_item = new TodoListItem( $todo_list, $content );
        $res            = $todo_list->addTodoListItem( $todo_list_item );
        return $res;
    }

    /**
     * 删除item
     * @param POST $todo_list_id
     * @param POST $todo_list_item_id
     */
    public
    function deleteItem( POST $todo_list_id, POST $todo_list_item_id )
    {
        $todo_list      = TodoList::getById( $todo_list_id );
        $todo_list_item = TodoListItem::getById( $todo_list_item_id );
        $res            = $todo_list->deleteTodoListItem( $todo_list_item );
        return $res;
    }
}