<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class VehicleModel extends Model
{
    protected $name = 'vehicle';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;


    /**
     * 根据搜索条件获取列表信息
     */
    public function getVehicleByWhere($map, $Nowpage, $limits)
    {
        return $this->field('siva_vehicle.*,id')->join('siva_vehicle_type', 'siva_vehicle.type_id = siva_vehicle_type.id')->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }
    
    
    /**
     * 添加清运车辆
     */
    public function insertVehicle($param)
    {
        try{
            $result = $this->validate('VehicleValidate')->allowField(true)->save($param);
            if(false === $result){             
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '清运车辆添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    /**
     * 编辑车辆信息
     */
    public function updateVehicle($param)
    {
        try{
            $result = $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){          
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '车辆信息编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    /**
     * 根据车辆id获取一条信息
     */
    public function getOneVehicle($id)
    {
        return $this->where('id', $id)->find();
    }



    /**
     * 删除车辆信息
     */
    public function delVehicle($id)
    {
        try{
            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '车辆信息删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}