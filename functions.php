<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION
add_action ( 'admin_enqueue_scripts', function () {
    if (is_admin ())
        wp_enqueue_media ();
} );


function ppoutput(){
    // echo "yes";
    include("popup_settings_html.php");
    // popup_settings_html.php
    
}
// Register settings using the Settings API 
function pp_register_my_setting() {
    // register_setting( 'my-options-group', 'my-option-name', 'intval' ); 
    // echo "yes";
    add_menu_page( 'Pop up settings', 'Pop up settings', 'administrator', "popupset", 'ppoutput' );
} 

add_action( 'admin_menu', 'pp_register_my_setting' );


function featured_post_func( $atts, $content ) {
    $default = array(
        'post_slug' => 'sponsored-category',
    );
    $args = array(
      'name'        => $atts['post_slug'],
      'post_type'   => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 1
    );
    ?>
        <?php
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <!-- Desktop View -->
        <div class="home_featured_post hf_desktop">
        <div class="hf_post_img">
        <a href="<?php the_permalink();?>">
        <?php echo get_the_post_thumbnail(); ?>
        </a>
        </div>
        <div class="hf_post_data">
            <?php if( tie_get_option( 'post_tags' ) ) the_tags( '<p class="post-tag">'.__ti( '' )  ,' ', '</p>'); ?>
            <a href="<?php the_permalink();?>">
            <h3><?php the_title() ?></h3>
             </a>
            <div class="amr_post_meta_group">
                <?php if( ( tie_get_option( 'post_authorbio' ) && empty( $get_meta["tie_hide_author"][0] ) ) || ( isset( $get_meta["tie_hide_related"][0] ) && $get_meta["tie_hide_author"][0] == 'no' ) ): ?>
        			<p><?php the_author() ?></p><!-- #author-name -->
        		<?php endif; ?>
        		<p>&nbsp;|&nbsp;<?php echo get_the_date(); ?></p>
            </div>
            <p class="hf_post_details">
           <?php $content = get_the_content();
           echo wp_trim_words( get_the_content(), 100, '...' ); ?>
           </p>
        </div>
       </div>
       
       
       <!-- Mobile View -->
       <div class="home_featured_post hf_mobile">
        <div class="hf_post_data">
            <?php if( tie_get_option( 'post_tags' ) ) the_tags( '<p class="post-tag">'.__ti( '' )  ,' ', '</p>'); ?>
            <a href="<?php the_permalink();?>">
            <h3><?php the_title() ?></h3>
            </a>
            <div class="amr_post_meta_group">
                <?php if( ( tie_get_option( 'post_authorbio' ) && empty( $get_meta["tie_hide_author"][0] ) ) || ( isset( $get_meta["tie_hide_related"][0] ) && $get_meta["tie_hide_author"][0] == 'no' ) ): ?>
        			<p><?php the_author() ?></p><!-- #author-name -->
        		<?php endif; ?>
        		<p>&nbsp;|&nbsp;<?php echo the_date(); ?></p>
            </div>
            <div class="hf_post_img">
            <a href="<?php the_permalink();?>">
            <?php echo get_the_post_thumbnail(); ?>
            </a>
            </div>
            <p class="hf_post_details">
           <?php $content = get_the_content();
           echo wp_trim_words( get_the_content(), 100, '...' ); ?>
           </p>
        </div>
       </div>
       
       
       <?php 
       endwhile;
        ?>
    
    <?php
    
    wp_reset_postdata();
 
}
 
add_shortcode( 'featured_post', 'featured_post_func' );











function wpb_widgets_init() {
 
    register_sidebar( array(
        'name' => __( 'Post Sidebar', 'wpb' ),
        'id' => 'sidebar-1',
        'description' => __( 'The Post sidebar appears on the right on each page except the front page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_widgets_init' );

// post grid Function
add_shortcode('post_grid','post_grid_func');

function post_grid_func(){
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 6
    );
    
    $categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
    ?>
<!-------------------------------------------->
    <!--post categories title home page -->
    <?php
     echo '<div class="amr_post_category_titl">';
    foreach( $categories as $category ) {
    $category_link = sprintf( 
        '<a href="%1$s" alt="%2$s">%3$s</a>',
        esc_url( get_category_link( $category->term_id ) ),
        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
        esc_html( $category->name )
    );
    
    echo '<p>' . sprintf( esc_html__( '%s', 'textdomain' ), $category_link ) . '</p>' ;
    // echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
    // echo '<p>' . sprintf( esc_html__( 'Post Count: %s', 'textdomain' ), $category->count ) . '</p>';
}  echo '</div>';
    ?>
    
    <div class="huzi-cate-selectbox-div">
        <select id="huzi-cate-selectbox">
            <?php
            foreach(get_categories('parent=0&hide_empty=1') as $category) {
               echo '<option value="' . get_category_link($category->term_id) . '">' . $category->name . '</option>';
            }
            ?>
        </select>
    </div>
    
    
    
<!------------------------------------------------->
<div class="amr_post_side_container">
    <div class="amr_post_grid">
        <?php
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <div class="amr_post">
        <a class="huzi-post-img" href="<?php the_permalink();?>">
        <?php echo get_the_post_thumbnail(); ?>
        </a>
        <a href="<?php the_permalink();?>">
        <h3><?php the_title() ?></h3>
        </a>
        <div class="amr_post_meta_group">
        <?php if( tie_get_option( 'post_tags' ) ) the_tags( '<p>'.__ti( '' )  ,' | ', '&nbsp; / &nbsp;</p>'); ?> <!-- Post Tags -->
        <?php if( ( tie_get_option( 'post_authorbio' ) && empty( $get_meta["tie_hide_author"][0] ) ) || ( isset( $get_meta["tie_hide_related"][0] ) && $get_meta["tie_hide_author"][0] == 'no' ) ): ?>
			<p><?php the_author() ?></p><!-- #author-name -->
		<?php endif; ?>
		<p>&nbsp;|&nbsp;<?php echo get_the_date(); ?></p>
        </div>
        <p class="amr_post_details">
       <?php $content = get_the_content();
       echo wp_trim_words( get_the_content(), 30, '...' ); ?>
       </p>
       </div>
    
       <?php 
       endwhile;
        ?>
    </div>
     <div class="amr_blog_sidebar">
            <?php dynamic_sidebar('sidebar-1'); ?>
       </div>
</div>

<!-------------------------------------------->
    <!--post categories title home page -->
    <?php
     echo '<div class="amr_post_category_titl amr_bottom_category">';
    foreach( $categories as $category ) {
    $category_link = sprintf( 
        '<a href="%1$s" alt="%2$s">%3$s</a>',
        esc_url( get_category_link( $category->term_id ) ),
        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
        esc_html( $category->name )
    );
     
    echo '<p>' . sprintf( esc_html__( '%s', 'textdomain' ), $category_link ) . '</p>' ;
   
    // echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
    // echo '<p>' . sprintf( esc_html__( 'Post Count: %s', 'textdomain' ), $category->count ) . '</p>';
}  echo '</div>';
    ?>
<!------------------------------------------------->
    <?php
    wp_reset_postdata();
}


// post grid Function
add_shortcode('feature_product','feature_product_func');

function feature_product_func(){
    $args = array(  
        'post_type' => 'products',
        'posts_per_page' => 3,
        'post_status' => 'publish'
    );

    $loop = new WP_Query( $args ); 
        
    while ( $loop->have_posts() ) : $loop->the_post();
        ?>
            <div class="huzi-sidebar-products">
                <h3 class="huzi-sp-text"><?php echo 'Just Added' ?></h3>
                <a href="<?php echo get_field('website_url') ?>">
                    <?php echo get_the_post_thumbnail() ?>
                </a>
                <h3 class="huzi-sp-title"><?php echo the_title(); ?></h3>
                <a class="huzi-blue-btn" href="<?php echo get_field('website_url') ?>">VISIT WEBSITE</a>
            </div>
        
        <?php
    endwhile;

    wp_reset_postdata();
}


// post grid Function
add_shortcode('just_add_product','just_add_func');

function just_add_func(){
    $args = array(  
        'post_type' => 'products',
        'posts_per_page' => 1,
        'post_status' => 'publish'
    );

    $loop = new WP_Query( $args ); 
        
    while ( $loop->have_posts() ) : $loop->the_post();
    
    $proCat = get_terms(['taxonomy'=>'product_categories']);
        foreach( $proCat as $proCatData ){
        $proCatTitle = $proCatData->name; 
        $proCatSlug = $proCatData->slug; 
        // echo $proCatSlug;
        if( $proCatSlug == 'just-added'){
        ?>
            <div class="huzi-sidebar-products">
                <h3 class="huzi-sp-text"><?php echo $proCatTitle ?></h3>
                <a href="<?php echo get_field('website_url') ?>">
                    <?php echo get_the_post_thumbnail() ?>
                </a>
                <h3 class="huzi-sp-title"><?php echo the_title(); ?></h3>
                <a class="huzi-blue-btn" href="<?php echo get_field('website_url') ?>">VISIT WEBSITE</a>
            </div>
        
        <?php
        }
    }
    endwhile;

    wp_reset_postdata();
}













