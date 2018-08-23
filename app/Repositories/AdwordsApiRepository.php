<?php

namespace App\Repositories;


use App\Models\AdwordsApi;

class AdwordsApiRepository
{
	protected $model;

	public function __construct(AdwordsApi $api)
	{
		$this->model = $api;
	}

	public function getAllByUser($user)
	{
		return $this->model->where('admin_id',$user)->orderBy('adwords_api_id')->get();
	}

	public function getById($id)
	{
		return $this->model->where('adwords_api_idid', $id)->first();
	}

	public function store($input)
	{
		try {
			$this->model->name = $input['name'];
			$this->model->adwords_developper_token = $input['adwords_developper_token'];
			$this->model->adwords_client_id = $input['adwords_client_id'];
			$this->model->adwords_client_secret = $input['adwords_client_secret'];
			$this->model->adwords_client_refresh_token = $input['adwords_client_refresh_token'];
			$this->model->adwords_client_customer_id = $input['adwords_client_customer_id'];
			$this->model->adwords_user_agent = $input['adwords_user_agent'];
			$this->model->admin_id = $input['admin_id'];
			$this->model->is_default = isset($input['is_default']) ? $input['is_default'] : '0';
			$this->model->save();
			return $this->model;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function updateById($id, $input)
	{
		try {
			$this->model = $this->model->findOrNew($id);
			$this->model->name = $input['name'];
			$this->model->adwords_developper_token = $input['adwords_developper_token'];
			$this->model->adwords_client_id = $input['adwords_client_id'];
			$this->model->adwords_client_secret = $input['adwords_client_secret'];
			$this->model->adwords_client_refresh_token = $input['adwords_client_refresh_token'];
			$this->model->adwords_client_customer_id = $input['adwords_client_customer_id'];
			$this->model->adwords_user_agent = $input['adwords_user_agent'];
			$this->model->admin_id = $input['admin_id'];
			$this->model->is_default = isset($input['is_default']) ? $input['is_default'] : '0';
			$this->model->save();
			return $this->model;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function deleteById($id)
	{
		return $this->model->destroy($id);
	}

}