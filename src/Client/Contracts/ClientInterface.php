<?php

namespace Octopy\Vultr\Client\Contracts;

use Octopy\Vultr\Config\VultrAccount;

interface ClientInterface
{
	/**
	 * @param  VultrAccount $account
	 */
	public function __construct(VultrAccount $account);

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return mixed
	 */
	public function get(string $url, array $params = []) : mixed;

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return mixed
	 */
	public function post(string $url, array $params = []) : mixed;

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return mixed
	 */
	public function put(string $url, array $params = []) : mixed;

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return mixed
	 */
	public function patch(string $url, array $params = []) : mixed;

	/**
	 * @param  string $url
	 * @param  array  $params
	 * @return mixed
	 */
	public function delete(string $url, array $params = []) : mixed;
}
