# External Assets Handler for Concrete5
[![Latest Version on Packagist](https://img.shields.io/packagist/v/xanweb/c5-ext-asset.svg?style=flat-square)](https://packagist.org/packages/xanweb/c5-ext-asset)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

Register assets within any library under Concrete5 Assets System

## Installation

Include library to your composer.json
```bash
composer require xanweb/c5-ext-asset
```

## Usage
* To Register an asset you need to use your library name like the example below ["xanweb/c5-js-cookie"](https://github.com/Xanweb/c5-js-cookie/blob/master/composer.json#L2).
* Supported Asset Types: ['vendor-javascript', 'vendor-css']  
* You can check the ["xanweb/c5-js-cookie"](https://github.com/Xanweb/c5-js-cookie) library as example
```php
<?php

use Xanweb\ExtAsset\Asset\VendorAssetManager;

VendorAssetManager::registerMultiple([
    'js-cookie' => [
        ['vendor-javascript', 'js/js.cookie.min.js', 'xanweb/c5-js-cookie', ['minify' => false, 'version' => '3.0.0-beta.3']],
    ],
]);

VendorAssetManager::registerGroup('myAsset/group', [
    ['javascript', 'jquery'],
    ['vendor-javascript', 'js-cookie'], // Just as example. js cookie doesn't require any dependencies
    ['vendor-css', 'other/library'],
    ['css', 'some/core/asset'],
]);
```

To use the library, as usual you requireAsset method
```php
<?php
    $g = \Concrete\Core\Http\ResponseAssetGroup::get();
    $g->requireAsset('vendor-javascript', 'js-cookie');
```

## License
The Concrete5 External Assets is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
