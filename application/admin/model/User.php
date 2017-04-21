<?php
/**
 * 用户模型
 * @author Bugstar <ren.pan@qq.com>
 * @since 2017-04-16
 */
namespace app\admin\model;

use think\Model;


class User extends Model
{
    protected $pk = 'uid';
    
    protected function initialize() {
        parent::initialize();
    }
    
}