# Filament Blocks Builder
This Filament PHP plugin adds a `BlockBuilder` form component, that allows you to create layouts using Blocks. This can be used as a builder for anything: layout, content, data and more.

## Installation
The package can be installed throught Composer by using the following command:
```sh
composer require skyraptor/filament-blocks-builder
```

### Patching
**Important:** This package does utilize `cweagans/composer-patches` in order to apply [a patch](https://patch-diff.githubusercontent.com/raw/filamentphp/filament/pull/13973.diff) required to fix a [bug](https://github.com/filamentphp/filament/pull/13973) in Filament PHP. This step will be removed once [the pull request](https://github.com/filamentphp/filament/pull/13973) to resolve this issue has been merged and Filament PHP updated.

Add the following to your project composer.json's extra secion in order to enable patches:
```json
"extra": {
    "composer-exit-on-patch-failure": true,
    "enable-patching": true,
    "patchLevel": {
        "filament/forms": "-p3"
    }
}
```
- `composer-exit-on-patch-failure`: This will ensure that the composer install / update commands will exit unsuccsessfully in case a patch could not be applied.
- `enable-patching`: This will enable patching without the need for the project to define it's own patches - i.e. install patches from packages.
- `patchLevel`: This adjusts the file paths inside the patch by removing the amount of slashes from the beginning of the file path.

## Useage
TODO
