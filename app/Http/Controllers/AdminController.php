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
			   return view('main.admin.dashboard.admin-dashboard',compact($c));
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


/*************************************************************************************** */


	
	
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