<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
	protected $order_item_repository;

	public function __construct()
	{

	}

	public function index()
	{
/*		$items = $this->order_item_repository->getAllBookedItems();
    	return view('admin.account.list',compact('items'));
*/	}

	public function show($id)
	{
/*		$item = $this->order_item_repository->getBookedItemById($id);
		return view('admin.account.show',compact('item'));
*/	}
}
