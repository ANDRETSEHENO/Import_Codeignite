<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ImportController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function upload() //sans validation inserte normal 
    {
        $model = new UserModel();
        $file = $this->request->getFile('csv_file');
        $handle = fopen($file->getTempName(), 'r');
        $headers = fgetcsv($handle, 0, ';');
        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            $data = array_combine($headers, $row);
            $model->insert($data);
        }
        return redirect()->back()->with('success', 'Fichier importé avec succès.');
    }
}