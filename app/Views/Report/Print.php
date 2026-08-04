<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Cycletime</title>
</head>

<body>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
        }

        .border {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .border-r {
            border-right: 1px solid black;
            border-collapse: collapse;
        }

        .border-l {
            border-left: 1px solid black;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            padding: 5px;
        }

        table {
            width: 100%;
        }

        .column {
            float: left;
            width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-up {
            vertical-align: top;
        }

        .text-bot {
            vertical-align: bottom;
        }

        .page {
            height: 50%;
        }

        .text-red {
            color: red;
        }

        .bg-red {
            background-color: red;
        }
    </style>
    <div class="row">
        <div class="column" style="width: 100%;">
            <h1 class="text-center">Report Cycletime</h1>
            <h2 class="text-center">SPK: <?= $no_spk ?></h2>
        </div>
        <br>
        <br>
        <table class="border">
            <tr class="border">
                <th class="border">Equipment</th>
                <th class="border">Line</th>
                <th class="border">Time ON</th>
                <th class="border">Time OFF</th>
                <th class="border">Duration</th>
                <th class="border">Actual</th>
            </tr>
            <?php foreach ($batchs as $batch): ?>
                <?php
                $no_batch = $batch['no_batch'];

                // Material Time (Un-used because material is pararel)
                $dossings = $equipmentModel->where('no_batch', $no_batch)->where('type_equipment', 'DOSSING')->findAll();
                $totalMaterialTime = 0;
                foreach ($dossings as $dossingTime) {
                    if ($dossingTime['status_equipment'] == 'OFF') {
                        $totalMaterialTime += strtotime($dossingTime['duration_equipment']) - strtotime('TODAY');
                    }
                }
                // Dossing Time
                $totalDossingTime = new DateTime('00:00:00');
                $cloneTotalDossingTime = clone $totalDossingTime;
                $idDossingFirst = $equipmentModel->getDossingFirst($no_batch);
                $dossingFirst = $equipmentModel->where('id_equipment', $idDossingFirst['id_equipment'])->first();
                $idDossingLast = $equipmentModel->getDossingLast($no_batch);
                $dossingLast = $equipmentModel->where('id_equipment', $idDossingLast['id_equipment'])->first();

                // Null check
                $dossingTimeOn = $batch['date_equipment'] . " " . "00:00:00";
                if ($dossingFirst) {
                    $dossingTimeOn = $dossingFirst['date_equipment'] . " " . $dossingFirst['time_equipment'];
                }

                // Null check
                $dossingTimeOff = $batch['date_equipment'] . " " . "00:00:00";
                if ($dossingLast) {
                    $dossingTimeOff = $dossingLast['date_equipment'] . " " . $dossingLast['time_equipment'];
                }

                $dossingTime1 = new DateTime(date("H:i:s", strtotime($dossingTimeOn)));
                $dossingTime2 = new DateTime(date("H:i:s", strtotime($dossingTimeOff)));
                $dossingTimeDiff = $dossingTime1->diff($dossingTime2);
                $totalDossingTime->add($dossingTimeDiff);

                $intervalDossingTime = $cloneTotalDossingTime->diff($totalDossingTime);

                // echo json_encode($dossingTimeOff);

                // Fix interval hari
                $intervalTotalDossingTime = sprintf(
                    "%02d:%02d:%02d",
                    // $intervalDossingTime->h,
                    $intervalDossingTime->h + ($intervalDossingTime->d * 24),
                    // jika interval lebih dari 1 hari, jam harus ditambah
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
                $idWeighingDischargeFirst = $equipmentModel->getWeighingDischargeFirst($no_batch);
                $weighingDischargeFirst = $equipmentModel->where('id_equipment', $idWeighingDischargeFirst['id_equipment'])->first();
                $idWeighingDischargeLast = $equipmentModel->getWeighingDischargeLast($no_batch);
                $weighingDischargeLast = $equipmentModel->where('id_equipment', $idWeighingDischargeLast['id_equipment'])->first();

                // Null check
                $weighingDischargeTimeOn = $batch['date_equipment'] . " " . "00:00:00";
                if ($weighingDischargeFirst) {
                    $weighingDischargeTimeOn = $weighingDischargeFirst['date_equipment'] . " " . $weighingDischargeFirst['time_equipment'];
                }

                $weighingDischargeTimeOff = $batch['date_equipment'] . " " . "00:00:00";
                if ($weighingDischargeLast) {
                    $weighingDischargeTimeOff = $weighingDischargeLast['date_equipment'] . " " . $weighingDischargeLast['time_equipment'];
                }


                // $weighingDischarge = $equipmentModel->where('no_batch', $no_batch)->where('name_equipment', 'WEIGHING DISCHARGE')->where('status_equipment', 'OFF')->first();

                $weighingDischargeTime1 = new DateTime(date("H:i:s", strtotime($weighingDischargeTimeOn)));
                $weighingDischargeTime2 = new DateTime(date("H:i:s", strtotime($weighingDischargeTimeOff)));
                $weighingDischargeTimeDiff = $weighingDischargeTime1->diff($weighingDischargeTime2);
                $totalWeighingDischargeTime->add($weighingDischargeTimeDiff);

                $intervalWeighingDischargeTime = $cloneTotalWeighingDischargeTime->diff($totalWeighingDischargeTime);

                // Fix interval hari
                $intervalTotalWeighingDischargeTime = sprintf(
                    "%02d:%02d:%02d",
                    // $intervalWeighingDischargeTime->h,
                    $intervalWeighingDischargeTime->h + ($intervalWeighingDischargeTime->d * 24),
                    // jika interval lebih dari 1 hari, jam harus ditambah
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
                $getMixingOn = $equipmentModel->getMixingOn($no_batch);
                $getDisrchargeUhOff = $equipmentModel->getDischargeUhOff($no_batch);
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

                // echo json_encode($mixingTimeOn);

                $intervalMixingTime = $cloneTotalMixingTime->diff($totalMixingTime);

                $intervalTotalMixingTime = sprintf(
                    "%02d:%02d:%02d",
                    $intervalMixingTime->h + ($intervalMixingTime->d * 24), // jika interval lebih dari 1 hari, jam harus ditambah
                    $intervalMixingTime->i,
                    $intervalMixingTime->s
                );

                // Underhopper Discharge Time
                $totalUnderhopperDischargeTime = "00:00:00";
                $underhopperDischarge = $equipmentModel->where('no_batch', $no_batch)->where('name_equipment', 'UNDERHOPPER DISCHARGE')->where('status_equipment', 'OFF')->first();

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
                // echo json_encode($scndDossingTime);
                $scndWeighingDischargeTime = $hWeighingDischarge * 3600 + $mWeighingDischarge * 60 + $sWeighingDischarge;
                $scndMixing = $hMixing * 3600 + $mMixing * 60 + $sMixing;
                // Feeding Cycle Time
                $feedingCycleTime = $scndDossingTime + $scndWeighingDischargeTime;
                $resultFeedingTime = gmdate("H:i:s", abs($feedingCycleTime));
                // echo $scndDossingTime . '/' . $scndWeighingDischargeTime;
                // Cycletime
                $cycleTime = $feedingCycleTime + $scndMixing;
                $resultCycleTime = gmdate("H:i:s", abs($cycleTime));

                $batchSummary = [
                    'feeding_cycle_time' => $resultFeedingTime,
                    'mixing_cycle_time' => $intervalTotalMixingTime,
                    'cycle_time' => $resultCycleTime,
                    'delay_time' => $resultDelayTime,
                    // 'batch_cycle_time' => 60 / $resultFeedingTime,
                ];

                $onEquipments = $equipmentModel->where('no_batch', $no_batch)->where('status_equipment', 'ON')->findAll();

                // Cycle Batch
                $batchCycleTimeMinutes = substr($resultFeedingTime, 3);
                $resultbatchCycleTime = str_replace(':', '.', $batchCycleTimeMinutes);

                // For Downtime Mixing To Underhopper
                $partsBatch = explode("-", $no_batch);
                $prefix1 = $partsBatch[0];
                $prefix2 = $partsBatch[1];
                $batchNumber = isset($partsBatch[2]) ? (int)$partsBatch[2] : 0;
                $nextBatchNumber = $batchNumber + 1;

                $nextBatch = $prefix1 . '-' . $prefix2 . '-' . $nextBatchNumber;
                $underhopperFull = $equipmentModel->where('no_batch', $no_batch)->where('name_equipment', 'UNDERHOPPER FULL')->first();
                $underhopperDischargeOn = $equipmentModel->where('no_batch', $nextBatch)->where('name_equipment', 'UNDERHOPPER DISCHARGE')->where('status_equipment', 'ON')->first();

                if ($underhopperFull) {
                    $timeUnderhopperFull = strtotime("1970-01-01 " . $underhopperFull['time_equipment']);

                    if ($underhopperDischargeOn) {
                        $timeUnderhopperDischargeOn = strtotime("1970-01-01 " . $underhopperDischargeOn['time_equipment']);
                        // Delay Time
                        $downtimeMixingToUnderhopper = $timeUnderhopperFull - $timeUnderhopperDischargeOn;
                        $resultDowntimeMixingToUnderhopper = gmdate("H:i:s", abs($downtimeMixingToUnderhopper));
                    }
                }
                ?>
                <tr>
                    <th colspan="5" class="text-left">
                        <span>Batch: <?= $batch['no_batch'] ?></span>
                        <br>
                        <span>Feeding: <?= $resultFeedingTime ?></span>
                        <br>
                        <span>Mixing: <?= $intervalTotalMixingTime ?></span>
                        <br>
                        <?php if ((float)$resultbatchCycleTime > 0): ?>
                            <span>Cycle Time: <?= $resultFeedingTime ?> (<?= number_format(60 / (float)$resultbatchCycleTime, 2, '.', ',') ?> Batch / jam)</span>
                        <?php endif; ?>
                        <?php if ((float)$resultbatchCycleTime <= 0): ?>
                            <span>Cycle Time: <div class="text-red">BATCH DATA ERROR</div></span>
                        <?php endif; ?>
                        <br>
                        <span>Total Time: <?= $resultCycleTime ?></span>
                        <br>
                        <span>Delay: <?= $resultDelayTime ?></span>
                        <span>Delay Mixing To Underhopper: <?= $underhopperFull && $underhopperDischargeOn ? $resultDowntimeMixingToUnderhopper : 0 ?></span>
                    </th>
                </tr>
                <?php foreach ($onEquipments as $onEquipment): ?>
                    <?php
                    $offEquipment = $equipmentModel->where('no_batch', $no_batch)->where('name_equipment', $onEquipment['name_equipment'])->where('status_equipment', 'OFF')->first();
                    ?>
                    <tr class="border">
                        <td class="border"><?= $onEquipment['name_equipment'] ?></td>
                        <td class="border text-center"><?= $onEquipment['line_equipment'] ?></td>
                        <td class="border text-center"><?= $onEquipment['time_equipment'] ?></td>
                        <td class="border text-center"><?= $offEquipment ? $offEquipment['time_equipment'] : 'Still running' ?></td>
                        <td class="border text-center"><?= $offEquipment ? $offEquipment['duration_equipment'] : '-' ?></td>
                        <td class="border text-center"><?= $offEquipment ? number_format($offEquipment['actual_equipment'], 0, '.', ',') : '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>