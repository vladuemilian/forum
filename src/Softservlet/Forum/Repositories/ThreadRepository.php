<?php namespace Softservlet\Forum\Repositories;

use DB;
use Softservlet\Forum\Thread\ThreadInterface;
use Softservlet\Forum\Repositories\ActorRepositoryInterface;
use Softservlet\Forum\Repositories\ThreadRepositoryInterface;
use Softservlet\Forum\Thread\Thread;

use Softservlet\Forum\Exception\ThreadFindByActorsNotExists;
use Softservlet\Forum\Exception\ThreadExistsByActorsInvalidParameter;
use Softservlet\Forum\Actor\ActorInterface;

class ThreadRepository implements ThreadRepositoryInterface
{
	private $actorRepository;
	private $messageRepository;
	
	public function __construct(ActorRepositoryInterface $actorRepository, MessageRepositoryInterface $messageRepository)
	{
		$this->actorRepository = $actorRepository;
		$this->messageRepository = $messageRepository;
	}
	
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
	public function create(Array $actors, $time = -1)
	{
		if($time == -1)
		{
			$time = time();
		}
		
		$threadId = DB::table('threads')->insertGetId(array('created'	=> $time));
		
		return new Thread($threadId, $this->messageRepository, $this);
	}
	
	/**
	 * @brief get an array of ActorInterface objects and returns
	 * an array of ThreadInterface objects
	 *
	 * @param array<ActorInterface> $actors
	 *
	 * @return ThreadInterface $thread
	*/
	public function findByActors($actors)
	{	
	
		$threadSql = DB::table('threads_actors');
		
		foreach($actors as $id)
		{
			$threadSql->where('actor_id', $id);
		}
		
		$threadSql = $threadSql->join('threads', 'threads_actors.thread_id', '=', 'threads.id')->first();
		
		if($threadSql == null)
		{
			throw new ThreadFindByActorsNotExists();	
		}	
		
		return new Thread($threadSql->thread_id, $this->messageRepository);
	}
	
	/**
	 * @brief same as findByActors except that the parameter is
	 * an unique id of specify thread. It returns an
	 * ThreadInterface object
	 *
	 * @param <T> $threadId
	 *
	 * @return ThreadInterface
	*/
	public function findById($threadId)
	{
			$thread = DB::table('threads')->where('id', $threadId)->first();
			return Thread($thread->id, $this->messageRepository);
	}
	
	/**
	 * @brief delete the thread with unique idnetifier equals
	 * with $threadId
	 *
	 * @param <T> $threadId
	 *
	 * @return bool
	*/
	public function delete($threadId)
	{
		DB::table('threads')->where('id', $threadId)->delete();		
	}
	
	/**
	 * @brief returns array of instances of ActorInterface
	 *
	 * @param ThreadInterface $thread
	 * @param int $limit
	 *
	 * @return Array<ActorInterface>
	 */
	public function getActors(ThreadInterface $thread)
	{
		$actors = array();
		
		$actors_ids = DB::table('threads_actors')->get();	
		foreach($actors_ids as $id)
		{
			$actor = $this->actorRepository->find($id);
			$actors[] = $actor;
		}
		
		return $actors;
	}
	
	/**
	 * @brief check if there already exists a thread for
	 * this array of ActorsInterface objects
	 *
	 * @param Array<ActorInterface> $actors
	 *
	 * @return boolean
	 */
	public function existsByActors(Array $actors)
	{
		$qry = DB::table('threads_actors');
		foreach($actors as $actor)
		{
			if( !(ActorInterface instanceof $actor) )
			{
				throw new ThreadExistsByActorsInvalidParameter;
			}
			$qry->where('actor_id', $actor);
		}		
		if($qry->first() == null)
		{
			return false;
		}
		return true;
	}
	
	/**
	 * @brief check if there exists a thread with specified
	 * id
	 *
	 * @param <T> $threadId
	 *
	 * @return boolean
	*/
	public function existsById($threadId)
	{
		$qry = DB::table('threads')->where('id', $threadId)->first();
		if($qry == null)
		{
			return false;
		}
		return true;
	}
	
	
	/* (non-PHPdoc)
	 * @see \Softservlet\Forum\Repositories\ThreadRepositoryInterface::addActor()
	 */
	public function addActor(ThreadInterface $thread, ActorInterface $actor)
	{
		return DB::table('threads_actors')->insert(
			array
			(
				'thread_id'		=> $thread->getId(),
				'actor_id'		=> $actor->getId()	
			)
		);
	}

	/* (non-PHPdoc)
	 * @see \Softservlet\Forum\Repositories\ThreadRepositoryInterface::removeActor()
	 */
	public function removeActor(ThreadInterface $thread, ActorInterface $actor)
	{
		return DB::table('threads_actors')->
		where('thread_id', $thread->getId())->
		where('actor_id', $actor->getId())->
		delete();
	}

	/* (non-PHPdoc)
	 * @see \Softservlet\Forum\Repositories\ThreadRepositoryInterface::existsActor()
	 */
	public function existsActor(ThreadInterface $thread, ActorInterface $actor)
	{
		$result = DB::table('threads_actors')->
		where('thread_id', $thread->getId())->
		where('actor_id', $actor->getId())->
		first();
		
		return $result != null;
	}
}