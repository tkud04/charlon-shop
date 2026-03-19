<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminPluginsController extends Controller {

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


}