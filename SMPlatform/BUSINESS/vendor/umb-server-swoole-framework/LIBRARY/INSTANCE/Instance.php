<?php
/**
 * Project: UmbServerSwooleFramework
 * File: Instance.php
 * Create: 2018/3/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\CORE\INSTANCE;

use UmbServer\SwooleFramework\LIBRARY\TOOL\Generator;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_DB;

/**
 * 实例基础类
 * Class Instance
 * @package UmbServer\SwooleFramework\MODEL\CORE\INSTANCE
 */
class Instance
{
    public $id = NULL; //所有实例都必须有id，可以是指定的、序号或是uuid

    const LOCAL_INSTANCE = false; //是否需要挂载到本地实例池
    const CACHE = _DB::Redis; //缓存方式，目前只可以选用null或redis
    const PERSISTENCE = _DB::MySQL; //持久化方式，目前只可以选用null或mysql

    /**
     * 创建实例
     * 处理好id问题
     * 判断LOCAL_INSTANCE，如果是，就在本地实例池创建，如果不是就在DataService创建
     * 根据CACHE和PERSISTENCE决定缓存和持久化方式，通过DataService实现
     */
    public function create()
    {
        //如果有id就用传入的id
        if ( !isset( $this->id ) ) {
            if ( get_class( $this )::TYPE_MAP[ 'id' ] == INT_TYPE ) {
                $this->id = $this->getDB()->getNextIntId( $this->table_name );
            } else {
                $this->id = $this->generateId();
            }
        }
        $this->registerToInstancePool();
    }

    private function createByLocalInstancePool()
    {

    }

    private function createByDataService()
    {

    }

    /**
     * 读取实例
     *
     * 从DataService读取数据
     */
    public function read()
    {

    }

    /**
     * 更新实例
     * 向DataService更新数据
     */
    public function update()
    {

    }

    /**
     * 删除实例
     * 向DataService删除实例
     * 实际上是软删除
     */
    public function delete()
    {

    }

    /**
     * 恢复实例
     * 向DataService申请回复实例，有可能已经被清除了，只能尝试
     */
    public function recover()
    {

    }

    /**
     * 根据类型转换数值
     *
     * @param $type
     * @param $value
     *
     * @return bool|float|int|string
     */
    public static function dataTypeStrict( $type, $value )
    {
        if ( !isset( $type ) || is_null( $value ) ) {
            return $value;
        }
        if ( $type == INT_TYPE ) {
            $res = (int)$value;
        } elseif ( $type == BOOL_TYPE ) {
            $res = (bool)$value;
        } elseif ( $type == FLOAT_TYPE ) {
            $res = (float)$value;
        } elseif ( $type == STRING_TYPE ) {
            $res = (string)$value;
        } else {
            $res = $value;
        }
        return $res;
    }

    /**
     * 为数据库映射对象设置数据库名和表名
     *
     * @param null $table_name
     * @param null $DB_name
     */
    public function setDBInfo( $table_name = NULL, $DB_name = NULL )
    {
        $this->table_name = $table_name ?? self::_getTableName( get_class( $this ) );
        $this->DB_name = $DB_name ?? $this->getDB()->DB_name;
        $this->instance_name = $this->table_name . self::POSTFIX;
    }

    /**
     * 保存到数据库
     * @return bool
     */
    public function save()
    {
        $data_array = $this->getDataArray();
        $res = $this->getDB()->updateById( $this->table_name, $data_array, $this->id );
        return $res;
    }

    /**
     * 获取对象数据
     * @return array
     */
    public function getDataArray(): array
    {
        $reflect_object = new \ReflectionObject( $this );
        $params = $reflect_object->getProperties();
        $data_array = [];
        foreach ( $params as $param ) {
            $param->setAccessible( true );
            $data_array[ $param->getName() ] = $param->getValue( $this );
        }
        unset( $data_array[ 'TYPE_MAP' ] );
        unset( $data_array[ 'DB_name' ] );
        unset( $data_array[ 'table_name' ] );
        unset( $data_array[ 'instance_name' ] );
        return $data_array;
    }

    /**
     * 从DBM中获取本Data的数据库对象
     * @return \LIBRARY\TOOL\DB
     */
    public function getDB(): DB
    {
        $DBM = DBManager::getInstance();
        return $DBM->getDB( $this->DB_name );
    }

    /**
     * 插入记录
     * @return mixed
     */
    public function insert()
    {
        $sql = 'INSERT INTO ' . $this->table_name . ' (id) VALUES (' . StringFormat::quotation( $this->id ) . ')';
        $res = $this->getDB()->insert( $sql );
        return $res;
    }

    /**
     * 执行属性赋值
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function setAttribute( $key, $value )
    {
        $this->setVal( $key, $value );
        $res = $this->save();
        return $res;
    }

    /**
     * 获取属性值
     *
     * @param $key
     *
     * @return mixed
     */
    public function getAttribute( $key )
    {
        $res = $this->$key;
        return $res;
    }

    /**
     * 通过数组为Data赋值
     *
     * @param array $array
     *
     * @return bool
     */
    public function setAttributeByArray( array $array )
    {
        foreach ( $array as $key => $value ) {
            if ( !isset( $value ) ) {
                continue;
            }
            $this->setVal( $key, $value );
        }
        $res = $this->save();
        return $res;
    }

    /**
     * 设置值
     *
     * @param $key
     * @param $value
     */
    public function setVal( $key, $value )
    {
        $type = get_class( $this )::TYPE_MAP[ $key ] ?? NULL;
        if ( isset( $type ) ) {
            $value = self::dataTypeStrict( $type, $value );
        }
        $this->$key = $value;
    }

    /**
     * 创建新Data
     *
     * @param null $id
     */
    public function create( $id = NULL )
    {
        if ( isset( $id ) ) {
            $this->setVal( 'id', $id );
        } else {
            if ( get_class( $this )::TYPE_MAP[ 'id' ] == INT_TYPE ) {
                $this->id = $this->getDB()->getNextIntId( $this->table_name );
            } else {
                $this->id = Generator::uuid();
            }
        }
        $this->registerToIRM();
        $this->insert();
    }

    /**
     * 创建新Data，不在IRM中注册
     *
     * @param null $id
     */
    public function createWithoutIRM( $id = NULL )
    {
        if ( isset( $id ) ) {
            $this->setVal( 'id', $id );
        } else {
            if ( get_class( $this )::TYPE_MAP[ 'id' ] == INT_TYPE ) {
                $this->id = $this->getDB()->getNextIntId( $this->table_name );
            } else {
                $this->id = Generator::uuid();
            }
        }
        $this->insert();
    }

    /**
     * 向IRM中注册，如果对应的InstanceManager没有创建，就先创建再注册
     * @return bool
     */
    public function registerToIRM()
    {
        $IRM = IRManager::getInstance();
        if ( $IRM->isExistInstanceManagerArray( $this->instance_name ) ) {
            if ( $IRM->getInstanceManagerByName( $this->instance_name )->isExistById( $this->id ) ) {
                $res = false;
            } else {
                $IRM->getInstanceManagerByName( $this->instance_name )->register( $this );
                $res = true;
            }
        } else {
            $IRM->registerInstanceManager( $this->instance_name );
            $IRM->getInstanceManagerByName( $this->instance_name )->register( $this );
            $res = true;
        }
        return $res;
    }

    /**
     * 在IRM中注销
     * @return bool
     */
    public function logoutFromIRM()
    {
        $IRM = IRManager::getInstance();
        if ( $IRM->isExistInstanceManagerArray( $this->instance_name ) ) {
            if ( $IRM->getInstanceManagerByName( $this->instance_name )->isExistById( $this->id ) ) {
                $IRM->getInstanceManagerByName( $this->instance_name )->logout( $this->id );
                $res = true;
            } else {
                $res = false;
            }
        } else {
            $res = false;
        }
        return $res;
    }

    /**
     * 判断是否在IRM中存在
     * @return bool
     */
    public function isRegister()
    {
        $IRM = IRManager::getInstance();
        if ( $IRM->isExistInstanceManagerArray( $this->instance_name ) ) {
            if ( $IRM->getInstanceManagerByName( $this->instance_name )->isExistById( $this->id ) ) {
                $res = true;
            } else {
                $res = false;
            }
        } else {
            $res = false;
        }
        return $res;
    }

    /**
     * 删除记录，并在IRM中去掉对象
     */
    public function delete()
    {
        $this->logoutFromIRM();
        $this->getDB()->deleteById( $this->table_name, $this->id );
    }

    /**
     * 为对象检索数据库获取数据信息
     *
     * @param      $id
     * @param null $table_name
     * @param null $DB_name
     */
    public function setDataById( $id, $table_name = NULL, $DB_name = NULL )
    {
        $this->setDBInfo( $table_name, $DB_name );
        $res_array = $this->getDB()->fetchById( $this->table_name, $id );
        foreach ( $res_array as $key => $value ) {
            $this->setVal( $key, $value );
        }
    }

    /**
     * 从数据库更新数据
     */
    public function update()
    {
        $this->setDataById( $this->id );
    }

    /**
     * 从IRM中取出数据给本对象赋值，用于子类复制数据
     *
     * @param \LIBRARY\TOOL\Data $object
     */
    public function setDataByIRM( Data $object )
    {
        $res_array = $object->getDataArray();
        foreach ( $res_array as $key => $value ) {
            $this->setVal( $key, $value );
        }
    }

    /**
     * 通过类名获取数据库表名的基础服务
     *
     * @param $class_path
     *
     * @return string
     */
    public static function _getTableName( $class_path )
    {
        $class_path_array = explode( '\\', $class_path );
        $class_name = array_reverse( $class_path_array )[ 0 ];
        $table_name = strtolower( substr( $class_name, 0, -4 ) );
        return $table_name;
    }

    /**
     * 返回IRM中的相应的对象数组，用于遍历
     *
     * @param $class_path
     *
     * @return array
     */
    public static function _getDataObjectArray( $class_path ): array
    {
        $IRM = IRManager::getInstance();
        $instance_name = self::_getTableName( $class_path ) . '_data';
        $instance_manager = $IRM->getInstanceManagerByName( $instance_name );
        $res = $instance_manager->getObjectArray();
        return $res;
    }

    /**
     * 返回IRM中的相应的对象，用于给子类封装
     *
     * @param $class_path
     * @param $id
     *
     * @return null
     * @throws \LIBRARY\TOOL\Error
     */
    public static function _getDataObjectById( $class_path, $id )
    {
        try {
            $IRM = IRManager::getInstance();
            $instance_name = self::_getTableName( $class_path ) . '_data';
            $instance_manager = $IRM->getInstanceManagerByName( $instance_name );
            $res = $instance_manager->getById( $id );
        } catch ( \Exception $e ) {
            throw new Error( Error::DATA_NOT_FOUND );
        }
        return $res;
    }

    /**
     * 查看本$id的实例是否已经完成注册，也是用于给子类封装
     *
     * @param $class_path
     * @param $id
     *
     * @return bool
     */
    public static function _isExistDataObjectById( $class_path, $id )
    {
        $IRM = IRManager::getInstance();
        $instance_name = self::_getTableName( $class_path ) . '_data';
        $instance_manager = $IRM->getInstanceManagerByName( $instance_name );
        $res = $instance_manager->isExistById( $id );
        return $res;
    }

    /**
     * 通过api_key返回IRM中的相应的对象，用于给子类封装
     *
     * @param $class_path
     * @param $api_key
     *
     * @return null
     */
    public static function _getDataObjectByApiKey( $class_path, $api_key )
    {
        $IRM = IRManager::getInstance();
        $instance_name = self::_getTableName( $class_path ) . '_data';
        $instance_manager = $IRM->getInstanceManagerByName( $instance_name );
        $res = $instance_manager->getByApiKey( $api_key );
        return $res;
    }

    /**
     * 查看本$api_key的实例是否已经完成注册，也是用于给子类封装
     *
     * @param $class_path
     * @param $api_key
     *
     * @return bool
     */
    public static function _isExistDataObjectByApiKey( $class_path, $api_key )
    {
        $IRM = IRManager::getInstance();
        $instance_name = self::_getTableName( $class_path ) . '_data';
        $instance_manager = $IRM->getInstanceManagerByName( $instance_name );
        $res = $instance_manager->isExistByApiKey( $api_key );
        return $res;
    }
}