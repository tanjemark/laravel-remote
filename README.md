# Remote

Execute all php artisan commands remotely using SSH

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
