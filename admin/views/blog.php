<?php
$model = new BlogPost();

if ($action === 'add' || $action === 'edit') {
    $item = $id > 0 ? $model->findById($id) : null;
?>
<div class="top-bar">
    <h1><?= $item ? 'Edit' : 'Add' ?> Blog Post</h1>
    <a href="/admin/?page=blog" class="btn btn-outline">Back to List</a>
</div>
<div class="card">
    <form method="POST" action="/admin/?page=blog&action=save&id=<?= $id ?>">
        <div class="form-row">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?= htmlspecialchars($item['title'] ?? '') ?>" required>
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
            <label>Excerpt</label>
            <textarea name="excerpt" rows="2"><?= htmlspecialchars($item['excerpt'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label>Content (HTML)</label>
            <textarea name="content" rows="15"><?= htmlspecialchars($item['content'] ?? '') ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" value="<?= htmlspecialchars($item['author'] ?? 'Locksmiths.ie') ?>">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="draft" <?= ($item['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="published" <?= ($item['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save Post</button>
    </form>
</div>
<?php } else {
    $items = $model->findAll('created_at DESC');
?>
<div class="top-bar">
    <h1>Blog Posts (<?= count($items) ?>)</h1>
    <a href="/admin/?page=blog&action=add" class="btn btn-primary">Add Post</a>
</div>
<table class="table">
    <tr><th>Title</th><th>Status</th><th>Author</th><th>Created</th><th>Actions</th></tr>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['title']) ?></td>
            <td><?= $item['status'] === 'published' ? '<span style="color:#27ae60">Published</span>' : '<span style="color:#888">Draft</span>' ?></td>
            <td><?= htmlspecialchars($item['author']) ?></td>
            <td><?= $item['created_at'] ?></td>
            <td class="actions">
                <a href="/admin/?page=blog&action=edit&id=<?= $item['id'] ?>" class="btn btn-sm btn-outline">Edit</a>
                <?php if ($item['status'] === 'published'): ?>
                    <a href="/blog/<?= htmlspecialchars($item['slug']) ?>" target="_blank" class="btn btn-sm btn-outline">View</a>
                <?php endif; ?>
                <form method="POST" action="/admin/?page=blog&action=delete&id=<?= $item['id'] ?>" style="display:inline" onsubmit="return confirm('Delete?')">
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php } ?>
