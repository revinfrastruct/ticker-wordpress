<?php
namespace RevInfrastruct\LiveTicker;

class LiveTicker
{
    public function __construct()
    {
        add_action('init', array($this, 'create_post_type'));
        add_action('init', array($this, 'register_ticker_taxonomy'));
        add_action('admin_notices', array($this, 'modify_admin_screen'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_filter('wp_insert_post_data', array($this, 'add_default_title'), 10, 2);
    }

    public function create_post_type()
    {
        register_post_type('livetick',
            array(
                'labels'            => array(
                    'name'          => __('Livetickers', 'revinfrastruct'),
                    'singular_name' => __('Tick', 'revinfrastruct'),
                ),
                'supports'          => array(
                    'editor',
                    'categories',
                    'thumbnail'
                ),
                'name_admin_bar'        => __('Liveticker', 'revinfrastruct'),
                'menu_icon'             => 'dashicons-megaphone',
                'public'                => true,
                'has_archive'           => true,
                'show_in_rest'          => true,
                'rest_base'             => 'live',
                'rest_controller_class' => 'WP_REST_Posts_Controller',
                'exclude_from_search'   => true,
            )
        );
    }

    public function enqueue_scripts($hook)
    {
        $screen = get_current_screen();
        if (($hook === 'edit.php' || $hook === 'post-new.php') && $screen->post_type === 'livetick') {
            wp_enqueue_script('livetickeradmin', REVINFRASTRUCT_LIVETICKER_URL.'/dist/livetickeradmin.js');
        }
    }

    public function register_ticker_taxonomy()
    {
        register_taxonomy('tickevents', 'livetick',
            array(
                'label' => __('Events', 'revinfrastruct'),
                'show_admin_column' => true,
                'hierarchical' => true
            )
        );
    }

    public function modify_admin_screen()
    {
        $current_screen = get_current_screen();
        if ($current_screen->post_type === 'livetick'
            && $current_screen->base === 'edit') {
            $tickers = get_terms('tickevents', array(
                'hide_empty' => false,
            ));
            include_once REVINFRASTRUCT_LIVETICKER_PATH.'src/templates/active-tickers.php';
        }
    }

    public function add_default_title($data, $postarray)
    {
        if ($postarray['post_type'] !== 'livetick') {
            return $data;
        }
        $data['post_title'] = $data['post_date'];
        return $data;
    }
}
