<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon;


class MainController extends Controller {

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
	public function getIndex()
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

			$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		$faqs = []; //$this->helpers->getFaqs();
		$addressSetting = $this->helpers->getSetting('address');
		$emailSetting = $this->helpers->getSetting('email');

		$contactDetails = $this->helpers->contactDetails;

		array_push($c,'faqs','contactDetails');

		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');

        return view('index',compact($c));
       // return view('temp',compact($c));
		
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDashboard()
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		else{
			return redirect()->intended('/');
		}

		
dd($user);
		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$userInfo = $this->helpers->getUser($user->email);
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
	


		$activeClass = "dashboard";
		$contactDetails = $this->helpers->contactDetails;
		array_push($c,'activeClass','userInfo','upcomingEvents','contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');
	    return view('dashboard',compact($c));	
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getProfile()
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		else{
			return redirect()->intended('/');
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');

		$activeClass = "profile";
		$profile = $this->helpers->getUser($user->email);
		$contactDetails = $this->helpers->contactDetails;

		array_push($c,'activeClass','profile','contactDetails');

           return view('profile',compact($c));	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getChangePassword()
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		else{
			return redirect()->intended('/');
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');

		return view('set-password',compact($c));	

		
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postUploadAvatar(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];

			$req = $request->all();
            $validator = Validator::make($req, [
                'pf' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:204800' //max 200mb
            ]);
         
            if($validator->fails())
            {
              $messages = $validator->messages();
              $ret['message'] = "file-validation";
            }
         
            else
            {
			  //If there was a previous avatar, delete it
			  $previousAvatar = $this->helpers->getCloudinaryImageFromUrl($user->avatar);

			  if(strlen($previousAvatar) > 0)
			  {
				$this->helpers->cloudinaryRemoveImage($previousAvatar);
			  }

              $avatar = $this->helpers->cloudinaryUploadImage($request->file('pf'));

               $userPayload = [
				'email' => $user->email,
                'avatar' => $avatar
               ];       

               $this->helpers->updateUser($userPayload); 
			   $ret = ['status' => "ok",'data' => $avatar];
		    }
		}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}

		 return json_encode($ret);
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postChangePassword(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];

			$req = $request->all();
            $validator = Validator::make($req, [
                'password' => 'required|min:6|confirmed',
            ]);
         
            if($validator->fails())
            {
              $messages = $validator->messages();
              $ret['message'] = "validation";
            }
         
            else
            {
               $userPayload = [
                'email' => $user->email,
                'password' => bcrypt($req['password']),
                'complete_signup' => "yes",
               ];       

               $this->helpers->updateUser($userPayload); 
			   $ret = ['status' => "ok"];
		    }
		}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}

		 return json_encode($ret);
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeleteAccount()
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		else{
			return redirect()->intended('/');
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');

		return view('delete-accounts',compact($c));	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postDeleteAccount(Request $request)
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];

			$req = $request->all();

		    $ret = ['status' => 'error', 'data' => $req,'message' => "nothing happened"];
            #dd($req);
        
             $validator = Validator::make($req, [
                             'p' => 'required',
             ]);
         
             if($validator->fails())
             {
              $ret['message'] = "validation";
             }
         
             else
             {

            $passwordCorrect = $this->helpers->isValidPassword($data=['user_id' => $user->id,'password' => $req['p']]);
			 if($passwordCorrect)
			 {
		       $this->helpers->deleteAccount($data['user_id']);

               $ret = ['status' => "ok"];
			 }
			 else
			 {
				$ret['error'] = 'auth';
			 }
			  
		    }
		}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}

		 return json_encode($ret);
    }


	

	
	 /**
	 * Show the application contact view to the user.
	 *
	 * @return Response
	 */
	public function getContact(Request $request)
    {
        $user = null;
	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');

		$addressSetting = $this->helpers->getSetting('address');
		$emailSetting = $this->helpers->getSetting('email');
		$phoneSetting = $this->helpers->getSetting('phone');
		/*
		$contactInfo = [
			'address' => $addressSetting['value'],
			'email' => $emailSetting['value'],
			'phone' => $phoneSetting['value'],
		];
		*/

		$contactInfo = [
			'address' => 'Test Address, Lagos ',
			'email' => 'info@ukporunique.com',
			'phone' =>'08012345678',
		];

		$admins = [
			[
				'name' => "Abuchi Nwosu",
				'phone' => "08012345678",
				'email' => "abuchinwosu@ukporunique.com",
			],
			[
				'name' => "Emeka Sunday Anene",
				'phone' => "08012345678",
				'email' => "sundayanene@ukporunique.com",
			],
			[
				'name' => "Geofrey Obuna",
				'phone' => "08012345678",
				'email' => "geofreyobuna@ukporunique.com",
			],
		];

		array_push($c,'contactInfo','admins');
		
    	return view('contact',compact($c));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postContact(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		//if($vu['check'])
		//{
			$user = $vu['user'];

			$req = $request->all();
            $validator = Validator::make($req, [
                'name' => 'required',
                'email' => 'required|email',
                'body' => 'required',
                'subject' => 'required',
            ]);
         
            if($validator->fails())
            {
              $messages = $validator->messages();
              $ret['message'] = "validation";
            }
         
            else
            {
				if(!isset($req['email'])) $req['email'] = '';
               $this->helpers->createSiteMessage($req); 
			   //TODO: send email to admin
			   $ret = ['status' => "ok"];
		    }
		/*}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}*/

		 return json_encode($ret);
    }


	/**
	 * Show the application contact view to the user.
	 *
	 * @return Response
	 */
	public function getAddSmtp(Request $request)
    {
        $user = null;
	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		
    	return view('add-smtp',compact($c));
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postAddSmtp(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		//if($vu['check'])
		//{
			$user = $vu['user'];
			$req = $request->all();

            $validator = Validator::make($req, [
				'ss' => "required",
				'sp' => "required|numeric",
				'sec' => "required",
				'sa' => "required",
				'su' => "required",
				'spp' => "required",
				//'sn' => "required",
				'se' => "required|email"
			 ]);
			 
			 if($validator->fails())
			 {
				$ret['message'] = "validation";
			 }
			 
			 else
			 {
				 $req['status'] = "ok";
				 $req['sn'] = "";
				 $req['current'] = "no";
				 $req['type'] = '';
				 $ret = $this->helpers->createSender($req);
				 
				 $ret = ['status' => 'ok'];
			 }

		 return json_encode($ret);
    }

	 /**
	 * Show the application contact view to the user.
	 *
	 * @return Response
	 */
	public function getSmtp(Request $request)
    {
        $user = null;
	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		
    	return view('smtp',compact($c));
    }



	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postSend(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		//if($vu['check'])
		//{
			$user = $vu['user'];

			$req = $request->all();
            $validator = Validator::make($req, [
                'sender' => 'required',
                //'sname' => 'required',
                'subject' => 'required',
                'to' => 'required|email',
                'body' => 'required',
            ]);
         
            if($validator->fails())
            {
              $messages = $validator->messages();
              $ret['message'] = "validation";
            }
         
            else
            {
               $this->helpers->bomb($req); 
			   //TODO: send email to admin
			   $ret = ['status' => "ok",'to' => $req['to']];
		    }
		/*}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}*/

		 return json_encode($ret);
    }


	 /**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getAbout(Request $request)
    {
       $user = null;
	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');


		
    	return view('about',compact($c));
    }


	


	 /**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getTerms(Request $request)
    {
       $user = null;
	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');


		
    	return view('terms',compact($c));
    }

	 /**
	 * Show the application about view to the user.
	 *
	 * @return Response
	 */
	public function getPrivacyPolicy(Request $request)
    {
       $user = null;
	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');

		
    	return view('privacy',compact($c));
    }

	/**
	 * Show the application contact view to the user.
	 *
	 * @return Response
	 */
	public function getCategories(Request $request)
    {
        $user = null;
	   $vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$categories = $this->helpers->getCategories();
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails','categories');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');
		
    	return view('categories',compact($c));
    }

	/**
	 * Show the application contact view to the user.
	 *
	 * @return Response
	 */
	public function getCategory(Request $request)
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
            $cat = $this->helpers->getCategory($req['xf']);
			if(count($cat) > 0)
			{ 
				$contactDetails = $this->helpers->contactDetails;
            array_push($c,'contactDetails','cat');
		    $sliderData = [
			   'popular' => $this->helpers->testProducts,
			   'specials' => $this->helpers->testProducts,
			   'featured' => $this->helpers->testProducts,
		    ];
		    array_push($c,'sliderData');
		
    	    return view('category',compact($c));
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
	public function getCart(Request $request)
    {
       $user = null;
	   $req = $request->all();

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		/*else
		{
			$u = '/';
			return redirect()->intended($u);
		}*/

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		$items = $this->helpers->getCartItems();
		$fee = 0;
		#dd($items);

		array_push($c,'items','fee');
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');
	    return view('cart',compact($c));	
		
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postAddToCart(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		//if($vu['check'])
		//{
			$user = $vu['user'];

			$req = $request->all();
            $validator = Validator::make($req, [
                'xf' => 'required',
                'qty' => 'required|numeric',
            ]);
         
            if($validator->fails())
            {
              $messages = $validator->messages();
              $ret['message'] = "validation";
            }
         
            else
            {
               $this->helpers->createCartItem($req); 
			   $ret = ['status' => "ok"];
		    }
		/*}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}*/

		 return json_encode($ret);
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postRemoveFromCart(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		//if($vu['check'])
		//{
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
               $this->helpers->removeCartItem($req); 
			   $ret = ['status' => "ok"];
		    }
		/*}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}*/

		 return json_encode($ret);
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCheckout(Request $request)
    {
       $user = null;
	   $req = $request->all();

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		/*else
		{
			$u = '/';
			return redirect()->intended($u);
		}*/

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$pmodes = $this->helpers->paymentModes;

		$items = $this->helpers->getCartItems();
		$fee = 0;
		#dd($items);
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');
		array_push($c,'items','fee','pmodes');
	    return view('checkout',compact($c));	
		
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postCheckout(Request $request)
    {
       $user = null;
	   $ret = ['status' => 'error','message' => "nothing happened"];

		$vu = $this->helpers->getValidUser();
		//if($vu['check'])
		//{
			$user = $vu['user'];

			$req = $request->all();
            $validator = Validator::make($req, [
                'pmode' => 'required',
            ]);
         
            if($validator->fails())
            {
              $messages = $validator->messages();
              $ret['message'] = "validation";
            }
         
            else
            {
               $ret = $this->helpers->checkout($req); 

			   if($ret !== 'error')
			   {
				$ret = ['status' => "ok",'xf' => $ret];
			   }
			   else
			   {
                 $ret['message'] = 'failed';
			   }
			  
		    }
		/*}
		else{
			$ret = ['status' => 'error','message' => "auth"];
		}*/

		 return json_encode($ret);
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

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		/*else
		{
			$u = '/';
			return redirect()->intended($u);
		}*/

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		if(isset($req['xf']))
         {
			
		    $o = $this->helpers->getOrder($req['xf']);

			if(count($o) > 0)
			{
			 array_push($c,'o');
			 dd($o);
			 $contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');
	           return view('order',compact($c));	
			}
			else
			{
				return redirect()->intended('/');
			}

           
         }
		 else
		 {
			 return redirect()->intended('/');
		 }

		
    }

	


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPosts(Request $request)
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');

		$activeClass = "add-fund";
		array_push($c,'activeClass');
	   

		$req = $request->all();
        
       
         if(isset($req['xf']))
         {
            return redirect()->intended('/');
         }
         
         else
         {
            $posts = $this->helpers->getPosts($req['xf']);

			if(isset($posts))
			{
			  array_push($c,'posts');
			  return view('posts',compact($c));
			}
		 }
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPost(Request $request)
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');

		$activeClass = "add-fund";
		array_push($c,'activeClass');
	   

		$req = $request->all();
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
            return redirect()->intended('/');
         }
         
         else
         {
            $post = $this->helpers->getPost($req['xf']);

			if(isset($post))
			{
			  array_push($c,'post');
			  $tags2 = $post['tags'];
			  $tags = json_decode($tags2,false);

			  return view('post',compact($c));
			}
		 }
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getFaq(Request $request)
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
		$sliderData = [
			'popular' => $this->helpers->testProducts,
			'specials' => $this->helpers->testProducts,
			'featured' => $this->helpers->testProducts,
		];
		array_push($c,'sliderData');


		$activeClass = "add-fund";
		array_push($c,'activeClass');
	   

		$req = $request->all();
        
       
         $faqs = $this->helpers->getFaqs();

			if(isset($faqs))
			{
			  array_push($c,'faqs');
			  return view('faq',compact($c));
			}
    }




	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getReferral()
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		else{
			return redirect()->intended('/');
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		$activeClass = "referral";
		
		array_push($c,'activeClass',);
	    return view('referral',compact($c));	

		
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getReferralBonus()
    {
       $user = null;

		$vu = $this->helpers->getValidUser();
		if($vu['check'])
		{
			$user = $vu['user'];
		}
		else{
			return redirect()->intended('/');
		}

		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;

		$activeClass = "referral-bonus";
		
		array_push($c,'activeClass',);
	    return view('referral-bonus',compact($c));	

		
    }

	
	
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


}