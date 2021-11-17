<?php

namespace Octopy\Vultr\Tests;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\App;
use Octopy\Vultr\Vultr;
use Octopy\Vultr\VultrServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
	/**
	 * @var Vultr
	 */
	protected Vultr $vultr;

	/**
	 * @return void
	 */
	protected function setUp() : void
	{
		parent::setUp();

		$this->vultr = App::make(Vultr::class);

		$this->vultr->config(function ($config) {
			$config->addAccount('default', getenv('API_KEY'));
		});
	}

	/**
	 * @param  Application $app
	 * @return array
	 */
	protected function getPackageProviders($app) : array
	{
		return [
			VultrServiceProvider::class,
		];
	}
}
