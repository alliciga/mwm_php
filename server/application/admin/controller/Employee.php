<?php

namespace app\admin\controller;
use app\admin\model\EmployeeModel;
use app\admin\model\EmployeeGroupModel;
use think\Db;

class Employee extends Base
{
    //*********************************************雇员组*********************************************//
    /**
     * 雇员组
     */
    public function group(){

        $key = input('key');
        $map = [];
        if($key&&$key!==""){
            $map['group_name'] = ['like',"%" . $key . "%"];          
        }      
        $group = new EmployeeGroupModel();
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');
        $count = $group->getAllCount($map);         //获取总条数
        $allpage = intval(ceil($count / $limits));  //计算总页面      
        $lists = $group->getAll($map, $Nowpage, $limits);  
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }

    /**
     * 添加雇员组
     */
    public function add_group()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $group = new EmployeeGroupModel();
            $flag = $group->insertGroup($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        return $this->fetch();
    }


    /**
     * 编辑雇员组
     */
    public function edit_group()
    {
        $group = new EmployeeGroupModel();
        if(request()->isPost()){           
            $param = input('post.');
            $flag = $group->editGroup($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $this->assign('group',$group->getOne($id));
        return $this->fetch();
    }


    /**
     * 删除雇员组
     */
    public function del_group()
    {
        $id = input('param.id');
        $group = new EmployeeGroupModel();
        $flag = $group->delGroup($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    /**
     * 雇员组状态
     */
    public function group_status()
    {
        $id=input('param.id');
        $status = Db::name('employee_group')->where(array('id'=>$id))->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('employee_group')->where(array('id'=>$id))->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('employee_group')->where(array('id'=>$id))->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }   
    } 


    //*********************************************雇员列表*********************************************//
    /**
     * 雇员列表
     */
    public function index(){

        $key = input('key');
        //暂时不考虑虚拟删除，但保留这种方式，需对应修改删除指令
        $map['closed'] = 0;//0未删除，1已删除
        if($key&&$key!=="")
        {
            $map['account|nickname|mobile'] = ['like',"%" . $key . "%"];
        }
        $employee = new EmployeeModel();
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = $employee->getAllCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));       
        $lists = $employee->getEmployeeByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }


    /**
     * 添加雇员
     */
    public function add_employee()
    {
        if(request()->isAjax()){

            $param = input('post.');
            $employee = new EmployeeModel();
            $flag = $employee->insertEmployee($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $group = new EmployeeGroupModel();
        $this->assign('group',$group->getGroup());
        return $this->fetch();
    }


    /**
     * 编辑雇员
     */
    public function edit_employee()
    {
        $employee = new EmployeeModel();
        if(request()->isAjax()){
            $param = input('post.');
            $flag = $employee->editEmployee($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        $group = new MemberGroupModel();
        $this->assign([
            'member' => $employee->getOneEmployee($id),
            'group' => $group->getGroup()
        ]);
        return $this->fetch();
    }


    /**
     * 删除雇员
     */
    public function del_employee()
    {
        $id = input('param.id');
        $member = new EmployeeModel();
        $flag = $member->delEmployee($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }



    /**
     * 雇员状态
     */
    public function employee_status()
    {
        $id = input('param.id');
        $status = Db::name('employee')->where('id',$id)->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('employee')->where('id',$id)->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('employee')->where('id',$id)->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }
    
    }

}