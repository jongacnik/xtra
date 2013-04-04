<?php 

//init post thumbnails
add_theme_support('post-thumbnails');

////////////////////////
// Customize Menu Order
////////////////////////
function remove_menus () {
global $menu;
	$restricted = array(__('Posts'), __('Comments'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');
function custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	
	return array(
		'index.php', // Dashboard
		'separator1', // First separator

		'edit.php?post_type=issue', // Issues
		'edit.php?post_type=article', // Articles
		'edit.php?post_type=event', // Events
		'edit.php?post_type=page', // Pages
		'edit.php?post_type=advertisement', // Ads
		//'edit.php', // Posts
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
add_action( 'admin_head', 'cpt_icons' );
function cpt_icons() { ?>

    <style type="text/css" media="screen">
        #menu-posts-issue .wp-menu-image,
        #menu-posts-article .wp-menu-image,
        #menu-posts-event .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/_img/custom_menu.gif) no-repeat !important;
        }
        #menu-posts-issue .wp-menu-image { background-position: 1px -34px !important; }
        #menu-posts-issue:hover .wp-menu-image { background-position: 1px -2px !important; }
        #menu-posts-article .wp-menu-image { background-position: -29px -34px !important; }
        #menu-posts-article:hover .wp-menu-image { background-position: -29px -2px !important; }
        #menu-posts-event .wp-menu-image { background-position: -59px -34px !important; }
        #menu-posts-event:hover .wp-menu-image { background-position: -59px -2px !important; }
    </style>

<?php }

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
// Event Post Type
////////////////////////
function event() {
	$labels = array(
		'name'               => _x( 'Events', 'post type general name' ),
		'singular_name'      => _x( 'event', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Event' ),
		'add_new_item'       => __( 'Add New Event' ),
		'edit_item'          => __( 'Edit Event' ),
		'new_item'           => __( 'New Event' ),
		'all_items'          => __( 'All Events' ),
		'view_item'          => __( 'View Event' ),
		'search_items'       => __( 'Search Events' ),
		'not_found'          => __( 'No events found' ),
		'not_found_in_trash' => __( 'No events found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Events'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'All Events',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'events')
	);
	register_post_type( 'event', $args );	
}
add_action( 'init', 'event' );

////////////////////////
// Ads Post Type
////////////////////////
function advertisement() {
	$labels = array(
		'name'               => _x( 'Advertisements', 'post type general name' ),
		'singular_name'      => _x( 'advertisement', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'advertisement' ),
		'add_new_item'       => __( 'Add New advertisement' ),
		'edit_item'          => __( 'Edit advertisement' ),
		'new_item'           => __( 'New advertisement' ),
		'all_items'          => __( 'All Advertisements' ),
		'view_item'          => __( 'View advertisement' ),
		'search_items'       => __( 'Search Advertisements' ),
		'not_found'          => __( 'No Advertisements found' ),
		'not_found_in_trash' => __( 'No Advertisements found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Ads'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'All Advertisements',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor'),
		'has_archive'   => false,
		'rewrite' => array('slug' => 'advertisements')
	);
	register_post_type( 'advertisement', $args );	
}
add_action( 'init', 'advertisement' );

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
  
   wp_register_script( 'cycle', get_template_directory_uri().'/_js/jquery.cycle.all.js');
   wp_enqueue_script('cycle');

   wp_register_script( 'stuck', get_template_directory_uri().'/_js/jquery.stuckontop.js');
   wp_enqueue_script('stuck');

   wp_register_script( 'shadowbox', get_template_directory_uri().'/_js/shadowbox.js');
   wp_enqueue_script('shadowbox');

   wp_register_script( 'magic', get_template_directory_uri().'/_js/magic.js');
   wp_enqueue_script('magic');
}
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');

////////////////////////
// Dashboard Additions
////////////////////////
add_action( 'admin_footer-index.php', 'wpse_82132_hide_rows' );

function wpse_82132_hide_rows(){
    $rows = array ('cats','tags','posts');
    $find = '.' . join( ',.', $rows ); ?>
	<script>
	jQuery( function( $ ) {
	    $("#dashboard_right_now").find('<?php echo $find; ?>').parent().addClass('hidden');
	});
	</script>
<?php }

function my_dash() {
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

	$types = array('issue','article');
	foreach($types as $type){
		$num_type = wp_count_posts( $type );
	    $num = number_format_i18n( $num_type->publish );
	    $text = _n( $type, $type.'s', $num_type->publish );
	    if ( current_user_can( 'edit_pages' ) ) { 
	        $num = "<a href='edit.php?post_type=$type'>$num</a>";
	        $text = "<a href='edit.php?post_type=$type'>".ucfirst($text)."</a>";
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
    
}
add_action( 'right_now_content_table_end', 'my_dash' );

////////////////////////
// Add Image Sizes
////////////////////////
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'advertisement', 75, 75, true );
	add_image_size( 'slider', 700, 427, true );
	add_image_size( 'artist-banner', 940, 427, true );
	add_image_size( 'artist-project-image', 1200, 9999, false );
}

////////////////////////
// Attachements
////////////////////////
define( 'ATTACHMENTS_DEFAULT_INSTANCE', false );
function my_attachments( $attachments )
{
  $args = array(
    'label'         => "Attached Images (For Artist's Project & Events)",
    'post_type'     => array( 'article', 'event' ),
    'filetype'      => null,
    'note'          => 'Attach files here!',
    'button_text'   => __( 'Attach Files', 'attachments' ),
    'modal_text'    => __( 'Attach', 'attachments' ),
 
    'fields'        => array(
      array(
        'name'  => 'title',                          // unique field name
        'type'  => 'text',                           // registered field type
        'label' => __( 'Title', 'attachments' ),     // label to display
      )
    ),
 
  );
 
  $attachments->register( 'my_attachments', $args ); // unique instance name
}
 
add_action( 'attachments_register', 'my_attachments' );

////////////////////////
// NEXT AND NUMBER LINKS
////////////////////////
add_filter('wp_link_pages_args','add_next_and_number');
function add_next_and_number($args){
    if($args['next_or_number'] == 'next_and_number'){
        global $page, $numpages, $multipage, $more, $pagenow;
        $args['next_or_number'] = 'number';
        $prev = '';
        $next = '';
        if ( $multipage ) {
            if ( $more ) {
                $i = $page - 1;
                if ( $i && $more ) {
                    $prev .= '<span class="np">' . _wp_link_page($i);
                    $prev .= $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a></span>';
                }
                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
                    $next .= '<span class="np">' . _wp_link_page($i);
                    $next .= $args['link_before']. $args['nextpagelink'] . $args['link_after'] . '</a></span>';
                }
            }
        }
        $args['before'] = $args['before'].$prev;
        $args['after'] = $next.$args['after'];    
    }
    return $args;
}


////////////////////////
// BETTER EXCERPT
////////////////////////
function improved_trim_excerpt($text) {
    global $post;
    if ( '' == $text ) {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = str_replace('\]\]\>', ']]&gt;', $text);
        $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
        $text = strip_tags($text, '<p>, <a>');
        $excerpt_length = 80;
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words)> $excerpt_length) {
            array_pop($words);
            array_push($words, '[...]');
            $text = implode(' ', $words);
        }
    }
    return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');
function excerpt_ellipse($text) {
   return str_replace('[...]', ' ...<br><br><b><a href="'.get_permalink().'" style="text-decoration:none;">Read More &rarr;</a></b>', $text); }
add_filter('the_excerpt', 'excerpt_ellipse');

////////////////////////
// Season Number
////////////////////////
$numbers = array(
	'fall' 		=> 'Number 1',
	'winter'	=> 'Number 2',
	'spring'	=> 'Number 3',
	'summer'	=> 'Number 4'
);
?>