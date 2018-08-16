<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StripeAccount;
use App\Repositories\StripeAccountRepository;
use Illuminate\Support\Facades\Validator;

class StripeAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $stripe_account_repo;

    public function __construct(StripeAccountRepository $stripe_account_repo)
    {
        $this->stripe_account_repo = $stripe_account_repo;
    }

    public function index()
    {
        $stripe_accounts = $this->stripe_account_repo->getAll();
        return view('admin.stripe_account.index')->with('stripe_accounts', $stripe_accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stripe_account.form')->with('stripe_account');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'stripe_account_name' => 'required',
            'publishable_key' => 'required',
            'secret_key' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return Redirect::to('admin/stripe_account/create')->withInput()->withErrors($validator);
        } else {
            $stripe_account=$this->stripe_account_repo->create($request->all());
            if($stripe_account){
                flash()->success("Ajout du nouveau compte stripe avec succès !");
                return Redirect('admin/stripe_account');
            }
        }
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
        $stripe_account = StripeAccount::find($id);
        return view('admin.stripe_account.form',compact('stripe_account'));
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
        $rules = array(
            'stripe_account_name' => 'required',
            'publishable_key' => 'required',
            'secret_key' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $stripe_account=$this->stripe_account_repo->updateById($id,$request->all());
            if($stripe_account){
                flash()->success("Modification du compte stripe avec succès ! ");
                return Redirect('admin/stripe_account');
            }
            return Redirect('admin/stripe_account');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->stripe_account_repo->deleteById($id);
        if ($status) {
            flash()->success("Suppression du compte avec succès !");
        } else {
            flash()->error(config("Erreur de suppression du compte"));
        }
        return redirect()->route('stripe_account.index');
    }
}
