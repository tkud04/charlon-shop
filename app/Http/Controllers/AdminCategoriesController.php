<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class AdminCategoriesController extends Controller {

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
			   return view('main.admin.categories.admin-categories',compact($c));
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
				return view('main.admin.categories.admin-add-product-category',compact($c));
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
						 return view('main.admin.cattegories.admin-product-category',compact($c));
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

}