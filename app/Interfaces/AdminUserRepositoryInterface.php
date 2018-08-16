<?php
namespace App\Interfaces;

interface AdminUserRepositoryInterface
{
	public function update($id, $input, $image_name);

	public function get($type);

	public function getById($admin_id);

	public function save($input, $type);

	public function deleteById($admin_id);

	public function updateById($admin, $input);

	public function getByRole();
}