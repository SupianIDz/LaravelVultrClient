<?php

namespace Octopy\Vultr;

use Closure;
use Octopy\Vultr\Config\Account;
use Octopy\Vultr\Config\Config;

class Vultr
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
	 * @return Config|Account
	 */
	public function config(Closure $callback = null) : Config|Account
	{
		if ($callback) {
			$callback($this->config);
		}

		return $this->config;
	}
}
