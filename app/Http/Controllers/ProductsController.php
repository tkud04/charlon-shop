<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon;


class ProductsController extends Controller {

	protected $helpers; //Helpers implementation
	protected $compactValues;
    
    public function __construct(Helper $h)
    {
    	$this->helpers = $h;      
		$this->compactValues = ['user','plugins','senders','signals','ads'];         
    }

	

	/**
	 * Show the application contact view to the user.
	 *
	 * @return Response
	 */
	public function getProduct(Request $request)
    {
        $user = null;
	   $vu = $this->helpers->getValidUser();
	   $req = $request->all();

		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		if(isset($req['xf']))
		{
            $product = $this->helpers->getProduct($req['xf']);
            //dd($product);

			if(count($product) > 0)
			{ 

				$hl = $user === null ? "false" : $this->helpers->hasLikedProduct([
					'slug' => $product['slug'],
					'user_id' => $user->id
				]);
	
				$contactDetails = $this->helpers->contactDetails;
				array_push($c,'contactDetails','product','hl');
		    $sliderData = $this->helpers->getSliderProducts();
		    array_push($c,'sliderData');
		
    	    return view('main.products.product',compact($c));
			}
			else
			{
				return redirect()->intended('categories');
			}
		    
		}
		else
		{
			return redirect()->intended('categories');
		}
		
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postLikeProduct(Request $request)
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
            ]);
         
            if($validator->fails())
            {
              $messages = $validator->messages();
              $ret['message'] = "validation";
            }
         
            else
            {
				$p = $this->helpers->getProduct($req['xf']);

				if(count($p) > 0)
				{
                    $payload = [
					    'product_slug' => $req['xf'],
					    'user_id' => $user->id
				    ];
                     $this->helpers->createProductLike($payload); 
			         $ret = ['status' => "ok"];
				}
				else
				{
					$ret = ['status' => 'error','message' => "invalid-product",'p' => $p];
				}
				
		    }
		}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}

		 return json_encode($ret);
    }



}