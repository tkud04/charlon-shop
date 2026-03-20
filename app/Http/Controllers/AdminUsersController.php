<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminUsersController extends Controller {

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
				dd($users);
				array_push($c,'users');
			   return view('main.admin.users.admin-users',compact($c));
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

						 return view('main.admin.users.admin-user',compact($c));
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


}