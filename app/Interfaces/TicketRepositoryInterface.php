<?php
/**
 * Created by PhpStorm.
 * User: Arsenaltech
 * Date: 6/24/2017
 * Time: 12:37 AM
 */

namespace App\Interfaces;


interface TicketRepositoryInterface
{
	public function getAll();

	public function getById($id);

	public function store($input);

	public function updateById($id, $input);

	public function deleteById($id);

	public function getByType($type);

	public function storePriorities($input);

	public function updatePriorities($id, $input);

	public function getByIdPriorities($id);

	public function deletePriorities($id);

	public function getAllPriorities();

}