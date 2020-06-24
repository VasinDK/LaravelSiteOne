<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Portfolio;

class PortfolioAddController extends Controller
{


        /*
        $portfolios - модель элемента портфолио объекта бд (строки)
        $input - передаваемые в запросе данные кроме строки '_token'
        $validator - объект проведенной валидации
        $file - объект передаваемого реквестом изображения
        $errors - ошибки
        $data - передаваемые данные в вид
        */

    // запускаем страницу создания нового портфолио. В случае отсутствия шаблона возвращаем 404.
    public function execute(Request $request){
    	// добавление страницы
    	if($request-> isMethod('post')){
    		$input = $request-> except('_token');

    	
	    	$message = [
	    		'required' => 'Поле :attribute обязательно к заполнению',
	    		'unique' => 'Поле :attribute повторяется. Дайте ему уникальное имя'
	    	];
            //валидация
	    	$validator = Validator::make($input, [
	    		'name' => 'required|max:255|unique:portfolios',
	    		'filter' => 'required'
	    	], $message);

	    	if($validator-> fails()){
	    		return redirect()-> route('portfoliosAdd')-> withErrors($validator)-> withInput();
	    	}

            //проверка наличия обновления картинки. В отсутствии используется старая картинка
	    	if($request-> hasFile('images')){
	    		$file = $request-> File('images');
	    		$input['images'] = $file -> getClientOriginalName();
	    		$file-> move(public_path() . '/assets/img' . $input['images']);
	    	}

	    	$portfolios = New Portfolio();
	    	$portfolios -> fill($input);
	    	
	    	if($portfolios-> save()){
	    		return redirect('admin')-> with('status', 'страница добавленна'); 
	    	}	

	    } 
        // инициализация страницы добавления
    	if(view()->exists('admin.portfolios_add')){
    		
    		$data = [
    			'title' => 'Новое портфолио'
    		];

    		return view('admin.portfolios_add', $data);

    	} abort(404);
    }
}
