# Forum (Laravel Package) version 1.0

The package was designed to resolve a common part of 
most web application: users messages. The package cames
with a extensible database structure which allows you
to use the package for problems such as private messages
between your users or a place where all your users
can write their ideas.

### Installation

Currently only a installation guide for Laravel 4 framework
are provided in this documentation.

 * Run database migrations
 
 `php artisan migrate --bench=softservlet/forum`

 * Add package service provider in your app/config/app.php

 `Softservlet\Forum\Providers\ForumServiceProvider`

 * Implement the ActorInterface in your application.

The base idea behind this package is to send messages between
entities. We call this entity an Actor. In order to use this
package, you must define in your application who is the actor.

The actor usually will send messages.

Somewhere in your models, you should implement ActorInterface
from `Softservlet\Forum\Actor\ActorInterface`. A code sample
for this might be:

```php
<?php

use Softservlet\Forum\Actor\ActorInterface;

class User implements ActorInterface
{

	private $userId;

	public function __construct($userId)
	{
		$this->userId = $userId;
	}

	public function getId()
	{
		return $this->userId;
	}

	//more about your user 
}
```

Once you've implemented ActorInterface, bind this to your
application service providers. In your application service
provider write:
`App::bind('Softservlet\Forum\Actor\ActorInterface', 'Your\Namespace\To\User');`

 * Implement ActorRepositoryInterface
The package needs to get instances to your objects which 
implements ActorInterface to be able to send messages. 

You need to implement:
`Softservlet\Forum\Repositories\ActorRepositoryInterface`

This interface contain a method `find($id)`, which should
return an instance of ActorInterface. Here you should retrieve
your user from database or from where you've stored it.

A sample code of this implementation might be:

```php
<?php

use Softservlet\Forum\Repositories\ActorRepositoryInterface;

class UserRepository implements ActorRepositoryInterface
{
	public find($id)
	{
		//get details about your user and create
		//a instance of it
		return new User($id, $params);
	}
}
```

then register the binding from this class to
`Softservlet\Forum\Repositories\ActorRepositoryInterface;`

More about Laravel binding on Laravel documentation.


### How to use





