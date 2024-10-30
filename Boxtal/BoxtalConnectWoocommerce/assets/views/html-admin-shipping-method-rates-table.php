<?php
/**
 * Shipping method rates table rendering
 *
 * @package     Boxtal\BoxtalConnectWoocommerce\Assets\Views
 */

use Boxtal\BoxtalConnectWoocommerce\Util\Misc_Util;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<table class="form-table" class="bw-shipping-method-info">
	<thead>
		<th class="bw-pricing-header">
			<b><?php esc_html_e( 'Pricing rules', 'boxtal-connect' ); ?></b>
			<p>
				<?php esc_html_e( 'Set up your rules regarding the shipping costs that will be displayed for your clients in the checkout page. The rules are prioritized from top to bottom. If no rules is applicable, the shipping method won\'t be displayed.', 'boxtal-connect' ); ?>
				<br/>
				<?php
				if ( null !== $help_center_link ) {
					/* translators: %1$1s: link start %2$2s: link end*/
					echo sprintf( esc_html__( 'Need some help? Just follow the instructions on %1$sthis article%2$s.', 'boxtal-connect' ), '<a href="' . esc_url( $help_center_link ) . '" target="_blank">', '</a>' );
				}
				?>
			</p>
		</th>
	</thead>
</table>
<table id="bw-rates-table" class="wc_input_table sortable widefat">
	<thead>
		<tr>
			<th rowspan="2" class="sort">&nbsp;</th>
			<th colspan="2" class="bw-center">
				<?php echo esc_html__( 'Cart price Excluding Tax', 'boxtal-connect' ) . ' (' . esc_html( get_woocommerce_currency_symbol() ) . ') '; ?>
			</th>
			<th colspan="2" class="bw-center"><?php echo esc_html__( 'Cart weight', 'boxtal-connect' ) . ' (kg)'; ?></th>
			<?php if ( count( $shipping_classes ) > 1 ) { ?>
			<th rowspan="2" class="bw-center">
				<?php
					echo '<span>' . esc_html__( 'Shipping class', 'boxtal-connect' ) . '</span>';
					$bx_tooltip_html  = '<ul><li>' . esc_html__( 'if you choose a shipping class, the rule will only apply to carts with all products belonging to the class', 'boxtal-connect' ) . '</li>';
					$bx_tooltip_html .= '<li>' . esc_html__( "Beware that newly created shipping classes won't be selected by default", 'boxtal-connect' ) . '</li></ul>';
					Misc_Util::echo_tooltip( $bx_tooltip_html );
				?>
			</th>
			<?php } ?>
			<th class="bw-center"><?php esc_html_e( 'Parcel point\'s maps to show to your customers', 'boxtal-connect' ); ?></th>
			<th rowspan="2" class="w11 bw-center">
			<?php
				echo '<span class="mr2">' . esc_html__( 'Price displayed ex-Tax', 'boxtal-connect' ) . ' (' . esc_html( get_woocommerce_currency_symbol() ) . ')</span>';
				$bx_tooltip_html  = __( 'If you wish to offer the shipping for free, put 0.', 'boxtal-connect' ) . '<br/>';
				$bx_tooltip_html .= __( 'If you\'ve set up a shipping tax, it will be applied to this price for your client.', 'boxtal-connect' );
				Misc_Util::echo_tooltip( $bx_tooltip_html );
			?>
			</th>
			<th rowspan="2" class="w11 bw-center">
			<?php
				echo '<span class="mr2">' . esc_html__( 'Status', 'boxtal-connect' ) . '</span>';
			?>
			</th>
			<th rowspan="2" ></th>
		</tr>
		<tr>
			<th class="bw-center"><?php esc_html_e( 'From', 'boxtal-connect' ); ?> (≥)</th>
			<th class="bw-center"><?php esc_html_e( 'To', 'boxtal-connect' ); ?> (<)</th>
			<th class="bw-center"><?php esc_html_e( 'From', 'boxtal-connect' ); ?> (≥)</th>
			<th class="bw-center"><?php esc_html_e( 'To', 'boxtal-connect' ); ?> (<)</th>
			<th class="bw-center info-small">
				<?php esc_html_e( 'If you want your customers to be able to choose their parcel point in the checkout, select the networks below to display', 'boxtal-connect' ); ?>
			</th>
		</tr>
	</thead>
	<tbody class="ui-sortable">
		<?php
		if ( isset( $pricing_items ) && is_array( $pricing_items ) ) {
			$i = 0;
			foreach ( $pricing_items as $pricing_item ) {
				include 'html-admin-shipping-method-rate.php';
				$i++;
			}
		}
		?>
	</tbody>
</table>

<button class="bw-add-rate-line" data-action="bw_add_rate_line">
	<i class="dashicons dashicons-plus-alt"></i>
	<?php esc_html_e( 'Add rule', 'boxtal-connect' ); ?>
</button>

<?php wp_nonce_field( $post_action, $post_action_field_name, true, true ); ?>
<input type="hidden" name="save" value="1">