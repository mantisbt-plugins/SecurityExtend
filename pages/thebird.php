<?php

require_once('core.php');
require_once('securityextend_api.php');

layout_page_header(plugin_lang_get('show_bird_on_bug_block_label'));

?>

<div class="col-xs-12 col-md-8 col-md-offset-2">

    <div class="widget-box widget-color-blue2  no-border">

    <div class="widget-header widget-header-small">
        <h4 class="widget-title lighter">
            <?php echo plugin_lang_get('show_bird_on_bug_block_label') ?>
        </h4>
    </div>

    <div class="widget-toolbox padding-8 clearfix">
        <?php echo plugin_lang_get('show_bird_on_bug_block_description') ?>
    </div>

    <div class="widget-body">
        <div class="widget-main no-padding">
            <table class="table table-bordered table-condensed table-striped">
                <tr>
                    <td width="100%" align="center">
                        <img src="<?php echo helper_mantis_url('plugins/SecurityExtend/files/img/thebird.jpg') ?>" height="600">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    </div>

</div>

<?php

html_meta_redirect($t_redirect_url, 3);
