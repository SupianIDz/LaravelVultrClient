<?php

namespace Octopy\Vultr\Adapter;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Octopy\Vultr\Adapter\Contracts\AdapterInterface;
use Octopy\Vultr\Config\VultrAccount;
use Octopy\Vultr\Exceptions\RequireApiKeyException;
use Throwable;

class DefaultAdapter extends AbstractAdapter implements AdapterInterface
{
	/**
	 * @var PendingRequest
	 */
	protected PendingRequest $request;

	protected bool $requireApiKey = false;

	/**
	 * @param  VultrAccount $account
	 */
	public function __construct(protected VultrAccount $account)
	{
		parent::__construct($account);

		$this->request = Http::baseUrl($this->baseUri)
			->withHeaders($this->getDefaultHeaders());
	}

	/**
	 * @param  bool $required
	 */
	public function requireApiKey(bool $required = true)
	{
		$this->requireApiKey = $required;
	}

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return Response|PromiseInterface
	 * @throws RequireApiKeyException
	 */
	public function get(string $url, array $params = []) : Response|PromiseInterface
	{
		return $this->request()->get($url, $params);
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

	/**
	 * @return PendingRequest
	 * @throws RequireApiKeyException|Throwable
	 */
	public function request() : PendingRequest
	{
		if ($this->requireApiKey) {
			throw_unless($this->getAccount()->hasApiKey(), new RequireApiKeyException($this->account));

			$this->request->withToken($this->account->getApiKey());
		}

		return $this->request;
	}
}
