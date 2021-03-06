<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PrioritiesController extends Controller
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
        $priorities = DataTables::collection($this->ticket_repository->getAllPriorities())->make(true);
        $priorities = $priorities->getData();
        return view('admin.tickets.priorities.index',compact('priorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priorities = false;
        return view('admin.tickets.priorities.form',compact('priorities'));
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
            $properties = $this->ticket_repository->storePriorities($request->all());
            if ($properties) {
                flash()->success(config('message.priorities.add-success'));
                return Redirect('admin/tickets/priorities');
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
        $priorities = $this->ticket_repository->getByIdPriorities($id);
        return view('admin.tickets.priorities.form',compact('priorities'));
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
            $properties = $this->ticket_repository->updatePriorities($id, $request->all());
            if ($properties) {
                flash()->success(config('message.priorities.update-success'));
                return Redirect('admin/tickets/priorities');
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
        if ($this->ticket_repository->deletePriorities($id)) {
            flash()->success(config('message.priorities.delete-success'));
        } else {
            flash()->error(config('message.priorities.delete-error'));
        }
        return Redirect('admin/tickets/priorities');
    }
}
