<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminBannersController extends Controller {

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
}