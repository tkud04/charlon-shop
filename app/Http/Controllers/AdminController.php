<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminController extends Controller {

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
	public function getDashboard()
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
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
				$sliderData = [
					'popular' => $this->helpers->testProducts,
					'specials' => $this->helpers->testProducts,
					'featured' => $this->helpers->testProducts,
				];
				$users = $this->helpers->getUsers();
				$products = [];//$this->helpers->getProducts();
				$orders = [];//$this->helpers->getOrders();
				$refunds = [];//$this->helpers->getRefunds();
				array_push($c,'sliderData','products','orders','refunds','users');
			   return view('admin-dashboard',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postGetSignupLink(Request $request)
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
					'xf' => 'required|email',
                 ]);

                 if($validator->fails())
                 {
                    $ret['message'] = "validation";
                 }

                 else
                 {
	                 $temp = $this->helpers->getMemberRequest($req['xf']);
					 if(count($temp) > 0)
					 {
                        $ret = ['status' => 'ok', 'data' => url('complete-registration')."?xf=".$temp['code']];
					 }
					 else
					 {
						$ret['message'] = "invalid-member-request";
					 }
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
	public function getSiteMessages()
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
				$data = $this->helpers->getSiteMessages();
				#dd($purchases);
				array_push($c,'data');
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
				$sliderData = [
					'popular' => $this->helpers->testProducts,
					'specials' => $this->helpers->testProducts,
					'featured' => $this->helpers->testProducts,
				];
				array_push($c,'sliderData');
			   return view('admin-site-messages',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postRemoveSiteMessage(Request $request)
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
					'xf' => 'required|numeric',
                 ]);

                 if($validator->fails())
                 {
                    $ret['message'] = "validation";
                 }

                 else
                 {
					
	                 $temp = $this->helpers->getSiteMessage($req['xf']);
					 
					 if(count($temp) > 0)
					 {
						$this->helpers->removeSiteMessage($req['xf']);
                        $ret = ['status' => 'ok'];
					 }
					 

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



/*----------------------*/


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCategories()
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
				//dd($categories);
				array_push($c,'categories');
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
				$sliderData = [
					'popular' => $this->helpers->testProducts,
					'specials' => $this->helpers->testProducts,
					'featured' => $this->helpers->testProducts,
				];
				array_push($c,'sliderData');
			   return view('admin-categories',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddCategory()
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
				
                $sliderData = [
					'popular' => $this->helpers->testProducts,
					'specials' => $this->helpers->testProducts,
					'featured' => $this->helpers->testProducts,
				];
				array_push($c,'sliderData');
				return view('admin-add-product-category',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddCategory(Request $request)
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
					'title' => 'required',
					'pf' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:204800' //max 200mb
                 ]);

                 if($validator->fails())
                 {
                    $ret['message'] = "validation";
					$ret['req'] = $req;
                 }

                 else
                 {
					$pic = $this->helpers->cloudinaryUploadImage($request->file('pf'));
					$categoryPayload = [
						'title' => $req['title'],
						'slug' => $req['slug'],
						'img' => $pic
					];
	                 $temp = $this->helpers->createCategory($categoryPayload);
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
	public function getCategory(Request $request)
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
					$category = $this->helpers->getCategory($req['xf']);

					if(count($category) > 0)
					{
						array_push($c,'category');
						$sliderData = [
							'popular' => $this->helpers->testProducts,
							'specials' => $this->helpers->testProducts,
							'featured' => $this->helpers->testProducts,
						];
						array_push($c,'sliderData');
						 return view('admin-product-category',compact($c));
					}
				}
            }
		}

		return redirect()->intended('/');
       
    }



	


	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function postRemoveCategory(Request $request)
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
				$p = $this->helpers->getCategory($req['xf']);
	
				if(count($p) > 0)
				{
					$this->helpers->cloudinaryRemoveImage($p['img']);
					$this->helpers->removeCategory($req['xf']);
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
			   return view('admin-products',compact($c));
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
				return view('admin-add-product',compact($c));
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

						 return view('admin-product',compact($c));
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

	


/*************************************************************************************** */


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getUsers()
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
				$users = $this->helpers->getUsers();
				array_push($c,'users');
			   return view('admin-users',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getUser(Request $request)
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
					$u = $this->helpers->getUser($req['xf']);

					if(count($u) > 0)
					{
						$purchases = $this->helpers->getPurchases('purchases',$u['id']);
						#dd($purchases);
						array_push($c,'u','purchases');

						 return view('admin-user',compact($c));
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
    public function postUser(Request $request)
    {
        $req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

       $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role !== "admin" || $user->role !== "su")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }


		$validator = Validator::make($req, [
			                 'xf' => 'required',
                             'op' => 'required',
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
			 
			 $u = $this->helpers->getUser($req['xf']);
             
             if(count($u) > 0)
			 {
				$dt = [
					'email' => $u['email'],
				];

				if($req['op'] === 'kyc')
			    {
                   $dt['complete_signup'] = "yes";
			    }
			    else
			    {
                    $dt['status'] = $req['op'] === 'enable' ? 'ok' : 'disabled';
					   
			    }
			  $this->helpers->updateUser($dt);
			 }
             
			 
			 $ret = ['status' => 'ok'];
         }

		 return json_encode($ret);
    }


	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getRemoveUser(Request $request)
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
				$p = $this->helpers->getUser($req['xf']);
	
				if(count($p) > 0)
				{
					$this->helpers->removeUser($req['xf']);
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

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSettings()
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
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
				$settings = $this->helpers->getSettings();
				array_push($c,'settings');
			   return view('admin-settings',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddSetting()
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
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
				return view('admin-add-setting',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddSetting(Request $request)
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
					'name' => 'required',
					'value' => 'required',
                ]);

                if($validator->fails())
                {
                  $ret['message'] = "validation";
                }

                else
                {
                	$req['status'] = "ok";
                	$this->helpers->createSetting($req);
	
                	$ret = ['status' => 'ok'];
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
	public function getSetting(Request $request)
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
					$setting = $this->helpers->getSetting($req['xf']);

					if(count($setting) > 0)
					{
						$contactDetails = $this->helpers->contactDetails;
						array_push($c,'contactDetails');
						array_push($c,'setting');
						 return view('admin-setting',compact($c));
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
    public function postSetting(Request $request)
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
					'xf' => 'required|numeric',
					'name' => 'required',
					'value' => 'required',
                ]);

                if($validator->fails())
                {
                   $ret['message'] = "validation";
                }

                else
                {
                	$req['id'] = "active";
	                $ret = $this->helpers->updateSetting($req);
	
	                $ret = ['status' => 'ok'];
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
	public function postRemoveSetting(Request $request)
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
				$p = $this->helpers->getSetting($req['xf']);
	
				if(count($p) > 0)
				{
					$this->helpers->removeSetting($req['xf']);
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

	

   
	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPlugins()
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
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
			   return view('admin-plugins',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAddPlugin(Request $request)
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
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
				return view('admin-add-plugin',compact($c));
            }
		}

		return redirect()->intended('/');

    	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddPlugin(Request $request)
    {
        $req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

       $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role !== "admin" || $user->role !== "su")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
		
		$validator = Validator::make($req, [
                             'name' => 'required',
                             'value' => 'required',
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
			 $req['status'] = "ok";
             $ret = $this->helpers->createPlugin($req);
			 
			 $ret = ['status' => 'ok'];
         }

		 return json_encode($ret);
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getPlugin(Request $request)
    {
       $user = null;
	   $senders = $this->helpers->getSenders();
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$ads = $this->helpers->getAds(); $c = $this->compactValues;

	   $req = $request->all();

	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
		   if($user->role === "admin" || $user->role === "su")
		   {
			  if(isset($req['xf']))
			  {
				$p = $this->helpers->getPlugin($req['xf']);
				 
				if(count($p) > 0)
				{
					$contactDetails = $this->helpers->contactDetails;
					array_push($c,'contactDetails');
					array_push($c,'p');
					return view('admin-plugin',compact($c));
				}
			  }
		   }
	   }

		
		else
		{
			session()->flash("plugin-status","error");
			return redirect()->intended('plugins');
		}

		return redirect()->intended('plugins');

    	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postPlugin(Request $request)
    {
		$req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

       $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role !== "admin" || $user->role !== "su")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
			                 'id' => 'required',
                             'status' => 'required'
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
             $this->helpers->updatePlugin($req);
			 $ret = ['status' => "ok"];
         } 	
		 return json_encode(($ret)); 
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function postRemovePlugin(Request $request)
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
				$p = $this->helpers->getPlugin($req['xf']);
	
				if(count($p) > 0)
				{
					$this->helpers->removePlugin($req['xf']);
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

	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSenders()
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
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
			   return view('admin-senders',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAddSender(Request $request)
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
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
				return view('admin-add-sender',compact($c));
            }
		}

		return redirect()->intended('/');

    	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddSender(Request $request)
    {
        $req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

       $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role !== "admin" || $user->role !== "su")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
		
		$validator = Validator::make($req, [
			'ss' => "required",
			'sp' => "required|numeric",
			'sec' => "required",
			'sa' => "required",
			'su' => "required",
			'spp' => "required",
			'sn' => "required",
			'se' => "required|email"
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
			 $req['status'] = "ok";
			 $req['current'] = "no";
			 $req['type'] = '';
             $ret = $this->helpers->createSender($req);
			 
			 $ret = ['status' => 'ok'];
         }

		 return json_encode($ret);
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getSender(Request $request)
    {
       $user = null;
	   $senders = $this->helpers->getSenders();
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$ads = $this->helpers->getAds(); $c = $this->compactValues;

	   $req = $request->all();

	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
		   if($user->role === "admin" || $user->role === "su")
		   {
			if(isset($req['xf']))
			{
				$s = $this->helpers->getSender($req['xf']);
	
				  if(count($s) > 0)
				  {
					$contactDetails = $this->helpers->contactDetails;
					array_push($c,'contactDetails');
					array_push($c,'s');
					return view('admin-sender',compact($c));
				  }
			}
		   }
	   }
	   else
	   {
		   return redirect()->intended('/');
	   }

	   return redirect()->intended('/');
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postSender(Request $request)
    {
		$req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

       $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role !== "admin" || $user->role !== "su")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
			                 'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
			if(isset($req['cr']) && $req['cr'] === 'u')
			{
                $this->helpers->clearCurrentSender();
			    $req['current'] = 'yes';
			}
             $this->helpers->updateSender($req);
			 $ret = ['status' => "ok"];
         } 	
		 return json_encode(($ret)); 
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function postRemoveSender(Request $request)
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
				$p = $this->helpers->getSender($req['xf']);
	
				if(count($p) > 0)
				{
					$this->helpers->removeSender($req['xf']);
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
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAds()
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
            if( $user->role === "su")
            {
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
				$ads = $this->helpers->getAds();
				array_push($c,'ads');
			   return view('admin-ads',compact($c));
            }
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAddAd(Request $request)
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
			
			if($user->role === "su")
            {
				$contactDetails = $this->helpers->contactDetails;
                array_push($c,'contactDetails');
				return view('admin-add-ad',compact($c));
            }
		}

		return redirect()->intended('/');

    	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddAd(Request $request)
    {
        $req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

       $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role !== "su")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
		
		$validator = Validator::make($req, [
                             'name' => 'required',
                             'image' => 'required',
                             'value' => 'required',
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
			 $req['status'] = "ok";
             $ret = $this->helpers->createAd($req);
			 
			 $ret = ['status' => 'ok'];
         }

		 return json_encode($ret);
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAd(Request $request)
    {
       $user = null;
	   $senders = $this->helpers->getSenders();
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$ads = $this->helpers->getAds(); $c = $this->compactValues;

	   $req = $request->all();

	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
		   if( $user->role !== "su")
		   {
			   return redirect()->intended('/');
		   }
	   }
	   else
	   {
		   return redirect()->intended('/');
	   }

		if(isset($req['xf']))
		{
			$a = $this->helpers->getAd($req['xf']);

			if(count($a) < 1)
			{
				session()->flash("ad-status","error");
			    return redirect()->intended('ads');
			}
		}
		else
		{
			session()->flash("ad-status","error");
			return redirect()->intended('ads');
		}

    	return view('admin-edit-ad',compact(['user','signals','a']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAd(Request $request)
    {
		$req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

       $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role !== "admin" || $user->role !== "su")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
			                 'id' => 'required',
                             'status' => 'required'
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
             $this->helpers->updateAd($req);
			 $ret = ['status' => "ok"];
         } 	
		 return json_encode(($ret)); 
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function postRemoveAd(Request $request)
    {
		$user = null;
		$ret = ['status' => 'error','message' => "nothing happened"];

	   $req = $request->all();


	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
		   if($user->role === "su")
		   {
			  if(isset($req['xf']))
			  {
				$a = $this->helpers->getAd($req['xf']);
	
				if(count($a) > 0)
				{
					$this->helpers->removeAd($req['xf']);
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

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBanners()
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
            if( $user->role === "su")
            {
				$banners = $this->helpers->getBanners();
			    array_push($c,'banners');
			   return view('admin-banners',compact($c));
            }

			
		}

		return redirect()->intended('/');
       
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAddBanner(Request $request)
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
			
			if($user->role === "su")
            {
				return view('admin-add-banner',compact($c));
            }
		}

		return redirect()->intended('/');

    	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddBanner(Request $request)
    {
        $req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

       $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role !== "su")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
		
		$validator = Validator::make($req, [
                             'title' => 'required',
                             'subtitle' => 'required',
                             'points' => 'required',
                             'image' => 'required',
                             'description' => 'required',
                             'btn_url_1' => 'required',
                             'btn_text_1' => 'required',
                             'btn_url_2' => 'required',
                             'btn_text_2' => 'required',
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
			 $req['status'] = "ok";
             $ret = $this->helpers->createBanner($req);
			 
			 $ret = ['status' => 'ok'];
         }

		 return json_encode($ret);
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getBanner(Request $request)
    {
       $user = null;
	   $senders = $this->helpers->getSenders();
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins(['mode' => "all"]);
		$ads = $this->helpers->getAds(); $c = $this->compactValues;

	   $req = $request->all();

	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
		   if( $user->role !== "su")
		   {
			   return redirect()->intended('/');
		   }
	   }
	   else
	   {
		   return redirect()->intended('/');
	   }

		if(isset($req['xf']))
		{
			$a = $this->helpers->getBanner($req['xf']);

			if(count($a) < 1)
			{
				session()->flash("banner-status","error");
			    return redirect()->intended('banners');
			}
		}
		else
		{
			session()->flash("banner-status","error");
			return redirect()->intended('banners');
		}

    	return view('admin-edit-banner',compact(['user','signals','a']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postBanner(Request $request)
    {
		$req = $request->all();
		$ret = ['status' => 'error','message' => "nothing happened"];

       $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
            if($user->role !== "admin" || $user->role !== "su")
            {
                $ret['message'] = "auth";
            }
		}
        else
        {
			$ret['message'] = "auth";
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
			                 'id' => 'required',
                             'status' => 'required'
         ]);
         
         if($validator->fails())
         {
			$ret['message'] = "validation";
         }
         
         else
         {
             $this->helpers->updateBanner($req);
			 $ret = ['status' => "ok"];
         } 	
		 return json_encode(($ret)); 
    }

	/**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getRemoveBanner(Request $request)
    {
		$user = null;
		$ret = ['status' => 'error','message' => "nothing happened"];

	   $req = $request->all();


	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];	
		   if($user->role === "su")
		   {
			  if(isset($req['xf']))
			  {
				$a = $this->helpers->getBanner($req['xf']);
	
				if(count($a) > 0)
				{
					$this->helpers->removeBanner($req['xf']);
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
	
/*************************************************************************************** */
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getZoho()
    {
        $ret = "1535561942737";
    	return $ret;
    }
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPractice()
    {
		$url = "http://www.kloudtransact.com/cobra-deals";
	    $msg = "<h2 style='color: green;'>A new deal has been uploaded!</h2><p>Name: <b>My deal</b></p><br><p>Uploaded by: <b>A Store owner</b></p><br><p>Visit $url for more details.</><br><br><small>KloudTransact Admin</small>";
		$dt = [
		   'sn' => "Tee",
		   'em' => "kudayisitobi@gmail.com",
		   'sa' => "KloudTransact",
		   'subject' => "A new deal was just uploaded. (read this)",
		   'message' => $msg,
		];
    	return $this->helpers->bomb($dt);
    }   


}