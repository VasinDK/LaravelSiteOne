<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Page;

class PageController extends Controller
{
    //
    public function execute($alias){

    	if(!$alias){
    		abort(404); // генерируем исключение и выбрасываем сответствующую страницу 404 
    	}
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
