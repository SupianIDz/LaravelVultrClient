<?php

namespace Octopy\Vultr\Adapter;

use JetBrains\PhpStorm\ArrayShape;
use Octopy\Vultr\Config\VultrAccount;

abstract class AbstractAdapter implements Contracts\AdapterInterface
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
	 * @return VultrAccount
	 */
	public function getAccount() : VultrAccount
	{
		return $this->account;
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
