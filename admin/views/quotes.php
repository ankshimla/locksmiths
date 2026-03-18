<?php
$model = new Quote();
$items = $model->getRecent(100);
?>
<div class="top-bar">
    <h1>Leads / Quote Requests (<?= count($items) ?>)</h1>
</div>

<?php if (empty($items)): ?>
    <div class="card"><p>No quote requests yet.</p></div>
<?php else: ?>
<table class="table">
    <tr><th>Date</th><th>Name</th><th>Phone</th><th>Email</th><th>Service</th><th>Location</th><th>Message</th><th>Actions</th></tr>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= $item['created_at'] ?></td>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><a href="tel:<?= htmlspecialchars($item['phone']) ?>"><?= htmlspecialchars($item['phone']) ?></a></td>
            <td><?= htmlspecialchars($item['email']) ?></td>
            <td><?= htmlspecialchars($item['service']) ?></td>
            <td><?= htmlspecialchars($item['location']) ?></td>
            <td><?= htmlspecialchars(substr($item['message'], 0, 60)) ?></td>
            <td>
                <form method="POST" action="/admin/?page=quotes&action=delete&id=<?= $item['id'] ?>" style="display:inline" onsubmit="return confirm('Delete?')">
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
