<?php
$model = new Brand();

if ($action === 'add' || $action === 'edit') {
    $item = $id > 0 ? $model->findById($id) : null;
?>
<div class="top-bar">
    <h1><?= $item ? 'Edit' : 'Add' ?> Car Brand</h1>
    <a href="/admin/?page=brands" class="btn btn-outline">Back to List</a>
</div>
<div class="card">
    <form method="POST" action="/admin/?page=brands&action=save&id=<?= $id ?>">
        <div class="form-row">
            <div class="form-group">
                <label>Brand Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($item['name'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" value="<?= htmlspecialchars($item['slug'] ?? '') ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Meta Title</label>
                <input type="text" name="meta_title" value="<?= htmlspecialchars($item['meta_title'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Meta Description</label>
                <input type="text" name="meta_description" value="<?= htmlspecialchars($item['meta_description'] ?? '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label>H1 Heading</label>
            <input type="text" name="h1" value="<?= htmlspecialchars($item['h1'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Intro</label>
            <textarea name="intro" rows="3"><?= htmlspecialchars($item['intro'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label>Content (HTML)</label>
            <textarea name="content" rows="12"><?= htmlspecialchars($item['content'] ?? '') ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="<?= $item['sort_order'] ?? 0 ?>">
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="active" <?= ($item['active'] ?? 1) ? 'checked' : '' ?>> Active</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save Brand</button>
    </form>
</div>
<?php } else {
    $items = $model->findAll('name ASC');
?>
<div class="top-bar">
    <h1>Car Brands (<?= count($items) ?>)</h1>
    <a href="/admin/?page=brands&action=add" class="btn btn-primary">Add Brand</a>
</div>
<table class="table">
    <tr><th>Name</th><th>Slug</th><th>Active</th><th>Actions</th></tr>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td>/auto-locksmith-<?= htmlspecialchars($item['slug']) ?></td>
            <td><span class="toggle <?= $item['active'] ? 'on' : 'off' ?>"></span></td>
            <td class="actions">
                <a href="/admin/?page=brands&action=edit&id=<?= $item['id'] ?>" class="btn btn-sm btn-outline">Edit</a>
                <a href="/auto-locksmith-<?= htmlspecialchars($item['slug']) ?>" target="_blank" class="btn btn-sm btn-outline">View</a>
                <form method="POST" action="/admin/?page=brands&action=delete&id=<?= $item['id'] ?>" style="display:inline" onsubmit="return confirm('Delete?')">
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php } ?>
