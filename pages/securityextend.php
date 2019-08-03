<?php
# Mantis - a php based bugtracking system
require_once('core.php');

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

            if ($t_current_tab === $t_first_tab_title)
            {
                $t_keywords_block_bug = "";
                $t_block_id = 'plugin_SecurityExtend_block_bug';
                $t_collapse_block = is_collapsed($t_block_id);
                $t_block_css = $t_collapse_block ? 'collapsed' : '';
                $t_block_icon = $t_collapse_block ? 'fa-chevron-down' : 'fa-chevron-up';
                
                $query = "SELECT value FROM " . plugin_table('config') . " WHERE name='block_bug'";
                $result = db_query($query);
                if ($row = db_fetch_array($result)) {
                    if (!$row) {
                        trigger_error(ERROR_FILE_NOT_FOUND, ERROR);
                    }
                    $keywords_block_bug = $row['value'];
                }
?>
                <div id="<?php echo $t_block_id ?>" class="widget-box widget-color-blue2  no-border <?php echo $t_block_css ?>">

                    <div class="widget-header widget-header-small">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-bug"></i>
                            <?php echo plugin_lang_get('management_block_bug_label'), lang_get('word_separator'), plugin_lang_get('management_block_description_label') ?>
                        </h4>
                        <div class="widget-toolbar">
                            <a data-action="collapse" href="#">
                                <i class="1 ace-icon fa <?php echo $t_block_icon ?> bigger-125"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="form-container">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-striped">
                                        <fieldset>
                                            <tr>
                                                <td>
                                                    <textarea name="block_bug" rows="5" spellcheck="true" style="width:100%" /><?php echo $keywords_block_bug ?></textarea>
                                                </td>
                                            </tr>
                                        </fieldset>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
<?php
            }
            else if ($t_current_tab === plugin_lang_get('management_block_domain_title'))
            {
                $t_block_id = 'plugin_SecurityExtend_block_bug';
                $t_collapse_block = is_collapsed($t_block_id);
                $t_block_css = $t_collapse_block ? 'collapsed' : '';
                $t_block_icon = $t_collapse_block ? 'fa-chevron-down' : 'fa-chevron-up';
?>
                <div id="<?php echo $t_block_id ?>" class="widget-box widget-color-blue2  no-border <?php echo $t_block_css ?>">

                    <div class="widget-header widget-header-small">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-bug"></i>
                            <?php echo plugin_lang_get('management_block_domain_label') ?>
                        </h4>
                        <div class="widget-toolbar">
                            <a data-action="collapse" href="#">
                                <i class="1 ace-icon fa <?php echo $t_block_icon ?> bigger-125"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="form-container">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-striped">
                                        <fieldset>
                                            <tr>
                                                <td>
                                                    Not implemented yet
                                                </td>
                                            </tr>
                                        </fieldset>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
<?php
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
