<?php

namespace Mohamedhk2\LaravelDevTools;

use Bestmomo\ArtisanLanguage\Commands\LanguageDiff;
use Bestmomo\ArtisanLanguage\Commands\LanguageMake;
use Bestmomo\ArtisanLanguage\Commands\LanguageStrings;
use Illuminate\Support\ServiceProvider;

class LaravelDevToolsProvider extends ServiceProvider
{
	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @return void
	 */
	public function boot()
	{
		if ($this->app->runningInConsole()) {
			$this->commands([
				Commands\ListArtisanCommands::class,
				Commands\LanguageSync::class,

				LanguageMake::class,
				LanguageDiff::class,
				LanguageStrings::class,
			]);
		}
	}
}
