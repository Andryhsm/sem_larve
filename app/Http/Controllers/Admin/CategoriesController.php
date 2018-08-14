<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    protected $ticket_repository;

    public function __construct(TicketRepository $ticket_repo)
    {
        $this->ticket_repository = $ticket_repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Datatables::collection($this->ticket_repository->getAllCategories())->make(true);
        $categories = $categories->getData();
        return view('admin.tickets.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = false;
        return view('admin.tickets.categories.form',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name_en' => 'required',
            'name_fr' => 'required',
            'color' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $properties = $this->ticket_repository->storeCategories($request->all());
            if ($properties) {
                flash()->success(config('message.categories.add-success'));
                return Redirect('admin/tickets/categories');
            }
        }
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
        $categories = $this->ticket_repository->getByIdCategories($id);
        return view('admin.tickets.categories.form',compact('categories'));
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
        $rules = array(
            'name_en' => 'required',
            'name_fr' => 'required',
            'color' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $properties = $this->ticket_repository->updateCategories($id, $request->all());
            if ($properties) {
                flash()->success(config('message.categories.update-success'));
                return Redirect('admin/tickets/categories');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->ticket_repository->deleteCategories($id)) {
            flash()->success(config('message.categories.delete-success'));
        } else {
            flash()->error(config('message.categories.delete-error'));
        }
        return Redirect('admin/tickets/categories');
    }
}
