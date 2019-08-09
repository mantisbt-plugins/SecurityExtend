<?php

require_once('securityextend_api.php');

form_security_validate( 'plugin_SecurityExtend_config_edit' );
auth_reauthenticate();

access_ensure_global_level(config_get('manage_plugin_threshold'));

$f_edit_threshold_level = gpc_get_int('edit_threshold_level');
$f_view_threshold_level = gpc_get_int('view_threshold_level');
$f_block_bug_duplicate = gpc_get_bool( 'block_bug_duplicate' );
$f_disable_user_on_antispam = gpc_get_bool( 'disable_user_on_antispam');
$f_clean_on_antispam = gpc_get_bool( 'clean_on_antispam');
$f_show_bird_on_bug_block = gpc_get_bool( 'show_bird_on_bug_block' );

plugin_config_set('edit_threshold', $f_edit_threshold_level);
plugin_config_set('view_threshold', $f_view_threshold_level);
plugin_config_set('block_bug_duplicate', $f_block_bug_duplicate);
plugin_config_set('disable_user_on_antispam', $f_disable_user_on_antispam);
plugin_config_set('clean_on_antispam', $f_clean_on_antispam);
plugin_config_set('show_bird_on_bug_block', $f_show_bird_on_bug_block);

form_security_purge( 'plugin_SecurityExtend_config_edit' );

se_print_success_and_redirect(plugin_page('config', TRUE));
