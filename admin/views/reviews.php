<?php
$model = new Review();

if ($action === 'add' || $action === 'edit') {
    $item = $id > 0 ? $model->findById($id) : null;
?>
<div class="top-bar">
    <h1><?= $item ? 'Edit' : 'Add' ?> Review</h1>
    <a href="/admin/?page=reviews" class="btn btn-outline">Back to List</a>
</div>
<div class="card">
    <form method="POST" action="/admin/?page=reviews&action=save&id=<?= $id ?>">
        <div class="form-row">
            <div class="form-group">
                <label>Page Type</label>
                <select name="page_type">
                    <option value="home" <?= ($item['page_type'] ?? '') === 'home' ? 'selected' : '' ?>>Home</option>
                    <option value="service" <?= ($item['page_type'] ?? '') === 'service' ? 'selected' : '' ?>>Service</option>
                    <option value="location" <?= ($item['page_type'] ?? '') === 'location' ? 'selected' : '' ?>>Location</option>
                    <option value="brand" <?= ($item['page_type'] ?? '') === 'brand' ? 'selected' : '' ?>>Brand</option>
                </select>
            </div>
            <div class="form-group">
                <label>Page ID (0 for home)</label>
                <input type="number" name="page_id" value="<?= $item['page_id'] ?? 0 ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Reviewer Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($item['name'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="<?= htmlspecialchars($item['location'] ?? '') ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Rating (1-5)</label>
                <select name="rating">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <option value="<?= $i ?>" <?= ($item['rating'] ?? 5) == $i ? 'selected' : '' ?>><?= $i ?> Stars</option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" value="<?= $item['date'] ?? date('Y-m-d') ?>">
            </div>
        </div>
        <div class="form-group">
            <label>Review Text</label>
            <textarea name="text" rows="4" required><?= htmlspecialchars($item['text'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="active" <?= ($item['active'] ?? 1) ? 'checked' : '' ?>> Active</label>
        </div>
        <button type="submit" class="btn btn-primary">Save Review</button>
    </form>
</div>
<?php } else {
    $items = $model->findAll('id DESC');
?>
<div class="top-bar">
    <h1>Reviews (<?= count($items) ?>)</h1>
    <a href="/admin/?page=reviews&action=add" class="btn btn-primary">Add Review</a>
</div>
<table class="table">
    <tr><th>Name</th><th>Type</th><th>Rating</th><th>Location</th><th>Active</th><th>Actions</th></tr>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><?= htmlspecialchars($item['page_type']) ?> #<?= $item['page_id'] ?></td>
            <td><?= str_repeat('&#11088;', $item['rating']) ?></td>
            <td><?= htmlspecialchars($item['location']) ?></td>
            <td><span class="toggle <?= $item['active'] ? 'on' : 'off' ?>"></span></td>
            <td class="actions">
                <a href="/admin/?page=reviews&action=edit&id=<?= $item['id'] ?>" class="btn btn-sm btn-outline">Edit</a>
                <form method="POST" action="/admin/?page=reviews&action=delete&id=<?= $item['id'] ?>" style="display:inline" onsubmit="return confirm('Delete?')">
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php } ?>
