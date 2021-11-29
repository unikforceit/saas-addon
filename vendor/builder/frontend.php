<?php
use Elementor\Plugin;


class SaaS_Doctor_Theme_Builder{

    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {

        add_filter('saas_doctor_single_post', [ $this, 'saas_doctor_single_post_tmpl']);
        add_filter('saas_doctor_single_listing', [ $this, 'saas_doctor_single_listing_tmpl']);
        add_action('template_redirect', [ $this, 'saas_doctor_tmpl_hook']);
        add_action('saas_doctor_404', [$this, 'saas_doctor_404_tmpl']);
        add_action('saas_doctor_search', [$this, 'saas_doctor_search_tmpl']);
        add_action('saas_doctor_author', [$this, 'saas_doctor_author_tmpl']);
        add_action('saas_doctor_archive', [$this, 'saas_doctor_archive_tmpl']);
    }


    function saas_has_404_template(){
        $args = array(
            'post_type' => 'saas_builders',
        );

        $templates = new WP_Query($args);

        if($templates->found_posts){
            $templates->the_post();
            $options = get_option( '_saas' );
            $ae_tid = $options['error_tpl'];
            wp_reset_postdata();
            return $ae_tid;
        }else{
            return false;
        }
    }

    function saas_has_search_template(){
        $args = array(
            'post_type' => 'saas_builders',
        );

        $templates = new WP_Query($args);
        if($templates->found_posts){
            $templates->the_post();
            $options = get_option( '_saas' );
            $ae_tid = $options['search_tpl'];
            wp_reset_postdata();
            return $ae_tid;
        }else{
            return false;
        }
    }

    function saas_has_author_template(){
        $args = array(
            'post_type' => 'saas_builders',
        );

        $templates = new WP_Query($args);
        if($templates->found_posts){
            $templates->the_post();
            $options = get_option( '_saas' );
            $ae_tid = $options['author_tpl'];
            wp_reset_postdata();
            return $ae_tid;
        }else{
            return false;
        }
    }

    function saas_has_blog_template(){
        $args = array(
            'post_type' => 'saas_builders',
        );

        $templates = new WP_Query($args);
        if($templates->found_posts){
            $templates->the_post();
            $ae_tid = '';
            wp_reset_postdata();
            return $ae_tid;
        }else{
            return false;
        }
    }

    function saas_has_archive_template(){
        $args = array(
            'post_type' => 'saas_builders',
        );

        $templates = new WP_Query($args);
        if($templates->found_posts){
            $templates->the_post();
            $options = get_option( '_saas' );
            $ae_tid = $options['archive_tpl'];
            $copy = $ae_tid;
            wp_reset_postdata();

            return $copy;

        }else{
            return false;
        }
    }

    function saas_get_active_post_template($post_id,$post_type){
        global $wp_query;
        $postid = $wp_query->post->ID;
        $meta = '';

        $options = get_option( '_saas' );
        $tpl = $options['single_tpl'];

        if(!isset($meta) || empty($meta)){
            $args = array(
                'post_type' => 'saas_builders',
            );
            $templates = new WP_Query($args);
            if($templates->found_posts){
                $templates->the_post();
                $ae_tid = $tpl;
            }else{
                return false;
            }
            wp_reset_postdata();

        }else{

            $ae_tid = $meta;
        }
        return $ae_tid;
    }
    function saas_get_active_listing_template($post_id,$post_type){
        global $wp_query;
        $postid = $wp_query->post->ID;
        $meta = '';

        $options = get_option( '_saas' );
        $tpl = $options['listing_tpl'];

        if(!isset($meta) || empty($meta)){
            $args = array(
                'post_type' => 'saas_builders',
            );
            $templates = new WP_Query($args);
            if($templates->found_posts){
                $templates->the_post();
                $ae_tid = $tpl;
            }else{
                return false;
            }
            wp_reset_postdata();

        }else{

            $ae_tid = $meta;
        }
        return $ae_tid;
    }

    function is_blog(){
        if ( is_front_page() && is_home() ) {
            return true;
        } elseif ( is_front_page() ) {
            return false;
        } elseif ( is_home() ) {
            return true;
        } else {
            return false;
        }
    }

    public function saas_render_insert_tmpl($template_id,$with_css = false){
        if(!isset($template_id) || empty($template_id)){
            return '';
        }

        $post_id = $template_id;
        $edit_mode = get_post_meta($post_id,'_elementor_edit_mode','');

        ob_start();
        if(Plugin::$instance->db->is_built_with_elementor( $post_id )) {
            ?>
            <div class="saas elementor-<?php echo esc_attr($post_id); ?>" data-aetid="<?php echo esc_attr($post_id); ?>">
                <?php echo Elementor\Plugin::instance()->frontend->get_builder_content( $post_id,$with_css ); ?>
            </div>
            <?php
        }else{
            echo esc_html__('Not a valid elementor page','saas-doctor');
        }
        $response = ob_get_contents();
        ob_end_clean();
        return $response;
    }


    public function saas_doctor_single_post_tmpl($content){

        if(!is_single() && !is_page()){
            return $content;
        }
        $post_id = $GLOBALS['post']->ID;
        $ae_post_template = $this->saas_get_active_post_template($post_id,$GLOBALS['post']->post_type);
        if(isset($ae_post_template) && is_numeric($ae_post_template)){
            $template_content = $this->saas_render_insert_tmpl($ae_post_template);
            echo $template_content;
        }

        return $content;
    }

    public function saas_doctor_single_listing_tmpl($content){

        if(!is_single() && !is_page()){
            return $content;
        }
        $post_id = $GLOBALS['post']->ID;
        $ae_post_template = $this->saas_get_active_listing_template($post_id,$GLOBALS['post']->post_type);
        if(isset($ae_post_template) && is_numeric($ae_post_template)){
            $template_content = $this->saas_render_insert_tmpl($ae_post_template);
            echo $template_content;
        }

        return $content;
    }


    function saas_doctor_search_tmpl(){

        $tid = $this->saas_has_search_template();
        if($tid){
            echo $this->saas_render_insert_tmpl($tid);
        }
    }

    function saas_doctor_author_tmpl(){

        $tid = $this->saas_has_author_template();
        if($tid){
            echo $this->saas_render_insert_tmpl($tid);
        }
    }

    function saas_doctor_404_tmpl(){

        $tid = $this->saas_has_404_template();
        if($tid){
            echo $this->saas_render_insert_tmpl($tid);
        }
    }

    function saas_doctor_archive_tmpl(){

        $tid = $this->saas_has_archive_template();
        if($tid){
            echo $this->saas_render_insert_tmpl($tid);
        }
    }

    public function saas_doctor_tmpl_hook(){

        $is_blog = $this->is_blog();

        if( is_single() &&  'post' == get_post_type() ){

            $post = get_post();
            if(!$this->saas_get_active_post_template($post->ID,$post->post_type)){
                return false;
            }
            $theme_obj = new SaaS_Doctor_My_Theme();
            $theme_obj->saas_doctor_manage_action();


        } elseif( is_single() &&  'mobile_listing' == get_post_type() ){

            $post = get_post();
            if(!$this->saas_get_active_listing_template($post->ID,$post->post_type)){
                return false;
            }
            $theme_obj = new SaaS_Doctor_My_Theme();
            $theme_obj->saas_doctor_manage_action();


        } elseif(is_404()){

            $tid_404 = $this->saas_has_404_template();
            if($tid_404){
                $theme_obj = new SaaS_Doctor_My_Theme();
                $theme_obj->saas_doctor_manage_action();
            }

        } elseif(is_archive() && 'post' == get_post_type() && !is_author()){

            $tid = $this->saas_has_archive_template();
            if(!$tid ){
                return false;
            }
            $theme_obj = new SaaS_Doctor_My_Theme();
            $theme_obj->saas_doctor_manage_action();

        } elseif(is_author()){

            $tid_404 = $this->saas_has_author_template();
            if($tid_404){
                $theme_obj = new SaaS_Doctor_My_Theme();
                $theme_obj->saas_doctor_manage_action();
            }

        } elseif(is_search()) {

            $tid_404 = $this->saas_has_search_template();
            if($tid_404){
                $theme_obj = new SaaS_Doctor_My_Theme();
                $theme_obj->saas_doctor_manage_action();
            }

        } elseif($is_blog) {

            $template_id = $this->saas_has_blog_template();
            if(!$template_id){
                return false;
            }
            $theme_obj = new SaaS_Doctor_My_Theme();
            $theme_obj->saas_doctor_manage_action();
        }

    }

}

SaaS_Doctor_Theme_Builder::instance();
