<?php

namespace app\admin\model;
use app\admin\validate\VehicleTypeValidate;
use think\Model;
use think\Db;

class VehicleTypeModel extends Model
{
    protected $name = 'vehicle_type';

    /**
     * 根据条件获取全部数据
     */
    public function getAll($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage,$limits)->order('id asc')->select();
    }


    /**
     * 添加车型
     */
    public function insertType($param)
    {
        try{
            $result = $this->validate('VehicleTypeValidate')->save($param);
            if(false === $result){     
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '车型添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    /**
     * 编辑车型
     */
    public function editType($param)
    {
        try{
            $result = $this->save($param, ['id' => $param['id']]);
            if(false === $result){          
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '车型更新成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 根据条件获取所有数量
     */
    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }


    /**
     * 根据分类id获取一条信息
     */
    public function getOneType($id)
    {
        return $this->where('id', $id)->find();
    }



    /**
     * 删除分类
     */
    public function delType($id)
    {
        try{
            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '车型删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}