<?php

require_once('core.php');
require_once('securityextend_api.php');

auth_reauthenticate();
access_ensure_project_level(plugin_config_get('view_threshold_level'));

layout_page_header(plugin_lang_get('management_title'));
layout_page_begin(__FILE__);
print_manage_menu('SecurityExtend/securityextend');

$keywords_block_bug = '';
$keywords_block_bugnote = '';

$t_current_tab = print_tab_bar();

?>

<div class="col-xs-12 col-md-8 col-md-offset-2">
    <div class="space-10"></div>
    <div id="config-div" class="form-container">
        <form method="post" enctype="multipart/form-data" action="<?php echo plugin_page('securityextend_edit') ?>">

<?php
        echo form_security_field('plugin_SecurityExtend_securityextend_edit');
        echo '<input type="hidden" name="tab" value="' . $t_current_tab . '">';

        #
        # 'Block bug' tab
        #
        if ($t_current_tab === plugin_lang_get('management_block_bug_title'))
        {
            print_textarea_section('block_bug', 'fa-bug');
            print_textarea_section('block_bug_disable_user', 'fa-bug');
            print_textarea_section('block_bug_delete_user', 'fa-bug');
            print_save_button_footer();
        }
        #
        # 'Blacklisted domains' tab
        #
        else if ($t_current_tab === plugin_lang_get('management_block_domain_title'))
        {
            print_textarea_section('block_domain', 'fa-envelope');
            print_save_button_footer();
        }
        #
        # 'Log' tab
        #
        else if ($t_current_tab === plugin_lang_get('management_log_title'))
        {
            $t_section_content = 'Not implemented yet';
            print_section('log', $t_section_content, 'fa-file-alt');
        }
?>
        </form>
    </div>
    <div class="space-10"></div>
</div>

<?php
layout_page_end();
