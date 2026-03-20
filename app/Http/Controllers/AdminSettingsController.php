<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminSettingsController extends Controller {

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
			   return view('main.admin.settings.admin-settings',compact($c));
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
				return view('main.admin.settings.admin-add-setting',compact($c));
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
						 return view('main.admin.settings.admin-setting',compact($c));
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


}