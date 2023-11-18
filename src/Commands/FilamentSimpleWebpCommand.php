<?php

namespace KaanTanis\FilamentSimpleWebp\Commands;

use Illuminate\Console\Command;

class FilamentSimpleWebpCommand extends Command
{
    public $signature = 'filament-simple-webp';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
