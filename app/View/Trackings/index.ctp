<!-- File: /app/View/Tracking/index.ctp -->

<h1>Currently Tracked Ideas</h1>
<?php echo $this->element('idealist', array("ideas" => $trackings)); ?>