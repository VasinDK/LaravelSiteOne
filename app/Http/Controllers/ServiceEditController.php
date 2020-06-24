<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service;

class ServiceEditController extends Controller
{
    //Изменение услуги
    public function execute(Service $service, Request $request){
        // Получаем данные из БД
        $old = $service-> toArray();
        $data = [
            'title' => 'Редактирование услуги ' . $old['name'],
            'old' => $old
        ];
        if(view()->exist('admin.services_edit')){
            return view('admin.services_edit', $data);
        }

        // Выводим их в вид

        // Делаем апдате

    }
}
