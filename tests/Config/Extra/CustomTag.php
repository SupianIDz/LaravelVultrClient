<?php

namespace Octopy\Vultr\Tests\Config\Extra;

use Octopy\Vultr\Tags\AbstractTag;

class CustomTag extends AbstractTag
{
	/**
	 * @inheritDoc
	 */
	public function getTagName() : string
	{
		return 'custom';
	}
}
