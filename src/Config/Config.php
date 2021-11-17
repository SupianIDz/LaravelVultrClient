<?php

namespace Octopy\Vultr\Config;

use Illuminate\Support\Collection;
use Octopy\Vultr\Exceptions\DuplicatedTagException;
use Octopy\Vultr\Exceptions\InvalidAccountNameException;
use Throwable;

class Config
{
	/**
	 * @var array
	 */
	protected array $tags = [];

	/**
	 * @var array<VultrAccount>
	 */
	protected array $accounts = [];

	/**
	 * Config constructor.
	 */
	public function __construct()
	{
		$this->tags = Tag::getDefaultTags()->toArray();
		$this->registerAccountsFromConfigFile();
	}

	/**
	 * @param  array|string $tags
	 */
	public function pushTag(array|string $tags) : void
	{
		if (is_string($tags)) {
			$tags = [$tags];
		}

		$this->tags = array_merge($this->tags, $tags);

		$this->mappingTagsToAccounts();
	}

	/**
	 * @param  VultrAccount|string $name
	 * @param  string|null         $apiKey
	 * @return Config
	 * @throws DuplicatedTagException
	 * @throws Throwable
	 */
	public function addAccount(VultrAccount|string $name, string $apiKey = null) : static
	{
		if ($name instanceof VultrAccount) {
			return $this->addAccount($name->getName(), $name->getApiKey());
		}

		$this->accounts[$name] = new VultrAccount($name, $apiKey);

		foreach ($this->tags as $tag) {
			$this->accounts[$name]->registerTag($tag);
		}

		return $this;
	}

	/**
	 * @param  string|null $name
	 * @return VultrAccount
	 * @throws InvalidAccountNameException
	 */
	public function getAccount(string $name = null) : VultrAccount
	{
		if (! $name) {
			$name = $this->getDefaultName();
		}

		return $this->accounts[$name] ?? throw new InvalidAccountNameException($name);
	}

	/**
	 * @return VultrAccount
	 * @throws InvalidAccountNameException
	 */
	public function getDefaultAccount() : VultrAccount
	{
		return $this->getAccount($this->getDefaultName());
	}

	/**
	 * @return Collection<VultrAccount, string>
	 */
	public function getAccounts() : Collection
	{
		return collect($this->accounts);
	}

	/**
	 * @param  string $name
	 */
	public function removeAccount(string $name) : void
	{
		unset($this->accounts[$name]);
	}

	/**
	 * @return void
	 */
	public function removeAccounts() : void
	{
		$this->accounts = [];
	}

	/**
	 * @param  string $offset
	 * @return bool
	 */
	public function hasAccount(string $offset) : bool
	{
		return isset($this->accounts[$offset]);
	}

	/**
	 * @return string
	 */
	protected function getDefaultName() : string
	{
		return config('vultr.default');
	}

	/**
	 * @return void
	 */
	protected function registerAccountsFromConfigFile() : void
	{
		foreach (config('vultr.accounts') as $name => $config) {
			$this->addAccount($name, $config['key']);
		}
	}

	protected function mappingTagsToAccounts()
	{
		foreach ($this->accounts as $account) {
			$account->removeTags();
			foreach ($this->tags as $tag) {
				$account->registerTag($tag);
			}
		}
	}
}
