<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon;


class OrdersController extends Controller {

	protected $helpers; //Helpers implementation
	protected $compactValues;
    
    public function __construct(Helper $h)
    {
    	$this->helpers = $h;      
		$this->compactValues = ['user','plugins','senders','signals','ads'];         
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getOrder(Request $request)
    {
       $user = null;
	   $req = $request->all();

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		/*else
		{
			$u = '/';
			return redirect()->intended($u);
		}*/

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		if(isset($req['xf']))
         {
			
		    $o = $this->helpers->getOrder($req['xf']);

			if(count($o) > 0)
			{
			 array_push($c,'o');
			 dd($o);
			 $contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');
	           return view('main.orders.order',compact($c));	
			}
			else
			{
				return redirect()->intended('/');
			}

           
         }
		 else
		 {
			 return redirect()->intended('/');
		 }

		
    }


}