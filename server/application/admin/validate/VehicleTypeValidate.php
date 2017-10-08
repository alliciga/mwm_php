<?php

namespace app\admin\validate;
use think\Validate;

class VehicleTypeValidate extends Validate
{
    protected $rule = [
        ['type_name', 'unique:vehicle_type', '车型已经存在']
    ];

}