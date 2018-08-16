<?php

namespace App\Http\Controllers\admin;

use App\Interfaces\RegionRepositoryInterface;
use App\Models\Admin;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Models\AdminRole;
use App\Repositories\AdminRoleRepository;
use App\Repositories\AdminUserRepository;
use App\Repositories\UserRepository;
use App\Service\UploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use Session;
use Redirect;

class UserController extends Controller
{
    protected $admin_user_repository;
    protected $upload_service;
    protected $user_repository;
	protected $region_repository;
    protected $admin_role_repository;

    public function __construct(AdminUserRepository $admin_user_repository, UploadService $upload_service,
								UserRepository $user_repository,
								RegionRepositoryInterface $region_repo,AdminRoleRepository $admin_role_repository
								)
    {
        $this->admin_user_repository = $admin_user_repository;
        $this->user_repository = $user_repository;
        $this->upload_service = $upload_service;
		$this->region_repository = $region_repo;
        $this->admin_role_repository = $admin_role_repository;
    }

    public function index(Request $request)
    {
        $type = 2;
        $admins = Datatables::collection($this->admin_user_repository->get($type))->make(true);
        $admins = $admins->getData();
        return view('admin.user.list', compact('admins'));
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
        $type=2;
        $admin = $this->admin_user_repository->save($input,$type);
        flash()->success(config('message.admin.add-success'));
        return redirect()->route('customer.index');      

    }

    public function create(Request $request)
    {
        $admin = false;
        $roles=$this->admin_role_repository->getByType(2);
        $roles=$this->getAllRole($roles);
        return view('admin.user.form', compact('admin','roles'));
    }

    public function show()
    {
        $user = Admin::get()->first();
        return view('admin.user.profile', compact('user'));
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
        $admin = $this->admin_user_repository->updateById($admin_id, $input);
        flash()->success(config('message.admin.update-success'));
        return redirect()->route('profile');
    }

    public function edit($admin_id)
    {
        $admin = $this->admin_user_repository->getById($admin_id);
        $roles=$this->admin_role_repository->getByType(2);
        $roles=$this->getAllRole($roles);

        return view('admin.user.form', compact('admin','roles'));
    }

    public function destroy($admin_id)
    {
        if ($this->admin_user_repository->deleteById($admin_id)) {
            flash()->success(config('message.admin.delete-success'));
        } else {
            flash()->error(config('message.admin.delete-error'));
        }
        return redirect()->route('customer.index');

    }
    public function getAllRole($roles){
        $role_array=[];
        foreach($roles as $index=>$role){
            $role_array[$role->admin_role_id]=$role->role_name;
        }
        return $role_array;
    }
}
