<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use App\Interfaces\FaqRepositoryInterface;
use Illuminate\Support\Facades\Redirect;

class SubscribeTicketsController extends Controller
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
    	$tickets = $this->ticket_repository->getTicketsByUserId(auth()->guard('admin')->user()->admin_id);
    	$type = 2;
        $categories = $this->ticket_repository->getTypeCategories($type);
    	$priorities = $this->ticket_repository->getAllPriorities();

    	return view('admin.tickets_subscribe.index')->with('tickets', $tickets)->with('categories', $categories)->with('priorities', $priorities);
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

    public function getFaq(Request $request) 
    {
        $faqs = $this->faq_repository->getByType(1);
        return view('admin.aid-faq.index')->with('faqs',$faqs);
    }
}
