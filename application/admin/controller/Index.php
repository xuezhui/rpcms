<?php
/**
 * 主控制器
 * @author Bugstar <ren.pan@qq.com>
 * @since 2017-04-15
 */
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
  
    /**
     * 首页
     */
    public function index()
    {
        $loginToken = input('__loginToken__');
        if ($loginToken !== session('__loginToken__'))
        {
            $this->error('非法登陆,请重新登陆',url('Index/login'));
        }
        return view('index');
    }
    
    /**
     * 登陆页
     */
    public function login()
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
                    $this->success('登陆成功', url('Index/index','__loginToken__='.$loginToken));
                } else {
                    $this->error('登陆失败，请重新登陆');
                }
            }   
        }
        
        $token = token('__loginToken__');
        return view('login',['loginToken'=>$token]);
    }
  
    /**
     * 退出登陆
     */
    public function loginOut()
    {
        $is_login = session('?__loginToken__');
        if ($is_login)
        {
            session('__loginToken__','null');
            $this->success('正在退出登陆','Index/login');
        }
    }
    
}