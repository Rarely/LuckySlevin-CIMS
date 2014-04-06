<?php
App::uses('AppController', 'Controller');
class SearchControllerTest extends ControllerTestCase {
    /**
    * @covers SearchController::index
    *
    */
    public function testIndex() {
        $result = $this->testAction('/search', array(
            'method' => 'GET',
            'return' => 'contents'));
        $this->assertRegExp('/<html/', $this->contents);
    }

    /**
    * @covers SearchController::result
    *
    */
    public function testResult() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        //TEST GOOD RESPONSE
        $result = $this->testAction('/search/result?q=John', array(
            'method' => 'GET',
            'return' => 'contents'
        ));

        $this->assertRegExp('/John would like to revisit the/', $this->contents);
        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }

    /**
    * @covers SearchController::export
    *
    */
    public function testExport() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        //TEST No Exceptions
        $this->testAction('/search/export?ids=1,2', array(
            'method' => 'GET',
            'return' => 'vars'
        ));
        // debug($this->vars);
        $this->assertEquals('cims-export.zip', $this->vars['id']);
        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }
}
?>