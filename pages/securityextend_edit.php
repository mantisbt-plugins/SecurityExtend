<?php

require_once('securityextend_api.php');

form_security_validate( 'plugin_SecurityExtend_securityextend_edit' );
auth_reauthenticate();

access_ensure_global_level(config_get('edit_threshold_level'));

$f_action = gpc_get_string('action');
$f_tab = gpc_get_string('tab');
$f_param = gpc_get_string('param', '');

$t_redirect_url = plugin_page('securityextend', true) . '&tab=' . $f_tab;

if ($f_action == 'save_bug_block')
{
    $f_block_bug = gpc_get_string('block_bug');
    $f_block_bug_disable_user = gpc_get_string('block_bug_disable_user');
    $f_block_bug_delete_user = gpc_get_string('block_bug_delete_user');

    save_config_value('block_bug', $f_block_bug);
    save_config_value('block_bug_disable_user', $f_block_bug_disable_user);
    save_config_value('block_bug_delete_user', $f_block_bug_delete_user);
}
else if ($f_action == 'save_account_block')
{
    $f_block_account= gpc_get_string('block_account_domain');
    save_config_value('block_account_domain', $f_block_account);
}
else if ($f_action == 'delete_log') 
{
    $f_id = gpc_get_int('id');

    if ($f_id >= 1) {
        $query = "DELETE FROM " . plugin_table('log') . " WHERE id=" . $f_id;
        $result = db_query($query);
    }
    else {
        $f_param = gpc_get_string('param');
        if (!is_blank($f_param)) {
            $query = "DELETE FROM " . plugin_table('log') . " WHERE action='" . $f_param . "'";
            $result = db_query($query);
        }
        else {
            print_failure_and_redirect($t_redirect_url);
        }
    }

    $query = "DELETE FROM " . plugin_table('log') . " WHERE id=" . $f_id;
    $result = db_query($query);
}
else if ($f_action == 'delete_account_blocked_email') 
{
    $f_param = gpc_get_string('param');
    $query = "DELETE FROM " . plugin_table('config') . " WHERE value='" . $f_param . "' AND name='block_account_email_address'";
    $result = db_query($query);
}
else {
    print_failure_and_redirect($t_redirect_url);
}

#
# Done, cleanup, show success, and redirect
#

form_security_purge('plugin_SecurityExtend_securityextend_edit');

print_success_and_redirect($t_redirect_url);
