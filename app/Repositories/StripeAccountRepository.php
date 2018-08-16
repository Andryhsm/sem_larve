<?php

namespace App\Repositories;

use App\StripeAccount;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\StripeAccountRepositoryInterface;

class StripeAccountRepository
{
    protected $model;

    public function __construct(StripeAccount $stripe_account)
    {
        $this->model = $stripe_account;
    }

    public function getById($stripe_account_id)
    {
        return $this->model->find($stripe_account_id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create($input)
    {   
        if(isset($input['is_active']) && $input['is_active']==1)
            $this->desactiveAllStripeAccount();
        $this->model->stripe_account_name = $input['stripe_account_name'];
        $this->model->publishable_key = $input['publishable_key'];
        $this->model->secret_key = $input['secret_key'];
        $this->model->is_active = isset($input['is_active']) ? $input['is_active'] : 0;
        return $this->model->save();
    }

    public function updateById($id, $input)
    {
        if(isset($input['is_active']) && $input['is_active']==1)
            $this->desactiveAllStripeAccount();
        $this->model = $this->model->findOrNew($id);
        $this->model->stripe_account_name = $input['stripe_account_name'];
		$this->model->publishable_key = $input['publishable_key'];
        $this->model->secret_key = $input['secret_key'];
        $this->model->is_active = $input['is_active'];
        return $this->model->save();
    }

    public function deleteById($id)
    {
        return $this->model->find($id)->delete();
    }

    public function getActiveStripeAccount()
    {
        return $this->model->whereIsActive(1)->get()->first();
    }

    private function desactiveAllStripeAccount()
    {
        StripeAccount::where('is_active', 1)->update(['is_active' => 0]);
    }
}