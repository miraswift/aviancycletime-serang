<?php

namespace App\Models;

use CodeIgniter\Model;

class StockSiloModel extends Model
{
    protected $table = 'tb_stock_silo';
    protected $primaryKey = 'id_stock_silo';

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'code_plant',
        'code_stock_silo',
        'supplier_stock_silo',
        'val_stock_silo',
        'status_stock_silo',
        'date_stock_silo',
        'time_stock_silo',
        'deleted_at',
    ];

    protected $useTimestamps = true;

    public function getUnionStockAndActual($name_equipment, $line_equipment, $code, $dateFrom, $dateTo)
    {
        // 1. Buat query pertama tanpa get()
        $query1 = $this->db->table('tb_equipment')
            ->select("date_equipment AS date, time_equipment AS time, no_batch AS number, actual_equipment AS value, 'OUT' AS status, ADDTIME(date_equipment, time_equipment) AS timestamp")
            ->where('status_equipment', 'OFF')
            ->where('name_equipment', $name_equipment)
            ->whereIn('line_equipment', $line_equipment)
            ->where('date_equipment >=', $dateFrom)
            ->where('date_equipment <=', $dateTo);

        // 2. Buat query kedua tanpa get()
        $query2 = $this->db->table('tb_stock_silo')
            ->select("date_stock_silo AS date, time_stock_silo AS time, '-' AS number, val_stock_silo AS value, 'IN' AS status, ADDTIME(date_stock_silo, time_stock_silo) AS timestamp")
            ->where('code_stock_silo', $code)
            ->where('date_stock_silo >=', $dateFrom)
            ->where('date_stock_silo <=', $dateTo);

        // Compile SQL dari masing-masing query builder
        $sql1 = $query1->getCompiledSelect();
        $sql2 = $query2->getCompiledSelect();

        // Gabungkan SQL secara manual dan beri ORDER BY di paling luar
        $finalSql = "($sql1) UNION ($sql2) ORDER BY timestamp ASC";

        return $this->db->query($finalSql)->getResultArray();
    }
}
