<?php

namespace App\Controllers;

use App\Models\EquipmentModel;
use DateTime;

class ReportCycletime extends BaseController
{
    protected $equipmentModel;

    public function __construct()
    {
        $this->equipmentModel = new EquipmentModel();
    }

    public function index()
    {
        $daterange = $this->request->getVar('daterange');

        if ($daterange) {
            $dates = explode("-", urldecode($daterange));
            $dateFrom = date("Y-m-d", strtotime($dates[0]));
            $dateTo = date("Y-m-d", strtotime($dates[1]));
        } else {
            $dateFrom = date("Y-m-d");
            $dateTo = date("Y-m-d");
        }

        $data['title'] = 'Cycle Time';
        $data['menuGroup'] = 'ReportProduksi';
        $data['menu'] = 'ReportCycletime';
        $data['dateFrom'] = $dateFrom;
        $data['dateTo'] = $dateTo;

        $data['batchs'] = $this->equipmentModel->getBatchNumberGroup($dateFrom, $dateTo);

        return view('ReportCycletime/Index', $data);
    }

    public function detail($no_batch)
    {
        $data['title'] = 'Cycle Time';
        $data['menuGroup'] = 'ReportProduksi';
        $data['menu'] = 'ReportCycletime';

        // Material Time (Un-used because material is pararel)
        $dossings = $this->equipmentModel->where('no_batch', $no_batch)->where('type_equipment', 'DOSSING')->findAll();
        $totalMaterialTime = 0;
        foreach ($dossings as $dossingTime) {
            if ($dossingTime['status_equipment'] == 'OFF') {
                $totalMaterialTime += strtotime($dossingTime['duration_equipment']) - strtotime('TODAY');
            }
        }
        // Dossing Time
        $totalDossingTime = new DateTime('00:00:00');
        $cloneTotalDossingTime = clone $totalDossingTime;
        $idDossingFirst = $this->equipmentModel->getDossingFirst($no_batch);
        $dossingFirst = $this->equipmentModel->where('id_equipment', $idDossingFirst['id_equipment'])->first();
        $idDossingLast = $this->equipmentModel->getDossingLast($no_batch);
        $dossingLast = $this->equipmentModel->where('id_equipment', $idDossingLast['id_equipment'])->first();
        $dossingTimeOn = $dossingFirst['date_equipment'] . " " . $dossingFirst['time_equipment'];
        $dossingTimeOff = $dossingLast['date_equipment'] . " " . $dossingLast['time_equipment'];

        $dossingTime1 = new DateTime(date("H:i:s", strtotime($dossingTimeOn)));
        $dossingTime2 = new DateTime(date("H:i:s", strtotime($dossingTimeOff)));
        $dossingTimeDiff = $dossingTime1->diff($dossingTime2);
        $totalDossingTime->add($dossingTimeDiff);

        $intervalDossingTime = $cloneTotalDossingTime->diff($totalDossingTime);

        $intervalTotalDossingTime = sprintf(
            "%02d:%02d:%02d",
            $intervalDossingTime->h + ($intervalDossingTime->d * 24), // jika interval lebih dari 1 hari, jam harus ditambah
            $intervalDossingTime->i,
            $intervalDossingTime->s
        );
        // $delayTime = $resDossingTime - $resMaterialTime;
        // $resultDelayTime = gmdate("H:i:s", abs($delayTime));

        // Weighing Discharge Time
        // $weighingDischargeOn = 0;
        // $weighingDischargeOff = 0;
        $totalWeighingDischargeTime = new DateTime('00:00:00');
        $cloneTotalWeighingDischargeTime = clone $totalWeighingDischargeTime;
        $idWeighingDischargeFirst = $this->equipmentModel->getWeighingDischargeFirst($no_batch);
        $weighingDischargeFirst = $this->equipmentModel->where('id_equipment', $idWeighingDischargeFirst['id_equipment'])->first();
        $idWeighingDischargeLast = $this->equipmentModel->getWeighingDischargeLast($no_batch);
        $weighingDischargeLast = $this->equipmentModel->where('id_equipment', $idWeighingDischargeLast['id_equipment'])->first();
        $weighingDischargeTimeOn = $weighingDischargeFirst['date_equipment'] . " " . $weighingDischargeFirst['time_equipment'];
        $weighingDischargeTimeOff = $weighingDischargeLast['date_equipment'] . " " . $weighingDischargeLast['time_equipment'];
        // $weighingDischarge = $this->equipmentModel->where('no_batch', $no_batch)->where('name_equipment', 'WEIGHING DISCHARGE')->where('status_equipment', 'OFF')->first();

        $weighingDischargeTime1 = new DateTime(date("H:i:s", strtotime($weighingDischargeTimeOn)));
        $weighingDischargeTime2 = new DateTime(date("H:i:s", strtotime($weighingDischargeTimeOff)));
        $weighingDischargeTimeDiff = $weighingDischargeTime1->diff($weighingDischargeTime2);
        $totalWeighingDischargeTime->add($weighingDischargeTimeDiff);

        $intervalWeighingDischargeTime = $cloneTotalWeighingDischargeTime->diff($totalWeighingDischargeTime);

        $intervalTotalWeighingDischargeTime = sprintf(
            "%02d:%02d:%02d",
            $intervalWeighingDischargeTime->h + ($intervalWeighingDischargeTime->d * 24), // jika interval lebih dari 1 hari, jam harus ditambah
            $intervalWeighingDischargeTime->i,
            $intervalWeighingDischargeTime->s
        );

        // if ($weighingDischarge) {
        // $totalWeighingDischargeTime = $weighingDischarge['duration_equipment'];
        // }

        // Mixing Time
        $mixingTimeOn = 0;
        $mixingTimeOff = date('Y-m-d H:i:s');
        $totalMixingTime = new DateTime('00:00:00');
        $cloneTotalMixingTime = clone $totalMixingTime;
        $getMixingOn = $this->equipmentModel->getMixingOn($no_batch);
        $getDisrchargeUhOff = $this->equipmentModel->getDischargeUhOff($no_batch);
        if ($getMixingOn) {
            $mixingTimeOn = $getMixingOn['date_equipment'] . ' ' . $getMixingOn['time_equipment'];
        }

        if ($getDisrchargeUhOff) {
            $mixingTimeOff = $getDisrchargeUhOff['date_equipment'] . ' ' . $getDisrchargeUhOff['time_equipment'];
        }

        $mixingTime1 = new DateTime(date("H:i:s", strtotime($mixingTimeOn)));
        $mixingTime2 = new DateTime(date("H:i:s", strtotime($mixingTimeOff)));
        $mixingTimeDiff = $mixingTime1->diff($mixingTime2);
        $totalMixingTime->add($mixingTimeDiff);

        $intervalMixingTime = $cloneTotalMixingTime->diff($totalMixingTime);

        $intervalTotalMixingTime = sprintf(
            "%02d:%02d:%02d",
            $intervalMixingTime->h + ($intervalMixingTime->d * 24), // jika interval lebih dari 1 hari, jam harus ditambah
            $intervalMixingTime->i,
            $intervalMixingTime->s
        );

        // Underhopper Discharge Time
        $totalUnderhopperDischargeTime = "00:00:00";
        $underhopperDischarge = $this->equipmentModel->where('no_batch', $no_batch)->where('name_equipment', 'UNDERHOPPER DISCHARGE')->where('status_equipment', 'OFF')->first();

        if ($underhopperDischarge) {
            $totalUnderhopperDischargeTime = $underhopperDischarge['duration_equipment'];
        }


        $resUnderhopperDischargeTime = strtotime("1970-01-01 " . $totalUnderhopperDischargeTime);
        $resDefaultUnderhopperDelay = strtotime("1970-01-01 00:00:30");
        // Delay Time
        $delayTime = $resUnderhopperDischargeTime - $resDefaultUnderhopperDelay;
        $resultDelayTime = gmdate("H:i:s", abs($delayTime));
        // $resDossingTime = strtotime("1970-01-01 " . $intervalTotalDossingTime);
        // $resMaterialTime = strtotime("1970-01-01 " . gmdate("H:i:s", abs($totalMaterialTime)));

        list($hDossing, $mDossing, $sDossing) = explode(":", $intervalTotalDossingTime);
        list($hWeighingDischarge, $mWeighingDischarge, $sWeighingDischarge) = explode(":", $intervalTotalWeighingDischargeTime);
        list($hMixing, $mMixing, $sMixing) = explode(":", $intervalTotalMixingTime);
        //  !!
        $scndDossingTime = $hDossing * 3600 + $mDossing * 60 + $sDossing;
        $scndWeighingDischargeTime = $hWeighingDischarge * 3600 + $mWeighingDischarge * 60 + $sWeighingDischarge;
        $scndMixing = $hMixing * 3600 + $mMixing * 60 + $sMixing;
        // Feeding Cycle Time
        $feedingCycleTime = $scndDossingTime + $scndWeighingDischargeTime;
        $resultFeedingTime = gmdate("H:i:s", abs($feedingCycleTime));
        // Cycletime
        $cycleTime = $feedingCycleTime + $scndMixing;
        $resultCycleTime = gmdate("H:i:s", abs($cycleTime));


        $data['no_batch'] = $no_batch;

        $data['onEquipments'] = $this->equipmentModel->where('no_batch', $no_batch)->where('status_equipment', 'ON')->findAll();
        $data['batchSummary'] = [
            'feeding_cycle_time' => $resultFeedingTime,
            'mixing_cycle_time' => $intervalTotalMixingTime,
            'cycle_time' => $resultCycleTime,
            'delay_time' => $resultDelayTime,
        ];
        // Model
        $data['equipmentModel'] = $this->equipmentModel;

        return view('ReportCycletime/Detail', $data);
    }
}
