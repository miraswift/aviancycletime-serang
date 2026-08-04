<?php

namespace App\Controllers;

class Status extends BaseController
{
    public function index()
    {
        $result = [
            'code' => 200,
            'status' => 'ok',
            'connect' => 'yes',
        ];

        return $this->response->setStatusCode(200)->setJSON($result);
    }
}
