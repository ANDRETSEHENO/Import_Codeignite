<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;

class ImportController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function upload()
    {
        $model = new \App\Models\UserModel();
      $file = $this->request->getFile('csv_file');
$handle = fopen($file->getTempName(), 'r');
$headers = fgetcsv($handle, 0, ';');
while (($row = fgetcsv($handle, 0, ';')) !== false) {
$data = array_combine($headers, $row);
$model->insert($data);
}
fclose($handle);
    return redirect()->back()->with('success', 'Fichier importé avec succès.');
    }

}