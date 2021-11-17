<?php

namespace Octopy\Vultr\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Octopy\Vultr\Config\VultrAccount;

class RequireApiKeyException extends Exception
{
	/**
	 * @param  VultrAccount $account
	 */
	#[Pure]
	public function __construct(VultrAccount $account)
	{
		parent::__construct(sprintf('This tag requires API Key but "%s" account doesn\'t have it.', $account->getName()), 403);
	}
}
