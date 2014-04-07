<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('threads', function($table)
		{
			$table->increments('id');
			$table->integer('created');
		});
		
		Schema::create('threads_actors', function($table)
		{
			$table->increments('id');
			$table->integer('thread_id')->unsigned();
			$table->integer('actor_id')->unsigned();
			
			//foreign 
			$table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
		});
		
		Schema::create('messages', function($table)
		{
			$table->increments('id');
			$table->integer('thread_id')->unsigned();
			$table->integer('actor_id')->unsigned();
			$table->text('message');
			$table->integer('created');
			
			//foreign
			$table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
		});
		
		Schema::create('messages_meta', function($table)
		{
			$table->increments('id');
			$table->integer('message_id')->unsigned();
			$table->string('meta_key');
			$table->string('meta_value');
			$table->integer('created');
			
			//foreign
			$table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('threads_actors', function($table)
		{
			$table->dropForeign('threads_actors_thread_id_foreign');
		});
		
		Schema::table('messages', function($table)
		{
			$table->dropForeign('messages_thread_id_foreign');
		});
		
		Schema::table('messages_meta', function($table)
		{
			$table->dropForeign('messages_meta_message_id_foreign');
		});
		
		Schema::drop('threads_actors');
		Schema::drop('threads');
		Schema::drop('messages');
		Schema::drop('messages_meta');
	}

}
