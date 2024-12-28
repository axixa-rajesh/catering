<?php
$ddata = DB('menu')->filter(['status' => 'yes']);

$finaldata = [];
$size = 0;
$categories = [];
foreach ($ddata as $info) {
    $cats = explode(',', $info['category']);
    if ($categories) {
        foreach ($cats as $v) {
            if (!in_array($v, $categories)) {
                $categories[] = $v;
            }
        }
    } else {
        $categories = $cats;
    }
}

foreach ($ddata as $info) {
    $cats = explode(',', $info['category']);
    foreach ($cats as $val) {
        if (in_array($val, $categories)) {
            $finaldata[$val][] = $info;
        }
    }
}


?>
<div class="container my-5">
    <h1 class="text-center mb-4 text-primary">Menu</h1>
    <?php foreach ($finaldata as $category => $data) { ?>
        <h3 class=" mb-4 text-warning"><?=$category;?></h3>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <!-- Product 1 -->
            <?php
            $index = 0;
            foreach ($data as $info) { ?>
                <div class="col">
                    <div class="product-card p-3">
                        <img src="<?= ROOT . "public/images/" . (($info['picture']) ? $info['picture'] : "notfound.jpg"); ?>" alt="Product 1" class="product-image img-fluid">
                        <h5 class="product-title mt-3"><?= $info['item']; ?></h5>
                        <!-- <p class="product-price">₹49.99</p> -->
                        <p class="product-description"><?= $info['description']; ?></p>
                        <!-- <a href="#" class="btn btn-primary w-100">Buy Now</a> -->
                    </div>
                </div>
            <?php } ?>

            <!-- Add more products here -->
        </div>
        <hr>
    <?php } ?>
</div>