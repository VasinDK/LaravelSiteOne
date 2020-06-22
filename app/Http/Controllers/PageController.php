<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Page;

class PageController extends Controller
{   
    // инициализация страницы
    public function execute($alias){

       /*
         $page - модель элемента страницы объекта бд (строки)
         $data - передаваемые данные в вид
       */
         // проверяем наличие id страницы
    	if(!$alias){
    		abort(404); // генерируем исключение и выбрасываем сответствующую страницу 404 
    	}

        // получаем и выводим стрницу
    	$page = Page::where('alias','=', strip_tags($alias))->first(); //strip_tegs удаляет теги
    	$data = [
    		'title' => $page->name,
    		'page' => $page
    	];
    	if(view()->exists('site.page')){
    		return view('site.page', $data); // туда же передаем массив с данными
    	}
    }
}
