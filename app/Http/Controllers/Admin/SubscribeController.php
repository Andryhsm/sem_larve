<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AdminUserRepositoryInterface;
use App\Interfaces\FaqRepositoryInterface;
use App\User;
use App\UserAddress;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Input;
use PDF;

class SubscribeController extends Controller
{
     protected $admin_repository;
    protected $faq_repository;

    public function __construct(AdminUserRepositoryInterface $admin_repository, FaqRepositoryInterface $faqRepository)
    {
        $this->admin_repository = $admin_repository;
        $this->faq_repository = $faqRepository;
    }
    public function index(){
        return view('front.customer.dashboard.index');
    }

   

    public function postManageAccount(Request $request)
    {
        $user = Auth::user();
        $user->first_name=\Input::get('first_name');
        $user->last_name=\Input::get('last_name');
        $user->email=\Input::get('email');
        $user->phone_number = Input::get('phone');
        $user->radius = Input::get('radius');
        $user->civility = Input::get('civility');
        $user->language_id = Input::get('language');
        if ($user->save(User::$manage_account_rules)) {
            if(Input::has('zip')){
                $user_address = ($user->address != null && count($user->address) > 0) ?  $user->address : new UserAddress();
                $user_address->first_name = Input::get('first_name');
                $user_address->last_name = Input::get('last_name');
                $user_address->phone = Input::get('phone');
                $user_address->zip = Input::get('zip');
                add_area_in_cookie(Input::get('zip'), Input::get('radius'));
                $user->address()->save($user_address);
            }
            \Session::flash('message.success', 'Account updated successfully.');
            return \Redirect::to("customer/customer-informations");
        } else {
            \Session::flash('message.arrayErrors', $user->errors()->all());
            return \Redirect::to('customer')->withInput($request->all());
        }
    }

    public function postResetPassword()
    {
        $user = Auth::user();
        $user->password=Hash::make(Input::get('password'));
        $user->save();
        \Session::flash('message.success', 'Password updated successfully.');
        flash()->success('Password updated successfully.');
        return \Redirect::to("customer");
    }


    public function getDashboard() {
        return view('front.customer.dashboard.index');
    }   
    
    public function getCustomerInformations(){
        $user_id = auth()->guard;
        dd($user_id);
        $customer = $this->admin_repository->getById($user_id);
        return view('admin.customer_informations.index', compact('customer'));
    }
 

    public function updatePassword(Request $request){
        
        $oldPass = $request['old_password'];
        $newPass = Hash::make($request['new_password']);
        
        $hashedPassword = auth()->user()->password;

        if(Hash::check($oldPass, $hashedPassword)) {
            $user = Auth::user();
            $user->password=$newPass;
            $user->save();
            return response()->json(['success'=> true,'message' => 'Mot de passe modifié avec succès']);
        }else{
            return response()->json(['success'=> false,'message' => 'Vérifier votre ancien mot de passe']);
        }   
    }

    public function getFaq()
    {
        $faqs = $this->faq_repository->getByType(1);
        return view('front.customer.aid_faq.index',compact('faqs'));
    }
}
