# Simple webp package for filament

### Stil in development, not ready for production

## Installation

You can install the package via composer:

```bash
"repositories": [
        {
            "type": "git",
            "url": "https://github.com/KaanTanis/filament-simple-webp.git"
        }
    ],
    
...
"require": {
    ...
    "kaantanis/filament-simple-webp": "@dev"
    ...
},
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-simple-webp-config"
```

This is the contents of the published config file:

```php
return [
    'prefix' => 'vogo-dev-',
];
```

## Usage

```php
FileUpload::make('image') // Official filament file upload
    ->webp() // webp macro from this package
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [KaanTanis](https://github.com/KaanTanis)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
