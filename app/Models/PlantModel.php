<?php

namespace App\Models;

use CodeIgniter\Model;

class PlantModel extends Model
{
    protected $table = 'tb_plant';
    protected $primaryKey = 'id_plant';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['code_plant', 'name_plant', 'deleted_at'];

    protected $useTimestamps = true;
}
