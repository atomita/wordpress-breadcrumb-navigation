<?php

namespace Atomita\Wordpress;

/**
 * Facade of BreadcrumbNavigation
 */
class BreadcrumbNavigationFacade extends \Atomita\Facade
{

	static protected function facadeInstance()
	{
		static $instance;
		if (!isset($instance)){
			$instance = new BreadcrumbNavigation();
		}
		return $instance;
	}

	/**
	 * Expand function
	 */
	static function expandFunction()
	{
		include_once rtrim(__FILE__, 'Facade.php') . DIRECTORY_SEPARATOR . 'functions.php';
	}

}
