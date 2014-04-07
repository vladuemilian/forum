<?php namespace Softservlet\Forum\Message;

use DB;

class MessageMeta implements MessageMetaInterface
{

	//store MessageInterface object
	private $message;
	
	public function __construct(MessageInterface $message)
	{
		$this->message;		
	}
		
	/* (non-PHPdoc)
	 * @see \Softservlet\Forum\Message\MessageMetaInterface::add()
	 */
	public function add($key, $value)
	{
		DB::table('messages_meta')->insert(
			array
			(
				'message_id'	=> $this->message->getId(),
				'meta_key'		=> $key,
				'meta_value'	=> $value
			)
		);
	}

	/* (non-PHPdoc)
	 * @see \Softservlet\Forum\Message\MessageMetaInterface::get()
	 */
	public function get($key)
	{

		$result = array();
		
		$query = DB::table('messages_meta')->
		where('message_id', $this->message->getId())->
		where('key', $key)->get();
		
		foreach($query as $row)
		{
			$result[] = $row->value;	
		}
		
		return $result;
	}
	
	/* (non-PHPdoc)
	 * @see \Softservlet\Forum\Message\MessageMetaInterface::exists()
	 */
	public function exists($key)
	{
		$status = DB::table('messages_meta')->
		where('message_id', $this->message->getId())->
		first();
		
		return $status!=null;
	}
}