<?php

namespace Octopy\Vultr\Config;

use Illuminate\Support\Collection;
use Octopy\Vultr\Tags\Contracts\TagInterface;

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
	 * @param  TagInterface $tag
	 */
	public function registerTag(TagInterface $tag)
	{
		$this->tags[$tag->getTagName()] = $tag;
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
	 * @return string
	 */
	public function getApiKey() : string
	{
		return $this->apiKey;
	}
}
