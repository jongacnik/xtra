<?php 

//init post thumbnails
add_theme_support('post-thumbnails');

////////////////////////
// Customize Menu Order
////////////////////////
function custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	
	return array(
		'index.php', // Dashboard
		'separator1', // First separator

		'edit.php?post_type=issue', // Issues
		'edit.php?post_type=article', // Issues
		'edit.php?post_type=page', // Pages
		'edit.php', // Posts
		'upload.php', // Media

		'separator2', // Second separator
		'link-manager.php', // Links
		'edit-comments.php', // Comments
		'separator3', // Fifth separator
		'themes.php', // Appearance
		'plugins.php', // Plugins
		'users.php', // Users
		'tools.php', // Tools
		'options-general.php', // Settings
		'separator-last', // Last separator
	);
}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');




////////////////////////
// Change post to event
////////////////////////
// function change_post_menu_label() {
// 	global $menu;
// 	global $submenu;
// 	$menu[5][0] = 'Events';
// 	$submenu['edit.php'][5][0] = 'Events';
// 	$submenu['edit.php'][10][0] = 'Add Events';
// 	$submenu['edit.php'][16][0] = 'Events Tags';
// 	echo '';
// }
// function change_post_object_label() {
// 	global $wp_post_types;
// 	$labels = &$wp_post_types['post']->labels;
// 	$labels->name = 'Events';
// 	$labels->singular_name = 'Events';
// 	$labels->add_new = 'Add Events';
// 	$labels->add_new_item = 'Add Events';
// 	$labels->edit_item = 'Edit Events';
// 	$labels->new_item = 'Events';
// 	$labels->view_item = 'View Events';
// 	$labels->search_items = 'Search Events';
// 	$labels->not_found = 'No Events found';
// 	$labels->not_found_in_trash = 'No Events found in Trash';
// }
// add_action( 'init', 'change_post_object_label' );
// add_action( 'admin_menu', 'change_post_menu_label' );

// add_filter('gettext', 'change_post_to_article');
// add_filter('ngettext', 'change_post_to_article');
// function change_post_to_article($translated) {
// $translated = str_ireplace('Post', 'Event', $translated);
// return $translated;
// }


////////////////////////
// Article Post Type
////////////////////////
function article() {
	$labels = array(
		'name'               => _x( 'Articles', 'post type general name' ),
		'singular_name'      => _x( 'article', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Article' ),
		'add_new_item'       => __( 'Add New Article' ),
		'edit_item'          => __( 'Edit Article' ),
		'new_item'           => __( 'New Article' ),
		'all_items'          => __( 'All Articles' ),
		'view_item'          => __( 'View Article' ),
		'search_items'       => __( 'Search Articles' ),
		'not_found'          => __( 'No articles found' ),
		'not_found_in_trash' => __( 'No articles found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Articles'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'All Articles',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'article')
	);
	register_post_type( 'article', $args );	
}
add_action( 'init', 'article' );

////////////////////////
// Issue Post Type
////////////////////////
function issue() {
	$labels = array(
		'name'               => _x( 'Issues', 'post type general name' ),
		'singular_name'      => _x( 'issue', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Issue' ),
		'add_new_item'       => __( 'Add New Issue' ),
		'edit_item'          => __( 'Edit Issue' ),
		'new_item'           => __( 'New Issue' ),
		'all_items'          => __( 'All Issues' ),
		'view_item'          => __( 'View Issue' ),
		'search_items'       => __( 'Search Issues' ),
		'not_found'          => __( 'No Issues found' ),
		'not_found_in_trash' => __( 'No Issues found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Issues'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'All Issues',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'issue')
	);
	register_post_type( 'issue', $args );	
}
add_action( 'init', 'issue' );



////////////////////////
// Issue Taxonomy
////////////////////////
function issue_taxonomy_init() {
	$labels = array(
		'name'              => _x( 'Issue', 'taxonomy general name' ),
		'singular_name'     => _x( 'issue', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Issue' ),
		'all_items'         => __( 'All Issue' ),
		'parent_item'       => __( 'Parent Issue' ),
		'parent_item_colon' => __( 'Parent Issue:' ),
		'edit_item'         => __( 'Edit Issue' ), 
		'update_item'       => __( 'Update Issue' ),
		'add_new_item'      => __( 'Add New Issue' ),
		'new_item_name'     => __( 'New Issue' ),
		'menu_name'         => __( 'Issue' ),
	);
	$args = array(
		'labels' => $labels,
		'show_admin_column' => true,
		'hierarchical' => true
	);
	register_taxonomy( 'issue_taxonomy', 'article', $args );
}
add_action( 'init', 'issue_taxonomy_init', 0 );


////////////////////////
// Volume Taxonomy
////////////////////////
function volume_taxonomy_init() {
	$labels = array(
		'name'              => _x( 'Volume', 'taxonomy general name' ),
		'singular_name'     => _x( 'volume', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Volume' ),
		'all_items'         => __( 'All Volume' ),
		'parent_item'       => __( 'Parent Volume' ),
		'parent_item_colon' => __( 'Parent Volume:' ),
		'edit_item'         => __( 'Edit Volume' ), 
		'update_item'       => __( 'Update Volume' ),
		'add_new_item'      => __( 'Add New Volume' ),
		'new_item_name'     => __( 'New Volume' ),
		'menu_name'         => __( 'Volume' ),
	);
	$args = array(
		'labels' => $labels,
		'show_admin_column' => true,
		'hierarchical' => true
	);
	register_taxonomy( 'volume_taxonomy', array('article','issue'), $args );
}
add_action( 'init', 'volume_taxonomy_init', 0 );


////////////////////////
// Article Type Taxonomy
////////////////////////
function artType_taxonomy_init() {
	$labels = array(
		'name'              => _x( 'Type', 'taxonomy general name' ),
		'singular_name'     => _x( 'type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Type' ),
		'all_items'         => __( 'All Type' ),
		'parent_item'       => __( 'Parent Type' ),
		'parent_item_colon' => __( 'Parent Type:' ),
		'edit_item'         => __( 'Edit Type' ), 
		'update_item'       => __( 'Update Type' ),
		'add_new_item'      => __( 'Add New Type' ),
		'new_item_name'     => __( 'New Type' ),
		'menu_name'         => __( 'Type' ),
	);
	$args = array(
		'labels' => $labels,
		'show_admin_column' => true,
		'hierarchical' => true
	);
	register_taxonomy( 'artType_taxonomy', array('article'), $args );
}
add_action( 'init', 'artType_taxonomy_init', 0 );


////////////////////////
// Add Dropdown Filters
////////////////////////
function todo_restrict_manage_posts() {
    global $typenow;
    $args=array( 'public' => true, '_builtin' => false ); 
    $post_types = get_post_types($args);
    if ( in_array($typenow, $post_types) ) {
    $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            wp_dropdown_categories(array(
                'show_option_all' => __('Show All '.$tax_obj->label.'s' ),
                'taxonomy' => $tax_slug,
                'name' => $tax_obj->name,
                'orderby' => 'name',
                'selected' => $_GET[$tax_obj->query_var],
                'hierarchical' => $tax_obj->hierarchical,
                'show_count' => false,
                'hide_empty' => true
            ));
        }
    }
}
function todo_convert_restrict($query) {
    global $pagenow;
    global $typenow;
    if ($pagenow=='edit.php') {
        $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $var = &$query->query_vars[$tax_slug];
            if ( isset($var) ) {
                $term = get_term_by('id',$var,$tax_slug);
                $var = $term->slug;
            }
        }
    }
    return $query;
}
add_action( 'restrict_manage_posts', 'todo_restrict_manage_posts' );
add_filter('parse_query','todo_convert_restrict');


////////////////////////
// Add Thumbnail to Issue
////////////////////////
function my_columns( $columns ) {
	unset( $columns['date'] );
    $columns['cover'] = 'Cover';
    $columns['date'] = 'Date';
    return $columns;
}
function my_custom_columns($column){
	global $post;
	if($column == 'cover'){
		the_post_thumbnail( array(75,75) );
	}
}
add_action( 'manage_issue_posts_custom_column', 'my_custom_columns');
add_filter( 'manage_edit-issue_columns', 'my_columns' );

////////////////////////
// Include JS
////////////////////////
if (!is_admin()) add_action("wp_enqueue_scripts", "xtra_scripts");
function xtra_scripts() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
   wp_register_script( 'beast', get_template_directory_uri().'/_js/beast.js');
   wp_enqueue_script('beast');
}

////////////////////////
// Dashboard Additions
////////////////////////
add_action( 'admin_footer-index.php', 'wpse_82132_hide_rows' );

function wpse_82132_hide_rows(){
    $rows = array ('cats','tags');
    $find = '.' . join( ',.', $rows ); ?>
	<script>
	jQuery( function( $ ) {
	    $("#dashboard_right_now").find('<?php echo $find; ?>').parent().addClass('hidden');
	});
	</script>
<?php }

function my_dash() {
	$types = array('article','issue');
	foreach($types as $type){
		$num_type = wp_count_posts( $type );
	    $num = number_format_i18n( $num_type->publish );
	    $text = _n( $type, $type.'s', $num_type->publish );
	    if ( current_user_can( 'edit_pages' ) ) { 
	        $num = "<a href='edit.php?post_type=$type'>$num</a>";
	        $text = "<a href='edit.php?post_type=$type'>$text</a>";
	    }   

	    echo '<tr>';
	    echo '<td class="first b b_pages">' . $num . '</td>';
	    echo '<td class="t pages">' . $text . '</td>';
	    echo '</tr>';
	}

	$args = array(
    'public' => true,
    '_builtin' => false,
  );
  $output   = 'object';
  $operator = 'and';
	  $taxonomies = get_taxonomies( $args, $output, $operator );
	  foreach ( $taxonomies as $taxonomy ) {
	  	if($taxonomy->name == 'volume_taxonomy'){
		    $num_terms = wp_count_terms( $taxonomy->name );
		    $num = number_format_i18n( $num_terms );
		    $text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name, intval( $num_terms ) );
		    if ( current_user_can( 'manage_categories' ) ) {
		      $num  = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '">' . $num . '</a>';
		      $text = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '">' . $text . 's</a>';
		    }
		    echo '<tr><td class="first b b_pages">' . $num . '</td>';
		    echo '<td class="t pages">' . $text . '</td></tr>';
		}
	  }
    
}
add_action( 'right_now_content_table_end', 'my_dash' );


?>