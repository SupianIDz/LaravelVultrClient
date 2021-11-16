<?php

namespace Octopy\Vultr\Config;

use Illuminate\Support\Collection;
use Octopy\Vultr\Exceptions\InvalidAccountNameException;

class Config
{
	/**
	 * @var array
	 */
	protected array $accounts = [];

	/**
	 * Config constructor.
	 */
	public function __construct()
	{
		$this->registerAllAccountsFromConfigFile();
	}

	/**
	 * @param  Account|string $name
	 * @param  string|null    $apiKey
	 * @return Config
	 */
	public function addAccount(Account|string $name, string $apiKey = null) : static
	{
		if ($name instanceof Account) {
			return $this->addAccount($name->getName(), $name->getApiKey());
		}

		$this->accounts[$name] = new Account($name, $apiKey);

		return $this;
	}

	/**
	 * @param  string|null $name
	 * @return Account
	 * @throws InvalidAccountNameException
	 */
	public function getAccount(string $name = null) : Account
	{
		if (! $name) {
			$name = $this->getDefaultName();
		}

		return $this->accounts[$name] ?? throw new InvalidAccountNameException($name);
	}

	/**
	 * @return Account
	 * @throws InvalidAccountNameException
	 */
	public function getDefaultAccount() : Account
	{
		return $this->getAccount($this->getDefaultName());
	}

	/**
	 * @return Collection<Account, string>
	 */
	public function getAccounts() : Collection
	{
		return collect($this->accounts);
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
	protected function registerAllAccountsFromConfigFile() : void
	{
		foreach (config('vultr.accounts') as $name => $config) {
			$this->addAccount($name, $config['key']);
		}
	}
}
