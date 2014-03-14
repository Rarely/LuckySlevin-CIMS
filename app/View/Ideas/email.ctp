<div class="row well well-top-margin">
<h1> Idea information </h1>
<pre>
<b>Name:</b> <?php echo $idea['Idea']['name'];?> 
<b>Description:</b> <?php echo $idea['Idea']['description'];?>
<br />
<b>Project start date:</b> <?php echo $idea['Idea']['start_date'];?>
<br />
<b>Project end date:</b> <?php echo $idea['Idea']['end_date'];?>
<br />
<b>Community partner:</b> <?php echo $idea['Idea']['community_partner'];?>
<br />
<b>Contact name:</b> <?php echo $idea['Idea']['contact_name'];?>
<br />
<b>Contact email:</b> <?php echo $idea['Idea']['contact_email'];?>
<br />
<b>Contact phone:</b> <?php echo $idea['Idea']['contact_phone'];?>
<br />
<b>Category information: </b>
<?php foreach($categories as $cat) { ?>
<b><?php echo $cat['Category']['name'] ?>:</b> <?php foreach($values as $value){ ?><?php if ($value['Value']['categoryid'] == $cat['Category']['id']) { ?><?php echo $value['Value']['name'];?> <br /><?php }?><?php } ?><!-- <br /> -->
<?php } ?>
</pre> 
</div>