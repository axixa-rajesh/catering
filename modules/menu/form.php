<?php
$obj = DB('menu');
if ($uid) {
    $info = $obj->find($uid);
}
if (isset($_POST['item'])) {
    $info = [
        'item' => $_POST['item'],
        'description' => $_POST['description'],
        'category' => ($_POST['category']) ? implode(',', $_POST['category']) : "",
        'status' => $_POST['status']
    ];

    if ($obj->save($info,$uid)) {
        redirect("menu");
    } else {
        echo "Something Went Worng!";
    }
}
?>
<div class="alert alert-primary h3 text-center">
    Item <?= $uid ? "Edit" : 'Add' ?> Form
</div>
<form method="post">
    <div class="mb-3">
        <label for="item">Item Name</label>
        <input type="text" class="form-control" placeholder="Enter Item Name" required name="item" id="item" value="<?= $info['item'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="description">Description</label>
        <textarea class="form-control" rows="10" placeholder="Enter Item Description" name="description" id="description"><?= $info['description'] ?? '' ?></textarea>
    </div>

    <div class="mb-3">
        <label>Select Category <small>(Hold ctrl button for multiple selection)</small></label>
        <?php $cats = explode(',', $info['category']??''); ?>
        <select name="category[]" class="form-select" multiple>
            <option value="Starter" <?= (in_array('Starter',$cats)) ? 'selected' : ''; ?>>Starter</option>
            <option value="Main Course" <?= (in_array('Main Course',$cats)) ? 'selected' : ''; ?> >Main Course</option>
            <option value="Fast Food" <?= (in_array('Fast Food',$cats)) ? 'selected' : ''; ?>>Fast Food</option>
            <option value="Dessert" <?= (in_array('Dessert',$cats)) ? 'selected' : ''; ?>>Dessert</option>
            <option value="Sweets" <?= (in_array('Sweets',$cats)) ? 'selected' : ''; ?>>Sweets</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
            <option value="yes">Yes</option>
            <option value="no" <?= ($info['status'] == 'no') ? 'selected' : ''; ?>>No</option>
        </select>
    </div>
    <div class="mb-3 text-center">
        <button class="btn btn-success"><?= $uid ? "Update" : 'Save' ?></button>
    </div> 
</form>