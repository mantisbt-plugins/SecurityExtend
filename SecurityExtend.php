<?php

# Copyright (c) 2019 Scott Meesseman
# Licensed under GPL3 

require_once('core/securityextend_api.php');


class SecurityExtendPlugin extends MantisPlugin
{

    function register() 
    {
		$this->name = plugin_lang_get("title");
        $this->description = plugin_lang_get("description");
        $this->page = 'config';

        $this->version = "1.0.3";
        $this->requires = array(
            "MantisCore" => "2.0.0",
        );

        $this->author = "Scott Meesseman";
        $this->contact = "spmeesseman@gmail.com";
        $this->url = "https://github.com/mantisbt-plugins/SecurityExtend";
    }
    

    function init() 
    {
        $t_core = config_get_global('core_path');
        $t_path = config_get_global('plugin_path'). plugin_get_current() . DIRECTORY_SEPARATOR . 'core'. DIRECTORY_SEPARATOR;
        set_include_path(get_include_path() . PATH_SEPARATOR . $t_core . PATH_SEPARATOR . $t_path);
    }


    function config() 
    {
		return array(
			'edit_threshold_level'	=> ADMINISTRATOR ,
            'view_threshold_level'	=> MANAGER,
            'block_bug' => ON,
            'block_bugnote' => ON,
            'show_bird_on_bug_block' => OFF
		);
	}


    function hooks() 
    {
		return array(
            'EVENT_MENU_MANAGE' => 'securityextend_menu',
            'EVENT_REPORT_BUG_DATA' => 'securityextend_bug_report',
            'EVENT_UPDATE_BUG_DATA' => 'securityextend_bug_update',
            'EVENT_MANAGE_USER_CREATE' => 'securityextend_user_create'
		);
    }
    

    function securityextend_menu() 
    {
        if (access_has_global_level(plugin_config_get('view_threshold_level'))) {
            return array(
                '<a href="' . plugin_page( 'securityextend' ) . '">' . plugin_lang_get( 'management_title' ) . '</a>',
            );
        }

        return array();
    }
    

    function securityextend_bug_report($p_event, $p_bug) 
    {
        block_bug($p_bug);
        return $p_bug;
    }
    

    function securityextend_bug_update($p_event, $p_updated_bug, $p_existing_bug) 
    {
        block_bug($p_updated_bug);
        return $p_updated_bug;
    }


    function securityextend_user_create($p_event, $p_user_id) 
    {
        block_account($p_user_id);
        return $p_user_id;
    }


	function schema() 
    {
        return array(
            array('CreateTableSQL',
                array( plugin_table('config', 'SecurityExtend'), "
                    id      I        NOTNULL UNSIGNED AUTOINCREMENT PRIMARY,
                    name    C(128)   NOTNULL DEFAULT '',
                    value   X        NOTNULL DEFAULT ''"
                )
            ),
            array('CreateTableSQL',
                array( plugin_table('log', 'SecurityExtend'), "
                    id      I        NOTNULL UNSIGNED AUTOINCREMENT PRIMARY,
                    user    C(128)   NOTNULL DEFAULT '',
                    email   C(128)   NOTNULL DEFAULT '',
                    date    T        NOTNULL DEFAULT '1970-01-01 00:00:01',
                    action  C(64)    NOTNULL DEFAULT '',
                    xdata1  C(128)   NOTNULL DEFAULT '',
                    xdata2  C(128)   NOTNULL DEFAULT '',
                    xdata3  C(128)   NOTNULL DEFAULT ''"
                )
            )
        );
    }

}
