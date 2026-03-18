<?php
$model = new Faq();

if ($action === 'add' || $action === 'edit') {
    $item = $id > 0 ? $model->findById($id) : null;
?>
<div class="top-bar">
    <h1><?= $item ? 'Edit' : 'Add' ?> FAQ</h1>
    <a href="/admin/?page=faqs" class="btn btn-outline">Back to List</a>
</div>
<div class="card">
    <form method="POST" action="/admin/?page=faqs&action=save&id=<?= $id ?>">
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
        <div class="form-group">
            <label>Question</label>
            <input type="text" name="question" value="<?= htmlspecialchars($item['question'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label>Answer</label>
            <textarea name="answer" rows="4" required><?= htmlspecialchars($item['answer'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label>Sort Order</label>
            <input type="number" name="sort_order" value="<?= $item['sort_order'] ?? 0 ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save FAQ</button>
    </form>
</div>
<?php } else {
    $items = $model->findAll('page_type ASC, page_id ASC, sort_order ASC');
?>
<div class="top-bar">
    <h1>FAQs (<?= count($items) ?>)</h1>
    <a href="/admin/?page=faqs&action=add" class="btn btn-primary">Add FAQ</a>
</div>
<table class="table">
    <tr><th>Question</th><th>Type</th><th>Page ID</th><th>Order</th><th>Actions</th></tr>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars(substr($item['question'], 0, 80)) ?>...</td>
            <td><?= htmlspecialchars($item['page_type']) ?></td>
            <td><?= $item['page_id'] ?></td>
            <td><?= $item['sort_order'] ?></td>
            <td class="actions">
                <a href="/admin/?page=faqs&action=edit&id=<?= $item['id'] ?>" class="btn btn-sm btn-outline">Edit</a>
                <form method="POST" action="/admin/?page=faqs&action=delete&id=<?= $item['id'] ?>" style="display:inline" onsubmit="return confirm('Delete?')">
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php } ?>
