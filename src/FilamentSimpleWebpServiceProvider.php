<?php

namespace KaanTanis\FilamentSimpleWebp;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\FileUpload;
use KaanTanis\FilamentSimpleWebp\Commands\FilamentSimpleWebpCommand;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSimpleWebpServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-simple-webp')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-simple-webp_table')
            ->hasCommand(FilamentSimpleWebpCommand::class);
    }

    public function boot(): void
    {
        Field::macro('webp', function ($maxWdith = 1920, $optimize = 70) {
            return $this
                ->saveUploadedFileUsing(
                    fn (FileUpload $component, TemporaryUploadedFile $file) => FilamentSimpleWebp::webp($component, $file, $maxWdith, $optimize)
                );
        });
    }
}
