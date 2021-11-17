<?php

namespace Octopy\Vultr\Client;

use JetBrains\PhpStorm\ArrayShape;
use Octopy\Vultr\Config\VultrAccount;

abstract class AbstractClient implements Contracts\ClientInterface
{
	/**
	 * @var string
	 */
	protected string $baseUri = 'https://api.vultr.com/v2/';

	/**
	 * @inheritDoc
	 */
	public function __construct(protected VultrAccount $account)
	{
		//
	}

	/**
	 * @return string[]
	 */
	#[ArrayShape([
		'Accept' => "string", 'Content-Type' => "string",
	])]
	protected function getDefaultHeaders() : array
	{
		return [
			'Accept'       => 'application/json',
			'Content-Type' => 'application/json',
		];
	}
}
