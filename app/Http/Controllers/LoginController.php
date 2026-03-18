<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 
use App\Models\User;

class LoginController extends Controller {

	protected $helpers; //Helpers implementation
    protected $compactValues;
    
    public function __construct(Helper $h)
    {
    	$this->helpers = $h;    
        $this->compactValues = ['user','plugins','senders','signals'];           
    }

    	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getApply(Request $request)
    {
		$user = null;
       $req = $request->all();
       $return = isset($req['return']) ? $req['return'] : '/';
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended($return);
		}

		$signals = $this->helpers->signals;
		$senders = $this->helpers->getSenders();
		$plugins = $this->helpers->getPlugins(['mode' => 'active']);
		$c = $this->compactValues;
        $contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails');
    	return view('apply',compact($c));
    }
	
		/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSignup(Request $request)
    {
		$user = null;
       $req = $request->all();
       $return = isset($req['return']) ? $req['return'] : '/';
       $xf = isset($req['xf']) ? $req['xf'] : '0';
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended($return);
		}

      //  $existingRequest = $this->helpers->getMemberRequest($xf);

       // if(isset($existingRequest['code']) && $existingRequest['code'] === $xf)
       // {
             $signals = $this->helpers->signals;
		    $senders = $this->helpers->getSenders();
		    $plugins = $this->helpers->getPlugins(['mode' => 'active']);
		    $c = $this->compactValues;
            $months = $this->helpers->months;
            $contactDetails = $this->helpers->contactDetails;
            array_push($c,'contactDetails','months');
            $sliderData = [
                'popular' => $this->helpers->testProducts,
                'specials' => $this->helpers->testProducts,
                'featured' => $this->helpers->testProducts,
            ];
            array_push($c,'sliderData');
    	   return view('signup',compact($c));
       /* }
        else
        {
           return redirect()->intended($return);
        }*/

		
    }

    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getLogin(Request $request)
    {
       $user = null;
       $req = $request->all();
       $return = isset($req['return']) ? $req['return'] : 'dashboard';
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended($return);
		}

		$signals = $this->helpers->signals;
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
    	return view('login',compact($c));
    }

    public function postApply(Request $request)
    {
        $req = $request->all();
        #dd($req);
        $ret = ['status' => 'error','message' => "nothing happened"];
        
        $validator = Validator::make($req, [
                             'email' => 'required|email|not_in:users', 
                             'fname' => 'required', 
                             'lname' => 'required',
                             'phone' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret['message'] = "validation";
         }
         
         else
         {
             $return = isset($req['return']) ? $req['return'] : '/';
            $existingUser = $this->helpers->getUser($req['email']);

            if(count($existingUser) > 0)
            {
              $ret['message'] = "existing-user";
            }
            else
            {     	 
  
              $this->helpers->createMemberRequest($req); 

                                                      
               //after creating the user, send back to the registration view with a success message
               #$this->helpers->sendEmail($user->email,'Welcome To Ukpor Unique Club!',['name' => $user->fname, 'id' => $user->id],'emails.welcome','view');
                $ret = ['status'=> "ok",'data' => $return];
            }
			
          }
          return json_encode($ret);    
    }



	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postLogin(Request $request)
    {
        $req = $request->all();
        $ret = ['status' => 'error','message' => "nothing happened"];
        #dd($req);
        
        $validator = Validator::make($req, [
                             'password' => 'required|min:6',
                             'username' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret['message'] = "validation";
         }
         
         else
         {
			
         	$remember = isset($req['remember']) ? $req['remember'] : true; 

             $return = isset($req['return']) ? $req['return'] : 'dashboard';
             
         	//authenticate this login
            if(
                Auth::attempt(['email' => $req['username'],'password' => $req['password'],'status'=> "ok"],$remember)
                || Auth::attempt(['username' => $req['username'],'password' => $req['password'],'status'=> "ok"],$remember)
            )
            {
            	//Login successful   
             
               $user = Auth::user(); 
               $request->session()->regenerate();       
               # dd($user); 
				              
                 $ret = ['status'=> "ok",'data' => $return];
            }
			
			else
			{
				$ret['message'] = "invalid-auth";
			}
         }
         return json_encode($ret);        
    }

    public function postSignup(Request $request)
    {
        $req = $request->all();
        #dd($req);
        $ret = ['status' => 'error','message' => "nothing happened"];
        
        $validator = Validator::make($req, [
                             //'xf' => 'required',
                             'password' => 'required|min:6|confirmed',
                             'email' => 'required|email|not_in:users', 
                             'fname' => 'required', 
                             'lname' => 'required',
                             //'phone' => 'required',
                             //'day' => 'required',
                             //'month' => 'required',
                             'gender' => 'required|not_in:none',
                              //'username' => 'required|not_in:users',
                             #'g-recaptcha-response' => 'required',
                           # 'terms' => 'accepted',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret['message'] = "validation";
         }
         
         else
         {
             $return = isset($req['return']) ? $req['return'] : '/';
           
              $req['phone'] = '';//$existingRequest['phone'];
             $req['bday'] = '';//$req['month']."-".$req['day'];
             $req['role'] = "user";
             $req['username'] = "";
             $req['avatar'] = "";
              $req['tier'] = 1;
             $req['status'] = "ok";  
             $req['verified'] = "yes";       			
             $req['complete_signup'] = "yes";       	 
  
              $user =  $this->helpers->createUser($req); 

                                                      
               //after creating the user, delete the request, and send back to the registration view with a success message
              #$this->helpers->sendEmail($user->email,'Welcome To Ukpor Unique Club!',['name' => $user->fname, 'id' => $user->id],'emails.welcome','view');
                $ret = ['status'=> "ok",'data' => $return];
            }

          return json_encode($ret);    
    }

	
	 public function getForgotPassword()
    {
    	$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended('/');
		}
		$signals = $this->helpers->signals;
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
         return view('forgot-password', compact($c));
    }
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postForgotPassword(Request $request)
    {
        $ret = ['status' => 'error','message' => "nothing happened"];

    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'id' => 'required'
                  ]);
                  
        if($validator->fails())
         {
             $messages = $validator->messages();
             $ret['error'] = 'validation';
         }
         
         else
         {
         	$id = $req['id'];

                $user = User::where('email',$id)
                                  ->orWhere('username',$id)->first();

                if(is_null($user))
                {
                    $ret['message'] = 'invalid-user';
                }
                else
                {
                     //get the reset code 
                    $code = $this->helpers->getPasswordResetCode($user);
                    $l = url('reset-password')."?xf=".$code;

                    //send email
                   /*
                    $emailContent = $this->helpers->getEmailContent([
                      'type' => 'forgot-password',
                      'data' => [
                        'username' => $user->username,
                        'link' => $l
                        ]
                    ]); 
                    $payload = $this->helpers->getCurrentSender();
                    $payload['to'] = $user->email;
                    $payload['htmlContent'] = $emailContent;
                    $payload['subject'] = "Reset your password";
                    $this->helpers->symfonySendMail($payload);
                    */
                    $ret = ['status' => 'ok'];
                }
        }
        return json_encode($ret);   
                  
    }   
    
    public function getResetPassword(Request $request)
    {
       $user = null;
       $senders = $this->helpers->getSenders();
	   $plugins = $this->helpers->getPlugins(['mode' => 'active']);
       $signals = $this->helpers->signals;
       $c = $this->compactValues;
       $contactDetails = $this->helpers->contactDetails;
       array_push($c,'contactDetails');

       $req = $request->all();

       $return = isset($req['return']) ? $req['return'] : '/';
	   
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended($return);
		}

        if(isset($req['xf']))
        {
            $code = $req['xf'];
            $u = $this->helpers->verifyPasswordResetCode($code);
            #dd($u);
            
            if($u !== null)
            {
                $xf = $u->id;
                array_push($c,'xf');
                $sliderData = [
                    'popular' => $this->helpers->testProducts,
                    'specials' => $this->helpers->testProducts,
                    'featured' => $this->helpers->testProducts,
                ];
                array_push($c,'sliderData');
                return view('reset-password',compact($c));
            }
            else
            {
                return redirect()->intended($return);
            }
           
        }
        else
        {
            return redirect()->intended($return);
        }
    	
    }


    public function postResetPassword(Request $request)
    {
        $req = $request->all();
        #dd($req);
        $ret = ['status' => 'error','message' => "nothing happened"];
        
  
        $validator = Validator::make($req, [
                             'xf' => 'required|numeric', 
                             'password' => 'required|min:6|confirmed',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret['message'] = "validation";
         }
         
         else
         {
            $user = User::where('id',$req['xf'])->first();
            if(is_null($user))
            {
               $ret['message'] = "invalid-user";
            }
            else
            {
                 #dd($req);
             $userPayload = [
                'email' => $req['xf'],
                'password' => bcrypt($req['password']),
             ];       

            $this->helpers->updateUser($userPayload); 

            $ret = ['status'=> "ok"];
            }
			
          }
          return json_encode($ret);    
    }

    public function getSetPassword(Request $request)
    {
       $user = null;
       $senders = $this->helpers->getSenders();
	   $plugins = $this->helpers->getPlugins(['mode' => 'active']);
       $signals = $this->helpers->signals;
       $c = $this->compactValues;
       $contactDetails = $this->helpers->contactDetails;
       array_push($c,'contactDetails');
       $sliderData = [
        'popular' => $this->helpers->testProducts,
        'specials' => $this->helpers->testProducts,
        'featured' => $this->helpers->testProducts,
    ];
    array_push($c,'sliderData');

       $req = $request->all();

       $return = isset($req['return']) ? $req['return'] : '/';
	   
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended($return);
		}

        if(isset($req['em']))
        {
            $em = $req['em'];
            array_push($c,'em');
            $u = $this->helpers->getUser($em);
            #dd($u);
            
            if(count($u) > 0 && $u['complete_signup'] === 'no')
            {
                return view('set-password',compact($c));
            }
            else
            {
                return redirect()->intended($return);
            }
           
        }
        else
        {
            return redirect()->intended($return);
        }
    	
    }


    public function postSetPassword(Request $request)
    {
        $req = $request->all();
        #dd($req);
        $ret = ['status' => 'error','message' => "nothing happened"];
        
  
        $validator = Validator::make($req, [
                             'email' => 'required|email', 
                             'password' => 'required|min:6|confirmed',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret['message'] = "validation";
         }
         
         else
         {
            $user = User::where('email',$req['email'])->first();
            if(is_null($user))
            {
               $ret['message'] = "invalid-user";
            }
            else if($user->complete_signup !== 'no')
            {
                $ret['message'] = "invalid-session";
            }
            else
            {
                 #dd($req);
             $userPayload = [
                'email' => $req['email'],
                'password' => bcrypt($req['password']),
                'complete_signup' => "yes",
             ];       

            $this->helpers->updateUser($userPayload); 

            $ret = ['status'=> "ok"];
            }
			
          }
          return json_encode($ret);    
    }

    public function getChangePassword(Request $request)
    {
       $user = null;
     

       $return = isset($req['return']) ? $req['return'] : '/';
	   
		if(Auth::check())
		{
			$user = Auth::user();
			
            $signals = $this->helpers->signals;
            $senders = $this->helpers->getSenders();
             $plugins = $this->helpers->getPlugins(['mode' => 'active']);
            $c = $this->compactValues;
            $contactDetails = $this->helpers->contactDetails;
            array_push($c,'contactDetails');
            $em = $user->email;
            array_push($c,'em');
            $sliderData = [
                'popular' => $this->helpers->testProducts,
                'specials' => $this->helpers->testProducts,
                'featured' => $this->helpers->testProducts,
            ];
            array_push($c,'sliderData');
           
            return view('change-password',compact($c)); 
		}

       
        else
        {
            return redirect()->intended($return);
        }
    	
    }

    public function postChangePassword(Request $request)
    {
        $ret = ['status' => 'error','message' => "nothing happened"];
        $user = null;
        if(Auth::check())
        {
            $user = Auth::user();
            $req = $request->all();
        #dd($req);
        
        $validator = Validator::make($req, [
            'email' => 'required|email', 
            'password' => 'required|min:6|confirmed',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret['message'] = "validation";
         }
         
         else
         {
			 #dd($req);
             $userPayload = [
                'email' => $user->email,
                'password' => bcrypt($req['password']),
             ];       

            $this->helpers->updateUser($userPayload); 

            $ret = ['status'=> "ok"];
          }
        }
        else
        {
            $ret['message'] = "invalid-session";
        }
        
          return json_encode($ret);    
    }

    
    public function getLogout()
    {
        if(Auth::check())
        {  
           Auth::logout();       	
        }
        
        return redirect()->intended('/');
    }

}