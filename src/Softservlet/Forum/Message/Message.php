<?php namespace Softservlet\Forum\Message;

use Softservlet\Forum\Actor\ActorInterface;
use Softservlet\Forum\Thread\ThreadInterface;

class Message implements MessageInterface
{
	private $actor;
	private $thread;
	private $text;
	private $time;
	private $meta;	
		
	public function __construct($id, ActorInterface $actor, ThreadInterface $thread, $text, $time)
	{
		$this->actor = $actor;
		$this->thread = $thread;
		$this->text = $text;
		$this->time = $time;	
	}
	
	/**
	 * @brief each message has a time, usually a
	 * timestamps(depends by implementation) when
	 * they are created
	 *
	 * @return int $timestamp
	 */
	public function getTime()
	{
		return $this->time;
	}
	
	/**
	 * @brief returns the raw data for this message
	 *
	 * @return string $data
	*/
	public function getText()
	{
		return $this->text;	
	}
	
	/**
	 * @return ActorInterface $actor
	*/
	public function getActor()
	{
		return $this->actor;	
	}
	
	/**
	 * @brief each message has possibility to add
	 * extra data(such as images or other objects
	 * from your application). Meta object provides
	 * a way to do this.
	 *
	 * @return MetaInterface $meta
	*/
	public function meta()
	{
		return new MessageMeta($this);
	}
	
	
	/* (non-PHPdoc)
	 * @see \Softservlet\Forum\Message\MessageInterface::getId()
	 */
	public function getId() {
		// TODO: Auto-generated method stub

	}

}