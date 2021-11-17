<?php

namespace Octopy\Vultr\Tests\Tags;

use Octopy\Vultr\Exceptions\DuplicatedTagException;
use Octopy\Vultr\Exceptions\RequireApiKeyException;
use Octopy\Vultr\Tests\TestCase;
use Throwable;

class TagTest extends TestCase
{
	/**
	 * @throws Throwable
	 * @throws DuplicatedTagException
	 */
	public function testRequiresAnApiKeyForEndpointsThatRequireAnApiKey()
	{
		$this->expectException(RequireApiKeyException::class);
		$this->vultr->config()->addAccount('withoutKey', null);
		$this->vultr->account('withoutKey')->tag('account')->getAccountInfo();
	}
}
