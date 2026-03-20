<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminSendersController extends Controller {

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
			   return view('main.admin.senders.admin-senders',compact($c));
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
				return view('main.admin.senders.admin-add-sender',compact($c));
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
					return view('main.admin.senders.admin-sender',compact($c));
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
}