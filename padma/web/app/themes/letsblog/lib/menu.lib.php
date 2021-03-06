<?php
/*
 *  Setup main navigation menu
 */
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu', THEMEDOMAIN ) );
	register_nav_menu( 'top-menu', __( 'Top Bar Menu', THEMEDOMAIN ) );
	register_nav_menu( 'side-menu', __( 'Side (Mobile) Menu', THEMEDOMAIN ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu', THEMEDOMAIN ) );
}

class Lets_Blog_walker extends Walker_Nav_Menu {

	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field])) { 
            $element->classes[] = 'arrow'; //enter any classname you like here!
        }
        
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
?>