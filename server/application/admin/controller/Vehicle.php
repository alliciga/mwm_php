<?php

namespace app\admin\controller;
use app\admin\model\VehicleModel;
use app\admin\model\VehicleTypeModel;
use think\Db;

class Vehicle extends Base
{
    //*********************************************清运车类别*********************************************//
    /**
     * 返回车型页面 或 返回车型数据
     */
    public function index_type(){

        $key = input('key');
        $map = [];
        if($key&&$key!==""){
            $map['type_name'] = ['like',"%" . $key . "%"];
        }      
        $group = new VehicleTypeModel();
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
     * 添加车型
     */
    public function add_type()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $type = new VehicleTypeModel();
            $flag = $type->insertType($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        return $this->fetch();
    }


    /**
     * 编辑车型
     */
    public function edit_type()
    {
        $type = new VehicleTypeModel();
        if(request()->isPost()){           
            $param = input('post.');
            $flag = $type->editType($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $this->assign('type',$type->getOneType($id));
        return $this->fetch();
    }


    /**
     * 删除车型
     */
    public function del_type()
    {
        $id = input('param.id');
        $group = new VehicleTypeModel();
        $flag = $group->delType($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    /**
     * 车型状态
     */
    public function type_status()
    {
        $id=input('param.id');
        $status = Db::name('vehicle_type')->where(array('id'=>$id))->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('vehicle_type')->where(array('id'=>$id))->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '车型已停用']);
        }
        else
        {
            $flag = Db::name('vehicle_type')->where(array('id'=>$id))->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '车型已启用']);
        }   
    } 


    //*********************************************清运车列表*********************************************//
    /**
     * 清运车列表
     */
    public function index(){

        $key = input('key');
        //暂时不考虑虚拟删除，但保留这种方式，需对应修改删除指令
        $map['closed'] = 0;//0未删除，1已删除
        if($key&&$key!=="")
        {
            $map['name'] = ['like',"%" . $key . "%"];
        }
        $vehicle = new VehicleModel();
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = $vehicle->getAllCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));       
        $lists = $employee->getVehicleByWhere($map, $Nowpage, $limits);
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
     * 添加清运车
     */
    public function add_vehicle()
    {
        if(request()->isAjax()){

            $param = input('post.');
            $vehicle = new VehicleModel();
            $flag = $vehicle->insertVehicle($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $type = new VehicleTypeModel();
        $this->assign('type_name',$type->getType());
        return $this->fetch();
    }


    /**
     * 编辑清运车
     */
    public function edit_vehicle()
    {
        $vehicle = new VehicleModel();
        if(request()->isAjax()){
            $param = input('post.');
            $flag = $vehicle->editVehicle($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        $type = new VehicleTypeModel();
        $this->assign([
            'vehicle' => $vehicle->getOneType($id),
            'type' => $type->getType()
        ]);
        return $this->fetch();
    }


    /**
     * 删除清运车
     */
    public function del_vehicle()
    {
        $id = input('param.id');
        $vehicle = new VehicleModel();
        $flag = $vehicle->delEmployee($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }



    /**
     * 清运车状态
     */
    public function vehicle_status()
    {
        $id = input('param.id');
        $status = Db::name('vehicle')->where('id',$id)->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('vehicle')->where('id',$id)->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('vehicle')->where('id',$id)->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }
    
    }

}