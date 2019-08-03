<?php

require_once('securityextend_api.php');

form_security_validate( 'plugin_SecurityExtend_securityextend_edit' );
auth_reauthenticate();

access_ensure_global_level(config_get('manage_plugin_threshold'));
access_ensure_global_level(config_get('edit_threshold_level'));

$f_block_bug = gpc_get_string('block_bug');
$f_block_bug_disable_user = gpc_get_string('block_bug_disable_user');
$f_block_bug_delete_user = gpc_get_string('block_bug_delete_user');

save_config_value('block_bug', $f_block_bug);
save_config_value('block_bug_disable_user', $f_block_bug_disable_user);
save_config_value('block_bug_delete_user', $block_bug_delete_user);

#
# Done, cleanup, show success, and redirect
#

form_security_purge( 'plugin_SecurityExtend_securityextend_edit' );

$t_redirect_url = plugin_page('securityextend', TRUE);

layout_page_header( null, $t_redirect_url );
layout_page_begin();
html_operation_successful( $t_redirect_url );
layout_page_end();
