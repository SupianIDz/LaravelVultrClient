<?php

namespace Octopy\Vultr\Tests;

use Octopy\Vultr\Config\Config;
use Octopy\Vultr\Config\VultrAccount;
use Octopy\Vultr\Exceptions\DuplicatedTagException;
use Octopy\Vultr\Exceptions\InvalidAccountNameException;
use Throwable;

class VultrTest extends TestCase
{
	/**
	 * @throws InvalidAccountNameException
	 */
	public function testGetAccount()
	{
		$this->assertInstanceOf(VultrAccount::class, $this->vultr->account());
	}

	/**
	 * @return void
	 * @throws DuplicatedTagException
	 * @throws Throwable
	 */
	public function testAddCustomAccountUsingClosure()
	{
		$this->vultr->config()->removeAccounts();

		$this->vultr->config(function (Config $config) {
			$config->addAccount('foo', 'bar');
			$config->addAccount('baz', 'quk');
		});

		$this->assertEquals(2, $this->vultr->config()->getAccounts()->count());

		$this->vultr->config(function (Config $config) {
			$config->addAccount('oof', 'bar');
			$config->addAccount('zab', 'quk');
		});

		$this->assertEquals(4, $this->vultr->config()->getAccounts()->count());
	}

	/**
	 * @throws InvalidAccountNameException
	 */
	public function testAddCustomAccountUsingArrayAccess()
	{
		$this->vultr->config()->removeAccounts();

		$this->vultr['foo'] = 'key';
		$this->assertSame('key', $this->vultr->account('foo')->getApiKey());

		$this->vultr['baz'] = new VultrAccount('bar', 'key');
		$this->assertSame('key', $this->vultr->account('baz')->getApiKey());
	}
}
