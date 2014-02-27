<?php if (count($notifications) > 0) { ?>
    <?php foreach ($notifications as $notification): ?>
        <li><a onclick="Ajax.Idea.showIdea(<?= $notification['Notification']['ideaid']; ?>);"><?= $notification['Notification']['message']; ?></a></li>
    <?php endforeach; ?>
    <?php unset($notification); ?>
<?php } else { 
        echo '<li><a>No Notifications</a></li>';
    }
?>
