<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Models\AdminRole;
use App\Repositories\AdminUserRepository;
use App\Service\UploadService;
use App\Repositories\AdminRoleRepository;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class SubAccountController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = 3;
        $admins = DataTables::collection($this->admin_repository->getSubaccount($type, 
            auth()->guard('admin')->user()->admin_id))->make(true);
        $admins = $admins->getData();

        return view('admin.subaccount.list', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = false;
        $roles=$this->admin_role_repository->getByType(3);
        $roles=$this->getAllRole($roles);
        return view('admin.subaccount.form', compact('admin','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $admin_request)
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
        $type=3;
        if($admin = $this->admin_repository->save($input,$type)) 
            flash()->success(config('message.admin.add-success'));
        else flash()->error(config('message.admin.add-error'));
        return redirect()->route('subaccount.index');
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
        $admin = $this->admin_repository->getById($id);
        $roles=$this->admin_role_repository->getByType(3);
        $roles=$this->getAllRole($roles);

        return view('admin.subaccount.form', compact('admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $admin_request, $id)
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
        if($admin = $this->admin_repository->updateById($id, $input)) 
            flash()->success(config('message.admin.update-success'));
        else flash()->error(config('message.admin.update-error'));
        return redirect()->route('subaccount.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->admin_repository->deleteById($id)) {
            flash()->success(config('message.admin.delete-success'));
        } else {
            flash()->error(config('message.admin.delete-error'));
        }
        return redirect()->route('subaccount.index');
    }

    public function getAllRole($roles){
        $role_array=[];
        foreach($roles as $index=>$role){
            $role_array[$role->admin_role_id]=$role->role_name;
        }
        return $role_array;
    }
}
