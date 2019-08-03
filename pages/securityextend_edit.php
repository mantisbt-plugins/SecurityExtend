<?php

form_security_validate( 'plugin_SecurityExtend_securityextend_edit' );
auth_reauthenticate();

access_ensure_global_level(config_get('manage_plugin_threshold'));
access_ensure_global_level(config_get('edit_threshold_level'));

$t_db_table = plugin_table('config');

#
# Update database - block_bug
#
$f_block_bug = gpc_get_string('block_bug');
$query = "SELECT COUNT(*) FROM $t_db_table WHERE name='block_bug'";
$t_result = db_query($query);
$t_row_count = db_result($result); 
if ($t_row_count < 1) {
    $query = "INSERT INTO $t_db_table (name, value) VALUES ('block_bug', ?)";
}
else {
    $query = "UPDATE $t_db_table SET value=? WHERE name='block_bug'";
}
db_query($query, array($f_block_bug));

form_security_purge( 'plugin_SecurityExtend_securityextend_edit' );

$t_redirect_url = plugin_page('securityextend', TRUE);

layout_page_header( null, $t_redirect_url );
layout_page_begin();
html_operation_successful( $t_redirect_url );
layout_page_end();
