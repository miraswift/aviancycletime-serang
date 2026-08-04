<?php

namespace App\Controllers;

use App\Models\PlantModel;
use App\Models\EquipmentModel;
use App\Models\LogEquipmentModel;
use DateTime;

class Equipment extends BaseController
{
    protected $plantModel;
    protected $equipmentModel;
    protected $logEquipmentModel;

    public function __construct()
    {
        $this->plantModel = new PlantModel();
        $this->equipmentModel = new EquipmentModel();
        $this->logEquipmentModel = new LogEquipmentModel();
    }

    public function create()
    {
        $vars = json_decode(json_encode($this->request->getVar()), true);

        $code_plant = $vars['code_plant'];
        $type_equipment = $vars['type_equipment'];
        $no_spk = $vars['no_spk'];
        $no_batch = $vars['no_spk'] . '-' . $vars['no_batch'];
        $code_formula = $vars['code_formula'];
        $name_equipment = $vars['name_equipment'];
        $status_equipment = $vars['status_equipment'];
        $line_equipment = $vars['line_equipment'];
        $target = $vars['target'];
        $actual = $vars['actual'];
        $date_equipment = $vars['date_equipment'];
        $time_equipment = $vars['time_equipment'];

        $plant = $this->plantModel->where('code_plant', $code_plant)->first();

        if ($plant == null) {
            $result = [
                'code' => 400,
                'status' => 'failed',
                'msg' => "Failed, plant not found",
            ];

            return $this->response->setStatusCode(400)->setJSON($result);
        } else {
            $checkEquipment = $this->equipmentModel->where('no_batch', $no_batch)->where('name_equipment', $name_equipment)->where('status_equipment', $status_equipment)->where('line_equipment', $line_equipment)->where('date_equipment', $date_equipment)->first();

            if ($status_equipment == 'OFF') {
                $checkEquipment = false;
            }

            if ($checkEquipment) {
                $result = [
                    'code' => 400,
                    'status' => 'failed',
                    'msg' => "Equipment already exist",
                ];

                return $this->response->setStatusCode(400)->setJSON($result);
            } else {
                // Duration
                $duration_equipment = null;

                if ($status_equipment == 'OFF') {
                    $equipmentOn = $this->equipmentModel->where('no_batch', $no_batch)->where('name_equipment', $name_equipment)->where('status_equipment', 'ON')->where('line_equipment', $line_equipment)->first();
                    $equipmentTimeOn = $equipmentOn['date_equipment'] . " " . $equipmentOn['time_equipment'];
                    $equipmentTimeOff = $date_equipment . " " . $time_equipment;

                    $totalEquipmentTime = new DateTime('00:00:00');
                    $cloneTotalEquipmentTime = clone $totalEquipmentTime;
                    $equipmentTime1 = new DateTime(date("H:i:s", strtotime($equipmentTimeOn)));
                    $equipmentTime2 = new DateTime(date("H:i:s", strtotime($equipmentTimeOff)));
                    $equipmentTimeDiff = $equipmentTime1->diff($equipmentTime2);
                    $totalEquipmentTime->add($equipmentTimeDiff);

                    $intervalEquipmentTime = $cloneTotalEquipmentTime->diff($totalEquipmentTime);

                    $intervalTotalEquipmentTime = sprintf(
                        "%02d:%02d:%02d",
                        $intervalEquipmentTime->h + ($intervalEquipmentTime->d * 24), // jika interval lebih dari 1 hari, jam harus ditambah
                        $intervalEquipmentTime->i,
                        $intervalEquipmentTime->s
                    );

                    $duration_equipment = $intervalTotalEquipmentTime;
                }

                $equipmentData = [
                    'id_plant' => $plant['id_plant'],
                    'type_equipment' => $type_equipment,
                    'no_spk' => $no_spk,
                    'no_batch' => $no_batch,
                    'code_formula' => $code_formula,
                    'name_equipment' => $name_equipment,
                    'status_equipment' => $status_equipment,
                    'line_equipment' => $line_equipment,
                    'date_equipment' => date('Y-m-d', strtotime($date_equipment)),
                    'time_equipment' => date('H:i:s', strtotime($time_equipment)),
                    'duration_equipment' => $duration_equipment,
                    'target_equipment' => $target,
                    'actual_equipment' => $actual,
                ];

                $save = $this->equipmentModel->save($equipmentData);

                if (!$save) {
                    $result = [
                        'code' => 400,
                        'status' => 'failed',
                        'msg' => "Equipment not saved",
                        'detail' => $this->equipmentModel->errors(),
                    ];

                    return $this->response->setStatusCode(400)->setJSON($result);
                } else {
                    $result = [
                        'code' => 200,
                        'status' => 'ok',
                        'msg' => "Equipment saved succesfully",
                    ];

                    return $this->response->setStatusCode(200)->setJSON($result);
                }
            }
        }
    }

    public function createLog()
    {
        $vars = json_decode(json_encode($this->request->getVar()), true);

        $code_plant = $vars['code_plant'];
        $type_equipment = $vars['type_equipment'];
        $no_spk = $vars['no_spk'];
        $no_batch = $vars['no_spk'] . '-' . $vars['no_batch'];
        $code_formula = $vars['code_formula'];
        $name_equipment = $vars['name_equipment'];
        $status_equipment = $vars['status_equipment'];
        $line_equipment = $vars['line_equipment'];
        $target = $vars['target'];
        $actual = $vars['actual'];
        $date_equipment = $vars['date_equipment'];
        $time_equipment = $vars['time_equipment'];

        $plant = $this->plantModel->where('code_plant', $code_plant)->first();

        $equipmentData = [
            'id_plant' => $plant ? $plant['id_plant'] : 0,
            'type_log_equipment' => $type_equipment,
            'no_spk' => $no_spk,
            'no_batch' => $no_batch,
            'code_formula' => $code_formula,
            'name_log_equipment' => $name_equipment,
            'status_log_equipment' => $status_equipment,
            'line_log_equipment' => $line_equipment,
            'date_log_equipment' => date('Y-m-d', strtotime($date_equipment)),
            'time_log_equipment' => date('H:i:s', strtotime($time_equipment)),
            'target_log_equipment' => $target,
            'actual_log_equipment' => $actual,
        ];

        $save = $this->logEquipmentModel->save($equipmentData);

        if (!$save) {
            $result = [
                'code' => 400,
                'status' => 'failed',
                'msg' => "Equipment not saved",
                'detail' => $this->logEquipmentModel->errors(),
            ];

            return $this->response->setStatusCode(400)->setJSON($result);
        } else {
            $result = [
                'code' => 200,
                'status' => 'ok',
                'msg' => "Equipment saved succesfully",
            ];

            return $this->response->setStatusCode(200)->setJSON($result);
        }
    }
}
