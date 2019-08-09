<?php

require_once('core.php');
require_once('securityextend_api.php');
require_once('parsedown.php');
require_once('parsedown-toc.php');

auth_reauthenticate();
access_ensure_project_level(plugin_config_get('view_threshold_level'));

layout_page_header_begin(plugin_lang_get('management_title'));
echo "\t" . '<script type="text/javascript" src="' . plugin_file('securityextend.js') . '"></script>' . "\n";
layout_page_header_end( $p_page_id );

layout_page_begin(__FILE__);
print_manage_menu('SecurityExtend/securityextend');

$keywords_block_bug = '';
$keywords_block_bugnote = '';

$t_current_tab = se_print_tab_bar();

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
            $t_file_path = config_get_global( 'plugin_path' ) . 'SecurityExtend' . DIRECTORY_SEPARATOR . 'README.md';
            $t_file = fopen($t_file_path , "r") or die("<br><br> &nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;<b>" . plugin_lang_get('cannot_open') . "</b>");
            $t_content = fread($t_file, filesize($t_file_path));
            fclose($t_file);

            $ParsedownToc = new ParsedownToc();
            $ParsedownToc->setSafeMode(false);

			$t_html = $ParsedownToc->text($t_content);
			// Bug in parsedown example '>' gets converted to &amp;gt; when it should be just &gt;
			$t_html = str_replace("&amp;gt;", "&gt;", $t_html);
			$t_html = str_replace("&amp;lt;", "&lt;", $t_html);
			$t_html = str_replace("&amp;quot;", "&quot;", $t_html);
            $t_html = str_replace('="res/', '="' . helper_mantis_url('plugins/SecurityExtend/res/'), $t_html);

            se_print_section('info', $t_html, 'fa-book');
            echo '<div class="space-10"></div>';
            
            $Parsedown = new ParsedownEx();

            $t_file_path = config_get_global( 'plugin_path' ) . 'SecurityExtend' . DIRECTORY_SEPARATOR . 'CHANGELOG.md';
            $t_file = fopen($t_file_path , "r") or die("<br><br> &nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;<b>" . plugin_lang_get('cannot_open') . "</b>");
            $t_content = fread($t_file, filesize($t_file_path));
            fclose($t_file);

            $t_html = $Parsedown->text($t_content);
			// Bug in parsedown example '>' gets converted to &amp;gt; when it should be just &gt;
			$t_html = str_replace("&amp;gt;", "&gt;", $t_html);
			$t_html = str_replace("&amp;lt;", "&lt;", $t_html);
            $t_html = str_replace("&amp;quot;", "&quot;", $t_html);
            
            se_print_section('info_changelog', $t_html, 'fa-book');
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
            se_print_textarea_section('block_account_domain', 'fa-envelope');
            se_print_save_button_footer('save_account_block');
            echo '</form>';
            se_print_blocked_email_section();
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
            se_print_textarea_section('block_bug', 'fa-bug');
            se_print_textarea_section('block_bug_disable_user', 'fa-bug');
            se_print_textarea_section('block_bug_delete_user', 'fa-bug');
            se_print_save_button_footer('save_bug_block');
            echo '</form>';
        }
        #
        # 'Log' tab
        #
        else if ($t_current_tab === plugin_lang_get('management_log_title'))
        {
            se_print_log_section('block_account_email_address', $t_current_tab);
            se_print_log_section('block_bug', $t_current_tab);
            se_print_log_section('block_bugnote', $t_current_tab);
            se_print_log_section('block_bug_disable_user', $t_current_tab);
            se_print_log_section('block_bugnote_disable_user', $t_current_tab);
            se_print_log_section('block_bug_delete_user', $t_current_tab);
            se_print_log_section('block_bugnote_delete_user', $t_current_tab);
            se_print_log_section('antispam_count_disable_user', $t_current_tab);
            se_print_log_section('antispam_count_delete_user', $t_current_tab);
            se_print_log_section('antispam_count_delete_bug', $t_current_tab);
            se_print_log_section('antispam_count_delete_bugnote', $t_current_tab);
        }
?>
    </div>
    <div class="space-10"></div>
</div>

<?php
layout_page_end();
