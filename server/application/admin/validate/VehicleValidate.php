<?php

namespace app\admin\validate;
use think\Validate;

class VehicleValidate extends Validate
{
    protected $rule = [
        ['name', 'unique:vehicle', '该清运车已经存在']
    ];

}