<?php

if (!function_exists('the_breadcrumb_navigation')){
	/**
	 * breadcrumb navigation output
	 * @param $id int	post id
	 */
	function the_breadcrumb_navigation($id = null)
	{
		echo get_the_breadcrumb_navigation($id);
	}
}

if (!function_exists('get_the_breadcrumb_navigation')){
	/**
	 * make breadcrumb navigation
	 * @param $id int	post id
	 * @return string
	 */
	function get_the_breadcrumb_navigation($id = null)
	{
		return \atomita\wordpress\BreadcrumbNavigationFacade::get($id);
	}
}

if (!function_exists('get_breadcrumbs')){
	/**
	 * make breadcrumb list
	 * @param $id int	post id
	 * @return array
	 */
	function get_breadcrumbs($id = null)
	{
		return \atomita\wordpress\BreadcrumbNavigationFacade::getlist($id);
	}
}
