<?php

namespace App\Interfaces;

interface BrandRepositoryInterface
{
    public function create($input, $image_name);

    public function update($id, $input, $image_name);

    public function get();

    public function getAll();

    public function getAllBrand();

	public function lists();
}