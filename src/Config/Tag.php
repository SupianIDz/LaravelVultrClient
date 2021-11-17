<?php

namespace Octopy\Vultr\Config;

use FilesystemIterator;
use Illuminate\Support\Collection;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use SplFileInfo;

class Tag
{
	/**
	 * @return Collection<string>
	 */
	public static function getTags() : Collection
	{
		return static::getIterator()
			->map(function (SplFileInfo $fileInfo) {
				return static::getClass($fileInfo);
			})
			->filter(function ($class) {
				$reflection = new ReflectionClass($class);

				return ! $reflection->isInterface() && ! $reflection->isAbstract();
			})
			->values();
	}

	/**
	 * @return Collection<SplFileInfo>
	 */
	private static function getIterator() : Collection
	{
		return collect(new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator(__DIR__ . '/../Tags', FilesystemIterator::SKIP_DOTS)
		));
	}

	/**
	 * @param  SplFileInfo $fileInfo
	 * @return string
	 */
	private static function getClass(SplFileInfo $fileInfo) : string
	{
		$class = substr($fileInfo->getPathname(), 0, -4);
		$class = str_replace(__DIR__ . '/../Tags/', '', $class);

		return '\Octopy\\Vultr\\Tags\\' . str_replace(DIRECTORY_SEPARATOR, '\\', $class);
	}
}
