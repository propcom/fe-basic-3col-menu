<div class="food-menu">
	<?php $siteId = XXX;
	$menuId = XXX;

	// Load Menu, but prevent from outputting.
	ob_start();
	require '/var/www/shared/menuincludes/menu.php';
	ob_end_clean();

	?>

	<?php foreach($menuCats as $menuInfo): ?>

		<?php
			$subcatId = $menuInfo['subcat_id'];
			$centreMenu = $menuInfo['menu_type'] == 'centre';
		?>
		<? //var_dump($subcatId); ?>

		<section class="menu_table four columns <?= $centreMenu ? 'centre_table' : 'left_table' ?>" id="cat-<?= $subcatId ?>">
			<article class="menu_item menu_item_head">
				<header class="menu_category_cell">
					<?php if (isset($menuATags) && $menuATags): ?>
						<a name="<?= htmlentities($menuInfo['subcat_name']); ?>"></a>
					<?php endif; ?>
					<?= $menuInfo['subcat_name'] ?>
				</header>
				<?php if ($menuInfo['no_headers'] > 0 && !$centreMenu): ?>
					<div class="menu_price_cell"><?= $menuInfo['price_header_1']?></div>
				<?php endif; ?>
				<?php if ($menuInfo['no_headers'] > 1 && !$centreMenu): ?>
					<div class="menu_price_cell"><?= $menuInfo['price_header_2']?></div>
				<?php endif; ?>
				<?php if ($menuInfo['no_headers'] > 2 && !$centreMenu): ?>
					<div class="menu_price_cell"><?= $menuInfo['price_header_3']?></div>
				<?php endif; ?>
				<div></div>
			</article>

			<?php
				$menuItems = $dbProcs->getMenuItems($subcatId);
			?>

			<?php foreach($menuItems as $itemCount=>$menuItem): ?>

				<article class="menu_item">
					<header class="menu_content_cell<?= ($itemCount % 2) ? ' oddRow' : ' evenRow' ?>">
						<span class="menu_title"><?= $menuItem['item_name']?></span>
						<?php if ($menuItem['item_desc']): ?>
							<span class="menu_description"><?= $menuItem['item_desc']?></span>
						<?php endif; ?>
					</header>
					<div class="price-wrap">
					<?php if ($menuInfo['no_headers'] > 0 && !$centreMenu): ?>
						<div class="menu_content_price_cell">£<?= $menuItem['price_1'] ?></div>
					<?php endif; ?>
					<?php if ($menuInfo['no_headers'] > 1 && !$centreMenu): ?>
						<div class="menu_content_price_cell"><?= $menuItem['price_2'] ?></div>
					<?php endif; ?>
					<?php if ($menuInfo['no_headers'] > 2 && !$centreMenu): ?>
						<div class="menu_content_price_cell"><?= $menuItem['price_3'] ?></div>
					<?php endif; ?>
					</div><!-- end of price-wrap -->
				</article>
			<?php endforeach; ?>
		</section>

	<?php endforeach; ?>

	<?php
		$notes = $dbProcs->getMenuNotes($menuId);
	?>

	<?php if ($notes !== false && strlen(trim($notes)) > 0): ?>
		<div class="menu_notes"><?= $notes ?></div>
	<?php endif; ?>

</div>