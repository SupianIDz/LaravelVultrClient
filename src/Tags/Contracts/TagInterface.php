<?php

namespace Octopy\Vultr\Tags\Contracts;

interface TagInterface
{
	/**
	 * @return string
	 */
	public function getTagName() : string;
}
