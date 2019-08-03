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

echo '<ul class="nav nav-tabs padding-18" style="margin-top:5px;margin-left:5px;">' . "\n";

$t_first_tab_title = plugin_lang_get('management_block_bug_title');

$t_current_tab = gpc_get_string('tab', null);
$t_is_first_page = ($t_current_tab === null);
if ($t_is_first_page) {
    $t_current_tab = $t_first_tab_title; 
}

$t_tab_title = $t_first_tab_title;
$menu_item = '<a href="' . plugin_page('securityextend') . '&tab=' . urlencode($t_tab_title) . '">' . $t_tab_title . '</a>';
$active = $t_current_tab === $t_tab_title ? ' class="active"' : '';
echo "<li{$active}>" . $menu_item . '</li>';

$t_tab_title = plugin_lang_get('management_block_domain_title');
$menu_item = '<a href="' . plugin_page('securityextend') . '&tab=' . urlencode($t_tab_title) . '">' . $t_tab_title . '</a>';
$active = $t_current_tab === $t_tab_title ? ' class="active"' : '';
echo "<li{$active}>" . $menu_item . '</li>';

echo '</ul>' . "\n<br />";

?>

<div class="col-xs-12 col-md-8 col-md-offset-2">
    <div class="space-10"></div>
    <div id="config-div" class="form-container">
        <form method="post" enctype="multipart/form-data" action="<?php echo plugin_page('securityextend_edit') ?>">

<?php
            echo form_security_field('plugin_SecurityExtend_securityextend_edit');
            echo '<input type="hidden" name="tab" value="' . $active_file . '">';

            #
            # 'Block bug' tab
            #
            if ($t_current_tab === $t_first_tab_title)
            {
                print_textarea_section('block_bug', 'fa-bug');
                print_textarea_section('block_bug_disable_user', 'fa-bug');
                print_textarea_section('block_bug_delete_user', 'fa-bug');
            }
            #
            # 'Blacklisted domains' tab
            #
            else if ($t_current_tab === plugin_lang_get('management_block_domain_title'))
            {
                print_textarea_section('block_domain', 'fa-envelope');
            }
?>
            <div class="widget-toolbox padding-8 clearfix">
                <input type="submit" class="btn btn-primary btn-white btn-round" value="<?php echo lang_get('save') ?>" />
            </div>
        </form>
    </div>
    <div class="space-10"></div>
</div>

<?php
layout_page_end();
