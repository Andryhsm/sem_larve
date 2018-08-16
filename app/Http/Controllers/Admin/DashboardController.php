<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	protected $user_repository;

	public function __construct(UserRepositoryInterface $userRepositoy)
	{
		$this->user_repository = $userRepositoy;
	}

	public function index()
    {
		return view('admin.dashboard.index');
    }
}
