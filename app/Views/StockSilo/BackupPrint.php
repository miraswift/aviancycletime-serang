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
            <h1 class="text-center">Report Stock Silo <?= $silo ?></h1>
            <h2 class="text-center">Tgl: <?= $dateFrom . ' - ' . $dateTo ?></h2>
        </div>
        <br>
        <br>
        <table class="border">
            <tr class="border">
                <th class="border">No</th>
                <th class="border">Material</th>
                <th class="border">Masuk</th>
                <th class="border">Keluar</th>
                <th class="border">Stok Akhir</th>
            </tr>
            <?php
            $no = 1;
            foreach ($materials as $material): ?>
                <?php
                $getStockIn = $stockSiloModel->select('SUM(val_stock_silo) AS val_stock_silo ')->where('code_stock_silo', $material['code'])->where('date_stock_silo >=', $dateFrom)->where('date_stock_silo <=', $dateTo)->first();

                $getStockOut = $equipmentModel->select('SUM(actual_equipment) AS actual_equipment')->where('status_equipment', 'OFF')->where('name_equipment', $material['name'])->where('date_equipment >=', $dateFrom)->where('date_equipment <=', $dateTo)->first();
                ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="border-l"><?= $material['code'] ?></td>
                    <td class="border-l text-center"><?= $getStockIn['val_stock_silo'] ?? 0 ?></td>
                    <td class="border-l text-center"><?= $getStockOut['actual_equipment'] ?? 0 ?></td>
                    <td class="border-l text-center"><?= $getStockIn['val_stock_silo'] - $getStockOut['actual_equipment'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>