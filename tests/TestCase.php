<?php

namespace Octopy\Vultr\Tests;

use Illuminate\Contracts\Foundation\Application;
use Octopy\Vultr\VultrServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
	/**
	 * @return void
	 */
	protected function setUp() : void
	{
		parent::setUp();
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
