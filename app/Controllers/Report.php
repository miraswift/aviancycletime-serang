<?php

namespace App\Controllers;

use App\Models\EquipmentModel;

use Mpdf\Mpdf;

class Report extends BaseController
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
        $data['menu'] = 'Report';
        $data['dateFrom'] = $dateFrom;
        $data['dateTo'] = $dateTo;

        $data['batchs'] = $this->equipmentModel->getSpkGroup($dateFrom, $dateTo);

        return view('Report/Index', $data);
    }

    public function print($no_spk)
    {
        $data['no_spk'] = $no_spk;
        $data['batchs'] = $this->equipmentModel->getBatchNumberGroupBySpk($no_spk);
        $data['equipmentModel'] = $this->equipmentModel;

        // return view('Report/Print', $data);

        $view = view('Report/Print', $data);

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_top' => 5,
            'margin_bottom' => 5,
            'margin_left' => 5,
            'margin_right' => 5,
        ]);

        $mpdf->WriteHTML($view);

        // Output sebagai browser PDF
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline;filename=' . 'Laporan_Cycletime' . $no_spk . '.pdf')
            ->setBody($mpdf->Output('', 'S')); // 'S' = return as string
    }
}
