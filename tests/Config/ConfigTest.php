<?php

namespace Octopy\Vultr\Tests\Config;

use Octopy\Vultr\Config\Config;
use Octopy\Vultr\Config\VultrAccount;
use Octopy\Vultr\Exceptions\InvalidAccountNameException;
use Octopy\Vultr\Tags\Account;
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
	public function testAddCustomAccount()
	{
		$this->config->addAccount('foo', 'bar');
		$this->config->addAccount(
			new VultrAccount('baz', 'quk')
		);

		$this->assertEquals('bar', $this->config->getAccount('foo')->getApiKey());
		$this->assertEquals('quk', $this->config->getAccount('baz')->getApiKey());
		$this->assertNotSame(
			$this->config->getAccount('foo')->getApiKey(),
			$this->config->getAccount('baz')->getApiKey()
		);
	}

	/**
	 * @return void
	 * @throws InvalidAccountNameException
	 */
	public function testGetDefaultAccount()
	{
		$this->assertSame('', $this->config->getDefaultAccount()->getApiKey());
	}

	/**
	 * @return void
	 * @throws InvalidAccountNameException
	 */
	public function testGetAccountByName()
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

	/**
	 * @throws InvalidAccountNameException
	 */
	public function testAccountHaveTag()
	{
		$this->config->addAccount('foo', 'bar');

		$this->assertInstanceOf(Account::class, $this->config->getAccount()->tag('account'));
		$this->assertInstanceOf(Account::class, $this->config->getAccount('foo')->tag('account'));
	}
}
