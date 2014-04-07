<?php namespace Softservlet\Forum\Message;

use Softservlet\Forum\Message\MessageInterface;

interface MessageMetaInterface
{
	/**
	 * @brief assign to MessageInterface $message parameter
	 * a new meta key with value of $value. The main purpose
	 * of messages meta is that if you want to transfer another
	 * data than a text through a message
	 * 
	 * @param string $key
	 * @param string $value
	 * 
	 * @return void
	 */
	public function add($key, $value);
	
	/**
	 * @brief get a meta value based on meta key. Returns an array
	 * of all values of the same keys.
	 * 
	 * @param string $key
	 * 
	 * @return array value 
	 */
	public function get($key);
	
	/**
	 * @brief check if the $message parameter has a $key  
	 * 
	 * @param string $key
	 * 
	 *  @return boolean
	 */
	public function exists($key);
	
}