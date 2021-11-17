<?php

namespace Octopy\Vultr\Client;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Octopy\Vultr\Client\Contracts\ClientInterface;
use Octopy\Vultr\Config\VultrAccount;

class DefaultClient extends AbstractClient implements ClientInterface
{
	/**
	 * @var PendingRequest
	 */
	protected PendingRequest $request;

	/**
	 * @param  VultrAccount $account
	 */
	public function __construct(VultrAccount $account)
	{
		parent::__construct($account);

		$this->request = Http::baseUrl($this->baseUri)
			->withHeaders($this->getDefaultHeaders())
			->withToken($account->getApiKey());
	}

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return mixed
	 */
	public function get(string $url, array $params = []) : mixed
	{
		// TODO: Implement get() method.
	}

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return mixed
	 */
	public function post(string $url, array $params = []) : mixed
	{
		// TODO: Implement post() method.
	}

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return mixed
	 */
	public function put(string $url, array $params = []) : mixed
	{
		// TODO: Implement put() method.
	}

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return mixed
	 */
	public function patch(string $url, array $params = []) : mixed
	{
		// TODO: Implement patch() method.
	}

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return mixed
	 */
	public function delete(string $url, array $params = []) : mixed
	{
		// TODO: Implement delete() method.
	}
}
