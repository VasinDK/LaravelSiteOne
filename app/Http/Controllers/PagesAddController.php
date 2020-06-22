<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use Validator;

class PagesAddController extends Controller
{
        /*
        $page - модель элемента страницы объекта бд (строки)
        $input - передаваемые в запросе данные кроме строки '_token'
        $validator - объект проведенной валидации
        $file - объект передаваемого реквестом изображения
        $data - передаваемые данные в вид 'admin.pages_edit'
        $errors - ошибки
        'images' - поле формы для загрузки файла
        'admin' - страница админки
        */

    public function execute(Request $request){

        // добавление страницы
    	if($request-> isMethod('post') ){
    		$input = $request->except('_token');  //выводит все поле кроме перечислинных.

    		$message = [
    			'required' => 'Поле :attribute обязательно к заполнению',
    			'unique' =>	'Поле :attribute должно быть уникальным'
    		];

            // валидация 
    		$validator = Validator::make($input, [
    			'name' => 'required|max:255',
    			'alias' => 'required|unique:pages|max:255',  /* уникальны в табличке pages */
    			'text' => 'required'
     		], $message);

     		if($validator -> fails()){
     			return redirect() -> route('pagesAdd')-> withErrors($validator) -> withInput(); /* withErrors вытащит ошибки валидации и передаст их. withInput - сохраняет заполненные ранее поля, чтобы пользователь не заполнял их  */
     		}

            // проверка наличия обновления картинки. В отсутствии используется старая картинка  
     		if($request->hasFile('images')){  
	     		$file = $request-> file('images');
	     		$input['images'] = $file->getClientOriginalName(); 
	     		$file->move(public_path().'/assets/img', $input['images']); /* move - копируем в папку. public_path() - путь до публичой папки, и имя. */

     		}

     		// $page = New Page($input); // можно так
     		
     		// или так
     		$page = New Page();
     		//$page -> unguard();

            // заполняем поля строки в бд данным
     		$page -> fill($input); /* метод заполняет поля пустого объекта соответствующими данными. Не забыть разрешить заполняемые поля в модели page */

            // сохраняем запись в бд
     		if($page-> save()){ /* сохраняем в бд и проверяем */
     			return redirect('admin') -> with('status', 'Страница добавлена');
     		}
    	}

        // инициируем страницу добавления материала
    	if(view()->exists('admin.pages_add')){
    		$data = [
    			'title' => 'новая страница'
    		];

    		return view('admin.pages_add', $data);
    	}
    	abort(404);
    }
}
