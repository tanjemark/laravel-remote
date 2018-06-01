# Remote

[![GitHub issues](https://img.shields.io/github/issues/tanjemark/remote.svg?style=flat-square)](https://github.com/tanjemark/remote/issues)
[![GitHub forks](https://img.shields.io/github/forks/tanjemark/remote.svg?style=flat-square)](https://github.com/tanjemark/remote/network)
[![GitHub stars](https://img.shields.io/github/stars/tanjemark/remote.svg?style=flat-square)](https://github.com/tanjemark/remote/stargazers)
[![GitHub license](https://img.shields.io/github/license/tanjemark/remote.svg?style=flat-square)](https://github.com/tanjemark/remote/blob/master/LICENSE)
[![Twitter](https://img.shields.io/twitter/url/https/github.com/tanjemark/remote.svg?style=flat-square)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2Ftanjemark%2Fremote)

---

Execute php artisan commands remotely using SSH.

## Installation

Require this package in your composer.json and update your dependencies:

```bash
composer require tanjemark/remote
```

Since this package supports Laravel's Package Auto-Discovery
you don't need to manually register the ServiceProvider.

After that, publish the configuration file:
```bash
php artisan vendor:publish --provider="Anjemark\Remote\RemoteServiceProvider"
```
You're gonna need to add a remote server to the configuration file.


## Usage

```bash
php artisan remote:artisan '@channel' 'command'
```

Example
```bash
php artisan remote:artisan @live migrate 
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
