<?php
mustlogin();
$obj = DB('menu');
if ($uid) {
    $info = $obj->find($uid);
    $picture = $info['picture'];
}
if (isset($_POST['item'])) {
    $valid = 1;
    if ($_FILES['picture']['error'] == 0) {
        if ('image' == substr($_FILES['picture']['type'], 0, strpos($_FILES['picture']['type'], '/'))) {
            if (isset($picture))
                unlink("public/images/$picture");
            $picture = time() . "_Axixa_" . $_FILES['picture']['name'];
            move_uploaded_file($_FILES['picture']['tmp_name'], 'public/images/' . $picture);
        } else {
            $valid = 0;
            $err = "File type is not image type!";
        }
    }
    if ($valid) {
        $info = [
            'item' => $_POST['item'],
            'description' => $_POST['description'],
            'category' => ($_POST['category']) ? implode(',', $_POST['category']) : "",
            'status' => $_POST['status'],
            'picture' => $picture
        ];

        if ($obj->save($info, $uid)) {
            Session::set('gt', "Data " . ($uid ? "Updated" : "Saved") . " Successfully");
            redirect("menu");
        } else {
            $err = "Something Went Worng!";
        }
    }
}
?>
<div class="alert alert-primary h3 text-center">
    Item <?= $uid ? "Edit" : 'Add' ?> Form
</div>
<?php
if (isset($err)) {
?>
    <div class="alert alert-danger"><?= $err; ?></div>
<?php
} ?>
<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="item">Item Name</label>
        <input type="text" class="form-control" placeholder="Enter Item Name" required name="item" id="item" value="<?= $info['item'] ?? '' ?>">
    </div>


    <div class="mb-3">
        <label>Select Category <small>(Hold ctrl button for multiple selection)</small></label>
        <?php $cats = explode(',', $info['category'] ?? ''); ?>
        <select name="category[]" class="form-select" multiple>
            <option value="Starter" <?= (in_array('Starter', $cats)) ? 'selected' : ''; ?>>Starter</option>
            <option value="Main Course" <?= (in_array('Main Course', $cats)) ? 'selected' : ''; ?>>Main Course</option>
            <option value="Fast Food" <?= (in_array('Fast Food', $cats)) ? 'selected' : ''; ?>>Fast Food</option>
            <option value="Dessert" <?= (in_array('Dessert', $cats)) ? 'selected' : ''; ?>>Dessert</option>
            <option value="Sweets" <?= (in_array('Sweets', $cats)) ? 'selected' : ''; ?>>Sweets</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
            <option value="yes">Yes</option>
            <option value="no" <?= (isset($info['status']) && $info['status'] == 'no') ? 'selected' : ''; ?>>No</option>
        </select>
    </div>
    <?php
    if (isset($picture)) {
    ?>

        <div class="mb-3">
            <label for="pic">Uploaded Picture</label>
            <div class="form-control">

                <img src="<?=ROOT.'public/images/'.$picture;?>" height="150px">
            </div>
        </div>
    <?php
    }
    ?>
    <div class="mb-3">
        <label for="pic">Upload Picture</label>
        <input type="file" class="form-control form-control-sm" accept="image/*" name="picture" id="pic">
    </div>
    <div class="mb-3">
        <label for="description">Description</label>
        <textarea class="form-control" rows="5" placeholder="Enter Item Description" name="description" id="description"><?= $info['description'] ?? '' ?></textarea>
    </div>
    <div class="mb-3 text-center">
        <button class="btn btn-success"><?= $uid ? "Update" : 'Save' ?></button>
    </div>
</form>