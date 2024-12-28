<?php $info = (DB('menu')->find($_GET['id'], 'item,price,unit')); ?>
<label for="price" class="form-label">Price</label>
<div class="input-group">
    <input type="number" id="price<?= $_GET['eleno'] ?>" class="form-control" readonly value="<?= $info['price'] ?>" placeholder="Price" min="1" name="price_per_unit[]" required>
    <div class="input-group-append">
        <span class="input-group-text"><?= $info['unit']; ?></span>
        <input type="hidden" name="itemname[]" value="<?php echo $info['item']; ?>">
    </div>
</div>