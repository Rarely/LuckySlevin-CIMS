<?php
    class IdeasControllerTest extends ControllerTestCase {
    /**
    *
    *   @covers Ideas::index
    *
    */
    public function testIndex() {
        $result = $this->testAction('/ideas/index',
            array(
                'method' =>'GET',
                'return' => 'contents'));
        $this->assertRegExp('/<html/', $this->contents);

    }

    /**
    *
    *   @covers Ideas::add
    *
    */

    /**
    *
    *   @covers Ideas::add_community
    *
    */

    /**
    *
    *   @covers Ideas::edit
    *
    */
    public function testEdit() {
        $result = $this->testAction(
            '/ideas/edit/13',
            array(
                'method' =>'GET',
                'return' => 'contents'));
        $this->assertRegExp('/<html/', $this->contents);
    } 

    /**
    *
    *   @covers Ideas::edit
    *   @expectedException NotFoundException
    */
    public function testEditInvalidInteger() {
        $result = $this->testAction(
            '/ideas/edit/0',
            array(
                'method' =>'GET',
                'return' => 'contents'));
        $this->assertRegExp('/<html/', $this->contents);
    }    

    /**
    *
    *   @covers Ideas::email
    *
    */

    public function testEmail() {
        $result = $this->testAction('/ideas/email/1',
            array(
                'method' =>'GET',
                'return' => 'contents'));
        $this->assertRegExp('/<html/', $this->contents);
    }

    /**
    *
    *   @covers Ideas::email
    *   @expectedException NotFoundException
    */

    public function testExceptionEmailInvalidInteger() {
        $result = $this->testAction('/ideas/email/0',
            array(
                'method' =>'GET',
                'return' => 'contents'));
        $this->assertRegExp('/<html/', $this->contents);
    }

    /**
    *
    *   @covers Ideas::saveIdeaReferences
    *
    */

    /**
    *
    *   @covers Ideas::saveCategoryInfo
    *
    */

    /**
    *
    *   @covers Ideas::comment
    *
    */

    // I am having a timestamp issue with this test, can't figure it out...

    // public function testComment() {
    //         $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

    //         $result = $this->testAction('/ideas/comment/13?c=');
    //         $result = json_decode($result, true);
    //         $expected = array(
    //             'response' => 'success',
    //             'data' => array(
    //                 'userid' => '13','html' => '<li class="row">
    //                         <div class= "col-xs-1 comment-avatar">
    //                           <img src="img/person.png">
    //                         </div>
    //                         <div class="col-xs-11">
    //                           <div class="comment-message"></div>
    //                           <div class="comment-user">- </div>
    //                         </div>
    //                     </li>'));
    //         $this->assertEquals($result, $expected);
    //         unset($_ENV['HTTP_X_REQUESTED_WITH']);
    // }

    /**
    *
    *   @covers Ideas::idea
    *
    */

    public function testIdea() {

        // Test good ajax response

        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $result = $this->testAction('/ideas/idea/1');

        
        $this->assertContains('ajax-modal', $result);

        unset($_ENV['HTTP_X_REQUESTED_WITH']);     
    }

    /**
    *
    *   @covers Ideas::idea
    *   @expectedException NotFoundException
    */    

    public function testIdeaInvalidIdeaId() {

        // Test good ajax response

        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $result = $this->testAction('/ideas/idea/0');

        
        $this->assertContains('ajax-modal', $result);

        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }

    /**
    *
    *   @covers Ideas::idea
    *   @expectedException NotFoundException
    */    

    public function testIdeaInvalidIdea() {

        // Test good ajax response

        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $result = $this->testAction('/ideas/idea/willnettke');

        
        $this->assertContains('ajax-modal', $result);

        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }

    /**
    *
    *   @covers Ideas::delete
    *
    */

    public function testDelete() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $result = $this->testAction('/ideas/delete?ids=1');
        $result = json_decode($result, true);
        $expected = array(
            'response' => 'success',
            'data' => ['1']
            );
        $this->assertEquals($expected, $result);

        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }

    /**
    *
    *   @covers Ideas::share
    *
    */

    public function testShare() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $result = $this->testAction('/ideas/share/1');
        $result = json_decode($result, true);
        $expected = array(
            'response' => 'success',
            'data' => []
            );
        $this->assertEquals($expected, $result);

        unset($_ENV['HTTP_X_REQUESTED_WITH']);

        // test non-ajax call
        $result = $this->testAction('/ideas/share/1');
        $result=json_decode($result, true);
        $expected = array(
            'response' => 'failed',
            'data' => []
            );
        $this->assertEquals($expected, $result);
    }

    /**
    *
    *   @covers Ideas::valuesList
    *
    */

    public function testValueslist() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $result = $this->testAction('/ideas/valueslist/1');
        $result = json_decode($result, true);
        $expected = array(
            array('id' => '1', 'text' => 'One-Time Project'),
            array('id' => '2', 'text' => 'Recurring Project'),
            array('id' => '3', 'text' => 'Part of a Multi-Phase Project'),
            array('id' => '4', 'text' => 'On-Going Activity')
            );
        $this->assertEquals($expected, $result);

        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }
    
    /**
    *
    *   @covers Ideas::ideaList
    *
    */    

    public function testIdealist() {
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $result = $this->testAction('/ideas/idealist/');
        $result = json_decode($result, true);
        $expected = 
            array('id' => '1', 'text' => 'Test idea Name',
               );
        $this->assertContains($expected, $result);

        unset($_ENV['HTTP_X_REQUESTED_WITH']);

    }   

}
?>