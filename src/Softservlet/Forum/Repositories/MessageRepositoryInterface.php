<?php namespace Softservlet\Forum\Repositories;

use Softservlet\Forum\Thread\ThreadInterface;
use Softservlet\Forum\Actor\ActorInterface;

interface MessageRepositoryInterface
{
	/**
	 * @brief get the messages from a thread
	 * 
	 * @param int $limit
	 * @param int $offset
	 * 
	 * @return array<Message> $array
	 */
	public function get(ThreadInterface $thread, $limit, $offset);
	
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
	public function search(ThreadInterface $thread, Array $keyowrds, $limit, $offset);
	
	/**
	 * @brief create a new message in specified thread
	 * 
	 * @param ThreadInterface $thread - thread where the message will belongs 
	 * @param string $text
	 * @param int $time - timestamps
	 * 
	 * @return MessageInterface $message
	 */
	public function create(ThreadInterface $thread, ActorInterface $actor, $text, $time);
	
}