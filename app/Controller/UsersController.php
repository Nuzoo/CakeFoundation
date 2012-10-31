<?php
class UsersController extends AppController {

	public $name = 'Users';

	public function beforeFilter()
	{
		parent::beforeFilter();
		// You'll want to remove 'add' from this.
		$this->Auth->allow('add', 'login', 'logout');
	}
	// END beforeFilter


	public function add()
	{
		$this->set('title_for_layout', __('Add New Account'));
        if ( $this->request->is('post') )
        {
            $this->User->create();
            if ( $this->User->save($this->request->data) )
            {
                $this->setMessage('User saved','success');
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->setMessage('The user could not be saved. Please, try again.','error');
            }
        }
	}
	// END add


	public function edit($id = null)
	{
		$this->set('title_for_layout', __('Edit User Account'));
        $this->User->id = $id;

        if (!$this->User->exists())
        {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->User->save($this->request->data))
            {
				$this->setMessage('<i class="icon-ok-sign"></i> User saved', 'success');
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->setMessage('The user could not be saved. Please, try again.','error');
            }
        }
        else
        {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }


	public function delete($id=null)
	{
		if ($this->request->is('get'))
		{
			throw new MethodNotAllowedException();
		}

		if ( !empty($id) )
		{
			$this->User->delete($id);
			$this->setMessage('User has been deleted.', 'success');
			$this->redirect(array('action' => 'index'));
		}
		else
		{
			$this->setMessage('Missing User ID', 'error');
		}
	}

	public function index()
	{
		$this->set('title_for_layout', __('User Listing'));
		$this->paginate = array(
			'User' => array(
				'recursive'=>1,
				'order' => array('User.email' => 'ASC'),
				'limit' => MAX_RESULTS
			)
		);

		$this->set('users', $this->paginate());
	}


	public function login()
	{
		$this->set('title_for_layout', 'Login');
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->write('Property.id', $this->Auth->user('property_id'));
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_login_at', date('Y-m-d H:i:s'), false);
				$this->User->saveField('ip_address', $_SERVER['REMOTE_ADDR'], false);
				$this->User->saveField('logins', $this->Auth->user('logins')+1, false);
				$this->redirect($this->Auth->redirect());

			} else {
				$this->setMessage('Invalid username or password, try again','alert');
			}
		}
	}
	// END login


	public function logout()
	{
		$this->set('title_for_layout', 'Logout');
		$this->redirect($this->Auth->logout());
	}
	// END logout

}
