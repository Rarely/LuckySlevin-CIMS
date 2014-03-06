<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package     app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $uses = array('Tracking', 'Notification', 'Category');
    public $helpers = array(
        'Session',
        'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
        'Form' => array('className' => 'BoostCake.BoostCakeForm'),
        'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
        );

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'ideas',
                'action' => 'index'
                ),
            'logoutRedirect' => array(
                'controller' => 'ideas',
                'action' => 'index'
                )
            )
        );

    public function isAuthorized($user) {
    // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
    // Default deny
        return false;
    }

    public function beforeFilter() {
        $this->set('userData', $this->Auth->user());

        $trackings =  $this->Tracking->find('all', array(
            'conditions' => array('Tracking.userid' => $this->Session->read('Auth.User.id'))
        ));
        $trackingIds = array();
        foreach ($trackings as $t) {
            array_push($trackingIds, $t['Idea']['id']);
        }
        $this->set('trackings', $trackingIds);

        $notifications = $this->Notification->find('all', array(
            'conditions' => array('Notification.userid' => $this->Session->read('Auth.User.id'))
        ));
        $this->set('notificationsCount', count($notifications));

        $categories =  $this->Category->find('all');
        $this->set('categories', $categories);
        foreach($categories as $category) {
            if ($category['Category']['name'] == "Current Status") {
                $this->set('StatusCategoryID', $category['Category']['id']);
            }
        }
    }
}
