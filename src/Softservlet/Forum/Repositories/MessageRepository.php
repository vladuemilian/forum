<?php namespace Softservlet\Forum\Repositories;

use Softservlet\Forum\Thread\ThreadInterface;
use DB;
use Softservlet\Forum\Message\Message;
use Softservlet\Forum\Actor\ActorInterface;

//todo object pool of actors
class MessageRepository implements MessageRepositoryInterface
{
	private $actorRepository;
	private $threadRepository;
	
	public function __construct(ActorRepositoryInterface $actorRepository)
	{
		$this->actorRepository = $actorRepository;		
	}
	
	/**
	 * @brief get the messages from a thread
	 *
	 * @param int $limit
	 * @param int $offset
	 * 
 	 * @return array<Message> $array
	 */
	public function get(ThreadInterface $thread, $limit, $offset)
	{
		return DB::table('messages')->where('thread_id', $thread->getId())->take($limit)->skip($offset)->get();
	}
	
	/**
	 * @brief search within a thread for all messages
	 * that contain given text
	 *
	 * @param ThreadInterface $thread
	 * @param Array $keyowrds
	 * @param int $limit
	 * @param int $offset
	 *
	 * @return Array<Messages> $messages
	 */
	public function search(ThreadInterface $thread, Array $keyowrds, $limit, $offset)	
	{
		//we will return this
		$messagesObjects = array();
		
		$messages = DB::table('messages')
		->where('thread_id', $thread->getId())
		->where(function($query)
		{		
			foreach($keyowrds as $keyword)
			{
				$query->orWhere('message', 'like', '%'.$keyword.'%');
			}
		});
		
		$messages->take($limit)->skip($offset);
		
		$messages = $messages->get();
		
		foreach($messages as $message)
		{
			$actor = $this->actorRepository->find($message->actor_id);
			
			$msg = new Message($thread, $actor, $message->message, $message->created);	
			$messagesObjects[] = $msg;
		}
		
		return $messagesObjects;
	}
	
	/**
	 * @brief create a new message in specified thread
	 * 
	 * @param ThreadInterface $thread - thread where the message will belongs 
	 * @param string $text
	 * @param int $time - timestamps
	 * 
	 * @return MessageInterface $message
	 */
	public function create(ThreadInterface $thread, ActorInterface $actor, $text, $time)
	{
		$id = DB::table('messages')->insertGetId(
			array
			(
				'thread_id'	=> $thread->getId(),
				'actor_id'	=> $actor->getId(),
				'message'	=> $text,
				'created'	=> $time
			)
		);
		
		return new Message($id, $actor, $thread, $text, $time);
	}

}