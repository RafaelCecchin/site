<?php 

    

    function display_home_submenu() {

        echo '<div class="wrap">
        <h1>Home</h1>
        <form method="post" action="options.php">';
                
            settings_fields( 'home_group_settings' ); // settings group name
            do_settings_sections( 'home' ); // just a page slug
            submit_button();

        echo '</form></div>';

    }


    add_action('admin_init', 'register_home_settings'); 

    function register_home_settings() {
        // Adicionar sessão mensagens
        add_settings_section(
            'messages_section_settings',
            '',
            '', 
            'home'
        );

        // Adiciona configuração de mensagens

        create_custom_option('message', 'Message', 'arraytext', 'messages_section_settings', 'home_group_settings', 'home');
    }

    

    