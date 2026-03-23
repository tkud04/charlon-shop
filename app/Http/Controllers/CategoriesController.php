<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon;


class CategoriesController extends Controller {

	protected $helpers; //Helpers implementation
	protected $compactValues;
    
    public function __construct(Helper $h)
    {
    	$this->helpers = $h;      
		$this->compactValues = ['user','plugins','senders','signals','ads'];         
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
		$sliderData = $this->helpers->getSliderProducts();
		array_push($c,'sliderData');
		
    	return view('main.categories.categories',compact($c));
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
				$categories = $this->helpers->getCategories();
				$products = $this->helpers->getProductsByCategory($cat['slug']);
				$brands = $this->helpers->getBrands();
            array_push($c,'contactDetails','cat','categories','products','brands');
		    $sliderData = $this->helpers->getSliderProducts();
		    array_push($c,'sliderData');
		
    	    return view('main.categories.category',compact($c));
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


}