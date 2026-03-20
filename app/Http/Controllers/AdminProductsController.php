<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminProductsController extends Controller {

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
	public function getProducts()
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
				$products = $this->helpers->getProducts();
				//dd($products);
				array_push($c,'products');
				$sliderData = [
					'popular' => $this->helpers->testProducts,
					'specials' => $this->helpers->testProducts,
					'featured' => $this->helpers->testProducts,
				];
				array_push($c,'sliderData');
			   return view('main.admin.products.admin-products',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddProduct()
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
				$categories = $this->helpers->getCategories();
				$statuses = $this->helpers->productStatuses;

				array_push($c,'statuses','categories');
				$sliderData = [
					'popular' => $this->helpers->testProducts,
					'specials' => $this->helpers->testProducts,
					'featured' => $this->helpers->testProducts,
				];
				array_push($c,'sliderData');
				return view('main.admin.products.admin-add-product',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddProduct(Request $request)
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
					'slug' => 'required',
					'category' => 'required',
					'title' => 'required',
					'image' => 'required',
					'price' => 'required|numeric',
					'status' => 'required'
                 ]);

                 if($validator->fails())
                 {
                    $ret['message'] = "validation";
                 }

                 else
                 {
					$req['thumb'] = '';
					$req['description'] = '';
	                $temp = $this->helpers->createProduct($req);
	                $rr = isset($temp) ? 'ok' : 'error';
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

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getProduct(Request $request)
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
					$product = $this->helpers->getProduct($req['xf']);
				#dd($product);

					if(count($product) > 0)
					{
						$statuses = $this->helpers->productStatuses;
						$categories = $this->helpers->getCategories();
						array_push($c,'product','statuses','categories');
						$sliderData = [
							'popular' => $this->helpers->testProducts,
							'specials' => $this->helpers->testProducts,
							'featured' => $this->helpers->testProducts,
						];
						array_push($c,'sliderData');

						 return view('main.admin.products.admin-product',compact($c));
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
    public function postProduct(Request $request)
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
					'category' => 'required',
					'title' => 'required',
					'image' => 'required',
					'price' => '|numeric',
					'status' => 'required'
                 ]);

                 if($validator->fails())
                 {
                    $ret['message'] = "validation";
                 }

                 else
                 {
	                 $rr = $this->helpers->updateProduct($req);
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


	


	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function postRemoveProduct(Request $request)
    {
		$user = null;
		$ret = ['status' => 'error','message' => "nothing happened"];

	   $req = $request->all();

	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
		   if($user->role === "admin" || $user->role === "su")
		   {
			  if(isset($req['xf']))
			  {
				$p = $this->helpers->getProduct($req['xf']);
	
				if(count($p) > 0)
				{
					$this->helpers->removeProduct($req['xf']);
					$ret = ['status' => "ok"];
				}
			  }
			  else
			  {
				$ret['message'] = "validation";
			  }
		   }
	   }
	   else
	   {
		 $ret['message'] = "auth";
	   }

	   return json_encode(($ret));
    }

}