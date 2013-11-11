function register_my_menus() {
  register_nav_menus(
    array(  
    	'codrops_header_navigation' => __( 'Codrops_Side' ), 
    	'codrops_bottom_navigation' => __( 'Codrops_Bottom' ), 
    )
  );
} 
add_action( 'init', 'register_my_menus' );


function copdrops_hp_nav() { 

$locations = get_registered_nav_menus();
$menus = wp_get_nav_menus();
$menu_locations = get_nav_menu_locations();

$sidemenu_location_id = 'codrops_header_navigation';
$bottommenu_location_id = 'codrops_bottom_navigation';

if (isset($menu_locations[ $sidemenu_location_id ])) {

	foreach ($menus as $menu) {
		
		if ($menu->term_id == $menu_locations[ $sidemenu_location_id ]) {
			// This is the correct menu

			// Get the items for this menu
			$sidemenu_items = wp_get_nav_menu_items($menu->term_id);
			
			$sidemenu_list = '<ul id="menu-' . '$sidemenu_name' . '">';
			
			// Loop through side menu items, and list
			foreach ( (array) $sidemenu_items as $key => $sidemenu_item ) {
				$title = $sidemenu_item->title;
				$url = $sidemenu_item->url;
				$sidemenu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
			}
		
			$sidemenu_list .= '</ul>';
			break;
		}
	}


}
else {
	$sidemenu_list = '<ul><li>side menuid "'. $sidemenu_location_id .'" is not defined</li></ul>';	
}

if (isset($menu_locations[ $bottommenu_location_id ])) {

	foreach ($menus as $menu) {
		
		if ($menu->term_id == $menu_locations[ $bottommenu_location_id ]) {
			// This is the correct menu

			// Get the items for this menu
			$bottommenu_items = wp_get_nav_menu_items($menu->term_id);
			
			$bottommenu_list = '<ul id="menu-' . '$bottommenu_name' . '">';
			
			// Loop through side menu items, and list
			foreach ( (array) $bottommenu_items as $key => $bottommenu_item ) {
				$title = $bottommenu_item->title;
				$url = $bottommenu_item->url;
				$classes = $bottommenu_item->classes['0'];
				$target = $bottommenu_item->target;
				$bottommenu_list .= '<li><a href="' . $url . '" class="bt-icon icon-'. $classes . '" target="'. $target .'">' . $title . '</a></li>';
			}
		
			$bottommenu_list .= '</ul>';
			break;
		}
		
	}


	}
	else {
		$bottommenu_list = '<ul><li>bottom menuid "'. $bottommenu_location_id .'" is not defined</li></ul>';
	}


	$menu_list = '<nav id="bt-menu" class="bt-menu">';
	$menu_list .= '<a href="#" class="bt-menu-trigger"><span>Menu</span></a>';
	$menu_list .= $sidemenu_list;
	$menu_list .= $bottommenu_list;
	$menu_list .= '</nav>';

	echo $menu_list ;
}