<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Models\AdminRole;
use App\Repositories\AdminUserRepository;
use App\Service\UploadService;
use App\Repositories\AdminRoleRepository;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Facades\Datatables;

class AdminUserController extends Controller
{
	protected $admin_repository;
	protected $upload_service;
	protected $admin_role_repository;

	public function __construct(AdminUserRepository $admin_repo,UploadService $uploadservice,AdminRoleRepository $admin_role_repository)
	{
		$this->admin_repository = $admin_repo;
		$this->upload_service = $uploadservice;
		$this->admin_role_repository = $admin_role_repository;

	}

	public function index()
	{
		$type = 1;
		$admins = Datatables::collection($this->admin_repository->get($type))->make(true);
		$admins = $admins->getData();
		return view('admin.administrator.list', compact('admins'));

	}

	public function store(AdminUserRequest $admin_request)
	{
		$image_name = null;
		if ($admin_request->hasFile('profile_image')) {
			$file = $admin_request->file('profile_image');
			try {
				$image_name = $this->upload_service->upload($file, 'upload/profile');
			} catch (\Exception $e) {
				flash()->error($e->getMessage());
				return Redirect::back();
			}
		}
		$input = $admin_request->all();
		$input['image_name'] = $image_name;
		$type=1;
		if($admin = $this->admin_repository->save($input,$type)) 
			flash()->success(config('message.admin.add-success'));
		else flash()->error(config('message.admin.add-error'));
		return redirect()->route('administrator');
	}

	public function create()
	{
		$admin = false;
        $roles=$this->admin_role_repository->getByType(1);
        $roles=$this->getAllRole($roles);
		return view('admin.administrator.form', compact('admin','roles'));
	}

	public function edit($admin_id)
	{
		$admin = $this->admin_repository->getById($admin_id);
        $roles=$this->admin_role_repository->getByType(1);
        $roles=$this->getAllRole($roles);

		return view('admin.administrator.form', compact('admin','roles'));
	}

	public function update($admin_id, AdminUserRequest $admin_request)
	{
        $image_name='';
		if ($admin_request->hasFile('profile_image')) {
			$file = $admin_request->file('profile_image');
			try {
				$image_name = $this->upload_service->upload($file, 'upload/profile');
			} catch (\Exception $e) {
				flash()->error($e->getMessage());
				return Redirect::back();
			}
		}
		$input = $admin_request->all();
		if ($image_name) {
			$input['image_name'] = $image_name;
		}
		if($admin = $this->admin_repository->updateById($admin_id, $input)) 
			flash()->success(config('message.admin.update-success'));
		else flash()->error(config('message.admin.update-error'));
		return redirect()->route('administrator');
	}

	public function destroy($admin_id)
	{
		if ($this->admin_repository->deleteById($admin_id)) {
			flash()->success(config('message.admin.delete-success'));
		} else {
			flash()->error(config('message.admin.delete-error'));
		}
		return redirect()->route('administrator');
	}

    public function getAllRole($roles){
        $role_array=[];
        foreach($roles as $index=>$role){
            $role_array[$role->admin_role_id]=$role->role_name;
        }
        return $role_array;
    }
}
