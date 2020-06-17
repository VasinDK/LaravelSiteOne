<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PortfolioAddController extends Controller
{

	
	
    //
    public function execute(){
    	
    	if(view()->exists('admin.portfolios_add')){
    		
    		$data = [
    			'title' => 'Новое портфолио'
    		];

    		return view('admin.portfolios_add', $data);

    	} abort(404);
    }
}
