<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use App\Interfaces\FaqRepositoryInterface;
use Illuminate\Support\Facades\Redirect;

class TicketsController extends Controller
{
	protected $ticket_repository;
    protected $faq_repository;

    public function __construct(TicketRepository $ticket_repository, FaqRepositoryInterface $faqRepository)
    {
    	$this->ticket_repository = $ticket_repository;
        $this->faq_repository = $faqRepository;
    }

    public function index()
    {
    	$tickets = $this->ticket_repository->getTicketsByUserId(auth()->user()->user_id);
    	$type = 2;
        $categories = $this->ticket_repository->getTypeCategories($type);
    	$priorities = $this->ticket_repository->getAllPriorities();
        $faqs = $this->faq_repository->getByType(1);

    	return view('front.customer.tickets.index')->with('tickets', $tickets)->with('categories', $categories)->with('priorities', $priorities)->with('faqs',$faqs);
    }

    public function store(Request $request)
    {
    	try {
    		$this->ticket_repository->storeTicket($request->all());
    		flash()->success(config('message.tickets.add-success'));
    	} catch (Exception $e) {
    		dd($e->getMessage());
    		flash()->success(config('message.tickets.add-error'));
    	}
    	return Redirect::back();
    }

    public function addComment(Request $request)
    {
    	$response = false;
    	\Log::debug($request->all());
    	try {
    		$this->ticket_repository->saveComment($request->all());
    		$response = true;
    	} catch (Exception $e) {
    		$response = false;
    		\Log::debug($e->getMessage());
    	}
    	return response()->json(['success' => true, 'data' => $response]);
    }
}
