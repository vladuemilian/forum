<?php namespace Softservlet\Forum\Repositories;

interface ActorRepositoryInterface
{
	/**
	 * @brief - get an instance of an actor
	 * based on his id 
	 * 
	 * @param int $id
	 * 
	 * @return ActorInterface $actor
	 */
	public function find($id);
}