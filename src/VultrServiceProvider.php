<?php

namespace Octopy\Vultr;

use Illuminate\Support\ServiceProvider;

class VultrServiceProvider extends ServiceProvider
{
	/**
	 * @return void
	 */
	public function register() : void
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../config/vultr.php', 'vultr'
		);
	}

	/**
	 * @return void
	 */
	public function boot() : void
	{
		//
	}
}
