<?php namespace Softservlet\Forum\Message;

interface MessageInterface
{
	/**
	 * @brief each message has a time, usually a  
	 * timestamps(depends by implementation) when
	 * they are created
	 * 
	 * @return int $timestamp
	 */
	public function getTime();
	
	/**
	 * @brief returns the raw data for this message
	 * 
	 * @return string $data
	 */
	public function getText();

	/**
	 * @return ActorInterface $actor
	 */
	public function getActor();

	/**
	 * @brief each message has possibility to add
	 * extra data(such as images or other objects
	 * from your application). Meta object provides
	 * a way to do this.
	 * 
	 * @return MetaInterface $meta
	 */
	public function meta();
	
	/**
	 * @brief returns the unique id of this message
	 * 
	 * @return <T> id
	 */
	public function getId();
}