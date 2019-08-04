<?php

require_once('core.php');
require_once('securityextend_api.php');

$f_id = gpc_get_int('id');
$f_action = gpc_get_string('action');
$f_tab = gpc_get_string('tab');

access_ensure_project_level(plugin_config_get('edit_threshold_level'));

$t_redirect_url = plugin_page('securityextend', TRUE) . '&tab=' . $f_tab;

if ($f_tab == 'Log') 
{
    if ($f_id >= 1) {
        $query = "DELETE FROM " . plugin_table('log') . " WHERE id=" . $f_id;
        $result = db_query($query);
    }
    else if (!is_blank($f_action)) {
        $query = "DELETE FROM " . plugin_table('log') . " WHERE action='" . $f_action . "'";
        $result = db_query($query);
    }
    else {
        print_failure_and_redirect($t_redirect_url);
    }
}
else {
    print_failure_and_redirect($t_redirect_url);
}

print_success_and_redirect($t_redirect_url);
