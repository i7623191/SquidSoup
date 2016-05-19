<?php

/*
Plugin Name: Video Jacker
Plugin URI: http://bz9.com
Description: Youtube, Screencast and Viewbix video management
Version: 1.4
Author: BZ9.com
Author URI: http://bz9.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class video_jacker_shortcode {

    private $handles = array();
    private $vidjac_type;
    private $allowed_host = array( "www.youtube.com","youtube.com","youtube.be","viewbix.com","www.viewbix.com","content.screencast.com","screencast.com","www.screencast.com" );

    /**
     * Initial setup
     */
    function __construct() {
        if( is_admin() )
        {
            add_action( 'wp_ajax_vidjac_shortpop', array( $this, 'vidjac_shortpop_ajax' ) );
            add_action( 'init', array(&$this, 'vidjac_custom_init' ), 9 );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
            add_action( 'save_post', array( $this, 'save' ) );
            add_filter( 'manage_edit-video_jacker_columns', array( $this, 'vidjac_columns' ) ) ;
            add_action( 'manage_posts_custom_column', array( $this, 'vidjac_populate_columns' ) );
            add_action( 'init', array(&$this, 'add_editor_button' ) );
            add_action( 'admin_menu', array( $this, 'vidjac_register_submenu_page' ) );
            add_filter( 'enter_title_here', array( $this, 'vidjac_enter_title_here' ) );
            if ( ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'video_jacker' ) || ( isset( $post_type ) && $post_type == 'video_jacker' ) || ( isset( $_GET['post'] ) && get_post_type( $_GET['post'] ) == 'video_jacker' ) )
            {
                add_action('admin_enqueue_scripts', array( $this, 'vidjac_admin_scripts' ) );
            }
            add_action( 'admin_head', array( $this, 'vidjac_plugin_header' ) );
            add_filter( 'post_row_actions', array( $this, 'vidjac_remove_quick_edit' ) );
            add_filter( 'post_updated_messages', array( $this, 'vidjac_updated_messages' ) );
        } else {
            add_shortcode( 'video_jacker', array(&$this, 'js_shortcode' ) );
        }
    }

    /**
     * Include popup window content
     */
    public function vidjac_shortpop_ajax(){
        if ( !current_user_can( 'edit_pages' ) && !current_user_can( 'edit_posts' ) )
            die(__("You are not allowed to be here"));

        include_once('form.php');
        die();
    }

    function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

    /**
     * Shortcode handler
     */
    function js_shortcode( $atts = array(), $content = null ){
        $cvideo = $content;
        $out = '';
        $sc_atts = array();
        extract( shortcode_atts( array(
            'style' => '',
            'saved' => '',
            'type'  => '',
            'height' => '',
            'width' => '',
            'content' => '',
            'autohide' => '',
            'autostart' => '',
            'loop' => '',
            'showendscreen' => '',
            'showsearch' => '',
            'showstartscreen' => '',
            'tocdoc' => '',
            'blurover' => '',
            'xmp' => ''
        ), $atts ) );

        $sc_atts['height'] = $height;
        $sc_atts['width'] = $width;
        $sc_atts['content'] = $content;
        $sc_atts['autohide'] = $autohide;
        $sc_atts['autostart'] = $autostart;
        $sc_atts['loop'] = $loop;
        $sc_atts['showendscreen'] = $showendscreen;
        $sc_atts['showsearch'] = $showsearch;
        $sc_atts['showstartscreen'] = $showstartscreen;
        $sc_atts['tocdoc'] = $tocdoc;
        $sc_atts['blurover'] = $blurover;
        $sc_atts['xmp'] = $xmp;


        if ($saved != '')
        {
            $saved_video = get_post_meta( $saved, 'vidjac_video', true );
            return $saved_video;
        }

        if( $cvideo )
        {
            if( is_array( $cvideo ) )
            {
                foreach ( $cvideo as $key => $content_new )
                {
                    $out .= $this->process_sc( $content_new );
                }

            } else {
                $out .= $this->process_sc($cvideo, $sc_atts );
            }
        }
    return $out;
    }

    /**
     * Process shortcode
     */
    private function process_sc( $video, $sc_atts=null ){

        if($this->startsWith($video, "/")){
            $video = "http:".$video;
        }

        //validate url
        if( !filter_var( $video, FILTER_VALIDATE_URL ) )
        {
            return;
        }

        //host test
        $res = parse_url( $video );
        if( !in_array( $res['host'],$this->allowed_host ) )
        {
            return;
        }
        //youtube
       if( $res['host'] == "www.youtube.com" || $res['host'] == "youtube.com" || $res['host'] == "youtube.be" )
        {
            $html = '<iframe width="'.$sc_atts['width'].'" height="'.$sc_atts['height'].'" src="'.$video.'" frameborder="0" allowfullscreen></iframe>';
            return $html;
        }

        //viewbix
        if( $res['host'] == "viewbix.com" || $res['host'] == "www.viewbix.com" )
        {
            $html = '<iframe src="'.$video.'" width="'.$sc_atts['width'].'" height="'.$sc_atts['height'].'" frameborder="0" scrolling="no"></iframe>';
            return $html;
        }
        //screencast
        if( $res['host'] == "content.screencast.com" || $res['host'] == "screencast.com" || $res['host'] == "www.screencast.com" )
        {
            $cvideo = str_replace('www','content',$video);
            $cvideo = str_replace('/embed','',$cvideo);
            $html = '<object id="scPlayer"  width="'.$sc_atts['width'].'" height="'.$sc_atts['height'].'" type="application/x-shockwave-flash" data="'.$cvideo.'/scplayer.swf" >
<param name="movie" value="'.$cvideo.'/scplayer.swf" />
<param name="quality" value="high" />
<param name="bgcolor" value="#FFFFFF" />
<param name="flashVars" value="thumb='.$cvideo.'/FirstFrame.jpg&containerwidth='.$sc_atts['width'].'&containerheight='.$sc_atts['height'].'&autohide='.$sc_atts['autohide'].'&autostart='.$sc_atts['autostart'].'&loop='.$sc_atts['loop'].'&showendscreen='.$sc_atts['showendscreen'].'&showsearch='.$sc_atts['showsearch'].'&showstartscreen='.$sc_atts['showstartscreen'].'&tocdoc='.$sc_atts['tocdoc'].'&xmp='.$sc_atts['xmp'].'&content='.$sc_atts['content'].'&blurover='.$sc_atts['blurover'].'" />
<param name="allowFullScreen" value="true" />
<param name="scale" value="showall" />
<param name="allowScriptAccess" value="always" />
<param name="base" value="'.$cvideo.'/" />
<iframe type="text/html" frameborder="0" scrolling="no" style="overflow:hidden;" src="'.$video.'" height="'.$sc_atts['height'].'" width="'.$sc_atts['width'].'" ></iframe>
</object> ';
            return $html;
        }

        return;

    }

    /**
     * Print footer scripts
     */
    function call_js(){
        wp_print_scripts( $this->handles );
    }

    /**
     * Register editor button
     */
    function register_button( $buttons ) {
        array_push( $buttons, "|", "video_jacker" );
        return $buttons;
    }

    /**
     * Add editor plugin
     */
    function add_plugin( $plugin_array ) {
        $plugin_array['video_jacker'] = WP_PLUGIN_URL.'/video-jacker/js/video_jacker.js';
        return $plugin_array;
    }

    /**
     * Add editor button
     */
    function add_editor_button() {

        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }

        if ( get_user_option( 'rich_editing' ) == 'true' ) {

            add_filter( 'mce_external_plugins', array( &$this, 'add_plugin' ) );
            add_filter( 'mce_buttons', array( &$this, 'register_button' ) );
        }

    }

    /**
     * Custom post setup
     */
    function vidjac_custom_init() {
        $labels = array(
            'name' => 'Your Saved Videos',
            'singular_name' => 'Video',
            'add_new' => 'Add New Video',
            'add_new_item' => 'Add New Video',
            'edit_item' => 'Edit Video',
            'new_item' => 'New Video',
            'all_items' => 'Saved Videos',
            'view_item' => 'View Video',
            'search_items' => 'Search Videos',
            'not_found' =>  'No Videos found',
            'not_found_in_trash' => 'No videos found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'Video Jacker'
        );

        $args = array(
            'labels' => $labels,
            'public' => false,
            'publicly_queryable' => false,
            'show_ui' => true,
            'menu_position' => 5,
            'query_var' => false,
            'rewrite' => false,
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => null,
            'menu_icon' => plugins_url( 'video-jacker/images/video_jacker.png' ),
            'supports' => array( 'title')
        );

        register_post_type( 'video_jacker', $args );
    }

    /**
     * Set custom messages
     */
    function vidjac_updated_messages( $messages ) {
        global $post, $post_ID;
        $messages['video_jacker'] = array(
            0 => '',
            1 => __('Your video has been updated.' ),
            2 => __('Custom field updated.'),
            3 => __('Custom field deleted.'),
            4 => __('Your video has been updated.'),
            5 => isset($_GET['revision']) ? sprintf( __('video restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => __('Your video has been saved.'),
            7 => __('Your video has been saved.'),
            8 => sprintf( __('Video submitted. <a target="_blank" href="%s">Preview Tool</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
            9 => sprintf( __('Video scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Tool</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
            10 => sprintf( __('Video draft updated. <a target="_blank" href="%s">Preview Tool</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        );
        return $messages;
    }

    /**
     * Adds the meta box container
     */
    public function add_meta_box() {
        add_meta_box(
            'vidjac_descr',
            'Video Details',
            array( &$this, 'render_meta_box_content' ),
            'video_jacker',
            'normal',
            'high'
        );
    }

    /**
     * Render Meta Box content
     */
    public function render_meta_box_content( $post ) {
        // Use nonce for verification
        wp_nonce_field( plugin_basename( __FILE__ ), 'vidjac_noncename' );

        $value = get_post_meta( $post->ID, 'vidjac_descr', true );
        $value2 = get_post_meta( $post->ID, 'vidjac_video', true );

        echo '<label class="vidjac_label" for="vidjac_descr">';
        _e( 'Description', 'myplugin_textdomain' );
        echo '</label> ';
        echo '<input type="text" id="vidjac_descr" name="vidjac_descr" value="'.esc_attr( $value ).'" size="70" /><br/><br/>';

        echo '<p class="formfield"><label class="vidjac_label" for="vidjac_tool">';
        _e( 'Add or Edit Video Embed Code', 'myplugin_textdomain' );
        echo '</label> ';
        echo '<textarea id="vidjac_video" name="vidjac_video" rows="4" cols="70">'.esc_attr( $value2 ).'</textarea></p>';
    }

    /**
     * Save Meta Box content
     */
    public function save( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( ! isset( $_POST['vidjac_noncename'] ) || ! wp_verify_nonce( $_POST['vidjac_noncename'], plugin_basename( __FILE__ ) ) )
            return;

        //  we need to check if the current user is authorised to do this action.
        if ( 'video_jacker' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) )
                return;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return;
        }

        $post_ID = $_POST['post_ID'];
        //sanitize user input
        $mydata = sanitize_text_field( $_POST['vidjac_descr'] );
        $mydata2 = stripslashes_deep(strip_tags($_POST['vidjac_video'],'<iframe><object><param>'));


        $valid_video = $this->vidjac_validate_video( $mydata2 );
        // Do something with $mydata
        // either using
        if ( !add_post_meta( $post_ID, 'vidjac_descr', $mydata, true ) ) {
            update_post_meta( $post_ID, 'vidjac_descr', $mydata );
        }
        //if valid video commit to db
        if ( $valid_video ){
            if ( !add_post_meta( $post_ID, 'vidjac_video', $mydata2, true ) ) {
                update_post_meta( $post_ID, 'vidjac_video', $mydata2 );
            }
            if ( !add_post_meta( $post_ID, 'vidjac_type', $this->vidjac_type, true ) ) {
                update_post_meta( $post_ID, 'vidjac_type', $this->vidjac_type );
            }
        }
    }

    /**
     * Validate user input
     */
    private function vidjac_validate_video( $content ){
        if ( !$content ) { return false; }
        $allowed_vid = false;
        preg_match_all( '/src=[\'"]([^\'"]+)[\'"]/i', $content, $matches );



        if( count( $matches ) > 0 ){
            foreach( $matches[1] as $key => $value){
                if($this->startsWith($matches[1][$key], "/")){
                    $matches[1][$key] = "http:".$matches[1][$key];
                }

                //validate url
                if( !filter_var( $matches[1][$key], FILTER_VALIDATE_URL ) )
                {
                    return false;
                }
                //host test
                $res = parse_url( $matches[1][$key] );

                if( !in_array( $res['host'],$this->allowed_host ) )
                {
                    return false;
                }

                $allowed_vid = true;
            }
        }
        if($allowed_vid){
            $this->vidjac_type = str_replace("www.","",$res['host']);
            return true;
        }
        return false;
    }

    /**
     * Change title text
     */
    function vidjac_enter_title_here( $message ){
        global $post;
        if( 'video_jacker' == $post->post_type ):
            $message = 'Enter Video Name';
        endif;
        return $message;
    }

    /**
     * Add admin scripts / css
     */
    public function vidjac_admin_scripts(){
        wp_enqueue_style ( 'vidjac_admin_css', WP_PLUGIN_URL.'/video-jacker/css/vidjac_admin.css' );
    }

    /**
     * Set admin page header
     */
    function vidjac_plugin_header() {
        global $post_type;
        ?>
        <style>
            <?php if ( ( $_GET['post_type'] == 'video_jacker' ) || ( $post_type == 'video_jacker' ) ) : ?>
            #icon-edit { background:transparent url('<?php echo WP_PLUGIN_URL .'/video-jacker/images/video_jacker32.png';?>') no-repeat; }
            <?php endif; ?>
        </style>
    <?php
    }

    /**
     * Set saved columns
     */
    public function vidjac_columns( $columns ){
        $new_columns['cb'] = '<input type="checkbox" />';
        $new_columns['title'] = _x('Video Name', 'column name');
        $new_columns['description'] = 'Description';
        $new_columns['type'] = 'Type';
        $new_columns['date'] = _x('Date', 'column name');

        return $new_columns;
    }

    /**
     * Populate columns
     */
    public function vidjac_populate_columns( $column ){
        if ( 'description' == $column ) {
            $vidjac_descr = esc_html( get_post_meta( get_the_ID(), 'vidjac_descr', true ) );
            echo $vidjac_descr;
        }
        if ( 'type' == $column ) {
            $vidjac_type = esc_html( get_post_meta( get_the_ID(), 'vidjac_type', true ) );
            echo $vidjac_type;
        }
    }

    /**
     * Remove quick edit link
     */
    public function vidjac_remove_quick_edit( $actions ){
        global $post;
        if( $post->post_type == 'video_jacker' ) {
            unset( $actions['inline hide-if-no-js'] );
        }
        return $actions;
    }

    /**
     * Register pages
     */
    public function vidjac_register_submenu_page(){
        add_submenu_page( 'edit.php?post_type=video_jacker', 'Account Management', 'Account Management', 'manage_options', 'video_jacker_account', array( $this, 'vidjac_account' ) );
        add_submenu_page( 'edit.php?post_type=video_jacker', 'Instructions', 'Instructions', 'manage_options', 'video_jacker', array( $this, 'vidjac_about' ) );
        }

    /**
     * Page headers
     */
    private function vidjac_page_header(){
        ?>
        <div class="vidjac_header_wrap">
        <div id="icon"><img src="<?php echo WP_PLUGIN_URL .'/video-jacker/images/video_jacker32.png';?>" /></div>
        <h2><?php echo get_admin_page_title(); ?></h2>
        </div>
        <?php
        return;
    }

    /**
     * About page
     */
    public function vidjac_about(){
        $this->vidjac_page_header();
        ?>
        <div align="center"><iframe width="650" height="434" src="http://www.viewbix.com/frame/e5558aef-29ac-42a7-9558-1e4ff8d1a151?w=650&h=434&ap=true" frameborder="0" scrolling="no" allowTransparency="true"></iframe></div>
    <?php
    }

    /**
     * Account page
     */
    public function vidjac_account(){
        $this->vidjac_page_header();
        ?>
        <div align="center"><span style="font-family: Arial; font-weight: normal; font-style: normal; text-decoration: none; font-size: 12pt;">In order to add, edit and create Video Jacker videos you will need an account through which to manage your videos.  Please use the options provided below ….</span></div><br>
        <div align="center"><a href="http://bz9.com/view_plugin" target="_blank"><img border="0" src="<?php echo WP_PLUGIN_URL .'/video-jacker/images/vj_inst_01.gif';?>" alt="Viewbix" width="737" height="166"></a></div>
        <div align="center"><a href="http://bz9.com/view_login" target="_blank"><img border="0" src="<?php echo WP_PLUGIN_URL .'/video-jacker/images/vj_inst_02.gif';?>" alt="Viewbix" width="737" height="167"></a></div>
        <div align="center"><a href="http://bz9.com/PluginYouTuber" target="_blank"><img border="0" src="<?php echo WP_PLUGIN_URL .'/video-jacker/images/vj_inst_03.gif';?>" alt="BZ9" width="737" height="162"></a></div>

    <?php
    }


}

/**
 * Initiate plugin
 */
$video_jacker_shortcode = new video_jacker_shortcode;