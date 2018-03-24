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
use UmbServer\SwooleFramework\LIBRARY\UTIL\Time;

class TodoListItem extends Instance
{
    const LOCAL_INSTANCE = true;

    const SCHEMA
        = [
            'id'               => STRING_TYPE,
            'create_timestamp' => STRING_TYPE,
            'update_timestamp' => STRING_TYPE,
            'finish_timestamp' => STRING_TYPE,
            'todo_list_id'     => STRING_TYPE,
            'content'          => TEXT_TYPE,
            'is_finish'        => BOOL_TYPE,
        ];

    public $finish_timestamp = NULL;
    public $todo_list_id;
    public $content          = '';
    public $is_finish        = false;

    public
    function __construct( TodoList $todo_list, $content )
    {
        $this->create_timestamp = Time::getNow();
        $this->todo_list_id     = $todo_list->id;
        $this->content          = $content;
        $this->is_finish        = false;
    }

    public
    function updateContent( $content )
    {
        $this->content = $content;
        $this->update();
    }

    public static
    function getById( $id ): self
    {
        return new self();
    }
}