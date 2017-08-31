<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    protected $table = 'staff';

    public function getStaffList($id) {
        $arResult = $this->find($id)->toArray();
        return($arResult);
    }
}
