<?php namespace Softservlet\Forum\Providers;

use Illuminate\Support\ServiceProvider;

class ForumServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('softservlet/forum');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Softservlet\Forum\Repositories\ThreadRepositoryInterface', 'Softservlet\Forum\Repositories\ThreadRepository');
		$this->app->bind('Softservlet\Forum\ThreadInterface', 'Softservlet\Forum\Thread');
		$this->app->bind('Softservlet\Forum\Repositories\MessageRepositoryInterface', 'Softservlet\Forum\Repositories\MessageRepository');
		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
