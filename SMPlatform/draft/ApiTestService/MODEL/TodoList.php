<?php
/**
 * Project: SMPlatform
 * File: IndustrialRealEstateAsset.php
 * Create: 2018/3/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace draft\ApiTestService\MODEL;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;

class TodoList extends Instance
{
    const LOCAL_INSTANCE = true;

    const SCHEMA = [
        'id' => STRING_TYPE,
        'todo_list_item_id_array' => ARRAY_TYPE,
    ];

    public $user_id;
    public $todo_list_item_array;

    public function addTodoListItem( TodoListItem $new_todo_list_item )
    {
        $add_id = $new_todo_list_item->id;
        $this->todo_list_item_array[] = $add_id;
        $new_todo_list_item->save();
        $this->save();
    }

    public function deleteTodoListItem( TodoListItem $todo_list_item )
    {
        $delete_id = $todo_list_item->id;
        $this->deleteIdFromIdArray( $delete_id, $this->todo_list_item_array );
        $todo_list_item->delete();
        $this->save();
    }

    public static
    function getById( $id ): self
    {
        return new self();
    }
}