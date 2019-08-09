<?php

require_once('securityextend_api.php');

form_security_validate( 'plugin_SecurityExtend_config_edit' );
auth_reauthenticate();

access_ensure_global_level(config_get('manage_plugin_threshold'));

$f_edit_threshold_level = gpc_get_int('edit_threshold_level');
$f_view_threshold_level = gpc_get_int('view_threshold_level');

$f_block_bug = gpc_get_bool( 'block_bug' );
$f_block_bugnote = gpc_get_bool( 'block_bugnote' );
$f_block_bug_duplicate = gpc_get_bool( 'block_bug_duplicate' );
$f_use_antispam_handler = gpc_get_bool( 'use_antispam_handler');
$f_clean_on_antispam = gpc_get_bool( 'clean_on_antispam');
$f_antispam_seconds = gpc_get_int( 'antispam_seconds');
$f_antispam_action = gpc_get_string( 'antispam_action');
$f_show_bird_on_bug_block = gpc_get_bool( 'show_bird_on_bug_block' );

plugin_config_set('edit_threshold', $f_edit_threshold_level);
plugin_config_set('view_threshold', $f_view_threshold_level);
plugin_config_set('block_bug', $f_block_bug);
plugin_config_set('block_bugnote', $f_block_bugnote);
plugin_config_set('block_bug_duplicate', $f_block_bug_duplicate);
plugin_config_set('use_antispam_handler', $f_use_antispam_handler);
plugin_config_set('antispam_action', $f_antispam_action);
plugin_config_set('clean_on_antispam', $f_clean_on_antispam);
plugin_config_set('antispam_seconds', $f_antispam_seconds);
plugin_config_set('show_bird_on_bug_block', $f_show_bird_on_bug_block);

form_security_purge( 'plugin_SecurityExtend_config_edit' );

se_print_success_and_redirect(plugin_page('config', TRUE));
