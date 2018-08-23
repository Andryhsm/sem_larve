<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
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
        $tickets = DataTables::collection($this->ticket_repository->getAll())->make(true);
        $tickets = $tickets->getData();
        return view('admin.tickets.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_priorities = $this->ticket_repository->getAllPriorities();
        $priorities = [];
        foreach ($all_priorities as $priority) {
            $priorities[$priority->id] = $priority->name;
        }
        $all_categories = $this->ticket_repository->getAllCategories();
        $categories = [];
        foreach ($all_categories as $category) {
            $categories[$category->id] = $category->name;
        }
        $ticket = false;
        return view('admin.tickets.form',compact('ticket','priorities','categories'));
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
            'subject' => 'required',
            'content' => 'required',
            'priority' => 'required',
            'category' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $ticket = $this->ticket_repository->store($request->all());
            if ($ticket) {
                flash()->success(config('message.tickets.add-success'));
                return Redirect('admin/tickets');
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
        $default_status = $this->ticket_repository->defaultStatus();
        $ticket = $this->ticket_repository->getById($id);
        $all_status = $this->ticket_repository->getAllStatuses();
        $statuses = [];
        foreach ($all_status as $status) {
            $statuses[$status->id] = $status->english->name;
        }
        return view('admin.tickets.details',compact('ticket','statuses','default_status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $all_priorities = $this->ticket_repository->getAllPriorities();
        $priorities = [];
        foreach ($all_priorities as $priority) {
            $priorities[$priority->id] = $priority->name;
        }
        $all_categories = $this->ticket_repository->getAllCategories();
        $categories = [];
        foreach ($all_categories as $category) {
            $categories[$category->id] = $category->name;
        }
        $ticket = $this->ticket_repository->getById($id);
        return view('admin.tickets.form',compact('ticket','priorities','categories'));
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
            'subject' => 'required',
            'content' => 'required',
            'priority' => 'required',
            'category' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $ticket = $this->ticket_repository->updateById($id, $request->all());
            if ($ticket) {
                flash()->success(config('message.tickets.updated-success'));
                return Redirect('admin/tickets');
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
        if ($this->ticket_repository->deleteById($id)) {
            flash()->success(config('message.tickets.delete-success'));
        } else {
            flash()->error(config('message.tickets.delete-error'));
        }
        return Redirect('admin/tickets');
    }

    public function reOpenTicket(Request $request)
    {
        $id = $request['ticket_id'];
        $ticket = $this->ticket_repository->reOpenTicket($request->all());
        if ($ticket) {
            flash()->success(config('message.tickets.updated-success'));
            return Redirect('admin/tickets/'.$id);
        }
    }

    public function selectStatus(Request $request)
    {
        $id = $request['ticket_id'];
        $ticket = $this->ticket_repository->selectStatus($request->all());
        if ($ticket) {
            flash()->success(config('message.tickets.updated-success'));
            return Redirect('admin/tickets/'.$id);
        }
    }
}
