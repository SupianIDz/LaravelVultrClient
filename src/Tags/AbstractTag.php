<?php

namespace Octopy\Vultr\Tags;

use Octopy\Vultr\Adapter\Contracts\AdapterInterface;
use Octopy\Vultr\Tags\Contracts\TagInterface;

abstract class AbstractTag implements TagInterface
{
	/**
	 * @var bool
	 */
	protected bool $requireApiKey = false;

	/**
	 * @param  AdapterInterface $client
	 */
	public function __construct(protected AdapterInterface $client)
	{
		$this->client->requireApiKey($this->requireApiKey);
	}
}
