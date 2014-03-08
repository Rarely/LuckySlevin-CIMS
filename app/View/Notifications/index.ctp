<?php if (count($notifications) > 0) { ?>
    <?php foreach ($notifications as $notification): ?>
        <?php $id = $notification['Notification']['id'] ?>
        <?php $ideaid = $notification['Notification']['ideaid'] ?>
        <?php $isread = $notification['Notification']['isread'] ?>
        <a href="#" class="list-group-item <?php if ($isread == 0) echo 'active' ?>" onclick="Ajax.Notifications.setNotified(this, <?php echo $id ?>); Ajax.Idea.showIdea(<?php echo $ideaid ?>);">
            <h5 class="list-group-item-heading"><?php echo $notification['Notification']['title'] ?></h5>
            <p class="list-group-item-text"><?php echo $notification['Notification']['message'] ?></p>
        </a>
    <?php endforeach; ?>
    <?php unset($notification); ?>
<?php } else { 
        echo '<a class="list-group-item">No Notifications</a>';
    }
?>
