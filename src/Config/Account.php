<?php

namespace Octopy\Vultr\Config;

class Account
{
	/**
	 * @param  string|null $name
	 * @param  string|null $apiKey
	 */
	public function __construct(protected string|null $name = null, protected string|null $apiKey = null)
	{
		//
	}

	/**
	 * @param  string $name
	 * @return Account
	 */
	public function setName(string $name) : Account
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() : string
	{
		return $this->name;
	}

	/**
	 * @param  string $apiKey
	 * @return Account
	 */
	public function setApiKey(string $apiKey) : Account
	{
		$this->apiKey = $apiKey;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getApiKey() : string
	{
		return $this->apiKey;
	}
}
