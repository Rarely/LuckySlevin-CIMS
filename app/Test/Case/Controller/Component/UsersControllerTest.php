<?php
App::uses('UsersController', 'Controller');
App::uses('User', 'Model');
App::uses('Ticket', 'Model');


/**
* UsersController Test Case
*
*/
class UsersControllerTest extends ControllerTestCase {


 	/*
	 *
	 *@covers UsersController::index
	 *
	 */
	public function testIndex() {
	    $this->testAction('/users/index',
		array(
		'method' => 'GET',
		'return' => 'contents'));
		$this->assertContains('html', $this->contents);
	}



	/*
	* Setting up UserController accessor's
	*
	*/
	public function setup(){
		$this->User = ClassRegistry::init('user');
		$this->Ticket = ClassRegistry::init('ticket');
	}

	/*
	 *
	 *@covers UsersController::memberslist
	 *
	 */
	 public function testMemberslist() {
       $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

       $result = $this->testAction('/users/memberslist/');
       $result = json_decode($result, true);
       $expected = array(
       		array(
       			'id' => '1',
       			'text' => 'Admin(admin@cims.com)',
				'name' => 'Admin',
				'email' => 'admin@cims.com')
       		,
       		array(
				'name' => 'Jill',
				'id' => '2',
				'text' => 'Jill(jill@cims.com)',
				'email' => 'jill@cims.com')
       		,
       		array(
       			 'id' => '3',
		         'text' => 'Heather(heather@cims.com)',
                 'name' => 'Heather',
                 'email' => 'heather@cims.com')
       		,
       		array(
       			 'id' => '4',
		        'text' => 'Justin(justin@cims.com)',
		       'name' => 'Justin',
		      'email' => 'justin@cims.com')
       		,
       		array(
       			'id' => '9',
		      'text' => 'New User(new@cims.com)',
     			'name' => 'New User',
		        'email' => 'new@cims.com')
       		,
       		array(
       			'id' => '10',
       	 		'text' => 'New Admin(newAdmin@cims.com)',
       	 		'name' => 'New Admin',
       			'email' => 'newAdmin@cims.com')
       		,
       		array(
       		  'id' => '14',
			 'text' => 'Cody(cody@cims.com)',
			  'name' => 'Cody',
			'email' => 'cody@cims.com')
       		,
       		array(
       			 'id' => '15',
	      'text' => 'Raghev(raghev@cims.com)',
	       'name' => 'Raghev',
	      'email' => 'raghev@cims.com')
       	        
           );
	//	debug($result);
	//	debug($expected);
       $this->assertEquals($expected, $result);

       unset($_ENV['HTTP_X_REQUESTED_WITH']);
   }

	/*
	 *
	 *@covers UsersController::add
	 *
	 */
     public function testadd(){
     	 $data = array(
    		'User' => array(
    			'name' => 'Ted',
    			'username' => 'ted@cims.com',
    			'role' => 'standard'
    			)
    		);

      $result = $this->testAction('/users/add', array('data' => $data, 'method', 'post'));
      $newuser = $this->User->findByUsername('ted@cims.com');
      $this->assertEquals($newuser['user']['name'], 'Ted');
    }

    /*
	 *
	 *@covers UsersController::testedit
	 *@depends testadd 
	 *
	 */
     public function testedit(){
    	  $data = array(
    		'User' => array(
    			'name' => 'Teddy',
    			'username' => 'cody@cims.com',
    			'role' => 'standard',
    			'id' => '14'
    			)
    		);

      $result = $this->testAction('/users/edit/14', array('data' => $data, 'method', 'post'));
      $newuser = $this->User->findByUsername('cody@cims.com');
      $this->assertEquals($newuser['user']['name'], 'Teddy');

    }


	/*
	 *
	 *@covers UsersController::delete
	 *@depends testedit
	 *
	 */
	 public function testdelete(){
		$result = $this->testAction('/users/delete/1');
          $result = json_decode($result, true);
          $expected = array(
              'response' => 'success',
              'data' => array(
              	'userid' => '1'
          		)
          );
          $this->assertEquals($expected, $result);
	}
	

	/*
	 *
	 *@covers UsersController::activateDeletedUser
	 *
	 */
   	 public function testactivateDeletedUser(){
		  $data = array(
    		'User' => array(
    			'name' => 'Admin',
    			'username' => 'admin@cims.com',
    			'role' => 'admin'
    			)
    		);
      $result = $this->testAction('/users/add', array('data' => $data, 'method', 'post'));
      $newuser = $this->User->findByUsername('admin@cims.com');
      $this->assertEquals($newuser['user']['name'], 'Admin');

    }


    /*
	 *
	 *@covers UsersController::login
	 *
	 */
	 public function testLogin() {
   		 $data = array('User' => array(
            'username' => 'admin@cims.com',
            'password' => '123'
            )
        );
   		 $this->Users = $this->generate('Users', array());
   		 $result = $this->testAction('/users/login', array('data' => $data, 'method' => 'post'));

    	$this->assertEquals($data['User']['username'],$this->Users->Session->read('Auth.User.username'));
    	$result = $this->testAction('/users/logout');
	}
	

	/*
	 *
	 *@covers UsersController::resetpassword
	 *
	 *
	 */
	 public function testresetpassword(){
		  $data = array(
				'User' => array(
					'email' => 'raghev@cims.com'
					));
		  $this->testAction('/users/resetpassword', array('data' => $data, 'method', 'post'));
		  $result = $this->Ticket->find('all', array('order' => 'created DESC'));
		  //debug($result);
		  $this->assertEquals($result[0]['ticket']['data'], 'raghev@cims.com');
	}
}

?>