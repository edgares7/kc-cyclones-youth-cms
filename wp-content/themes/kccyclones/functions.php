<?php
// Require the theme boilerplate to include important functions!
require_once 'includes/GliBoilerplate.php';

class KcCyclones extends Gli_Boilerplate
{
    /**
     * Methods from Gli_Boilerplate class
     * 
     * - public static get_asset(String $path)
     * - protected load_template(String $post_type, String $template, Array $data = [])
     */

    /**
     * Version the theme if you want, you can pass this when enqueuing things,
     * helpful when trying to bust caches
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Initialize your theme!
     * This is where hooks and filters should be defined.
     * It's important to keep in mind that everything here runs in the admin area! :)
     */
    public function __construct()
    {
        include_once( 'includes/post-types.php' );
        require_once 'includes/Shortcode.php';
        $this->register_shortcodes();

        // Theme supports
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        // Adds a hook to add expires header to facility pages for caching purposes
        // Remove if not an SE site
        add_action('se_unit_response_expires_header', [ $this, 'add_expires_header' ], 10, 1);

        add_action('wp_enqueue_scripts', [ $this, 'enqueue_styles' ]);
        add_action('wp_enqueue_scripts', [ $this, 'enqueue_scripts' ]);
    }

    /**
     * Adds expires header to facility pages. Removed if not an SE Site
     * @param [type] $expiration [description]
     */
    public function add_expires_header($expiration)
    {
        if (get_post_type() === 'facility') {
            // Convert timestamp to Expires header format
            header('Cache-Control: public, max-age=' . ((int)$expiration - time()));
            header('Expires: ' . date('D, d M Y H:i:s \G\M\T', $expiration));
        }
    }

    public function enqueue_styles()
    {
        wp_enqueue_style('style-min', self::get_asset('css/style.min.css'), [], $this->version);
    }

    public function enqueue_scripts()
    {
        // 
    }

    /**
     * Use this method to register shortcodes following the below method
     * Shortcode templates will be searched for in: shortcode-templates/{{ my-shortcode }}.php
     * Template file names should be dashes instead of underscores
     */
    protected function register_shortcodes()
    {
        /**
         * my_shortcode - Does something
         * Template: shortcode-templates/my-shortcode.php
         */
        new GLI_Shortcode([
            'name' => 'my_shortcode',
            'atts' => [
                'message' => false,
                'description' => 'default message'
            ]
        ]);
    }
}

$kcCyclones = new KcCyclones();
