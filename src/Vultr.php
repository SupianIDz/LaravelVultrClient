<?php

namespace Octopy\Vultr;

use ArrayAccess;
use Closure;
use Octopy\Vultr\Config\Config;
use Octopy\Vultr\Config\VultrAccount;
use Throwable;

class Vultr implements ArrayAccess
{
	/**
	 * @param  Config|null $config
	 */
	public function __construct(protected Config|null $config = null)
	{
		if (is_null($this->config)) {
			$this->config = new Config;
		}
	}

	/**
	 * @param  Closure<Config>|null $callback
	 * @return Config|VultrAccount
	 */
	public function config(Closure $callback = null) : Config|VultrAccount
	{
		if ($callback) {
			$callback($this->config);
		}

		return $this->config;
	}

	/**
	 * @throws Exceptions\InvalidAccountNameException
	 */
	public function account(string|null $name = null) : VultrAccount
	{
		return $this->config->getAccount($name);
	}

	/**
	 * @param  string $offset
	 * @return bool
	 */
	public function offsetExists($offset) : bool
	{
		return $this->config->hasAccount($offset);
	}

	/**
	 * @throws Exceptions\InvalidAccountNameException
	 */
	public function offsetGet($offset) : VultrAccount
	{
		return $this->config->getAccount($offset);
	}

	/**
	 * @param  string              $offset
	 * @param  VultrAccount|string $value
	 * @return void
	 * @throws Exceptions\DuplicatedTagException
	 * @throws Throwable
	 */
	public function offsetSet($offset, $value) : void
	{
		if ($value instanceof VultrAccount) {
			$value = $value->getApiKey();
		}

		$this->config->addAccount($offset, $value);
	}

	/**
	 * @param  mixed $offset
	 */
	public function offsetUnset($offset)
	{
		$this->config->removeAccount($offset);
	}
}
