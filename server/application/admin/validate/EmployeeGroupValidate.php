<?php

namespace app\admin\validate;
use think\Validate;

class EmployeeGroupValidate extends Validate
{
    protected $rule = [
        ['group_name', 'unique:employee_group', '雇员组已经存在']
    ];

}