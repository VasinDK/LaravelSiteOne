<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service;

class ServiceController extends Controller
{
    /*
    $services - все услуги
    $data - передаваемые значения
    */

    //вывод всех услуг
    public function execute(){
        if(view()-> exists('admin.services')){
           $services = Service::all();
           $data = [
                'title' => 'Услуги',
                'services' => $services
           ];
           return view('admin.services', $data);
        } abort(404);
    }
}
