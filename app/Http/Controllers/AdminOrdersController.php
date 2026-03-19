<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminOrdersController extends Controller {

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
	public function getOrders()
    {
        $user = null;
		$senders = $this->helpers->getSenders();
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$ads = $this->helpers->getAds(); $c = $this->compactValues;


		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role === "admin" || $user->role === "su")
            {
				$orders = $this->helpers->getOrders();
				dd($orders);
				array_push($c,'orders');
				$sliderData = [
					'popular' => $this->helpers->testProducts,
					'specials' => $this->helpers->testProducts,
					'featured' => $this->helpers->testProducts,
				];
				array_push($c,'sliderData');
			   return view('admin-orders',compact($c));
            }
		}

		return redirect()->intended('/');
       
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
		$senders = $this->helpers->getSenders();
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$ads = $this->helpers->getAds(); $c = $this->compactValues;


		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role === "admin" || $user->role === "su")
            {
				if(isset($req['xf']))
				{
					$o = $this->helpers->getOrder($req['xf']);
				#dd($product);

					if(count($o) > 0)
					{
						array_push($c,'o');
                        $sliderData = [
							'popular' => $this->helpers->testProducts,
							'specials' => $this->helpers->testProducts,
							'featured' => $this->helpers->testProducts,
						];
						array_push($c,'sliderData');
						 return view('admin-order',compact($c));
					}
				}
            }
		}

		return redirect()->intended('/');
       
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postOrder(Request $request)
    {
        $req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

       $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role === "admin" || $user->role === "su")
            {
                

				$validator = Validator::make($req, [
					'xf' => 'required',
					'status' => 'required'
                 ]);

                 if($validator->fails())
                 {
                    $ret['message'] = "validation";
                 }

                 else
                 {
	                 $rr = $this->helpers->updateOrder($req);
					 $ret = ['status' => $rr];
                 }
            }
			else
			{
				$ret['message'] = "auth";
			}
		}
        else
        {
			$ret['message'] = "auth";
        }

		 return json_encode($ret);
    }


}