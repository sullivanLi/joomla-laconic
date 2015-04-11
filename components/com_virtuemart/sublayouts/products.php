<?php
/**
 * sublayout products
 *
 * @package	VirtueMart
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
 * @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
 */

defined('_JEXEC') or die('Restricted access');
$products_per_row = $viewData['products_per_row'];
$currency = $viewData['currency'];
$showRating = $viewData['showRating'];
echo shopFunctionsF::renderVmSubLayout('askrecomjs');

$ItemidStr = '';
$Itemid = shopFunctionsF::getLastVisitedItemId();
if(!empty($Itemid)){
	$ItemidStr = '&Itemid='.$Itemid;
}

foreach ($viewData['products'] as $type => $products ) {

	$rowsHeight = shopFunctionsF::calculateProductRowsHeights($products,$currency,$products_per_row);

	?>
<table class="table-no-border" width="100%">
		<?php // Start the Output
		$col = 1;
		$row = 1;
		$now_row =1;

	foreach ( $products as $product ) {

		if ($col == 1){
			?>
			<tr>
			<?php
		}
    // Show Products ?>
	<td>
		<table class="table" width="70%">
			<tr><td bgcolor="#B0D180" colspan="2"><?php echo $product->product_name ?></td></tr>
			<tr><td>
					<a title="<?php echo $product->product_name ?>" href="<?php echo $product->link.$ItemidStr; ?>">
						<?php
						echo $product->images[0]->displayMediaThumb('class="browseProductImage"', false);
						?>
					</a>
			</td>
			<td>
				<p>
					<?php // Product Short Description
					if (!empty($product->product_s_desc)) {
						echo shopFunctionsF::limitStringByWord ($product->product_s_desc, 60, ' ...') ?>
					<?php } ?>
				</p>

			<?php //echo $rowsHeight[$row]['price'] ?>
			<div> <?php
				echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$product,'currency'=>$currency)); ?>
			</div>
			<div>
				<a href="<?php echo $product->link.$ItemidStr; ?>">詳細資料</a>
			</div>
		</td>
		</tr>
		</table>
		<td width="5%"></td>
	</td>
    <?php
    	if ($col == $products_per_row){
    		$col = 1;
			$now_row++;
    	}else{
    		$col++;
    	}
		if ($row <> $now_row){
			$row = $now_row;
			?>
		</tr>
			<?php
		}
    }
	?>
</table>
	<?php
  }		
	?>

