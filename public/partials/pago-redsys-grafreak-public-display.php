<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.grafreak.net
 * @since      1.0.0
 *
 * @package    Pago_Redsys_Grafreak
 * @subpackage Pago_Redsys_Grafreak/public/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
if ( ! isset( $_REQUEST['Ds_SignatureVersion'] ) ) { // FORMULARIO PRE ENVIO. ?>
	<div class="plugin-form-tpv">
	<?php
	echo esc_html( $content );
	$titulo_plugin = get_option( $this->option_name . '_titulo' );
	echo esc_html( $titulo_plugin ) ? '<h2>' . esc_html( $titulo_plugin ) . '</h2>' : '';
	$inputnp    = '';
	$readonlynp = '';
	$inputc     = '';
	$readonlyc  = '';
	if ( isset( $_REQUEST['np'] ) ) {
		$inputnp    = sanitize_text_field( wp_unslash( $_REQUEST['np'] ) );
		$inputnp    = substr( $inputnp, 0, 8 );
		$readonlynp = 'readonly="readonly"';
	}
	if ( isset( $_REQUEST['c'] ) ) {
		$inputc    = sanitize_text_field( wp_unslash( $_REQUEST['c'] ) );
		$inputc    = floatval( str_replace( ',', '.', $inputc ) );
		$readonlyc = 'readonly="readonly"';
	}
	?>
	<div class="form_tpv"></div>
	<table class="table-form-tpv">
		<tr class="tpv-plugin-codigo-pedido">
			<td><?php esc_html_e( 'Order code', 'pago-redsys-grafreak' ); ?></td>
			<td><span class="error"><?php esc_html_e( 'Must be between 4 and 8 characters', 'pago-redsys-grafreak' ); ?></span><input type="text" value="<?php echo esc_html( $inputnp ); ?>" name="orderNumber" id="orderNumber" <?php echo esc_html( $readonlynp ); ?> /></td>
		</tr>
		<tr class="tpv-plugin-cantidad-pagar">
			<td><?php esc_html_e( 'Quantity to pay', 'pago-redsys-grafreak' ); ?></td>
			<td><span class="error"><?php esc_html_e( 'Must specify a quantity', 'pago-redsys-grafreak' ); ?></span><input type="number" step="0.01" value="<?php echo esc_html( $inputc ); ?>" name="amountTPV" id="amountTPV" <?php echo esc_html( $readonlyc ); ?> /><span>€<span></td>
		</tr>
	</table>
	<div class="section-right-form-tpv">
		<div class="img-formaspago"><img width="60%" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__ ) ) ) . 'img/img-formaspago.png'; ?>" /></div>
		<input type="hidden" name="nonce_secure" id="nonce_secure" value="<?php echo esc_html( wp_create_nonce( 'tpv_submit' ) ); ?>" />
		<?php if ( $atts['url_ok'] !== '' ){ ?>
			<input type="hidden" name="url_ok" id="url_ok" value="<?php echo esc_url_raw( $atts['url_ok'] ); ?>" />
		<?php } ?>
		<?php if ( $atts['url_ko'] !== '' ){ ?>
			<input type="hidden" name="url_ko" id="url_ko" value="<?php echo esc_url_raw( $atts['url_ko'] ); ?>" />
		<?php } ?>
		<a href="#" id="form_tpv_submit"><?php esc_html_e( 'Pay', 'pago-redsys-grafreak' ); ?></a>
	</div>
</div>
<?php } ?>
