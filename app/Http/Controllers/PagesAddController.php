<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use Validator;

class PagesAddController extends Controller
{
    //
    public function execute(Request $request){

    	if($request-> isMethod('post') ){
    		$input = $request->except('_token');  //выводит все поле кроме перечислинных.

    		$message = [
    			'required' => 'Поле :attribute обязательно к заполнению',
    			'unique' =>	'Поле :attribute должно быть уникальным'
    		];

    		$validator = Validator::make($input, [
    			'name' => 'required|max:255',
    			'alias' => 'required|unique:pages|max:255',  /* уникальны в табличке pages */
    			'text' => 'required'
     		], $message);

     		if($validator -> fails()){
     			return redirect() -> route('pagesAdd')-> withErrors($validator) -> withInput(); /* withErrors вытащит ошибки валидации и передаст их. withInput - сохраняет заполненные ранее поля, чтобы пользователь не заполнял их  */
     		}

     		if($request->hasFile('images')){  /* images - поле формы для загрузки файла */
	     		$file = $request-> file('images'); /* объект загруженного изображения. */
	     		$input['images'] = $file->getClientOriginalName(); /* получаем имя файла и записываем его в сооветствующую ячейку */
	     		$file->move(public_path().'/assets/img', $input['images']); /* move - копируем в папку. public_path() - путь до публичой папки, и имя. */

     		}

     		// $page = New Page($input); // можно так
     		
     		// или так
     		$page = New Page();
     		//$page -> unguard();
     		$page -> fill($input); /* метод заполняет поля пустого объекта соответствующими данными. Не забыть разрешить заполняемые поля в модели page */

     		if($page-> save()){ /* сохраняем в бд и проверяем */
     			return redirect('admin') -> with('status', 'Страница добавлена');
     		}
    	}

    	if(view()->exists('admin.pages_add')){
    		$data = [
    			'title' => 'новая страница'
    		];

    		return view('admin.pages_add', $data);
    	}
    	abort(404);
    }
}
