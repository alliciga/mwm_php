<?php

namespace app\admin\validate;
use think\Validate;

class EmployeeValidate extends Validate
{
    protected $rule = [
        ['account', 'unique:employee', '该雇员已经存在']
    ];

}