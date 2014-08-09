<?php
new theme_customizer();

class theme_customizer
{
    public function __construct()
    {
        add_action ('admin_menu', array(&$this, 'customizer_admin'));
        add_action( 'customize_register', array(&$this, 'customize_manager_demo' ));
    }

    /**
     * Add the Customize link to the admin menu
     * @return void
     */
    public function customizer_admin() {
        add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
    }

    /**
     * Customizer manager demo
     * @param  WP_Customizer_Manager $wp_manager
     * @return void
     */
    public function customize_manager_demo( $wp_manager )
    {
        $this->demo_section( $wp_manager );
    }

    public function demo_section( $wp_manager )
    {
        $wp_manager->add_section( 'c2hh_footer_section', array(
            'title'          => 'Footer',
            'priority'       => 200,
        ) );

        // Textbox control
        $wp_manager->add_setting( 'facebook_setting', array(
            'default'        => 'mailto:',
        ) );

        $wp_manager->add_control( 'facebook_setting', array(
            'label'   => 'Facebook Link',
            'section' => 'c2hh_footer_section',
            'type'    => 'text',
            'priority' => 1
        ) );

        $wp_manager->add_setting( 'twitter_setting', array(
            'default'        => 'http://',
        ) );

        $wp_manager->add_control( 'twitter_setting', array(
            'label'   => 'Twitter Link',
            'section' => 'c2hh_footer_section',
            'type'    => 'text',
            'priority' => 2
        ) );   

        $wp_manager->add_setting( 'contact_email', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( 'contact_email', array(
            'label'   => 'Contact Email',
            'section' => 'c2hh_footer_section',
            'type'    => 'text',
            'priority' => 3
        ) ); 
        $wp_manager->add_setting( 'footer_copyright', array(
            'default'        => '© Close to Home Housing',
        ) ); 
        $wp_manager->add_control( 'footer_copyright', array(
            'label'   => 'Footer Copyright',
            'section' => 'c2hh_footer_section',
            'type'    => 'text',
            'priority' => 4
        ) );
        // Checkbox control
        /*$wp_manager->add_setting( 'checkbox_setting', array(
            'default'        => '1',
        ) );

        $wp_manager->add_control( 'checkbox_setting', array(
            'label'   => 'Checkbox Setting',
            'section' => 'customiser_demo_section',
            'type'    => 'checkbox',
            'priority' => 2
        ) );

        // Radio control
        $wp_manager->add_setting( 'radio_setting', array(
            'default'        => '1',
        ) );

        $wp_manager->add_control( 'radio_setting', array(
            'label'   => 'Radio Setting',
            'section' => 'customiser_demo_section',
            'type'    => 'radio',
            'choices' => array("1", "2", "3", "4", "5"),
            'priority' => 3
        ) );

        // Select control
        $wp_manager->add_setting( 'select_setting', array(
            'default'        => '1',
        ) );

        $wp_manager->add_control( 'select_setting', array(
            'label'   => 'Select Dropdown Setting',
            'section' => 'customiser_demo_section',
            'type'    => 'select',
            'choices' => array("1", "2", "3", "4", "5"),
            'priority' => 4
        ) );

        // Dropdown pages control
        $wp_manager->add_setting( 'dropdown_pages_setting', array(
            'default'        => '1',
        ) );

        $wp_manager->add_control( 'dropdown_pages_setting', array(
            'label'   => 'Dropdown Pages Setting',
            'section' => 'customiser_demo_section',
            'type'    => 'dropdown-pages',
            'priority' => 5
        ) );

        // Color control
        $wp_manager->add_setting( 'color_setting', array(
            'default'        => '#000000',
        ) );

        $wp_manager->add_control( new WP_Customize_Color_Control( $wp_manager, 'color_setting', array(
            'label'   => 'Color Setting',
            'section' => 'customiser_demo_section',
            'settings'   => 'color_setting',
            'priority' => 6
        ) ) );

        // WP_Customize_Upload_Control
        $wp_manager->add_setting( 'upload_setting', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new WP_Customize_Upload_Control( $wp_manager, 'upload_setting', array(
            'label'   => 'Upload Setting',
            'section' => 'customiser_demo_section',
            'settings'   => 'upload_setting',
            'priority' => 7
        ) ) );

        // WP_Customize_Image_Control
        $wp_manager->add_setting( 'image_setting', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'image_setting', array(
            'label'   => 'Image Setting',
            'section' => 'customiser_demo_section',
            'settings'   => 'image_setting',
            'priority' => 8
        ) ) );*/
    }

}

?>
