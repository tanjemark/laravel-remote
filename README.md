# Laravel Remote

[![GitHub issues](https://img.shields.io/github/issues/tanjemark/remote.svg?style=flat-square)](https://github.com/tanjemark/remote/issues)
[![GitHub forks](https://img.shields.io/github/forks/tanjemark/remote.svg?style=flat-square)](https://github.com/tanjemark/remote/network)
[![GitHub stars](https://img.shields.io/github/stars/tanjemark/remote.svg?style=flat-square)](https://github.com/tanjemark/remote/stargazers)
[![GitHub license](https://img.shields.io/github/license/tanjemark/remote.svg?style=flat-square)](https://github.com/tanjemark/remote/blob/master/LICENSE)
[![Twitter](https://img.shields.io/twitter/url/https/github.com/tanjemark/remote.svg?style=flat-square)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2Ftanjemark%2Fremote)

Execute commands remotely using SSH.

---

## Installation

Require this package in your composer.json and update your dependencies:

```bash
$ composer require tanjemark/laravel-remote
```

Since this package supports Laravel's Package Auto-Discovery
you don't need to manually register the ServiceProvider.

After that, publish the configuration file:
```bash
$ php artisan vendor:publish --provider="Tanjemark\LaravelRemote\RemoteServiceProvider"
```
You're gonna need to add a remote server to the configuration file.


## Usage

### Artisan
```bash
$ php artisan remote:artisan '@alias' 'command'
```

```bash
# Example
$ php artisan remote:artisan @live migrate 
```

### Database sync
If you have provided a `fake` setting in `config/remote.php` the provided columns will be faked. Making it possible to make your sync GDPR approved 😁

```bash
$ php artisan remote:db-sync '@from_alias' '@to_alias'
```

```bash
# Example
$ php artisan remote:db-sync @live @local --fake
```

## Requirements
ssh2 have to be installed on all your servers.

```bash
$ sudo apt-get install php7.2-ssh2
```

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
