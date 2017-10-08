<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class EmployeeModel extends Model
{
    protected $name = 'employee';
    protected $autoWriteTimestamp = true;   // 开启自动写入时间戳

    /**
     * 根据搜索条件获取雇员信息
     */
    public function getEmployeeByWhere($map, $Nowpage, $limits)
    {
        return $this->field('siva_employee.*,group_name')->join('siva_employee_group', 'siva_employee.group_id = siva_employee_group.id')
            ->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的雇员数量
     * @param $where
     */
    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }


    /**
     * 插入信息
     */
    public function insertEmployee($param)
    {
        try{
            $result = $this->validate('EmployeeValidate')->allowField(true)->save($param);
            if(false === $result){            
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑信息
     * @param $param
     */
    public function editEmployee($param)
    {
        try{
            $result =  $this->validate('EmployeeValidate')->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){            
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    /**
     * 根据id获取雇员信息
     * @param $id
     */
    public function getOneEmployee($id)
    {
        return $this->where('id', $id)->find();
    }


    /**
     * 删除雇员
     * @param $id
     */
    public function delEmployee($id)
    {
        try{

            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];

        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}