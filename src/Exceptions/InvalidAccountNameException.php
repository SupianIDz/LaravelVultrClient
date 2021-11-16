<?php

namespace Octopy\Vultr\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

class InvalidAccountNameException extends Exception
{
	/**
	 * @param  string $name
	 */
	#[Pure]
	public function __construct(string $name)
	{
		parent::__construct("Invalid account name: {$name}");
	}
}
