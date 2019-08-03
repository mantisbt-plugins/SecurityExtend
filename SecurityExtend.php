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

        $this->version = "1.0.0";
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
            'block_bugnote' => ON
		);
	}


    function hooks() 
    {
		return array(
            'EVENT_MENU_MANAGE' => 'securityextend_menu',
            'EVENT_REPORT_BUG_DATA' => 'securityextend_bug_report',
            'EVENT_UPDATE_BUG_DATA' => 'securityextend_bug_update'
		);
    }
    

    function securityextend_menu() 
    {
		return array(
			'<a href="' . plugin_page( 'securityextend' ) . '">' . plugin_lang_get( 'management_title' ) . '</a>',
		);
    }
    

    function securityextend_bug_report($p_event, $p_bug) 
    {
        securityextend_block_bug($p_bug, 'block_bug_delete_user');
        securityextend_block_bug($p_bug, 'block_bug_disable_user');
		securityextend_block_bug($p_bug, 'block_bug');
    }
    

    function securityextend_bug_update($p_event, $p_updated_bug, $p_existing_bug) 
    {
        securityextend_block_bug($p_updated_bug, 'block_bug_delete_user');
        securityextend_block_bug($p_updated_bug, 'block_bug_disable_user');
		securityextend_block_bug($p_updated_bug, 'block_bug');
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
            )/*,
            array('AddColumnSQL', 
                array( plugin_table('file', 'ServerFiles'), "
                    order              I       NOTNULL DEFAULT 0",
                    array( "mysql" => "DEFAULT CHARSET=utf8" ) 
                )
            )*/
        );
    }

}
