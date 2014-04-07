<?php namespace Softservlet\Forum\Repositories;

use Softservlet\Forum\Thread\ThreadInterface;
use Softservlet\Forum\Actor\ActorInterface;

interface ThreadRepositoryInterface
{
	/**
	 * @brief Create a thread, takes as parameter an
	 * array of ActorInterface which has access to specify
	 * thread.
	 *
	 * @param  array $actorsArray - an array of ActorInterface
	 * @param  int $time - you can manually specify the time creation.
	 * We provide this parameter for caching purposes. If the parameter
	 * is -1, the timestamps when the method is called will be taken.
	 *
	 * @return ThreadInterface $object
	 */
	public function create(Array $actors, $time);	
	
	/**
	 * @brief get an array of ActorInterface objects and returns
	 * an array of ThreadInterface objects
	 * 
	 * @param array<ActorInterface> $actors
	 * 
	 * @return array<ThreadInterface> $threads
	 */
	public function findByActors($actors);
	
	/**
	 * @brief same as findByActors except that the parameter is
	 * an unique id of specify thread. It returns an
	 * ThreadInterface object
	 * 
	 * @param <T> $threadId
	 * 
	 * @return ThreadInterface
	 */
	public function findById($threadId);
	
	/**
	 * @brief delete the thread with unique idnetifier equals
	 * with $threadId
	 * 
	 * @param <T> $threadId
	 * 
	 * @return bool 
	 */
	public function delete($threadId);
	
	/**
	 * @brief returns array of instances of ActorInterface 
	 * 
	 * @param ThreadInterface $thread
	 * 
	 * @return Array<ActorInterface>
	 */
	public function getActors(ThreadInterface $thread);
	
	/**
	 * @brief check if there already exists a thread for
	 * this array of ActorsInterface objects
	 * 
	 * @param Array<ActorInterface> $actors
	 * 
	 * @return boolean
	 */
	public function existsByActors(Array $actors);

	/**
	 * @brief check if there exists a thread with specified
	 * id 
	 * 
	 * @param <T> $threadId
	 * 
	 * @return boolean
	 */
	public function existsById($threadId);

	/**
	 * @brief add an actor to specify thread
	 *  
	 * @param ThreadInterface $thread
	 * @param ActorInterface $actor
	 * 
	 * @param return boolean
	 */
	public function addActor(ThreadInterface $thread, ActorInterface $actor);

	/**
	 * @brief remove an actor from a thread
	 * 
	 * @param ThreadInterface $thread
	 * @param ActorInterface $actor
	 * 
	 * @param return boolean
	 */
	public function removeActor(ThreadInterface $thread, ActorInterface $actor);

	/**
	 * @brief check in specify thread if there are an actor registered 
	 * 
	 * @param ThreadInterface $thread
	 * @param ActorInterface $actor
	 * 
	 * @return boolean
	 */
	public function existsActor(ThreadInterface $thread, ActorInterface $actor);
	
}