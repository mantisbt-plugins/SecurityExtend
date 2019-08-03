<?php

form_security_validate( 'plugin_SecurityExtend_config_edit' );
auth_reauthenticate();

access_ensure_global_level(config_get('manage_plugin_threshold'));
access_ensure_global_level(config_get('edit_threshold_level'));

$f_submit_type = gpc_get_string('submit');
$rows_affected = 0;

if ($f_submit_type == plugin_lang_get('update_config')) 
{
    plugin_config_set('edit_threshold', gpc_get_int('edit_threshold_level', ADMINISTRATOR));
    plugin_config_set('view_threshold', gpc_get_int('view_threshold_level', DEVELOPER));
}
else if ($f_submit_type == plugin_lang_get('config_new_file')) 
{
    $query = "INSERT INTO " . plugin_table('file') . "(title, diskfile) VALUES ('" .
                gpc_get_string('file_title')."', '".gpc_get_string('file_diskfile')."')";
    $rows = db_query($query);
    $rows_affected = db_num_rows($rows);
}
else if ($f_submit_type == plugin_lang_get('config_save_file')) 
{
    $query = "UPDATE " . plugin_table('file') . " SET title='" . gpc_get_string('file_title') .
             "', diskfile='" . gpc_get_string('file_diskfile') . "' WHERE title='" . gpc_get_string('file_title_orig') .
             "' AND diskfile='" . gpc_get_string('file_diskfile_orig') . "'";
    $rows = db_query($query);
    $rows_affected = db_num_rows($rows);
}
else if ($f_submit_type == plugin_lang_get('config_delete_file')) 
{
    $query = "DELETE FROM " . plugin_table('file') . " WHERE title='" . gpc_get_string('file_title_orig') .
             "' AND diskfile='" . gpc_get_string('file_diskfile_orig') . "'";
    $rows = db_query($query);
    $rows_affected = db_num_rows($rows);
}
else {
    trigger_error('Invalid submit value', ERROR_INVALID_REQUEST_METHOD);
}

if ($rows_affected == 0) {
    trigger_error('Query succeeded but no records affected', ERROR_DB_QUERY_FAILED);
}

form_security_purge( 'plugin_SecurityExtend_config_edit' );

$t_redirect_url = plugin_page('config', TRUE);

layout_page_header( null, $t_redirect_url );
layout_page_begin();
html_operation_successful( $t_redirect_url );
layout_page_end();
