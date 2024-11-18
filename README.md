# Filament PHP Blocks Builder

[![Tests](https://github.com/bumbummen99/filament-blocks-builder/actions/workflows/tests.yml/badge.svg)](https://github.com/bumbummen99/filament-blocks-builder/actions/workflows/tests.yml)
[![codecov](https://codecov.io/github/bumbummen99/filament-blocks-builder/graph/badge.svg?token=CQUDGFF150)](https://codecov.io/github/bumbummen99/filament-blocks-builder)
[![Filament Version](https://img.shields.io/packagist/dependency-v/skyraptor/filament-blocks-builder/filament%2Ffilament?label=filament)](https://github.com/filamentphp/filament/)
[![Stable Version](https://img.shields.io/packagist/v/skyraptor/filament-blocks-builder?label=stable)](https://packagist.org/packages/skyraptor/filament-blocks-builder)
[![Total Downloads](https://img.shields.io/packagist/dt/skyraptor/filament-blocks-builder)](https://packagist.org/packages/skyraptor/filament-blocks-builder)
[![License](https://img.shields.io/packagist/1/skyraptor/filament-blocks-builder)](https://github.com/bumbummen99/filament-blocks-builder/blob/master/LICENSE)

This Filament PHP plugin adds a `BlockBuilder` form component, that allows you to create layouts using Blocks. This can be used as a builder for anything: layout, content, data and more.

## Installation
The package can be installed throught Composer by using the following command:
```sh
composer require skyraptor/filament-blocks-builder
```

## Useage
### Add Blocks Builder to a Resource
Since the Blocks Builder is essentially only an Form Component, you can use it on any Resource or Form however you like!
In order to do so just add below code snippet to your form:
```php
use SkyRaptor\FilamentBlocksBuilder\Blocks;
use SkyRaptor\FilamentBlocksBuilder\Forms\Components\BlocksInput;

BlocksInput::make('content')
    ->blocks(fn () => [
        Blocks\Layout\Card::block($form),
        Blocks\Typography\Heading::block($form),
        Blocks\Typography\Paragraph::block($form)
    ])
```

### Creating custom Blocks
A Block itself is a combination of a Filament PHP Form definition as well as the view required to render the Block on the frontend.

The package does include basic example Blocks, however it is **recommended** that you do create and maintain 
your own library of Blocks - this can be done in your project as well as in a package.

In order to create your custom Block you will have to extend the `Block` Contract provided by this package as shown 
in the example below. The implementation must define and configure the Block's Filament PHP Form schema as well 
as the view to be used.
```php
<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components;
use Filament\Forms\Form;

class Example extends \SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\Block
{
    public static function block(Form $form): Components\Builder\Block
    {
        return parent::block($form)->schema([
            Components\Textarea::make('content')
                ->required(),
        ]);
    }

    public static function view(): string
    {
        return 'example';
    }
}
```

Next the Block's view has to be created. In our example, this is just a Laravel Blade view called `example.blade.php`. **The view itself has access to the data defined by the Block's schema**.
```php
<p>{{ $content }}</p>
```

Now you can add the custom Block to your BlocksInput of choice!
```php
->blocks(fn () => [
    Blocks\Layout\Card::block($form),
    Blocks\Typography\Heading::block($form),
    Blocks\Typography\Paragraph::block($form),
    // ...
    App\Filament\Blocks\Example::block($form)
])
```

## Contributing
This project is open for contributions throught pull requests on GitHub. Please make sure that the tests do succeed when contributing to the project.
Below you will find helpful information about the project for contributors.

### DevContainer
This project includes a DevContainer configuration to quickly setup a environment with all required dependencies to start working right away. 
To do so simply open the project's `.code-workspace`, then use the remote development menu in the lower left to *Reopen in Container*.

### Debugging
#### PHPUnit
Sometimes it can be very useful to debug the test cases themself. This project provides the `Debug Tests` launch configuration in Visual Studio code 
as a convenient way to run PHPUnit as well as to setup xDebug.

#### Workbench
The Orchestral Workbench used for functional and browser based tests can also be previewed as well as debugged.

Use the following Orchestral Workbench command to generate an empty, persistent SQlite database in the Laravel skeleton.
```bash
vendor/bin/testbench package:create-sqlite-db
```

Next you will have to run the Migrations defined in the Workbench using the command below.
```bash
vendor/bin/testbench migrate
```

Now that the Orchestral Workbench environment has a functional database, you will have to create a user using the following command.
```bash
vendor/bin/testbench make:filament-user
```

Now that the Orchestral Workbench environment is completely setup, you can use the `Debug Workbench` launch configuration in Visual Studio Code. 
This will start the builtin webserver using Laravel's `serve` command as well as to setup xDebug.