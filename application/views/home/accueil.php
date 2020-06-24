



<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">

            <?php
            foreach ($all_featured_products as $single_feature_product) {
                ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="<?php echo base_url('single/' . $single_feature_product->pId); ?>"><img style="width:250px;height:250px" src="<?php echo base_url('assets/produits/' . $single_feature_product->default_image) ?>" alt="" /></a>
                    <h2><?php echo $single_feature_product->pName; ?> </h2>
                    <p><?php echo word_limiter($single_feature_product->pDescription, 10) ?></p>
                    <p><span class="price"><?php echo $this->cart->format_number($single_feature_product->pPrice); ?> F CFA</span></p>
                    <div class="button"><span><a href="<?php echo base_url('single/' . $single_feature_product->pId); ?>" class="details">Details</a></span></div>
                </div>

            <?php } ?> 

        </div>

        <div class="content_bottom">
            <div class="heading">
                <h3>New Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php foreach ($all_new_products as $single_new_product) { ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="<?php echo base_url('single/' . $single_new_product->pId); ?>"><img style="width:250px;height:250px" src="<?php echo base_url('produits/' . $single_new_product->default_image) ?>" alt="" /></a>
                    <h2><?php echo $single_new_product->pName; ?></h2>
                    <p><?php echo word_limiter($single_new_product->pDescription, 10) ?></p>
                    <p><span class="price"><?php echo $this->cart->format_number($single_new_product->pPrice); ?> F CFA</span></p>
                    <div class="button"><span><a href="<?php echo base_url('single/' . $single_feature_product->pId); ?>" class="details">Details</a></span></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>