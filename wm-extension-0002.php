<?php
/*
 * Plugin Name: Woomelly Extension 002 Add ons 
 * Version: 1.0.0
 * Plugin URI: https://woomelly.com
 * Description: Woomelly extension that allows you to remove paragraph chunks from the long description of publicarion (sync Woo > ML)
 * Author: Team MakePlugins
 * Author URI: https://woomelly.com
 * Requires at least: 4.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'woomelly_admin_menu_ext_002' ) ) {
	add_action( 'admin_menu', 'woomelly_admin_menu_ext_002', 10 );
	function woomelly_admin_menu_ext_002() {
		add_menu_page( 'WM Extesion 002', 'WM Extesion 002', 'manage_options', 'wm-extension002-menu', 'wm_extension002_menu', '', 72 );
	}
	function wm_extension002_menu() {
        if ( isset($_POST['wm_submit_strings']) ) {
            $strings_save = array();
            if ( isset($_POST['wm_string_01']) )
                $strings_save[] = trim($_POST['wm_string_01']);
            if ( isset($_POST['wm_string_02']) )
                $strings_save[] = trim($_POST['wm_string_02']);
            if ( isset($_POST['wm_string_03']) )
                $strings_save[] = trim($_POST['wm_string_03']);
            if ( isset($_POST['wm_string_04']) )
                $strings_save[] = trim($_POST['wm_string_04']);
            if ( isset($_POST['wm_string_05']) )
                $strings_save[] = trim($_POST['wm_string_05']);
            if ( isset($_POST['wm_string_06']) ) {
                $wc_categories = explode(',',$_POST['wm_string_06']);
                if ( !empty($wc_categories) ) {
                    $wc_categories_temp = array();
                    foreach ( $wc_categories as $value ) {
                        $wc_categories_temp[] = trim($value);
                    }
                    unset($wc_categories);
                    $wc_categories = $wc_categories_temp;
                }
                $strings_save[] = $wc_categories;
            }
            update_option( 'wm_strings_ext_002', $strings_save);
            echo '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"><p><strong>Ajustes guardados.</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>';
		}
        $strings = get_option( 'wm_strings_ext_002', array());
        if ( !isset($strings[0])) $strings[0] = '';
        if ( !isset($strings[1])) $strings[1] = ''; 
        if ( !isset($strings[2])) $strings[2] = '';
        if ( !isset($strings[3])) $strings[3] = '';
        if ( !isset($strings[4])) $strings[4] = '';
        if ( !isset($strings[5])) $strings[5] = ''; else $strings[5] = implode(',',$strings[5]);
    	?>
    	<div class="wrap">
    		<h2 class="uk-heading-divider"><?php echo __("WM Extesion 002", "woomelly"); ?></h2><br>
			<div style="padding-top: 15px;">
                <form action="" method="post">
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th scope="row"><label for="blogname">String Delimitador 01</label></th>
                                    <td><input name="wm_string_01" type="text" id="wm_string_01" value="<?php echo $strings[0]; ?>" class="regular-text"></td>
                                </tr>
                            <tr>
                            <tr>
                                <th scope="row"><label for="blogname">String Delimitador 02</label></th>
                                    <td><input name="wm_string_02" type="text" id="wm_string_02" value="<?php echo $strings[1]; ?>" class="regular-text"></td>
                                </tr>
                            <tr>
                            <tr>
                                <th scope="row"><label for="blogname">String Delimitador 03</label></th>
                                    <td><input name="wm_string_03" type="text" id="wm_string_03" value="<?php echo $strings[2]; ?>" class="regular-text"></td>
                                </tr>
                            <tr>
                            <tr>
                                <th scope="row"><label for="blogname">String Delimitador 04</label></th>
                                    <td><input name="wm_string_04" type="text" id="wm_string_04" value="<?php echo $strings[3]; ?>" class="regular-text"></td>
                                </tr>
                            <tr>
                            <tr>
                                <th scope="row"><label for="blogname">String Delimitador 05</label></th>
                                    <td><input name="wm_string_05" type="text" id="wm_string_05" value="<?php echo $strings[4]; ?>" class="regular-text"></td>
                                </tr>
                            <tr>
                            <?php /*
                            <tr>
                                <th scope="row"><label for="blogname">WooCommerce Categorías</label></th>
                                    <td><input name="wm_string_06" type="text" id="wm_string_06" value="<?php echo $strings[5]; ?>" class="regular-text"></td>
                                </tr>
                            <tr>
                            */ ?>
                        </tbody>
                    </table>
                    <p class="submit"><input type="submit" name="wm_submit_strings" id="wm_submit_strings" class="button button-primary" value="Guardar cambios"></p>
                </form>
            </div>
    	<?php
	}
}

if ( ! function_exists( 'woomelly_get_extension_import_detail_ext_002' ) ) {
	add_filter( 'filter_woomelly_get_extension_import_detail', 'woomelly_get_extension_import_detail_ext_002', 10, 1 );
	function woomelly_get_extension_import_detail_ext_002 ( $plain_text ) {
		$strings = get_option( 'wm_strings_ext_002', array());
        $set_detail_temp = array();
        if ( !empty($strings) ) {
            foreach ( $strings as $value ) {
                if ( $value != "" ) {
                    unset($set_detail_temp);
                    $set_detail_temp = explode($value, $plain_text);
                    if ( count($set_detail_temp) > 1 ) {
                        break;
                    }
                }
            }
        }
		if ( isset($set_detail_temp[0]) ) {
			$plain_text = $set_detail_temp[0];	
		}
		return $plain_text;
	}
}

/*if ( ! function_exists( 'wm_filter_validate_sync_product_ext_002' ) ) {
    add_filter( 'wm_filter_validate_sync_product', 'wm_filter_validate_sync_product_ext_002', 10, 2 );
    function wm_filter_validate_sync_product_ext_002 ( $validate, $product ) {
        $validate = false;
        $strings = get_option( 'wm_strings_ext_002', array());
        
        if ( isset($strings[5]) ) {
            $wc_categories = implode(',',$strings[5]);
            $all_categories_ids = $product->get_category_ids();
            if ( is_array($wc_categories) && !empty($all_categories_ids) ) {
                if ( !empty($wc_categories) ) {
                    foreach ( $wc_categories as $value ) {
                        if ( in_array($value, $all_categories_ids) ) {
                            $validate = true;
                            break;
                        }
                    }
                } else {
                    $validate = true;
                }
            } else if ( !empty($all_categories_ids) ) {
                if ( in_array($wc_categories, $all_categories_ids) ) {
                    $validate = true;
                }
            } else {
                $validate = true;
            }
        } else {
            $validate = true;
        }

        return $validate;
    }
}*/

?>