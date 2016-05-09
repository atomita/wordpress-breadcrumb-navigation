WordPress Breadcrumb Navigation
========================

# Install

```sh
composer require atomita/wordpress-breadcrumb-navigation
```

# Example

```php
require "vendor/autoload.php";

use atomita\wordpress\BreadcrumbNavigationFacade;

BreadcrumbNavigationFacade::expandFunction();

the_breadcrumb_navigation(); // output breadcrumb
```

```php
require "vendor/autoload.php";

use atomita\wordpress\BreadcrumbNavigationFacade;

BreadcrumbNavigationFacade::expandFunction();

add_filter('breadcrumb-navigation-around-getlist', function($breadcrumb){
  $breadcrumb[] = [
    'url' => '/',
    'title => 'home'
  ];
  $breadcrumb[] = [
    'url' => '/foo',
    'title => 'foo'
  ];
  return $breadcrumb;
});

the_breadcrumb_navigation(); // output breadcrumb
```
