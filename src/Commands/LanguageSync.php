<?php

namespace Mohamedhk2\LaravelDevTools\Commands;

use Bestmomo\ArtisanLanguage\Commands\LanguageSync as LanguageSyncBase;
use Illuminate\Support\Collection;
use Mohamedhk2\LaravelDevTools\Classes\RegexConfig;
use Symfony\Component\Finder\SplFileInfo;

class LanguageSync extends LanguageSyncBase
{
	/**
	 * Get strings collection
	 *
	 * @return Collection
	 */
	protected function getStrings()
	{
		return collect(config('artisan-language.scan_paths', [
			app_path(),
			resource_path('views'),
			resource_path('js'),
		]))
			->map(function (string $path) {
				return $this->filesystem->allFiles($path);
			})
			->collapse()
			->map(function (SplFileInfo $item) {
				$result = [];
				collect(config('artisan-language.patterns', []))
					->each(function ($pattern) use (&$result, $item) {
						if ($pattern instanceof RegexConfig) {
							/**
							 * @var $pattern RegexConfig
							 */
							preg_match_all(
								$pattern->getPattern(),
								$item->getContents(),
								$out,
								PREG_PATTERN_ORDER);
							$result = array_merge($result, $pattern->result($out));
						}
					});
				return $result;
			})
			->collapse()
			->unique()
			->filter(function ($value) {
				return !$this->translator->has($value);
			})
			->sort(function ($a, $b) {
				return strtolower($a) > strtolower($b);
			});
	}
}
