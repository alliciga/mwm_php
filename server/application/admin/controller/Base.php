<?php

namespace app\admin\controller;
use app\admin\model\Node;
use think\Controller;

/*
 * 重写 Controller 基础类
 * 在最底层嵌入权限审核代码
 * 配置文件参数加载
 */

class Base extends Controller
{
    public function _initialize()
    {

        if(!session('uid')||!session('username')){
            $this->redirect('login/index');
        }
        
        $auth = new \com\Auth();   
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        $url        = $module."/".$controller."/".$action;

        //管理员账户跳过检测
        if(session('uid')!=1){
            //逻辑无关页面跳过检测
            if(!in_array($url, ['admin/index/index','admin/index/indexpage','admin/upload/upload','admin/index/uploadface'])){
                //检查角色权限
                if(!$auth->check($url,session('uid'))){
                    $this->error('没有操作权限');
                }
            }
        }

        //角色权限检测通过
        
        $node = new Node();
        $this->assign([
            'username' => session('username'),
            'portrait' => session('portrait'),
            'rolename' => session('rolename'),
            'menu' => $node->getMenu(session('rule'))
        ]);

        $config = cache('db_config_data');

        if(!$config){
            $config = load_config();                          
            cache('db_config_data',$config);
        }
        config($config);

        //检查 'web_site_close' 参数配置，如果为 0，则除管理员外无法访问
        if(config('web_site_close') == 0 && session('uid') !=1 ){
            $this->error('站点已经关闭，请联系管理员。');
        }

        //检查管理员IP白名单
        if(config('admin_allow_ip') && session('uid') !=1 ){          
            if(in_array(request()->ip(),explode('#',config('admin_allow_ip')))){
                $this->error('403:禁止访问');
            }
        }

    }
}