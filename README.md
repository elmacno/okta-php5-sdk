# Okta PHP 5 SDK

The official [Okta PHP sdk](https://github.com/okta/okta-sdk-php) transpiled to PHP 5.5 compatible code so that it can be used with the Centos6.5 sandboxes.

## Table of Contents

 * [Installation](#installation)
 * [Usage](#usage)
 * [Do it yourself](#do-it-yourself)

## Installation

To add this library to your own project, run:
```sh
composer config repositories.repo-name vcs https://github.eagleview.com/engineering/okta-php5-sdk.git
composer require okta/php5-sdk:dev-master
```

## Usage

To use the library you can follow the [examples](https://github.com/okta/okta-sdk-php#client-initialization) in the official repository, and also here's the [SDK documentation](https://developer.okta.com/okta-sdk-php/develop/index.html).

## Do it yourself

Here are the steps you can follow to get to this library by hand.

1. Download the official okta php sdk:
   ```sh
   git clone https://github.com/okta/okta-sdk-php.git
   ```
2. Install spatie's 7to5 php transpiler globally (it's only global to your user, not system-wide):
   ```sh
   composer global require spatie/7to5
   ```
3. Use the newly installed tool to transpile the whole okta library to php 5.6 (we'll need to downgrade some stuff manually to php 5.5):
   ```sh
   php7to5 okta-sdk-php okta-sdk-php5 --copy-all # or maybe ~/.composer/vendor/spatie/7to5/php7to5 if it
                                                 # wasn't added to the bin path automatically
   ```
4. On a temporary directory, we'll need to install all okta-sdk-php's requirements, but for PHP 5.5 instead of PHP 7:
   ```sh
   mkdir temp && cd temp
   composer init --quiet
   composer require psr/http-message        \
                    php-http/client-common  \
                    php-http/client-common  \
                    php-http/message        \
                    php-http/discovery      \
                    php-http/curl-client    \
                    symfony/yaml            \
                    nesbot/carbon           \
                    tightenco/collect       \
                    guzzlehttp/psr7         \
                    psr/cache               \
                    league/flysystem-memory \
                    cache/filesystem-adapter
   ```
5. Once the packages are installed and downloaded, then open the `composer.json` file and copy the requirements section and replace the one on `okta-sdk-php5`. Make sure to replace also the php version to the correct one:
   ```json
   "require": {
        "php": "^5.5",
        "psr/http-message": "^1.0",
        "php-http/client-common": "^1.7",
        "php-http/httplug": "^1.1",
        "php-http/message": "^1.7",
        "php-http/discovery": "^1.4",
        "php-http/curl-client": "^1.7",
        "symfony/yaml": "^3.4",
        "nesbot/carbon": "^1.33",
        "tightenco/collect": "^5.3",
        "guzzlehttp/psr7": "^1.4",
        "psr/cache": "^1.0",
        "league/flysystem-memory": "^1.0",
        "cache/filesystem-adapter": "^0.3.3"
    }
   ```
   Most likely the version numbers will be the same as these ones, but it's better to let composer decide.
6. In that `composer.json` file, you can also change the package name to something more suitable. The end result should be something like this:
   ```json
    {
      "name": "okta/php5-sdk",
      "description": "PHP5 Wrapper for the Okta API",
      "type": "library",
      "license": "Apache-2.0",
      "authors": [
          {
              "name": "Your Name",
              "email": "your.name@eagleview.com"
          }
      ],
      "require": {
          "php": "^5.5",
          "psr/http-message": "^1.0",
          "php-http/client-common": "^1.7",
          "php-http/httplug": "^1.1",
          "php-http/message": "^1.7",
          "php-http/discovery": "^1.4",
          "php-http/curl-client": "^1.7",
          "symfony/yaml": "^3.4",
          "nesbot/carbon": "^1.33",
          "tightenco/collect": "^5.3",
          "guzzlehttp/psr7": "^1.4",
          "psr/cache": "^1.0",
          "league/flysystem-memory": "^1.0",
          "cache/filesystem-adapter": "^0.3.3"
      },
      "autoload": {
          "psr-4": {
              "Okta\\": "src"
          }
      }
    }
   ```
7. The only thing left to do is to modify some code on the library to account for the dependencies changes and some more downgrading, because `php7to5` transpiles to PHP 5.6 and our Centos6.5 sandbox uses PHP 5.5:
   1. First open `src/Resource/AbstractCollection.php` and replace the `Tightenco\Collect` namespace with `Illuminate`:
      ```diff
      - use Tightenco\Collect\Support\Collection;
      - use Tightenco\Collect\Support\Arr;
      + use Illuminate\Support\Collection;
      + use Illuminate\Support\Arr;
      ```
   2. Then, in `src/DataStore/DefaultDataStore.php`, we need to remove the `use function` import by:
      1. Replacing the import with a namespace alias:
         ```diff
         - use function GuzzleHttp\Psr7\build_query;
         - use function GuzzleHttp\Psr7\parse_query;
         + use GuzzleHttp\Psr7 as GuzzleHttpPsr7;
         ```      
      2. Replace calls to `build_query` and `parse_query` with `GuzzleHttpPsr7\build_query` and `GuzzleHttpPsr7\parse_query`, respectively:
         ```diff
            */
           private function appendQueryValues($currentQuery, $queryDictionary)
           {
         -   $currentQueryParts = parse_query($currentQuery);
         +   $currentQueryParts = GuzzleHttpPsr7\parse_query($currentQuery);
             if ($currentQuery == '') {
               $result = [];
             }
         ```
         and
         ```diff
               }
             }
             $result = array_replace_recursive($currentQueryParts, $result);
         -   return build_query($result);
         +   return GuzzleHttpPsr7\build_query($result);
           }
           /**
            * Get the current PluginClient instance.
         ```
And that is it!
