<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Form extends BaseController
{
    public function index()
    {
        return view('form');
    }

    public function store()
    {
        helper(['form', 'url']);

        $db      = \Config\Database::connect();
        $builder = $db->table('file');

        $validated = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[file,4096]',
            ],
        ]);

        $response = [
            'success' => false,
            'data' => '',
            'msg' => "Image has not been uploaded successfully"
        ];

        if ($validated) {
            $avatar = $this->request->getFile('file');
            $avatar->move(WRITEPATH . 'uploads');

            $data = [

                'name' =>  $avatar->getClientName(),
                'type'  => $avatar->getClientMimeType()
            ];

            $save = $builder->insert($data);
            $response = [
                'success' => true,
                'data' => $save,
                'msg' => "Image has been uploaded successfully"
            ];
        }

        return $this->response->setJSON($response);
    }
}
