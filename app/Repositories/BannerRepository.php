<?php

namespace App\Repositories;

use App\Interfaces\BannerRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Banner;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Hash;

class BannerRepository implements BannerRepositoryInterface
{
    protected $model;

    public function __construct(Banner $banner)
    {
        $this->model = $banner;
    }

    public function getById($template_id)
    {
        return $this->model->find($template_id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create($input,$image_name)
    {

        $this->model->banner_title = $input['banner_title'];
        $this->model->alt = $input['alt'];
        $this->model->banner_image = $image_name['english_image_name'];
        $this->model->french_banner_image = $image_name['french_image_name'];
        $this->model->is_subbanner = isset($input['is_subbanner']) ? $input['is_subbanner'] : '0';
        $this->model->is_active = isset($input['is_active']) ? $input['is_active'] : '0';
		$this->model->url = $input['banner_url'];
        $this->model->created_by = auth()->guard('admin')->user()->admin_id;
        return $this->model->save();
    }

    public function updateById($id, $input,$image_name)
    {
        $this->model = $this->model->findOrNew($id);
        $this->model->banner_title = $input['banner_title'];
		$this->model->alt = $input['alt'];
        if(!empty($image_name['english_image_name'])){
        $this->model->banner_image = $image_name['english_image_name'];
        }
        if(!empty($image_name['french_image_name'])){
            $this->model->french_banner_image = $image_name['french_image_name'];
        }
        $this->model->is_subbanner = isset($input['is_subbanner']) ? $input['is_subbanner'] : '0';;
        $this->model->is_active = isset($input['is_active']) ? $input['is_active'] : '0';
		$this->model->url = $input['banner_url'];
		$this->model->created_by = auth()->guard('admin')->user()->admin_id;
        return $this->model->save();
    }

    public function deleteById($id)
    {
        return $this->model->find($id)->delete();
    }

    public function getActiveBanner()
    {
        return $this->model->whereIsActive(1)->whereIsSubbanner(0)->orderBy('banner_id', 'DESC')->limit(5)->get();
    }

    public function getSubBanner()
    {
        return $this->model->whereIsActive(1)->whereIsSubbanner(1)->orderBy('banner_id', 'DESC')->limit(5)->get();
    }
}