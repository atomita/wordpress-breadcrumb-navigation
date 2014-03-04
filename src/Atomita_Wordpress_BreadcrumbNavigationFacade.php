<?php

/**
 * Facade of Atomita_Wordpress_BreadcrumbNavigation
 * 
 * @author atomita
 */
class Atomita_Wordpress_BreadcrumbNavigationFacade
{
	static protected function facadeInstance()
	{
		static $instance;
		if (!isset($instance)){
			$instance = new Atomita_Wordpress_BreadcrumbNavigation();
		}
		return $instance;
	}

	static function __callStatic($method, $args)
	{
		$instance = self::facadeInstance();
		return call_user_func_array(array($instance, $method), $args);
	}

	/**
	 * Expand function
	 */
	static function expandFunction()
	{
		if (!function_exists('the_breadcrumb_navigation')){
			/**
			 * breadcrumb navigation output
			 * @param	$id	int	post id
			 */
			function the_breadcrumb_navigation($id = null)
			{
				echo get_the_breadcrumb_navigation($id);
			}
		}
		
		if (!function_exists('get_the_breadcrumb_navigation')){
			/**
			 * make breadcrumb navigation
			 * @param	$id	int	post id
			 * @return	string
			 */
			function get_the_breadcrumb_navigation($id = null)
			{
				return Atomita_Wordpress_BreadcrumbNavigationFacade::get($id);
			}
		}
		
		if (!function_exists('get_breadcrumbs')){
			/**
			 * make breadcrumb list
			 * @param	$id	int	post id
			 * @return	array
			 */
			function get_breadcrumbs($id = null)
			{
				return Atomita_Wordpress_BreadcrumbNavigationFacade::getlist($id);
			}
		}
	}

}
