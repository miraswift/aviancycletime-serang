<?php

namespace App\Models;

use CodeIgniter\Model;

class LogEquipmentModel extends Model
{
    protected $table = 'tb_log_equipment';
    protected $primaryKey = 'id_log_equipment';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_plant', 'type_log_equipment', 'no_spk', 'no_batch', 'code_formula', 'name_log_equipment', 'status_log_equipment', 'line_log_equipment', 'date_log_equipment', 'time_log_equipment', 'target_log_equipment', 'actual_log_equipment', 'deleted_at'];

    protected $useTimestamps = true;
}
