<?php

class Gli_Boilerplate
{
    public static function get_asset($path = '')
    {
        return get_stylesheet_directory_uri() . '/assets/' . $path;
    }

    /**
     * Load a template using output buffering.
     * It's nice because you can pass variables into the template using an array
     * 
     * This function is similar to the WP function: "get_template_part"
     * @param  string $post_type   Prefix to the template's filename
     * @param  string $template    Suffix to the template's filename
     * @param  array  $data        A key => value array of variables to make available in the template
     * @return bool                Returns true if a template was found and will output, false if template was not found
     */
    protected function load_template($post_type = '', $template = '', $data = [])
    {
        extract($data);

        $name = $post_type . '-' . $template . '.php';
        $template = locate_template('template-parts/' . $name);
        if ($template){
            ob_start();
            include($template);
            echo ob_get_clean();
            return true;
        }

        return false;
    }
}
