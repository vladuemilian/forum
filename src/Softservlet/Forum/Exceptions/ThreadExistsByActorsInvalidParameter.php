<?php namespace Softservlet\Forum\Exception;

use Exception;

/**
 * @brief Exception raised when trying to pass an array
 * with other objects than ActorInterface in ThreadRepository
 *
 */
class ThreadExistsByActorsInvalidParameter extends Exception
{
}