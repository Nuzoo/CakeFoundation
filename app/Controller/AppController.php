<?php
App::uses('Sanitize', 'Utility');
class AppController extends Controller
{
	public $currentUser = null;
	public $currentProperty = null;
	public $controller = null;
	public $action = null;
    public $helpers = array('Time', 'Html', 'Form', 'Session');
    public $uses = array('User');
    public $components = array('Session',
    	'RequestHandler',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email', 'password' => 'password'),
					'scope' => array('User.deleted' => null)
				)
			),
			'loginRedirect' => array('controller' => 'dashboard', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authorize' => array('Controller')
		)
    );


	public function beforeFilter()
	{
		if ( $this->Auth->loggedIn() )
		{
			/**
			 *
			 *	Find current user information and set some global variables for controllers and views.
			 *
			 */
			$this->currentUser = $this->User->find('first', array(
				'recursive'=> 0,
				'conditions' => array('User.id' => $this->Auth->user('id'))
			));

			AppModel::$currentUser = $this->currentUser;
			$this->set('currentUser', $this->currentUser);
			//$this->theme = $this->currentUser['Customer']['theme'];
		}

		$this->controller = $this->params->params['controller'];
		$this->action = $this->params->params['action'];
		$this->set('controller', $this->controller);
		$this->set('action', $this->action);


	}
	// END beforeFilter


    public function isAuthorized($user = null)
    {
    	return empty($user) ? false : true;
    }
    // END isAuthorized


	/**
	 *
	 *	Override CakePHP's Flash Messages.
	 *
	 **/
	public function setMessage($message, $type='')
	{
		$this->Session->setFlash(__($message), 'default', array('class'=>'alert-box ' . $type));
	}
	// END setMessage
}
