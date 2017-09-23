<?php

namespace app\admin\controller;
use app\admin\model\UserType;
use think\Controller;
use think\Db;
use org\Verify;
use com\Geetestlib;

class Login extends Controller
{

    /**
     * 登录页面
     * @return
     */
    public function index()
    {
        $this->assign('verify_type', config('verify_type'));
        return $this->fetch('/login');
    }


    /**
     * 登录操作
     * @return
     */
    public function doLogin()
    {
        $username = input("param.username");
        $password = input("param.password");
        
        $result = $this->validate(compact('username', 'password'), 'AdminValidate');
        if(true !== $result){
            return json(['code' => -5, 'url' => '', 'msg' => $result]);
        }

        $hasUser = Db::name('admin')->where('username', $username)->find();

        //1、检查账户是否存在
        if(empty($hasUser)){
            writelog(0,"anonymous","试图用账户【".$username.'】登录',2);
            return json(['code' => -1, 'url' => '', 'msg' => '用户不存在']);
        }

        //2、检查账号密码是否正确
        if(md5(md5($password) . config('auth_key')) != $hasUser['password']){
            writelog($hasUser['id'],$username,'用户【'.$username.'】登录失败：密码错误',2);
            return json(['code' => -2, 'url' => '', 'msg' => '账号或密码错误']);
        }

        //3、检查用户是否被禁用
        if(1 != $hasUser['status']){
            writelog($hasUser['id'],$username,'用户【'.$username.'】登录失败：该账号被禁用',2);
            return json(['code' => -6, 'url' => '', 'msg' => '该账号被禁用']);
        }


        //获取该用户的角色信息
        $user = new UserType();
        $info = $user->getRoleInfo($hasUser['groupid']);
        
        session('uid', $hasUser['id']);         //用户ID
        session('username', $hasUser['username']);  //用户名
        session('portrait', $hasUser['portrait']); //用户头像
        session('rolename', $info['title']);    //角色名
        session('rule', $info['rules']);        //角色节点
        session('name', $info['name']);         //角色权限
  
        //更新用户状态
        $param = [
            'loginnum' => $hasUser['loginnum'] + 1,
            'last_login_ip' => request()->ip(),
            'last_login_time' => time(),
            'token' => md5($hasUser['username'] . $hasUser['password'])
        ];

        Db::name('admin')->where('id', $hasUser['id'])->update($param);
        writelog($hasUser['id'],session('username'),'用户【'.session('username').'】登录成功',1);

        //登录成功，跳转到 Admin 后台管理页面
        return json(['code' => 1, 'url' => url('index/index'), 'msg' => '登录成功']);
    }

    /**
     * 退出登录
     * @return
     */
    public function loginOut()
    {
        session(null);
        cache('db_config_data',null);//清除缓存中网站配置信息
        $this->redirect('login/index');
    }
}