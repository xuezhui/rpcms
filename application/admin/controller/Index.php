<?php
/**
 * 主控制器
 * @author Bugstars <ren.pan@qq.com>
 * @since 2017-04-15
 */
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    function _initialize()
    {
        //验证token
        $token = input('get.token');
        if (is_null($token) || $token !== session('__loginToken__'))
        {
            $this->error('非法操作,请重新登陆',url('Login/index'));
        }
        
        $this->assign('token',$token);
        $this->assign('version','?v='.date('Ymd',time()));   
    }
    
    /**
     * 首页
     */
    public function index()
    {
        return view('index');
    }
    
    /**
     * 管理员资料
     */
    public function user()
    {
        return view('user');
    }
}