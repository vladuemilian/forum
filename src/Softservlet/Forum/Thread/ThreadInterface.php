<?php namespace Softservlet\Forum\Thread;

use Softservlet\Forum\Actor\ActorInterface;

interface ThreadInterface
{

	/**
	 * @brief - retrieve the latest messages from 
	 * this thread
	 * 
	 * @param int $limit
	 * @param int $offset
	 * 
	 * @return array<MessageInterface> $messages
	 */
	public function get($limit, $offset);
	
	/**
	 * @brief - search for a specify text in 
	 * messages array list
	 * 
	 * @param array $keywords
	 * @param int $limit 
	 * @param int $offset
	 * 
	 * @return array<MessageInterface> $messages
	 */
	public function search(Array $keywords, $limit, $offset);
	
	/**
	 * @brief returns an array of ActorInterface objects
	 * 
	 * @return array<ActorInterface> $actors
	 */
	public function getActors();

	/**
	 * @brief returns the id of the thread
	 * 
	 * @return int - unique id of the thread
	 */
	public function getId();

	/**
	 * @brief gives rights to an actor for this specify
	 * thread.
	 * 
	 * @param ActorInterface $actor
	 * 
	 * @return bool
	 */
	public function addActor(ActorInterface $actor);

	/**
	 * @brief as opposite of addActor, it will remove the
	 * actor from thread. 
	 * 
	 * @param ActorInterface $actor
	 * 
	 * @return bool
	 */
	public function removeActor(ActorInterface $actor);
	
	/**
	 * @brief verify if the specify actor has rights in
	 * this thread
	 * 
	 * @return bool
	 */
	public function exists(ActorInterface $actor);
	

}