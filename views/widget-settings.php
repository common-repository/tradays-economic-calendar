<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
		<?php echo esc_html__( 'Title', 'tradays' ); ?>:
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>">
		<?php echo esc_html__( 'Width', 'tradays' ); ?>:
	</label>
	<input class="tradays-widget-size widefat width" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>">
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">
		<?php echo esc_html__( 'Height', 'tradays' ); ?>:
	</label>
	<input class="tradays-widget-size widefat height" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>">
</p>
<p>
	<input type="checkbox" class="tradays-widget-autosize" id="<?php echo esc_attr( $this->get_field_id( 'autosize' ) ); ?>" name="<?php echo $this->get_field_name( 'autosize' ); ?>" value="1" <?php echo $autosize === '1' ? 'checked' : ''; ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'autosize' ) ); ?>">
		<?php echo esc_html__( 'Auto Size', 'tradays' ); ?>
	</label>
</p>
<span><?php echo esc_html__( 'Mode', 'tradays' ); ?>:</span>
<?php
foreach ( $options['modes'] as $item ) {
	$label   = $item['label'];
	$value   = $item['value'];
	$checked = $mode === $value ? 'checked' : '';
	echo '<div style="padding: 4px 0;">';
	echo '<label for="' . esc_attr( $this->get_field_id( 'mode-' . $value ) ) . '">';
	echo '<input type="radio" class="widefat" id="' . esc_attr( $this->get_field_id( 'mode-' . $value ) ) . '" name="' . esc_attr( $this->get_field_name( 'mode' ) ) . '" value="' . esc_attr( $value ) . '" ' . esc_attr( $checked ) . '>' . esc_html__( $label, 'tradays' ) . '</label>';
	echo '</div>';
}
?>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'lang' ) ); ?>">
		<?php echo esc_html__( 'Language', 'tradays' ); ?>:
	</label>
	<br />
	<select id="<?php echo esc_attr( $this->get_field_id( 'lang' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lang' ) ); ?>">
	<?php
	foreach ( $options['langs'] as $item) {
		$label    = $item['label'];
		$value    = $item['value'];
		$selected = $lang === $value ? 'selected' : '';
		echo '<option value="' . esc_attr( $value ) . '" ' . esc_attr( $selected ) . '>' . esc_html__( $label, 'tradays' ) . '</option>';
	}
	?>
	</select>
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'dateformat' ) ); ?>">
		<?php echo esc_html__( 'Date Format', 'tradays' ); ?>:
	</label>
	<br />
	<select id="<?php echo esc_attr( $this->get_field_id( 'dateformat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dateformat' ) ); ?>">
	<?php
	foreach ( $options['dateformats'] as $item ) {
		$label    = $item['label'];
		$value    = $item['value'];
		$selected = $dateformat === $value ? 'selected' : '';
		echo '<option value="' . esc_attr( $value ) . '" ' . esc_attr( $selected ) . '>' . esc_html( $label ) . '</option>';
	}
	?>
	</select>
</p>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('.tradays-widget-autosize').change(function() {
			if (jQuery(this).is(":checked")) {
				jQuery('.tradays-widget-size').attr('disabled', 'disabled');
			} else {
				jQuery('.tradays-widget-size').removeAttr('disabled');
			}
		});

		jQuery('.tradays-widget-autosize').trigger('change');
	});
</script>
