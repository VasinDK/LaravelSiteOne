<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Service;

class ServiceAddController extends Controller
{   
    /*
    $input - принетмает данные запроса 
    $data - передаваемые данные
    $file - переменная для операций с изображением
    */
    // добавление услуги
    public function execute(Request $request){

        if($request-> isMethod('POST')){
            $input = $request-> except('_token');

            // валидация
            $message = [
                'required' => 'Поле :attribute обязательно для заполнения',
                'unique' => 'Поле :attribute должно быть уникальным'
            ];

            $validate = Validator::make($input, [
                'name' => 'required|max:255|unique:services',
                'text' => 'required'
            ], $message);

            if($validate-> fails()){
                return redirect()->route('servicesAdd')
                                -> withErrors($validate)
                                -> withInput();
            }

            if($request-> hasFile('images')){
                $file = $request-> File('images');
                $input['images'] = $file-> getClientOriginalName();
                $file->move(public_path() . '/assets/img' . $input['images']);
            }

            $service = New Service();
            $service-> fill($input);

            if($service-> save()){
                return redirect('admin')->with('status', 'Добавлена услуга');
            }
        }

        // инициализация страницы добавления услуги
        if(view()->exists('admin.services_add')){
            $data = [
                'title' => 'Добавление новой услуги'
            ];
            return view('admin.services_add', $data);
        } abort(404);
    }
}
