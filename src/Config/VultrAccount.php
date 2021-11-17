<?php

namespace Octopy\Vultr\Config;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use JetBrains\PhpStorm\Pure;
use Octopy\Vultr\Adapter\Contracts\AdapterInterface;
use Octopy\Vultr\Adapter\DefaultAdapter;
use Octopy\Vultr\Exceptions\DuplicatedTagException;
use Octopy\Vultr\Tags\Contracts\TagInterface;
use Throwable;

class VultrAccount
{
	/**
	 * @var array<TagInterface>
	 */
	protected array $tags = [];

	/**
	 * @param  string|null $name
	 * @param  string|null $apiKey
	 */
	public function __construct(protected string|null $name = null, protected string|null $apiKey = null)
	{
		//
	}

	/**
	 * @return AdapterInterface
	 */
	public function getClient() : AdapterInterface
	{
		return new DefaultAdapter($this);
	}

	/**
	 * @param  string $name
	 * @return TagInterface
	 */
	public function tag(string $name) : TagInterface
	{
		return $this->tags[$name];
	}

	/**
	 * @return Collection<TagInterface>
	 */
	public function tags() : Collection
	{
		return collect($this->tags);
	}

	/**
	 * @param  string $tag
	 * @throws DuplicatedTagException|Throwable
	 */
	public function registerTag(string $tag)
	{
		$tag = App::make($tag, [
			'client' => $this->getClient(),
		]);

		throw_if($this->hasTag($tag->getTagName()), new DuplicatedTagException($tag->getTagName()));

		$this->tags[$tag->getTagName()] = $tag;
	}

	/**
	 * @param  string $tag
	 * @return bool
	 */
	public function hasTag(string $tag) : bool
	{
		return isset($this->tags[$tag]);
	}

	/**
	 * @param  string $tag
	 */
	public function removeTag(string $tag)
	{
		unset($this->tags[$tag]);
	}

	/**
	 * @return void
	 */
	public function removeTags()
	{
		$this->tags = [];
	}

	/**
	 * @param  string $name
	 * @return VultrAccount
	 */
	public function setName(string $name) : VultrAccount
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() : string
	{
		return $this->name;
	}

	/**
	 * @param  string $apiKey
	 * @return VultrAccount
	 */
	public function setApiKey(string $apiKey) : VultrAccount
	{
		$this->apiKey = $apiKey;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getApiKey() : string|null
	{
		return $this->apiKey;
	}

	/**
	 * @return bool
	 */
	#[Pure]
	public function hasApiKey() : bool
	{
		return $this->getApiKey() !== null && $this->getApiKey() !== '';
	}
}
