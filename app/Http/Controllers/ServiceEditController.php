<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Service;
use Validator;

class ServiceEditController extends Controller
{
    //Изменение услуги. 
    public function execute(Service $service, Request $request){

        // удаление элемента. С записью статуса в сессию
        if ($request-> isMethod('delete')){
            $service->delete();
            return redirect('admin')-> with('status', 'удалено');
        }

        // Записываем данные в модель
        if($request-> isMethod('post')){

            $input = $request-> except('_token'); 

            // сообщения для валидации   
            $message = [
                'required' => 'Поле :attrebute обязательно к заполнению',
                'max' => 'Поле :attrebute должно иметь не более 255 символов'
            ];        

            // Проверка валидации
            $validator = Validator::make($input, [
                    'name' => 'required|max:255', 
                    'text' =>  'required'
                ], $message);

            if($validator-> fails()){
                return redirect()
                        -> route('servicesEdit',['service' => $input['id']])
                        -> withErrors($validator);
            }

            // проверка наличия загруженной картинки
            if($request->hasFile('icon')){
                $file = $request-> File('icon');
                $file-> move(public_path() . '/assets/img/', $file-> getClientOriginalName());
                $input['icon'] = $file-> getClientOriginalName();
                unset($input['old_icon']);
            } else $input['icon'] = $input['old_icon'];

            // обновление данных
            $service-> fill($input);
            if($service->update()){
                return redirect('admin')-> with('status', 'обновление прошло');
            }
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
