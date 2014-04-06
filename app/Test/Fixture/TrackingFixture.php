<?php
class TrackingFixture extends CakeTestFixture {
  // public $import = array('model' => 'Tracking', 'records' => true);
  // Optional.
  // Set this property to load fixtures to a different test datasource
  // public $useDbConfig = 'test';
  public $fields = array(
      'userid' => array(
        'type' => 'integer',
        'length' => 11,
        'null' => false
      ),
      'ideaid' => array(
        'type' => 'integer',
        'length' => 11,
        'null' => false
      )
  );
  public $records = array(
      array(
        'userid' => 1,
        'ideaid' => 1
      ),
      array(
        'userid' => 1,
        'ideaid' => 2
      )
  );
} ?>