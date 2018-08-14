<?php

namespace App\Repositories;

use App\Models\Priorities;
use App\Models\PrioritiesTranslation;
use App\Models\Statuses;
use App\Models\StatusesTranslation;
use App\Models\Categories;
use App\Models\CategoriesTranslation;
use App\Models\Ticketit;
use App\Models\TicketitComments;
use Illuminate\Support\Facades\Auth;

class TicketRepository
{
	protected $modelPriorities;
	protected $modelCategories;
	protected $modelStatuses;
	protected $modelTicketit;
	protected $modelComments;

	public function __construct(Priorities $priorities,Categories $categories, Statuses $statuses, Ticketit $ticketit, TicketitComments $comms)
	{
		$this->modelPriorities = $priorities;
		$this->modelCategories = $categories;	
		$this->modelStatuses = $statuses;	
		$this->modelTicketit = $ticketit;
		$this->modelComments = $comms;
	}

	public function getAll()
	{
		return $this->modelTicketit::with('category','priority','status','category.french','priority.french','status.french','category.english','priority.english','status.english','user','admin','comments','comments.user','comments.admin')->orderby('id','desc')->get();
	}

	public function getById($id)
	{
		return Ticketit::with('category','priority','status','category.french','priority.french','status.french','category.english','priority.english','status.english')->where('id',$id)->get()->first();
	}

	public function getTicketsByUserId($user_id)
	{
		return Ticketit::with('category', 'priority', 'status')->where('user_id', $user_id)->orderby('id','desc')->get();
	}

	public function defaultStatus()
	{
		$default = $this->modelStatuses::with('english','french')->where('is_default',1)->first();
		if($default)
			return $default;
		else
			return $this->modelStatuses->get()->first();
	}

	public function store($input)
	{
		$default_statuses = $this->defaultStatus();
		/*dd($default_statuses);*/
		$this->modelTicketit->subject = $input['subject'];
		$this->modelTicketit->content = $input['content'];
		$this->modelTicketit->priority_id = $input['priority'];
		$this->modelTicketit->category_id = $input['category'];
		$this->modelTicketit->user_id = auth()->guard('admin')->user()->admin_id;
		$this->modelTicketit->status_id = $default_statuses->id;
		$this->modelTicketit->save();
		return $this->modelTicketit;
	}

	public function updateById($id, $input)
	{
		$ticket = $this->modelTicketit->findOrNew($id);
		$ticket->subject = $input['subject'];
		$ticket->content = $input['content'];
		$ticket->priority_id = $input['priority'];
		$ticket->category_id = $input['category'];
		$ticket->save();
		return $ticket;
	}

	public function storeContact($input)
	{
		$category = $this->getByIdCategories($input['subject']);
		$ticket = new Ticketit();
		$ticket->type = "Contact";
		$ticket->subject = $category->english->name;
		$ticket->content =  $input['message'];
		$ticket->priority_id = null;
		$ticket->user_id = null;
		$ticket->name = $input['name'];
		$ticket->email = $input['email'];
		$ticket->category_id = $input['subject'];
		$ticket->status_id = null;
		$ticket->save();
		return $ticket;	
	}

	public function storeTicket($input)
	{
		$ticket = new Ticketit();
		$ticket->type = "Ticket";
		$ticket->subject = $input['subject'];
		$ticket->content =  $input['content'];
		$ticket->priority_id = $input['priority_id'];
		$ticket->user_id = auth()->user()->user_id;
		$ticket->name = auth()->user()->first_name.' '.auth()->user()->last_name;
		$ticket->email = auth()->user()->email;
		$ticket->category_id = $input['category_id'];
		$ticket->status_id = $this->defaultStatus()->id;
		$ticket->save();
		return $ticket; 
	}

	public function deleteById($id)
	{
		return $this->modelTicketit->find($id)->delete();
	}

	public function reOpenTicket($input)
	{
		$default_statuses = $this->modelStatuses::where('is_default',1)->first();
		$ticket = $this->modelTicketit->findOrNew($input['ticket_id']);
		$ticket->status_id = $default_statuses->id;
		$ticket->save();
		return $ticket;

	}

	public function selectStatus($input)
	{
		$ticket = $this->modelTicketit->findOrNew($input['ticket_id']);
		$ticket->status_id = $input['status_id'];
		$ticket->save();
		return $ticket;

	}

	//Properties fonctionality
	public function storePriorities($input)
	{
		$this->modelPriorities->color = $input['color'];
		$this->modelPriorities->save();

		if(isset($input['name_en']) && !empty($input['name_en'])){
			$translation = new PrioritiesTranslation();
			$translation->name = $input['name_en'];
			$translation->language_id = '1';
			$this->modelPriorities->translation()->save($translation);
		}

		if(isset($input['name_fr']) && !empty($input['name_fr'])){
			$translation = new PrioritiesTranslation();
			$translation->name = $input['name_fr'];
			$translation->language_id = '2';
			$this->modelPriorities->translation()->save($translation);
		}

		return $this->modelPriorities;
	}
	
	public function updatePriorities($id, $input)
	{
		$priority = $this->modelPriorities->findOrNew($id);
		$priority->color = $input['color'];
		$priority->save();

		if(isset($input['name_en']) && !empty($input['name_en'])){
			PrioritiesTranslation::updateOrCreate(['priority_id'=>$id,'language_id'=>'1'],
				['name'=>$input['name_en'],'language_id'=>'1']
			);
		}
		if(isset($input['name_fr']) && !empty($input['name_fr'])){
			PrioritiesTranslation::updateOrCreate(['priority_id'=>$id,'language_id'=>'2'],
				['name'=>$input['name_fr'],'language_id'=>'2']
			);
		}

		return $priority;
	}

	public function getByIdPriorities($id)
    {
        return Priorities::with('english','french')->where('id',$id)->get()->first();
    }

	public function deletePriorities($id){
		return $this->modelPriorities->find($id)->delete();
	}

	public function getAllPriorities()
    {
        return $this->modelPriorities::with('english','french')->get();
    }

    //Categories fonctionnality
    public function storeCategories($input)
	{
		$this->modelCategories->color = $input['color'];
		$this->modelCategories->type = $input['type'];
		$this->modelCategories->save();

		if(isset($input['name_en']) && !empty($input['name_en'])){
			$translation = new CategoriesTranslation();
			$translation->name = $input['name_en'];
			$translation->language_id = '1';
			$this->modelCategories->translation()->save($translation);
		}

		if(isset($input['name_fr']) && !empty($input['name_fr'])){
			$translation = new CategoriesTranslation();
			$translation->name = $input['name_fr'];
			$translation->language_id = '2';
			$this->modelCategories->translation()->save($translation);
		}

		return $this->modelCategories;
	}
	
	public function updateCategories($id, $input)
	{
		$category = $this->modelCategories->findOrNew($id);
		$category->color = $input['color'];
		$category->type = $input['type'];
		$category->save();

		if(isset($input['name_en']) && !empty($input['name_en'])){
			CategoriesTranslation::updateOrCreate(['category_id'=>$id,'language_id'=>'1'],
				['name'=>$input['name_en'],'language_id'=>'1']
			);
		}
		if(isset($input['name_fr']) && !empty($input['name_fr'])){
			CategoriesTranslation::updateOrCreate(['category_id'=>$id,'language_id'=>'2'],
				['name'=>$input['name_fr'],'language_id'=>'2']
			);
		}

		return $category;
	}

	public function getByIdCategories($id)
    {
        return Categories::with('english','french')->where('id',$id)->get()->first();
    }

	public function deleteCategories($id){
		return $this->modelCategories->find($id)->delete();
	}

	public function getTypeCategories($type)
    {
    	$tc = 3;
        return $this->modelCategories::with('english','french')->where('type',$type)->orwhere('type',$tc)->get();
    }

    public function getAllCategories()
    {
        return $this->modelCategories::with('english','french')->get();
    }

    public function getStatusesById($id)
    {
    	return Statuses::with('english','french')->where('id', $id)->get()->first();
    }

    public function storeStatuses($input)
    {
    	if(isset($input['is_default']) && $input['is_default'] == 1){
    		Statuses::where('is_default', 1)->update(['is_default' => 0]);
    	}
    	$this->modelStatuses = new Statuses();
    	$this->modelStatuses->color = $input['color'];
    	$this->modelStatuses->is_default = (isset($input['is_default'])) ? $input['is_default'] : 0;
    	$this->modelStatuses->save();

    	if(isset($input['name_en']) && !empty($input['name_en'])){
			$translation = new StatusesTranslation();
			$translation->name = $input['name_en'];
			$translation->language_id = '1';
			$this->modelStatuses->translation()->save($translation);
		}

		if(isset($input['name_fr']) && !empty($input['name_fr'])){
			$translation = new StatusesTranslation();
			$translation->name = $input['name_fr'];
			$translation->language_id = '2';
			$this->modelStatuses->translation()->save($translation);
		}
    }

    public function updateStatusesById($id, $input)
    {
    	if(isset($input['is_default']) && $input['is_default'] == 1){
    		Statuses::where('is_default', 1)->update(['is_default' => 0]);
    	}
    	$statuses = $this->modelStatuses->findOrNew($id);
    	$statuses->color = $input['color'];
    	$statuses->is_default = (isset($input['is_default'])) ? $input['is_default'] : 0;
    	$statuses->save();

    	if(isset($input['name_en']) && !empty($input['name_en'])){
			StatusesTranslation::updateOrCreate(['status_id'=>$id,'language_id'=>'1'],
				['name'=>$input['name_en'],'language_id'=>'1']
			);
		}
		if(isset($input['name_fr']) && !empty($input['name_fr'])){
			StatusesTranslation::updateOrCreate(['status_id'=>$id,'language_id'=>'2'],
				['name'=>$input['name_fr'],'language_id'=>'2']
			);
		}
    }

    public function deleteStatuses($id, $input)
    {
    	return $this->modelStatuses->find($id)->delete();
    }

    public function getAllStatuses()
    {
    	return $this->modelStatuses::with('english','french')->get();
    }

    //Comments
    public function sendComment($input){
    	$this->modelComments = new TicketitComments();
    	$this->modelComments->content = $input['content'];
    	$this->modelComments->user_id = auth()->guard('admin')->user()->admin_id;
    	$this->modelComments->ticket_id = $input['ticket_id'];
    	$this->modelComments->type_compte = 2;

    	$this->modelComments->save();
    	return $this->modelComments;
    }

    public function saveComment($input){
    	$this->modelComments = new TicketitComments();
    	$this->modelComments->content = urldecode($input['content']);
    	$this->modelComments->user_id = auth()->user()->user_id;
    	$this->modelComments->ticket_id = $input['ticket_id'];
    	$this->modelComments->type_compte = 1;

    	$this->modelComments->save();
    }
}