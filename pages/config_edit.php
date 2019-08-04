<?php

form_security_validate( 'plugin_SecurityExtend_config_edit' );
auth_reauthenticate();

access_ensure_global_level(config_get('manage_plugin_threshold'));
access_ensure_global_level(config_get('edit_threshold_level'));

$f_edit_threshold_level = gpc_get_int('edit_threshold_level');
$f_view_threshold_level = gpc_get_int('view_threshold_level');
$f_show_bird_on_bug_block = gpc_get_bool( 'show_bird_on_bug_block' );

plugin_config_set('edit_threshold', $f_edit_threshold_level);
plugin_config_set('view_threshold', $f_view_threshold_level);
plugin_config_set('show_bird_on_bug_block', $f_show_bird_on_bug_block);

form_security_purge( 'plugin_SecurityExtend_config_edit' );

$t_redirect_url = plugin_page('config', TRUE);

layout_page_header( null, $t_redirect_url );
layout_page_begin();
html_operation_successful( $t_redirect_url );
layout_page_end();
