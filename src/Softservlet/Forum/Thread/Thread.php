<?php namespace Softservlet\Forum\Thread;

use Softservlet\Forum\Repositories\MessageRepositoryInterface;
use Softservlet\Forum\Actor\ActorInterface;
use Softservlet\Forum\Repositories\ThreadRepositoryInterface;

class Thread implements ThreadInterface
{
	
	private $id;
	private $messageRepository;
	private $actorRepository;
		
	public function __construct($id, MessageRepositoryInterface $messageRepository, ThreadRepositoryInterface $threadRepository)
	{
		$this->id = $id;
		$this->messageRepository = $messageRepository;		
		$this->threadRepository = $threadRepository;
	}
	
	/**
	 * @brief - retrieve the latest messages from
	 * this thread
	 *
	 * @param int $limit
	 * @param int $offset
	 *
	 * @return array<MessageInterface> $messages
	 */
	public function get($limit = 10, $offset = 0)
	{
		return $this->messageRepository->get($this, $limit, $offset);
	}
	
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
	public function search(Array $keywords, $limit = 10, $offset = 0)
	{
		return $this->messageRepository->search($this, $keyowrds, $limit, $offset);
	}
	
	/**
	 * @brief returns an array of ActorInterface objects
	 *
	 * @return array<ActorInterface> $actors
	*/
	public function getActors()
	{
		return $this->threadRepository->getActors($this);
	}
	
	/**
	 * @brief returns the id of the thread
	 *
	 * @return int - unique id of the thread
	*/
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @brief gives rights to an actor for this specify
	 * thread.
	 *
	 * @param ActorInterface $actor
	 *
	 * @return bool
	*/
	public function addActor(ActorInterface $actor)
	{
		return $this->threadRepository->addActor($this, $actor);
	}
	
	/**
	 * @brief as opposite of addActor, it will remove the
	 * actor from thread.
	 *
	 * @param ActorInterface $actor
	 *
	 * @return bool
	*/
	public function removeActor(ActorInterface $actor)
	{
		return $this->threadRepository->removeActor($this, $actor);
	}
	
	/**
	 * @brief verify if the specify actor has rights in
	 * this thread
	 *
	 * @return bool
	*/
	public function exists(ActorInterface $actor)
	{
		return $this->threadRepository->existsActor($this, $actor);
	}
	
}