<div class="row well well-top-margin">
<h1> Idea information </h1>
<pre>
<b>Name:</b> <?php echo $idea['Idea']['name'];?> 
<b>Description:</b> <?php echo $idea['Idea']['description'];?>
<br />
<b>Timeframe:</b>
    <b>Project start date:</b> <?php echo $idea['Idea']['start_date'];?>
    <br />
    <b>Project end date:</b> <?php echo $idea['Idea']['end_date'];?>
    <br />
<b>Community partner:</b> <?php echo $idea['Idea']['community_partner'];?>
<br />
<b>Contact information:</b>
<?php echo $idea['Idea']['contact_name'];?>
<br />
<?php echo $idea['Idea']['contact_email'];?>
<br />
<?php echo $idea['Idea']['contact_phone'];?>
</pre> 
</div>