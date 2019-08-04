<?php

require_once('core.php');
require_once('securityextend_api.php');

auth_reauthenticate();
access_ensure_project_level(plugin_config_get('view_threshold_level'));

layout_page_header_begin(plugin_lang_get('management_title'));
echo "\t" . '<script type="text/javascript" src="' . plugin_file('securityextend.js') . '"></script>' . "\n";
layout_page_header_end( $p_page_id );

layout_page_begin(__FILE__);
print_manage_menu('SecurityExtend/securityextend');

$keywords_block_bug = '';
$keywords_block_bugnote = '';

$t_current_tab = print_tab_bar();

echo '<div hidden title="' . plugin_lang_get('management_confirm_clear') . '" id="securityextend_confirm_clear"></div>';

?>

<div class="col-xs-12">
    <div id="config-div" class="form-container">
<?php
        #
        # 'Info' tab
        #
        if ($t_current_tab === plugin_lang_get('management_info_title'))
        {
            $t_section_content = 'Not implemented yet';
            print_section('info', $t_section_content, 'fa-book');
            print_section('info_changelog', $t_section_content, 'fa-book');
        }
        #
        # 'Block domain' tab
        #
        else if ($t_current_tab === plugin_lang_get('management_block_account_title'))
        {
            echo '<form method="post" enctype="multipart/form-data" action="' . plugin_page('securityextend_edit'). '">';
            echo form_security_field('plugin_SecurityExtend_securityextend_edit');
            echo '<input type="hidden" name="tab" value="' . $t_current_tab . '" />';
            echo '<input type="hidden" name="id" value="0" />';
            print_textarea_section('block_account_domain', 'fa-envelope');
            print_save_button_footer('save_account_block');
            echo '</form>';
            print_blocked_email_section();
        }
        #
        # 'Block bug' tab
        #
        if ($t_current_tab === plugin_lang_get('management_block_bug_title'))
        {
            echo '<form method="post" enctype="multipart/form-data" action="' . plugin_page('securityextend_edit'). '">';
            echo form_security_field('plugin_SecurityExtend_securityextend_edit');
            echo '<input type="hidden" name="tab" value="' . $t_current_tab . '" />';
            echo '<input type="hidden" name="id" value="0" />';
            print_textarea_section('block_bug', 'fa-bug');
            print_textarea_section('block_bug_disable_user', 'fa-bug');
            print_textarea_section('block_bug_delete_user', 'fa-bug');
            print_save_button_footer('save_bug_block');
            echo '</form>';
        }
        #
        # 'Log' tab
        #
        else if ($t_current_tab === plugin_lang_get('management_log_title'))
        {
            print_log_section('block_account_email_address', $t_current_tab);
            print_log_section('block_bug', $t_current_tab);
            print_log_section('block_bug_disable_user', $t_current_tab);
            print_log_section('block_bug_delete_user', $t_current_tab);
        }
?>
    </div>
    <div class="space-10"></div>
</div>

<?php
layout_page_end();
