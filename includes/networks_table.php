<?php
/**
 * SocialWiggle - Social network chooser on settings page
 *
 * @author 	Brad Vincent
 * @package 	social-wiggle/includes
 * @version     1.0
 */

function socwig_render_networks_table($saved_networks) {
    $networks = $GLOBALS['socialwiggle_networks'];
	$socwig_actual_sortorder = array_keys($networks);
	$sortorder = '';

	if (empty($saved_networks)) {
		$saved_networks = array();
	} else if (array_key_exists('sortorder', $saved_networks)) {
		$sortorder = $saved_networks['sortorder'];
		if (!empty($sortorder)) {
			$sortorder = str_replace('socwig-sort[]=&', '', $sortorder);

			parse_str($sortorder, $socwig_actual_sortorder);

			$socwig_actual_sortorder = $socwig_actual_sortorder['socwig-sort'];
		}
	}

$url = plugins_url( 'images' , __FILE__ );
?>
<p><?php _e('Select which social networks you want to use by ticking the checkboxes. To change their display order, simply click and drag the icons up or down.', 'socialwiggle'); ?></p>
<input type="hidden" id="socwig-sort-order" name="socialwiggle[networks][sortorder]" style="width:100%" value="<?php echo $sortorder; ?>" />
<table id="socwig-sort" class="widefat socwig-container socwig-32 socwig-table" cellspacing="0">
	<thead>
		<tr>
			<th scope="col" id="cb" class="manage-column column-cb"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></th>
			<th scope="col" id="network" class="manage-column column-title">Network</th>
			<th scope="col" id="options" class="manage-column column-options">URL</th>
			<th scope="col" id="options" class="manage-column column-options">Tooltip</th>
		</tr>
	</thead>
	<tbody id="the-list">
	<?php foreach ($socwig_actual_sortorder as $class) {
		$network = $networks[$class];
		$name = $network['name'];
		$message = $network['message'];
		$placeholder = $network['placeholder'];
		$linkprefix = $network['linkprefix'];
		$checked = array_key_exists($class.'-enabled', $saved_networks);
		$disabled = $checked ? '' : 'disabled';
		$url = array_key_exists($class.'-url', $saved_networks) ? $saved_networks[$class.'-url'] : $linkprefix;
		$tooltip = array_key_exists($class.'-tooltip', $saved_networks) ? $saved_networks[$class.'-tooltip'] : $message;
		?>
		<tr id="<?php echo $class; ?>" class="<?php echo $disabled; ?>">
			<td><input <?php echo $checked ? 'checked="checked"' : ''; ?> name="socialwiggle[networks][<?php echo $class; ?>-enabled]" value="<?php echo $class; ?>" type="checkbox" class="socwig-table-check" /></td>
			<td>
				<i title="<?php echo $name; ?>" class="socwig-dragme socwigbtn socwig-<?php echo $class; ?>"></i><span class="socwig-table-title"><?php echo $name; ?></span>
			</td>
			<td>
				<input type="text" class="regular-text" style="width:300px" value="<?php echo $url; ?>" name="socialwiggle[networks][<?php echo $class; ?>-url]" />
			</td>
			<td>
				<input type="text" class="regular-text" style="width:200px" value="<?php echo $tooltip; ?>" name="socialwiggle[networks][<?php echo $class; ?>-tooltip]" />
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php
}