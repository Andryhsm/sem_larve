<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Statuses;
use App\Repositories\TicketRepository;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $ticket_repository;

    public function __construct(TicketRepository $ticket_repository)
    {
        $this->ticket_repository = $ticket_repository;
    }

    public function index()
    {
        $statuses = $this->ticket_repository->getAllStatuses();
        return view('admin.tickets.statuses.index')->with('statuses', $statuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = null;
        return view('admin.tickets.statuses.form')->with('statuses', $statuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required',
            'name_fr' => 'required',
            'color'     => 'required',
        ]);

        //Store status ticketing in database
        try{
            $this->ticket_repository->storeStatuses($request->all());
        }catch(\Exception $e){ 
            return flash()->error("Enregistrement non succès! ");
        }
        /*$statuses = \Cache::remember('statuses', 60, function () {
            return Statuses::all();
        });*/
        flash()->success("Enregistrement avec success!");
        return redirect()->route('statuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $statuses = \Cache::remember('statuses', 60, function () {
            return Statuses::all();
        });

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statuses = $this->ticket_repository->getStatusesById($id);
        return view('admin.tickets.statuses.form')->with('statuses', $statuses);
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
        $this->validate($request, [
            'name_en' => 'required',
            'name_fr' => 'required',
            'color'     => 'required',
        ]);

        try {
            $this->ticket_repository->updateStatusesById($id, $request->all());
        } catch (Exception $e) {
            return flash()->error("Erreur de modification");
        }
        flash()->success("Modification avec succès !");
        return redirect()->route('statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{
            $this->ticket_repository->deleteStatuses($id, $request->all());
            flash()->success("Enregistrement avec succès! ");
        }catch(\Exception $e){ 
            flash()->error("Enregistrement non succès! ");
        }
        return redirect()->route('statuses.index');
    }
}
