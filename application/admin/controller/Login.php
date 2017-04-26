<?php
/**
 * 后台登陆
 * @author Bugstars <ren.pan@qq.com>
 * @since 2017-4-26
 */
namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    function _initialize()
    {
        $this->assign('version','?v='.date('Ymd',time()));
    }
    
    /**
     * 登陆页
     */
    public function index()
    {
        $username = input('post.username');
        $password = input('post.password');
        $loginToken = input('post.__loginToken__');
    
        if (isset($username) && isset($password) && isset($loginToken))
        {
            $password = md5(md5($password).'think');
            //登陆令牌验证
            if ($loginToken === session('__loginToken__'))
            {
                $user = model('User')->get(1);
                if ($username == $user->username && $password == $user->password)
                {
                    $this->success('登陆成功', url('Index/index',array('token'=>$loginToken)));
                } else {
                    $this->error('登陆失败，请重新登陆');
                }
            }
        } else {
            $token = token('__loginToken__');
            return view('index',['loginToken'=>$token]);
        }
    }
    
    /**
     * 退出登陆
     */
    public function out()
    {
        session('__loginToken__','null');
        session_destroy();
        $this->success('正在退出登陆','Login/index');
    }
    
}