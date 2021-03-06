## Mustard Messaging module

[![StyleCI](https://styleci.io/repos/45992045/shield?style=flat)](https://styleci.io/repos/45992045)
[![Build Status](https://travis-ci.org/hamjoint/mustard-messaging.svg)](https://travis-ci.org/hamjoint/mustard-messaging)
[![Total Downloads](https://poser.pugx.org/hamjoint/mustard-messaging/d/total.svg)](https://packagist.org/packages/hamjoint/mustard-messaging)
[![Latest Stable Version](https://poser.pugx.org/hamjoint/mustard-messaging/v/stable.svg)](https://packagist.org/packages/hamjoint/mustard-messaging)
[![Latest Unstable Version](https://poser.pugx.org/hamjoint/mustard-messaging/v/unstable.svg)](https://packagist.org/packages/hamjoint/mustard-messaging)
[![License](https://poser.pugx.org/hamjoint/mustard-messaging/license.svg)](https://packagist.org/packages/hamjoint/mustard-messaging)

User messaging support for [Mustard](http://withmustard.org/), the open source marketplace platform.

### Installation

#### Via Composer (using Packagist)

```sh
composer require hamjoint/mustard-messaging
```

Then add the Service Provider to config/app.php:

```php
Hamjoint\Mustard\Messaging\Providers\MustardMessagingServiceProvider::class
```

### Licence

Mustard is free and gratis software licensed under the [GPL3 licence](https://www.gnu.org/licenses/gpl-3.0). This allows you to use Mustard for commercial purposes, but any derivative works (adaptations to the code) must also be released under the same licence. Mustard is built upon the [Laravel framework](http://laravel.com), which is licensed under the [MIT licence](http://opensource.org/licenses/MIT).
