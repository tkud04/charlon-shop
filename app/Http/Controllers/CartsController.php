<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon;


class CartsController extends Controller {

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
	public function getCart(Request $request)
    {
       $user = null;
	   $req = $request->all();

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		else
		{
			$u = '/';
			return redirect()->intended($u);
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		$items = $this->helpers->getCartItems($user->id);
		$fee = 0;
		#dd($items);

		array_push($c,'items','fee');
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = $this->helpers->getSliderProducts();
		array_push($c,'sliderData');
	    return view('main.cart.cart',compact($c));	
		
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postAddToCart(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];

			$req = $request->all();
            $validator = Validator::make($req, [
                'xf' => 'required',
                'qty' => 'required|numeric',
            ]);
         
            if($validator->fails())
            {
              $messages = $validator->messages();
              $ret['message'] = "validation";
            }
         
            else
            {
				$cartPayload = [
					'product_slug' => $req['xf'],
					'user_id' => $user->id,
					'qty' => $req['qty'],
				];
               $this->helpers->createCartItem($cartPayload); 
			   $ret = ['status' => "ok"];
		    }
		}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}

		 return json_encode($ret);
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postRemoveFromCart(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		//if($vu['check'])
		//{
			$user = $vu['user'];

			$req = $request->all();
            $validator = Validator::make($req, [
                'xf' => 'required',
            ]);
         
            if($validator->fails())
            {
              $messages = $validator->messages();
              $ret['message'] = "validation";
            }
         
            else
            {
               $this->helpers->removeCartItem($req['xf']); 
			   $ret = ['status' => "ok"];
		    }
		/*}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}*/

		 return json_encode($ret);
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCheckout(Request $request)
    {
       $user = null;
	   $req = $request->all();

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		else
		{
			$u = '/';
			return redirect()->intended($u);
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$pmodes = $this->helpers->paymentModes;
		$shippingInfo = $this->helpers->getShippingDetails($user->id);

		$items = $this->helpers->getCartItems($user->id);
		$fee = 0;
		#dd($items);
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = $this->helpers->getSliderProducts();
		array_push($c,'sliderData');
		array_push($c,'items','fee','pmodes','shippingInfo');
	    return view('main.cart.checkout',compact($c));	
		
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postCheckout(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		//if($vu['check'])
		//{
			$user = $vu['user'];

			$req = $request->all();
            $validator = Validator::make($req, [
                'pmode' => 'required',
            ]);
         
            if($validator->fails())
            {
              $messages = $validator->messages();
              $ret['message'] = "validation";
            }
         
            else
            {
               $ret = $this->helpers->checkout($req); 

			   if($ret !== 'error')
			   {
				$ret = ['status' => "ok",'xf' => $ret];
			   }
			   else
			   {
                 $ret['message'] = 'failed';
			   }
			  
		    }
		/*}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}*/

		 return json_encode($ret);
    }


}