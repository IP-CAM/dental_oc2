<div class="boss_featured">
  <div class="box-content">
      <?php foreach ($products as $product) { ?>
      <div class="one-product-featured">
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
        <div class="model"><?php echo $product['model']; ?></div>
        <div class="shop-now"><a href="<?php echo $product['href']; ?>"><?php echo $text_shop; ?></a></div>
      </div>
      <?php } ?>
  </div>
</div>