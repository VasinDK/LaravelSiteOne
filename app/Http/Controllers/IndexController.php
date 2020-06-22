<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use App\Service;
use App\Portfolio;
use App\People;
use DB;
use Mail;

class IndexController extends Controller
{
    //
    public function execute(Request $request){

        /*
        $data - данные передаваемые запросом
        $resault - результат отправки сообщения
        $pages - массив страниц
        $services - массив услуг
        $portfolios - массив портфолио
        $peoples - массив людей (команда)
        $tegs - массив тегов для портфолио
        $menu - массив меню
        $item - элемент меню. Его тайтл и алиас для заполнения $menu
        'Name' - поле имя заполняемой формы
        'Email' - поле емаил заполняемой формы
        'Text' - поле текст заполняемой формы
        */

        // отпревка сообщения из футера главной страницы
    	if($request-> isMethod('post')){

    		$messages = [
    			'required'=>'Поле :attribute обязательно к заполнению',
    			'email'=>'Поле :attribute должно соответствовать email адресу',

    		];

            // валидация
    		$this-> validate($request, [
    			'Name' => 'required|max:255',
    			'Email' => 'required|email',
    			'Text' => 'required'
    		], $messages);

    		$data = $request->all();

            // отправка сообщения
    		$resault = Mail::send('site.email',['data' =>$data], function($message) use ($data) {
    			$mail_admin = env('MAIL_ADMIN'); // ? от какого ящика отправлять. Можно указать переменную из файла .env (там мы сами ее прописали)
    			$message-> from($data['Email'], $data['Name']); // адрес отправителя и имя
    			$message-> to($mail_admin)->subject('Question'); // ящик на который отправляется сообщение
    		}); // site.email- шаблон вот вью

    		if($resault){
    			return redirect()->route('home')->with('status', 'Email is send');  /* после редиректа значение status записывается в сессию */
    		}
    	}

        // собираем все страницы, услуги, портфолио, люди, фильтры
    	$pages = Page::all();    
    	$services = Service::where('id','<',20)->get();  // или можно выбрать в соответствии с условием
    	$portfolios = Portfolio::get(['name', 'filter', 'images']); //или можно выбрать конкретные поля из модели
    	$peoples = People::take(3)->get(); // или можно выбрать первых трех. 
    	// и переопределили в моделе People таблицу, с которой работает данная модель.
    	$tegs = DB::table('portfolios')->distinct()->lists('filter'); //distinct - выберает только уникальные значения
    	
        // создаем массив меню
    	$menu = array();
    	foreach($pages as $page){
    		$item = ['title'=>$page-> name, 'alias'=>$page-> alias];
    		array_push($menu, $item);
    	}

    	// дополнительняем меню
    	$item = ['title'=>'Services', 'alias'=>'service'];
    	array_push($menu, $item);
    	$item = ['title'=>'Portfolio', 'alias'=>'Portfolio'];
    	array_push($menu, $item);
    	$item = ['title'=>'Team', 'alias'=>'team'];
    	array_push($menu, $item);
    	$item = ['title'=>'Contact', 'alias'=>'contact'];
    	array_push($menu, $item);
    	
    	   // возвращаем вид и передаем ему параметры
    	return view('site.index',[
    		'menu'=>$menu,
    		'pages'=>$pages,
    		'services'=>$services,
    		'portfolios'=>$portfolios,
    		'peoples'=>$peoples,
    		'tegs' => $tegs
    	]);
    }
}
