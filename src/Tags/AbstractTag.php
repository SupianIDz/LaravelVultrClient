<?php

namespace Octopy\Vultr\Tags;

use Octopy\Vultr\Client\Contracts\ClientInterface;
use Octopy\Vultr\Tags\Contracts\TagInterface;

abstract class AbstractTag implements TagInterface
{
	/**
	 * @var string
	 */
	public string $tagName;

	/**
	 * @param  ClientInterface $client
	 */
	public function __construct(protected ClientInterface $client)
	{
		//
	}
}
