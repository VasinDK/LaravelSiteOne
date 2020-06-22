<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Portfolio;

class PortfolioController extends Controller
{
    //
    /*
    $portfolios - список портфолио
    $data - передаваемые данные в вид
    */
    public function execute(){

        // вывод списка портфолио 
    	if(view()->exists('admin.portfolios')){

    		$portfolios = Portfolio::all();
    		$data = [
    			'title' => 'Портфолио',
    			'portfolios' => $portfolios
    		];

    		return view('admin.portfolios', $data);
    	} abort(404, 'ошибка 404 нет такой страницы');
    }
}
