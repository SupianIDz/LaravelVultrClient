<?php

namespace Octopy\Vultr\Tests;

use Illuminate\Support\Facades\App;
use Octopy\Vultr\Config\Config;
use Octopy\Vultr\Exceptions\InvalidAccountNameException;
use Octopy\Vultr\Vultr;

class VultrTest extends TestCase
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
	}

	/**
	 * @return void
	 */
	public function testDefaultAccountIsLoaded()
	{
		$this->assertEquals(2, $this->vultr->config()->getAccounts()->count());
	}

	/**
	 * @return void
	 * @throws InvalidAccountNameException
	 */
	public function testAddAccount()
	{
		$this->vultr->config()->addAccount('foo', 'bar');

		$this->assertEquals(3, $this->vultr->config()->getAccounts()->count());
		$this->assertSame('bar', $this->vultr->config()->getAccount('foo')->getApiKey());
	}

	/**
	 * @return void
	 */
	public function testAddAccountUsingClosure()
	{
		$this->vultr->config(function (Config $config) {
			$config->addAccount('foo', 'bar');
			$config->addAccount('baz', 'quk');
		});

		$this->assertEquals(4, $this->vultr->config()->getAccounts()->count());
	}
}
