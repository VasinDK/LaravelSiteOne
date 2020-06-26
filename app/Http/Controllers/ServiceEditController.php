<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service;
use App\Validator;

class ServiceEditController extends Controller
{
    //Изменение услуги
    public function execute(Service $service, Request $request){

        // Записываем данные в модель
        if($request-> isMethod('post')){

            $input = $request-> except('_token');    
            $message = [
                'required' => 'Поле :attrebute обязательно к заполнению',
                'max' => 'Поле :attrebute должно иметь не более 255 символов'
            ];        

            $validator = Validator::make($input, [
                    'name' => 'required|max:255', 
                    'text' =>  'required'
                ], $message;

            if($validator-> fails){
                return redirect('')
            }
            $service = 0;
        }

        // Получаем данные из БД
        $old = $service-> toArray();
        $data = [
            'title' => 'Редактирование услуги ' . $old['name'],
            'data' => $old
        ];
        if(view()->exists('admin.services_edit')){
            return view('admin.services_edit', $data);
        }

        // Выводим их в вид

        // Делаем апдате

    }
}
