<?php

auth_reauthenticate();
access_ensure_global_level(config_get('manage_plugin_threshold'));

layout_page_header(plugin_lang_get('title'));
layout_page_begin(__FILE__);
print_manage_menu( 'manage_plugin_page.php' );

$edit_threshhold = plugin_config_get('edit_threshold_level');
$view_threshhold = plugin_config_get('view_threshold_level');
$block_bug = plugin_config_get('block_bug');
$block_bugnote = plugin_config_get('block_bugnote');

?>

<br />

<div class="col-xs-12 col-md-8 col-md-offset-2">
	<div class="space-10"></div>
	<div id="config-div" class="form-container">
		<form id="config-form" method="post" action="<?php echo plugin_page('config_edit') ?>">
		    <?php echo form_security_field( 'plugin_SecurityExtend_config_edit' ) ?>
			<div class="widget-box widget-color-blue2">
				<div class="widget-header widget-header-small">
					<h4 class="widget-title lighter">
						<i class="ace-icon fa fa-cogs"></i>
						<?php echo plugin_lang_get('title') . ': ' . plugin_lang_get('config') ?>
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<div class="form-container">
							<div class="table-responsive">
								<table class="table table-bordered table-condensed table-striped">
									<fieldset>
										<tr <?php echo helper_alternate_class() ?>>
											<td class="category" width="250">
												<?php echo lang_get('custom_field_access_level_r') ?>
											</td>
											<td>
												<select name="view_threshold_level">
													<?php print_enum_string_option_list('access_levels', $view_threshhold) ?>
												</select>
											</td>
										</tr>
										<tr <?php echo helper_alternate_class() ?>>
											<td class="category" width="250">
												<?php echo lang_get('custom_field_access_level_rw') ?>
											</td>
											<td>
												<select name="edit_threshold_level">
													<?php print_enum_string_option_list('access_levels', $edit_threshhold) ?>
												</select>
											</td>
										</tr>
										<tr <?php echo helper_alternate_class() ?>>
											<td class="category" width="250">
												<?php echo plugin_lang_get('config_block_bug_duplicate'); ?><br>
												<span class="required"> * <?php echo plugin_lang_get('config_block_bug_duplicate_note') ?></span>
											</td>
											<td>
												<input type="checkbox" name="block_bug_duplicate" <?php if (plugin_config_get('block_bug_duplicate', ON) == ON) echo ' checked="checked"' ?> />
											</td>
										</tr>
										<tr <?php echo helper_alternate_class() ?>>
											<td class="category" width="250">
												<?php echo plugin_lang_get('config_disable_user_on_antispam'); ?><br>
												<span class="required"> * <?php echo plugin_lang_get('config_disable_user_on_antispam_note') ?></span>
											</td>
											<td>
												<input type="checkbox" name="disable_user_on_antispam" <?php if (plugin_config_get('disable_user_on_antispam', ON) == ON) echo ' checked="checked"' ?> />
											</td>
										</tr>
										<tr <?php echo helper_alternate_class() ?>>
											<td class="category" width="250">
												<?php echo plugin_lang_get('config_clean_on_antispam'); ?><br>
												<span class="required"> * <?php echo plugin_lang_get('config_clean_on_antispam_note') ?></span>
											</td>
											<td>
												<input type="checkbox" name="clean_on_antispam" <?php if (plugin_config_get('clean_on_antispam', ON) == ON) echo ' checked="checked"' ?> />
											</td>
										</tr>
										<tr <?php echo helper_alternate_class() ?>>
											<td class="category" width="250">
												<?php echo plugin_lang_get('config_show_bird_on_bug_block'); ?><br>
												<span class="required"> * <?php echo plugin_lang_get('config_show_bird_on_bug_block_note') ?></span>
											</td>
											<td>
												<input type="checkbox" name="show_bird_on_bug_block" <?php if (plugin_config_get('show_bird_on_bug_block', ON) == ON) echo ' checked="checked"' ?> />
											</td>
										</tr>
									</fieldset>
								</table>

							</div>
						</div>
					</div>

					<div class="widget-toolbox padding-8 clearfix">
						<input type="submit" name="submit" class="btn btn-primary btn-white btn-round" value="<?php echo plugin_lang_get('update_config') ?>" />
					</div>
				</div>
			</div>

		</form>
	</div>
	<div class="space-10"></div>
</div>

<?php
layout_page_end();
