<?php

if (false){
	
	/**
	 * breadcrumb navigation
	 * 
	 * @author atomita
	 */
	class atomita_wordpress_BreadcrumbNavigation
	{

		/**
		 * @param	$name	string	
		 * @param	$template	string	
		 */
		function __construct($name = 'breadcrumb-nabigation', $template = null){}

		/**
		 * @param	$template	string
		 * @return	$this
		 */
		function setTemplate($template){}

		/**
		 * set default template
		 * @return	$this
		 */
		function resetTemplate(){}

		/**
		 * make breadcrumb navigation
		 * @param	$id	int	post id
		 * @return	string
		 */
		function get($id = null){}

		/**
		 * make breadcrumb list
		 * @param $id int	post id
		 * @return array
		 */
		function getList($id = null){}
	
	}

}
else{
	$file = '/atomita/wordpress/BreadcrumbNavigation.php';
	if ('/' != DIRECTORY_SEPARATOR){
		$file = str_replace('/', DIRECTORY_SEPARATOR, $file);
	}
	
	$definition = ltrim(file_get_contents(dirname(__FILE__) . $file), '<?php');

	eval(str_replace(
		array(
			'namespace atomita\\wordpress;',
			'class BreadcrumbNavigation',
		),
		array(
			'',
			'class atomita_wordpress_BreadcrumbNavigation',
		),
		$definition));
}
