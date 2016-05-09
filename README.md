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
    'url' => 'https://example.com',
    'title => 'home'
  ];
  $breadcrumb[] = [
    'url' => 'https://example.com/foo',
    'title => 'foo'
  ];
  return $breadcrumb;
});

the_breadcrumb_navigation(); // output breadcrumb

/* output
<div class="level-1 " itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
	<a href="https://example.com" itemprop="url">
		<span itemprop="title">home</span>
	</a> &gt;
	<div class="level-2 last" itemprop="child" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
		<a href="https://example.com/foo" itemprop="url">
			<span itemprop="title">foo</span>
		</a>
	</div>
</div>
*/
```
