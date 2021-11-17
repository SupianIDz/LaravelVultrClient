<?php

namespace Octopy\Vultr\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class DuplicatedTagException extends Exception
{
	/**
	 * @param  string         $tag
	 * @param  int            $code
	 * @param  Throwable|null $previous
	 */
	#[Pure]
	public function __construct(string $tag, int $code = 0, Throwable $previous = null)
	{
		parent::__construct(sprintf('Tag "%s" already exists.', $tag), $code, $previous);
	}
}
