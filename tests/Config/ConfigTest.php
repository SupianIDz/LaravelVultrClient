<?php

namespace Octopy\Vultr\Tests\Config;

use Octopy\Vultr\Config\Account;
use Octopy\Vultr\Config\Config;
use Octopy\Vultr\Exceptions\InvalidAccountNameException;
use Octopy\Vultr\Tests\TestCase;

class ConfigTest extends TestCase
{
	/**
	 * @var Config
	 */
	protected Config $config;

	/**
	 * @return void
	 */
	protected function setUp() : void
	{
		parent::setUp();

		$this->config = new Config;
	}

	/**
	 * @return void
	 * @throws InvalidAccountNameException
	 */
	public function testSetConfig()
	{
		$this->config->addAccount('foo', 'bar');
		$this->config->addAccount(
			new Account('baz', 'quk')
		);

		$this->assertEquals('bar', $this->config->getAccount('foo')->getApiKey());
		$this->assertEquals('quk', $this->config->getAccount('baz')->getApiKey());
	}

	/**
	 * @return void
	 * @throws InvalidAccountNameException
	 */
	public function testGetDefaultConfig()
	{
		$this->assertSame('', $this->config->getDefaultAccount()->getApiKey());
	}

	/**
	 * @return void
	 * @throws InvalidAccountNameException
	 */
	public function testGetConfigByName()
	{
		$this->assertSame('', $this->config->getAccount('account-1')->getApiKey());
	}

	/**
	 * @throws InvalidAccountNameException
	 */
	public function testThrowExceptionForInvalidName()
	{
		$this->expectException(InvalidAccountNameException::class);

		$this->config->getAccount('wrong-name');
	}
}
