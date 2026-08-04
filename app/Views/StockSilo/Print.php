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
    <?php
    // dd($stoks);
    ?>
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
                <th class="border">Time</th>
                <th class="border">No</th>
                <th class="border">IN</th>
                <th class="border">OUT</th>
                <th class="border">STOK</th>
            </tr>
            <?php
            $no = 1;
            $stok_in = 0;
            $stok_out = 0;
            foreach ($stoks as $stok): ?>
                <?php
                $stok['status'] == 'IN' ? $stok_in += (int)$stok['value'] : $stok_in += 0;
                $stok['status'] == 'OUT' ? $stok_out += (int)$stok['value'] : $stok_out += 0;
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td class="border-l text-center"><?= $stok['timestamp'] ?></td>
                    <td class="border-l text-center"><?= $stok['number'] ?></td>
                    <td class="border-l text-center"><?= $stok['status'] == 'IN' ? $stok['value'] : '-' ?></td>
                    <td class="border-l text-center"><?= $stok['status'] == 'OUT' ? ($stok['value'] / 2) : '-' ?></td>
                    <td class="border-l text-center"><?= $stok_in - ($stok_out / 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>