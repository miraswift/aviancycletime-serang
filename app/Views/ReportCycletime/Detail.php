<?= $this->extend('Layout/Template_Main') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#"><?= $menuGroup ?></a></li> -->
                        <li class="breadcrumb-item active"><?= $menu ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php



    ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header bg-light">
                            NO BATCH: <span class="h5">
                                <div class="badge badge-info"><?= $no_batch ?></div>
                            </span>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Feeding Cycle Time</span>
                                <span><?= $batchSummary['feeding_cycle_time'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Mixing Cycle Time</span>
                                <span><?= $batchSummary['mixing_cycle_time'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total Cycle Time</span>
                                <span><?= $batchSummary['cycle_time'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <?php
                                $delayTxtColor = 'text-success';

                                if ($batchSummary['delay_time'] > date('H:i:s', strtotime('00:00:30'))) {
                                    $delayTxtColor = 'text-danger';
                                }
                                ?>
                                <span>Delay</span>
                                <span class="<?= $delayTxtColor ?>"><?= $batchSummary['delay_time'] ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            EQUIPMENTS
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($onEquipments as $onEquipment): ?>
                                <?php
                                $offEquipment = $equipmentModel->where('no_batch', $no_batch)->where('name_equipment', $onEquipment['name_equipment'])->where('status_equipment', 'OFF')->first();
                                ?>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <span><?= $onEquipment['name_equipment'] ?> <div class="badge bg-teal"><?= $onEquipment['line_equipment'] ?></div></span>

                                        <?php if ($offEquipment): ?>
                                            <span class="badge badge-success"><?= $offEquipment['duration_equipment'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <small>Start: <?= $onEquipment['time_equipment'] ?></small>
                                    <br>
                                    <small>Stop: <?= $offEquipment ? $offEquipment['time_equipment'] : 'Still running' ?></small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection() ?>