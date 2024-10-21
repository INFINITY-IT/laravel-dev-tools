<?php

namespace Mohamedhk2\LaravelDevTools\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\View\Components\TwoColumnDetail;
use Illuminate\Support\Facades\Artisan;

class ListArtisanCommands extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'commands:list';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List all Artisan commands and their file paths';

	/**
	 * Execute the console command.
	 * @throws \ReflectionException
	 */
	public function handle(): int
	{
		$commands = Artisan::all();
		$list = [];
		foreach ($commands as $name => $command) {
			$reflection = new \ReflectionClass($command);
			$filePath = $reflection->getFileName();
			$list[$name] = $filePath;
		}
		ksort($list);
		foreach ($list as $name => $filePath)
			with(new TwoColumnDetail($this->output))->render(
				"<fg=bright-blue;options=bold>{$name}</>",
				"<fg=bright-green;options=bold>{$filePath}</>",
			);
		return 0;
	}
}
