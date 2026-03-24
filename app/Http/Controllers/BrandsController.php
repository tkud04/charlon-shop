<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Illuminate\Support\Facades\Auth;
use Session; 
use Validator; 
use Carbon\Carbon;


class BrandsController extends Controller {

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
	public function getBrands(Request $request)
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
		$brands = $this->helpers->getBrands();
		$contactDetails = $this->helpers->contactDetails;
        array_push($c,'contactDetails','brands');
		$sliderData = $this->helpers->getSliderProducts();
		array_push($c,'sliderData');
		
    	return view('main.brands.brands',compact($c));
    }

	/**
	 * Show the application contact view to the user.
	 *
	 * @return Response
	 */
	public function getBrand(Request $request)
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
            $bra = $this->helpers->getBrand($req['xf']);
			if(count($bra) > 0)
			{ 
				$contactDetails = $this->helpers->contactDetails;
				$categories = $this->helpers->getCategories();
				$allBrands = $this->helpers->getProductsByBrand($bra['slug']);
				$totalPages = $this->helpers->numPages($allBrands);
				$products = [];
				$ops = ['prev','next'];

				$v1 = isset($req['page']) && intval($req['page']) > 0;
				$v2 = isset($req['op']) && in_array($req['op'],$ops);
				
				$page = $v1 ? $req['page'] : '1'; 
				$products = $this->helpers->changePage($allBrands,$page);
				

				if($v2)
				{
					if($req['op'] === 'prev') $products = $this->helpers->prevPage($allBrands,$page);
					if($req['op'] === 'next') $products = $this->helpers->nextPage($allBrands,$page);
				}

				$brands = $this->helpers->getBrands();
            array_push($c,'contactDetails','bra','categories','totalPages','page','products','brands');
		    $sliderData = $this->helpers->getSliderProducts();
		    array_push($c,'sliderData');
		
    	    return view('main.brands.brand',compact($c));
			}
			else
			{
				return redirect()->intended('brands');
			}
		    
		}
		else
		{
			return redirect()->intended('brands');
		}
		
    }


}