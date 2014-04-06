<?php
App::uses('AppController', 'Controller');
class NotificationsControllerTest extends ControllerTestCase {
    public $dropTables = false;
    /**
    * @covers NotificationsController::index
    *
    */
    public function testIndex() {
        $result = $this->testAction('/notifications/index', array(
            'method' => 'GET',
            'return' => 'contents'));
        $this->assertRegExp('/<html/', $this->contents);
    }
    
    /**
    * @covers NotificationsController::notified
    *
    */
    public function testNotified() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        //TEST GOOD RESPONSE
        $result = $this->testAction('/notifications/notified/1');
        $result = json_decode($result, true);
        $expected = array(
            'response' => 'success',
            'data' => '1'
        );
        $this->assertEquals($expected, $result);

        unset($_ENV['HTTP_X_REQUESTED_WITH']);

        //TEST NON-AJAX
        $result = $this->testAction('/notifications/notified/1');
        $result = json_decode($result, true);
        $expected = array(
            'response' => 'failed',
            'data' => '1'
        );
        $this->assertEquals($expected, $result);
    }

    /**
    * @covers NotificationsController::notified
    * @expectedException NotFoundException
    *
    */
    public function testNotifiedBadInput() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $this->testAction('/notifications/notified/abcd');
        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }

    /**
    * @covers NotificationsController::sendNotifications
    *
    */
    public function testSendNotification() {
        App::import('Controller', 'Notifications');
        $Notifications = new NotificationsController;
        $this->assertTrue($Notifications->sendNotifications("Test", "message", 1, 1, 2));
        $this->assertFalse($Notifications->sendNotifications("Test", "message", null, 1, 2));
        $this->assertFalse($Notifications->sendNotifications("Test", null, 1, 1, 2));
        $this->assertFalse($Notifications->sendNotifications(null, "message", 1, 1, 2));
        $this->assertTrue($Notifications->sendNotifications("Test", "message", 1, null, 2));
        $this->assertTrue($Notifications->sendNotifications("Test", "message", 1, 1, null));
    }
}
?>