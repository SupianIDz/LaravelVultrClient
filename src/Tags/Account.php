<?php

namespace Octopy\Vultr\Tags;

use Octopy\Vultr\Adapter\DefaultAdapter;
use Octopy\Vultr\Exceptions\RequireApiKeyException;

/**
 * @property DefaultAdapter $client
 */
class Account extends AbstractTag
{
	/**
	 * @var bool
	 */
	protected bool $requireApiKey = true;

	/**
	 * @return string
	 */
	public function getTagName() : string
	{
		return 'account';
	}

	/**
	 * @return mixed
	 * @throws RequireApiKeyException
	 */
	public function getAccountInfo() : mixed
	{
		return $this->client->get('account')->json('account');
	}
}
