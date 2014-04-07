<?php namespace Softservlet\Forum\Actor;

interface ActorInterface
{
	/**
	 * @brief each actor must have an unique id
	 * 
	 * @return <T> unique id
	 */
	public function getId();
	
}