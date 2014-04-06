<?php
class TrackingsControllerTest extends ControllerTestCase {
    public $fixtures = array('app.tracking');
    /**
    * @covers Trackings::index
    *
    */
    public function testIndex() {
        $result = $this->testAction('/trackings/index', array(
            'method' => 'GET',
            'return' => 'contents'));
        $this->assertRegExp('/<html/', $this->contents);
    }

    /**
    * @covers Trackings::track
    *
    */
    public function testTrack() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        //TEST GOOD RESPONSE
        $result = $this->testAction('/trackings/track/1');
        $result = json_decode($result, true);
        $expected = array(
            'response' => 'success',
            'data' => '1'
        );
        $this->assertEquals($expected, $result);

        unset($_ENV['HTTP_X_REQUESTED_WITH']);

        //TEST NON-AJAX
        $result = $this->testAction('/trackings/track/1');
        $result = json_decode($result, true);
        $expected = array(
            'response' => 'failed',
            'data' => '1'
        );
        $this->assertEquals($expected, $result);
    }
    
    /**
    * @covers Trackings::track
    * @expectedException NotFoundException
    *
    */
    public function testExceptionTrack() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $this->testAction('/trackings/track/1fdasfds');
        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }

    /**
    * @covers Trackings::untrack
    *
    */
    public function testUntrack() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        //TEST GOOD RESPONSE
        $result = $this->testAction('/trackings/untrack/2');
        $result = json_decode($result, true);
        $expected = array(
            'response' => 'success',
            'data' => '2'
        );
        $this->assertEquals($expected, $result);

        unset($_ENV['HTTP_X_REQUESTED_WITH']);

        //TEST NON-AJAX
        $result = $this->testAction('/trackings/untrack/2');
        $result = json_decode($result, true);
        $expected = array(
            'response' => 'failed',
            'data' => '2'
        );
        $this->assertEquals($expected, $result);
    }

    /**
    * @covers Trackings::untrack
    * @expectedException NotFoundException
    *
    */
    public function testExceptionUntrack() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $this->testAction('/trackings/untrack/1fdasfds');
        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }
}?>