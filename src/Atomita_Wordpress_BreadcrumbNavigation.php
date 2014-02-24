<?php

/**
 * breadcrumb navigation
 */
class Atomita_Wordpress_BreadcrumbNavigation
{
	var $name = 'breadcrumb-nabigation';
	
	var $template = <<<EOD
<div class="level-%d %s" %s itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
	<a href="%s" itemprop="url">
		<span itemprop="title">%s</span>
	</a>%s
	%s
</div>
EOD;
	
	
	static function instance()
	{
		static $instance;
		if (isset($instance)){
			$instance = new self();
		}
		return $instance;
	}
	
	static function expansion()
	{
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
				return Atomita_Wordpress_BreadcrumbNavigation::instance()->get($id);
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
				return Atomita_Wordpress_BreadcrumbNavigation::instance()->getlist($id);
			}
		}
	}

	/**
	 * make breadcrumb navigation
	 * @param $id int	post id
	 * @return string
	 */
	function get($id = null)
	{
		apply_filters("{$this->name}-before-get-breadcrumb-navigation");

		$around = apply_filters("{$this->name}-around-get-breadcrumb-navigation", '', $id);
		if (!empty($around) or false === $around){
			$navigation = $around;
		}
		else{
			$template	= apply_filters("{$this->name}-after-template", $this->template);
			$navigation = $this->templateApplied($template, $this->getList($id));
		}
		return apply_filters("{$this->name}-after-get-breadcrumb-navigation", $navigation, $id);
	}

	protected function templateApplied($template, array $breadcrumbs, $level = 1, $class = '', $child = '')
	{
		if (empty($breadcrumbs)){
			return '';
		}
		$breadcrumb = (object)array_shift($breadcrumbs);
		$args = apply_filters(
			"{$this->name}-after-format-params",
			array(
				$template, $level, $class, $child,
				esc_url($breadcrumb->url),
				esc_html($breadcrumb->title),
				empty($breadcrumbs) ? '' : ' &gt;',
				$this->templateApplied($template, $breadcrumbs, $level, empty($breadcrumbs) ? 'last' : '', 'itemprop="child"')));
		
		return call_user_func_array('sprintf', $args);
	}
	

	/**
	 * make breadcrumb list
	 * @param $id int	post id
	 * @return array
	 */
	function getList($id = null)
	{
		apply_filters("{$this->name}-before-get-breadcrumbs");

		$around = apply_filters("{$this->name}-around-get-breadcrumbs", array(), $id);
		if (!empty($around) or false === $around){
			$breadcrumbs = is_array($around) ? $around : array();
		}
		else{

			$breadcrumbs = array();
			if ($this->is('home', $id) or $this->is('front_page', $id)){
				
			}
			elseif ($this->is('single', $id)) {
				$url   = get_permalink($id);
				$title = get_the_title($id);

				$post_type = get_post_type($id);
				switch ($post_type){
					case 'post':
						break;
					default:
						$post_type_obj = get_post_type_object($post_type);
						$breadcrumbs[] = array(
							'url'	=> home_url('/') . $post_type,
							'title' => $post_type_obj->label
						);
				}
			}
			elseif ($this->is('page', $id)) {
				$url   = get_permalink($id);
				$title = get_the_title($id);

				$ancestors = get_post_ancestors($id);
				foreach ($ancestors as $ancestor){
					$breadcrumbs[] = array(
						'url'	=> get_permalink($ancestor),
						'title' => get_the_title($ancestor)
					);
				}
			}
			elseif ($this->is('archive', $id)) {
				if (is_category()) {
					$cat	  = get_query_var('cat');
					$category = get_term($cat, 'category');
					$url	  = get_category_link($cat);
					$title	  = sprintf(__('category "%s" archive'), $category->name);
				}
				elseif (is_tag()) {
					$id    = get_query_var('tag');
					$tag   = get_term_by('slug', $id, 'post_tag');
					$url   = get_tag_link($tag);
					$title = sprintf(__('tag "%s" archive'), $tag->name);
				}
				else{
					// other post type
					$post_type	   = get_post_type();
					$post_type_obj = get_post_type_object($post_type);
					$url		   = home_url('/') . $post_type;
					$title		   = $post_type_obj->label;
				}
			}
			elseif($this->is('search', $id)) {
				$url = home_url() . '?s=' . get_query_var('s');
				$title = sprintf(__('"%s" Searched'), get_query_var('s'));
			}

			if (isset($url)){
				$breadcrumbs[] = compact('url', 'title');
			}

			if (!empty($breadcrumbs)){
				array_unshift($breadcrumbs, array('url' => home_url('/'), 'title' => __('HOME')));
			}
		}
		return apply_filters("{$this->name}-after-get-breadcrumbs", $breadcrumbs, $id);
	}

	private function is($func, $id)
	{
		static $null_only = array('front_page', 'home', 'archive', 'search');
		
		$is_func = "is_{$func}";
		if (is_null($id)){
			return $is_func();
		}
		else{
			if (!in_array($func, $null_only)){
				return $is_func($id);
			}
		}
		return false;
	}
	
}
