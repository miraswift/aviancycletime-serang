<?php

namespace App\Controllers;

use App\Models\EquipmentModel;

use Mpdf\Mpdf;

class ReportByHour extends BaseController
{
    protected $equipmentModel;

    public function __construct()
    {
        $this->equipmentModel = new EquipmentModel();
    }

    public function index()
    {
        $date = $this->request->getVar('date');
        $timerange = $this->request->getVar('timerange');

        if ($timerange) {
            $times = explode("-", urldecode($timerange));
            $timeFrom = date("H:i", strtotime($times[0]));
            $timeTo = date("H:i", strtotime($times[1]));
            $batchs = $this->equipmentModel->getBatchNumberGroupByDateAndHour($date, $timeFrom, $timeTo);
        } else {
            $timeFrom = date("Y-m-d");
            $timeTo = date("Y-m-d");
            $batchs = null;
        }

        $data['batchs'] = $batchs;

        $data['title'] = 'Report Batch By Hour';
        $data['menuGroup'] = 'ReportProduksi';
        $data['menu'] = 'ReportByHour';
        $data['timeFrom'] = $timeFrom;
        $data['timeTo'] = $timeTo;
        $data['date'] = $date;

        return view('ReportByHour/Index', $data);
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
