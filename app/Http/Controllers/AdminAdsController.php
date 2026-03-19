<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminAdsController extends Controller {

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

}