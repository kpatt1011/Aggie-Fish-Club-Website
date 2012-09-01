<?php
/**
 * This function echoes lasers for Matt Thomas
 * and can be called wherever and whenever required
 */
function onlinemarketer_super_laser_defense() {
	$lasers = apply_filters( 'onlinemarketer_super_laser_defense', 'http://baldguy.files.wordpress.com/2011/07/pewpew.jpg' );
	echo '<img src="' . $lasers . '" alt="<pew><pew>" />';
}
