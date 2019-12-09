<?php

class GLI_Shortcode
{
    protected $name;
    protected $atts;
    protected $template_name;

    public function __construct($data)
    {
        if (!isset($data['name'])){
            return false;
        }

        $this->name = $data['name'];
        $this->atts = isset($data['atts']) ? $data['atts'] : [];
        if (isset($data['template_name'])) {
            $this->template_name = $data['template_name'];
        } else {
            $this->template_name = str_replace('_', '-', $this->name);
        }

        add_shortcode($this->name, [ $this, 'render' ]);
    }

    public function render($atts = [], $content = null)
    {
        extract( shortcode_atts($this->atts, $atts));
        $template = locate_template('shortcode-templates/' . $this->template_name . '.php');

        if ($template === ''){
            return false;
        }

        ob_start();
        include(locate_template('shortcode-templates/' . $this->template_name . '.php'));
        return ob_get_clean();
    }
}
