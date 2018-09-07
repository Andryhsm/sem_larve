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
use \Log;
 
class KeywordTrendsController extends Controller
{   
	protected $keyword_trend_repository; 
	 
    public function __construct(KeywordTrendsRepository $keyword_trend_repo)
    {
         $this->keyword_trend_repository = $keyword_trend_repo;
	} 
	
    public function researchTools() 
    {
    	//dd(config('adwords-targeting-idea-service.user_agent'));
        $locations = [];
		$countries = Locations::where('parent_id', '')->orderBy('location_name', 'asc')->get();
        return view('admin.keyword_trends.research_tools', compact('countries'));  
    }
     
    public function getStatesByLocation(Request $request) 
    {
    	$id = $request->get('id');
    	$states = Locations::where('parent_id', $id)->orderBy('location_name', 'asc')->get();
    	return response()->json(['status' => 'ok', 'data' => $states]);
    }
    
    public function dataCollections() 
    {
    	$user_id = get_user_id();
		$campaigns = $this->keyword_trend_repository->getAllByUser($user_id);
		//dd($campaigns);
    	return view('admin.keyword_trends.data_collections',compact('campaigns'));
    }
    
    public function importExcel(Request $request)
	{
		$keyword = "";
		$insert = [];
		$use_first_line = $request->get('use_first_line');
		if(Input::hasFile('import_file')){
			    $path = Input::file('import_file')->getRealPath();
			    $original_name = Input::file('import_file')->getClientOriginalName();
			    $ext = pathinfo($original_name, PATHINFO_EXTENSION);
			    if($ext != 'csv' && $ext != 'xlsx' && $ext != 'xls')
			        return response()->json([
			            	'status' => 'error_ext',
			            	'message' => 'You have uploaded the wrong extension! Only the extension .csv and .xlsx are accepted! Try again please!',
			            	'type_alert' => 'alert-danger'
			            ]);
			    $data = Excel::load($path, function($reader) {})->get();
			if(!empty($data) && $data->count()){
			    $keyword = $data[0]->keys()[0];
			    ($use_first_line == 'on') ? $i = 1 : $i = 0;
			    for( ; $i < sizeof($data) ; $i++) {
			    	if($data[$i]->$keyword != false)
						$insert[] = $data[$i]->$keyword;
			    }
			    
				/*foreach ($data as $key => $value) {
					if($value->$keyword != false)
						$insert[] = $value->$keyword;
				}*/
				
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

	
	// public function makeRequestAdwords(Request $request) 
	// {
	// 	$keywords = json_decode($request->get('keywords'));
	// 	$params = $request->get('params');
	// 	$searchVolumes = collect();	
	// 	$tab_keywords = array_chunk($keywords, 800);

	// 	foreach ($tab_keywords as $tab_keyword) {
	// 		$result = $this->launch_request_keyword($params, $tab_keyword);
	// 		$searchVolumes[] = $result;
	// 	}
		
	// 	//$searchVolumes = $this->launch_request_keyword($params, $keywords);

	// 	// if($params['monthly_searches'] == 0 && $params['convert_null_to_zero'] ==0) {
	// 	// 	$searchVolumes = \AdWords::location($params['area_id'])->language($params['language_id'])->searchVolumes($keywords);
	// 	// } else if($params['monthly_searches'] == 1 && $params['convert_null_to_zero'] ==0) {
	// 	// 	$searchVolumes = \AdWords::withTargetedMonthlySearches()->location($params['area_id'])->language($params['language_id'])->searchVolumes($keywords);
	// 	// } else if($params['monthly_searches'] == 0 && $params['convert_null_to_zero'] ==1) {
	// 	// 	$searchVolumes = \AdWords::convertNullToZero()->location($params['area_id'])->language($params['language_id'])->searchVolumes($keywords);
	// 	// } else if($params['monthly_searches'] == 1 && $params['convert_null_to_zero'] ==1) {
	// 	// 	$searchVolumes = \AdWords::withTargetedMonthlySearches()->convertNullToZero()->location($params['area_id'])->language($params['language_id'])->searchVolumes($keywords);
	// 	// }

    //     return response()->json([
    //     	'status' => 'ok',
    //     	'data' => $searchVolumes,
    //     	'params' => $params,
    //     	'keyword_param' => $keywords
    //     ]);
	// }

	public function launch_request_keyword($params, $keywords) {
		$searchVolumes = null;
        foreach ($params['area_id'] as $key=>$value) {
            if($params['monthly_searches'] == 0 && $params['convert_null_to_zero'] ==0) {
                $searchVolumes[] = \AdWords::location((string)$value)->language($params['language_id'])->searchVolumes($keywords);

            } else if($params['monthly_searches'] == 1 && $params['convert_null_to_zero'] ==0) {
                $searchVolumes[] = \AdWords::withTargetedMonthlySearches()->location((string)$value)->language($params['language_id'])->searchVolumes($keywords);
                //\Log::debug($searchVolumes);


            } else if($params['monthly_searches'] == 0 && $params['convert_null_to_zero'] ==1) {
                $searchVolumes[] = \AdWords::convertNullToZero()->location((string)$value)->language($params['language_id'])->searchVolumes($keywords);


            } else if($params['monthly_searches'] == 1 && $params['convert_null_to_zero'] ==1) {
                $searchVolumes[] = \AdWords::withTargetedMonthlySearches((string)$value)->convertNullToZero()->location('1002491')->language($params['language_id'])->searchVolumes($keywords);
            }

        }
        $resume_search_volume = null;
        $monthly_searches = null;
        for($j = 0 ; $j< sizeof($keywords); $j++) {
            $nb = 0;
            $average_competition = 0;
            $average_cpc = 0;
            $sum_search_volume = 0;
            $count = 0;
            $keyword = '';
            $year = 0;
            $month = 0;
            $index = 0;

            for ($i=0; $i< sizeof($params['area_id']); $i++){
                $average_competition += $searchVolumes[$i][$j]->competition;
                $average_cpc += $searchVolumes[$i][$j]->cpc;
                $sum_search_volume += $searchVolumes[$i][$j]->search_volume;
                $keyword =  $searchVolumes[$i][$j]->keyword;
                $nb++;

            }

            for ($k=0; $k<12; $k++){
                $count = 0;
                for ($l=0; $l< sizeof($params['area_id']); $l++){
                    if ( $searchVolumes[$l][$j]->targeted_monthly_searches  != null) {
                        if ($searchVolumes[$l][$j]->targeted_monthly_searches[$k]['count'] == null ){
                            $index = 0;
                        }else {
                            $index = $searchVolumes[$l][$j]->targeted_monthly_searches[$k]['count'];
                        }
                    }

                    $count +=  $index;
                    $month = $searchVolumes[$l][$j]->targeted_monthly_searches[$k]['month'];
                    $year = $searchVolumes[$l][$j]->targeted_monthly_searches[$k]['year'];
                }
                $monthly_searches[$k]['year'] = $year;
                $monthly_searches[$k]['month'] = $month;
                $monthly_searches[$k]['count'] = $count;
            }
            $average_competition = $average_competition / $nb;
            $average_cpc = $average_cpc / $nb;
            $resume_search_volume[$j]['keyword'] = $keyword;
            $resume_search_volume[$j]['competition'] = $average_competition;
            $resume_search_volume[$j]['cpc'] = $average_cpc;
            $resume_search_volume[$j]['search_volume'] = $sum_search_volume;
            $resume_search_volume[$j]['targeted_monthly_searches'] = $monthly_searches;
        }


		return $resume_search_volume;
	}

	public function makeRequestAdwords(Request $request) 
	{
		$campaign = null;
		$keywords = json_decode($request->get('keywords'));
		$params = $request->get('params');
		$searchVolumes = collect();	
		$tab_keywords = array_chunk($keywords, 800);

		foreach ($tab_keywords as $tab_keyword) {
			$result = $this->launch_request_keyword($params, $tab_keyword);
			$searchVolumes[] = $result;
		}

		try{
			$campaign = $this->keyword_trend_repository->storeDataCollection($request->all(), $searchVolumes);
		} catch(\Exception $e) {
			\Log::debug($e->getMessage());
		}
		$params = $request->get('params');
		return response()->json([
			'status' => 'ok', 
			'campaign' => $campaign,
			'search_volume' => $searchVolumes
		]);
	}
	
	/*public function save_data_collection(Request $request) 
	{
		$campaign = [];
		$keyword_result =  $request->get('keywords_result');

		try{
			$campaign = $this->keyword_trend_repository->storeDataCollection($request->all());
		} catch(\Exception $e) {
			\Log::debug($e->getMessage());
		}
		$params = $request->get('params');
		return response()->json(['status' => 'ok', 'campaign' => $campaign]);
	}	*/
	
	public function showCampaignResultData(Request $request) {
		$campaign_id = Input::get('campaign_id');
		$datas = $this->keyword_trend_repository->getKeywordByCampaignId($campaign_id);
		$campaign = $this->keyword_trend_repository->getCampaignById($campaign_id);
		$area = '';
		$state = '';
		$country = '';
		// if(isset($campaign->area->parent)) {
		// 	$area = $campaign->area->location_name;
		// 	$state = $campaign->area->parent->location_name;
		// 	$country = $campaign->area->parent->parent->location_name;
		// }
		$language = $campaign->language->language_name;
		return response()->json(['datas' => $datas,'area' => $area ,'campaign'=>$campaign ,'state' => $state, 'country' => $country, 'language' => $language]);
	}
	
	public function OverviewListKeyword(Request $request) {
		$campaign_id = Input::get('campaign_id');
		return view('admin.keyword_trends.overview_keyword_list', compact('campaign_id')); 
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

	public function TrackSaveCampaign($campaign_id, Request $request){
		//$campaign = Campaign::find($campaign_id);	
		$locations = [];
		$countries = Locations::where('parent_id', '')->orderBy('location_name', 'asc')->get();
		$campaign = $this->keyword_trend_repository->getCampaignById($campaign_id);
		// dd($campaign);
		$area = $campaign->area->location_name;
		$state = $campaign->area->parent->canonical_name;
		$country = $campaign->area->parent->parent->canonical_name;
		$language = $campaign->language->language_name;	
		
		$datas = $this->keyword_trend_repository->getKeywordByCampaignId($campaign_id);
		$keywords_decode = json_decode($datas);

		return view('admin.keyword_trends.tracksave_campaign')->with('campaign', $campaign)->with('countries', $countries)
		->with('area', $area)->with('state', $state)->with('country', $country)->with('language', $language)->with('keywords_decode', $keywords_decode);
	}
	
	public function makeRequestAdwordsTrackSave(Request $request){
		$params = $request->get('params');
		$campaign = null;
		$campaign_id = $params['campaign_id'];
		$datas = $this->keyword_trend_repository->getKeywordByCampaignId($campaign_id);
		$keywords = [];
		foreach($datas as $keyword){
			$keywords[] = $keyword->keyword_name;
		}
		$searchVolumes = collect();
		$tab_keywords = array_chunk($keywords, 800);

		foreach ($tab_keywords as $tab_keyword) {
			$result = $this->launch_request_keyword_decode($params, $tab_keyword);
			$searchVolumes[] = $result;
		}
		$campaign = $this->keyword_trend_repository->updateKeywordByCampaignId($params, $searchVolumes);
		return response()->json([

        	'status' => 'ok',
        	'data' => $searchVolumes,
        	'params' => $params,
        	'keyword_param' => $keywords
        ]);
	}
	public function launch_request_keyword_decode($params, $keywords_decodes) {
		$searchVolumes = null;
		if($params['monthly_searches'] == 0 && $params['convert_null_to_zero'] ==0) {
			$searchVolumes = \AdWords::location($params['area_id'])->language($params['language_id'])->searchVolumes($keywords_decodes);
		} else if($params['monthly_searches'] == 1 && $params['convert_null_to_zero'] ==0) {
			$searchVolumes = \AdWords::withTargetedMonthlySearches()->location($params['area_id'])->language($params['language_id'])->searchVolumes($keywords_decodes);
		} else if($params['monthly_searches'] == 0 && $params['convert_null_to_zero'] ==1) {
			$searchVolumes = \AdWords::convertNullToZero()->location($params['area_id'])->language($params['language_id'])->searchVolumes($keywords_decodes);
		} else if($params['monthly_searches'] == 1 && $params['convert_null_to_zero'] ==1) {
			$searchVolumes = \AdWords::withTargetedMonthlySearches()->convertNullToZero()->location($params['area_id'])->language($params['language_id'])->searchVolumes($keywords_decodes);
		}
		return $searchVolumes;
	}
}
