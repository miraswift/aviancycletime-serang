<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentModel extends Model
{
    protected $table = 'tb_equipment';
    protected $primaryKey = 'id_equipment';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_plant', 'type_equipment', 'no_spk', 'no_batch', 'code_formula', 'name_equipment', 'status_equipment', 'line_equipment', 'date_equipment', 'time_equipment', 'duration_equipment', 'target_equipment', 'actual_equipment', 'deleted_at'];

    protected $useTimestamps = true;

    public function getBatchNumberGroup($dateFrom, $dateTo)
    {
        $this->where('DATE(created_at) >=', $dateFrom);
        $this->where('DATE(created_at) <=', $dateTo);
        $this->groupBy('no_batch');
        $this->orderBy('no_batch', 'DESC');

        return $this->findAll();
    }

    public function getBatchNumberGroupByDateAndHour($date, $timeFrom, $timeTo)
    {
        $this->where('name_equipment', 'MIXING');
        $this->where('DATE(created_at)', $date);
        $this->where('HOUR(created_at) >=', $timeFrom);
        $this->where('HOUR(created_at) <=', $timeTo);
        $this->groupBy('no_batch');
        $this->orderBy('no_batch', 'DESC');

        return $this->findAll();
    }

    public function getBatchNumberGroupBySpk($no_spk)
    {
        $this->where('no_spk', $no_spk);
        $this->groupBy('no_batch');
        $this->orderBy('time_equipment', 'DESC');

        return $this->findAll();
    }

    public function getSpkGroup($dateFrom, $dateTo)
    {
        $this->where('DATE(created_at) >=', $dateFrom);
        $this->where('DATE(created_at) <=', $dateTo);
        $this->groupBy('no_spk');
        $this->orderBy('no_spk', 'DESC');

        return $this->findAll();
    }

    public function getDossingFirst($no_batch)
    {
        $this->select('MIN(id_equipment) AS id_equipment');
        $this->where('type_equipment', 'DOSSING');
        $this->where('status_equipment', 'ON');
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getDossingLast($no_batch)
    {
        $this->select('MAX(id_equipment) AS id_equipment');
        $this->where('type_equipment', 'DOSSING');
        $this->where('status_equipment', 'OFF');
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getWeighingDischargeFirst($no_batch)
    {
        $this->select('MIN(id_equipment) AS id_equipment');
        $this->where('name_equipment', 'WEIGHING DISCHARGE');
        $this->where('status_equipment', 'ON');
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getWeighingDischargeLast($no_batch)
    {
        $this->select('MAX(id_equipment) AS id_equipment');
        $this->where('name_equipment', 'WEIGHING DISCHARGE');
        $this->where('status_equipment', 'OFF');
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getDischargeOn($no_batch)
    {
        // $this->select('MAX(id_equipment) AS id_equipment');
        $this->where('name_equipment', 'WEIGHING DISCHARGE');
        $this->where('status_equipment', 'ON');
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getMixingOn($no_batch)
    {
        // $this->select('MAX(id_equipment) AS id_equipment');
        $this->like('name_equipment', 'MIXING');
        $this->where('status_equipment', 'ON');
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getDischargeUhOff($no_batch)
    {
        // $this->select('MAX(id_equipment) AS id_equipment');
        $this->where('name_equipment', 'UNDERHOPPER DISCHARGE');
        $this->where('status_equipment', 'OFF');
        $this->where('no_batch', $no_batch);

        return $this->first();
    }
}
