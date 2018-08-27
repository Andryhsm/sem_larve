<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LanguageCode;
use App\Locations;
use Excel;
use Illuminate\Support\Facades\Input;
use App\Repositories\KeywordTrendsRepository;
use League\Csv\Reader;
use League\Csv\Statement;
use App\Models\AdwordsApi;
 
class KeywordTrendsController extends Controller
{   
	protected $keyword_trend_repository; 
	 
    public function __construct(KeywordTrendsRepository $keyword_trend_repo)
    {
         $this->keyword_trend_repository = $keyword_trend_repo;
         $auth_adword = AdwordsApi::where('is_default', 1)->first();
         config(['adwords-targeting-idea-service.developer_token' => $auth_adword->adwords_developper_token]);
         config(['adwords-targeting-idea-service.client_id' => $auth_adword->adwords_client_id]);
         config(['adwords-targeting-idea-service.client_secret' => $auth_adword->adwords_client_secret]);
         config(['adwords-targeting-idea-service.client_refresh_token' => $auth_adword->adwords_client_refresh_token]);
         config(['adwords-targeting-idea-service.client_customer_id' => $auth_adword->adwords_client_customer_id]);
         config(['adwords-targeting-idea-service.user_agent' => $auth_adword->adwords_user_agent]);
    } 
     
    public function researchTools() 
    {
        $locations = [];
		//$countries = Locations::where('parent_id', '')->get();
        return view('admin.keyword_trends.research_tools');  //, compact('countries')
    }
     
    public function getStatesByLocation(Request $request) 
    {
    	$id = $request->get('id');
    	$states = Locations::where('parent_id', $id)->get();
    	return response()->json(['status' => 'ok', 'data' => $states]);
    }
    
    public function dataCollections() 
    {
    	$user_id = auth()->guard('admin')->user()->admin_id;
    	$campaigns = $this->keyword_trend_repository->getAllByUser($user_id);
    	return view('admin.keyword_trends.data_collections',compact('campaigns'));
    }
    
    public function importExcel()
	{
		$keyword = "";
		if(Input::hasFile('import_file')){
			    $path = Input::file('import_file')->getRealPath();
			    $original_name = Input::file('import_file')->getClientOriginalName();
			    $ext = pathinfo($original_name, PATHINFO_EXTENSION);
			    if($ext != 'csv' && $ext != 'xlsx')
			        return response()->json([
			            	'status' => 'error_ext',
			            	'message' => 'You have uploaded the wrong extension! Only the extension .csv and .xlsx are accepted! Try again please!',
			            	'type_alert' => 'alert-danger'
			            ]);
			    $data = Excel::load($path, function($reader) {})->get();
			if(!empty($data) && $data->count()){
			    $keyword = $data[0]->keys()[0];
			    
				foreach ($data as $key => $value) {
					if($value->$keyword != false)
						$insert[] = $value->$keyword;
				}
				
			} else {
		        return response()->json([
        		    'status' => 'empty', 
        		    'message' => "The data is empty"
        		]);	    
			}
		} else {
		    return response()->json([
		         'status' => 'no_file',
		         'message' => "You must select the file to import!",
		         'type_alert' => 'alert-danger'
		        ]);
		}
		if($keyword == "") {
			return response()->json([
		    	'status' => 'not_finish', 
		    	'message' => "Some keywords can not be recovered. Please create a csv file and manually copy the contents of this file to it and try again if you want to have a correct keywords list!",
		    	'data' => $insert,
		    	'type_alert' => 'alert-warning'
		    ]);	
		}
			   
		return response()->json([
		    'status' => 'ok', 
		    'message' => "Your file is successfully uploaded!",
		    'data' => $insert,
		    'type_alert' => 'alert-success'
		    ]);
	}
	
	public function makeRequestAdwords(Request $request) 
	{
		$keywords = Input::get('keywords');
		$params = Input::get('params');
	
		$searchVolumes = [];
		if($params['monthly_searches'] == 0 && $params['convert_null_to_zero'] ==0) {
			$searchVolumes = \AdWords::location($params['location_id'])->language($params['language_id'])->searchVolumes($keywords);
		} else if($params['monthly_searches'] == 1 && $params['convert_null_to_zero'] ==0) {
			$searchVolumes = \AdWords::withTargetedMonthlySearches()->location($params['location_id'])->language($params['language_id'])->searchVolumes($keywords);
		} else if($params['monthly_searches'] == 0 && $params['convert_null_to_zero'] ==1) {
			$searchVolumes = \AdWords::convertNullToZero()->location($params['location_id'])->language($params['language_id'])->searchVolumes($keywords);
		} else if($params['monthly_searches'] == 1 && $params['convert_null_to_zero'] ==1) {
			$searchVolumes = \AdWords::withTargetedMonthlySearches()->convertNullToZero()->location($params['location_id'])->language($params['language_id'])->searchVolumes($keywords);
		}
        return response()->json([
        	'status' => 'ok',
        	'data' => $searchVolumes,
        	'param' => $params
        	]);
	}
	
	public function save_data_collection(Request $request) 
	{
		$keyword_result = $request->get('keywords_result');
		try{
			$campaign = $this->keyword_trend_repository->storeDataCollection($request->all());
		} catch(\Exception $e) {
			\Log::debug($e->getMessage());
		}
		$params = $request->get('params');
		return response()->json(['status' => 'ok', 'campaign' => $campaign]);
	}	
	
	public function showCampaignResultData(Request $request) {
		$campaign_id = Input::get('campaign_id');
		$datas = $this->keyword_trend_repository->getKeywordByCampaignId($campaign_id);
		return response()->json($datas);
	}
	
	public function OverviewListKeyword(Request $request) {
		$campaign_id = Input::get('campaign_id');
		$datas = $this->keyword_trend_repository->getKeywordByCampaignId($campaign_id);
		return view('admin.keyword_trends.overview_keyword_list', compact('datas'));
	}
	
	public function deleteCampaign(Request $request)
	{
		$campaign_id = Input::get('campaign_id');
		$status = $this->keyword_trend_repository->deleteCampaignById($campaign_id);
		if ($status) {
			return response()->json([
        	'status' => 'alert-success',
        	'message' => 'Campaign deleted successfully.'
        	]);
		} else {
			return response()->json([
        	'status' => 'alert-danger',
        	'message' => 'Campaign not deleted successfully.'
        	]);
		}
	}
}
