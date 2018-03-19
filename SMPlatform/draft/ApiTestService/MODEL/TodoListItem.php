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

class TodoListItem extends Instance
{
    const LOCAL_INSTANCE = true;

    const DATA_SCHEMA = [
        'id' => STRING_TYPE,
        'create_timestamp' => STRING_TYPE,
        'finish_timestamp' => STRING_TYPE,
        'todo_list_id' => STRING_TYPE,
        'content' => TEXT_TYPE,
        'is_finish' => BOOL_TYPE,
    ];

    public $create_timestamp;
    public $finish_timestamp;
    public $todolist_id;
    public $content;
    public $is_finish;
}