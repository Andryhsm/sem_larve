<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AdwordsApiRepository;
use Yajra\DataTables\Facades\DataTables;

class AdwordsApiController extends Controller
{
    
    protected $adwords_api_repository;

	public function __construct(AdwordsApiRepository $api)
	{
		$this->adwords_api_repository = $api;
	}
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->guard('admin')->user()->admin_id;
        $adwords_apis = DataTables::collection($this->adwords_api_repository->getAllByUser($user))->make(true);
		$adwords_apis = $adwords_apis->getData();
		return view('admin.adwords_api.index', compact('adwords_apis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adwords_api = false;
		return view('admin.adwords_api.form', compact('adwords_api'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adwords_api = $this->adwords_api_repository->store($request->all());
		flash()->success(config('message.account_api.add-success'));
		return redirect()->route('adwords_api.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adwords_api = $this->adwords_api_repository->getById($id);
		return view('admin.adwords_api.form', compact('adwords_api'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $adwords_api = $this->adwords_api_repository->updateById($id, $request->all());
		flash()->success(config('message.account_api.update-success'));
		return redirect()->route('adwords_api.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->adwords_api_repository->deleteById($id);
		if ($status) {
			flash()->success(config('message.account_api.delete-success'));
		} else {
			flash()->error(config('message.account_api.delete-error'));
		}
		return redirect()->route('adwords_api.index');
    }
}
