<?php
class UsersController extends AppController {

	public $name = 'Users';

	public function beforeFilter()
	{
		parent::beforeFilter();
		// You'll want to remove 'add' from this.
		$this->Auth->allow('login', 'logout', 'register', 'verify');
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


	/**
	 *	register
	 *
	 *	Register a new user.
	 *
	 **/
	public function register()
	{
		$this->set('title_for_layout', __('New user sign up'));

		if ( !empty($this->request->data) )
		{
			$chars = strtoupper(sha1(uniqid(mt_rand(), true)));

            $this->request->data['User']['last_login_at'] = date('Y-m-d H:i:s');
			$this->request->data['User']['ip_addr'] = $_SERVER['REMOTE_ADDR'];
			$this->request->data['User']['perishable_token'] = sha1($this->request->data['User']['email'] . time() . rand(0, 100));
			$this->request->data['User']['username'] = strtolower(current(explode('@',Sanitize::clean($this->request->data['User']['email']))));

			if ( $this->User->save($this->request->data) )
			{
				$this->set('user', $this->request->data);
				// Send registration E-Mail with authToken
				$email = new CakeEmail();
                $email->to($this->request->data['User']['email']);
                $email->subject('Thank you for registering!');
                $email->from(array('noreply@cybr.us'));
                $email->replyTo(array('noreply@cybr.us'));
                $email->template('register');
                $email->emailFormat('both');
				$email->send();

				$email->viewVars(array('token'=>$this->request->data['User']['perishable_token']));

				$this->setMessage('Registration E-Mail sent.');

				$this->redirect('/users/verify');
			}
			else
			{
				$this->setMessage('Please correct the errors below.', 'error');
			}
		}

		$this->request->data['User']['password'] = null;
		$this->User->data['User']['password'] = null;
	}
	// END register


	/**
	 *
	 *	verify
	 *
	 *	Verify new user's email address via token.
	 *
	 **/
	public function verify()
	{
		$this->set('title_for_layout', __('User Verification'));
        if ( isset($this->params['url']['t']) )
		{
            $this->request->data['User']['perishable_token'] = $this->params['url']['t'];
        }

        if ( !empty($this->request->data) )
		{
            $user = $this->User->find('first',array('User.perishable_token' => $this->request->data['User']['perishable_token']));

			if ( !empty($user) )
			{
                $user['User']['perishable_token'] = null;

                if ( $this->User->save($user, false) )
				{
					//$this->User->save(array('id' => $this->User->id, 'perishable_token' => null), false);
                    $this->setMessage('Your account has been verified!');
					$this->Auth->login($user);
                    $this->redirect('/');
                }
				else
				{
                    $this->setMessage('Failed to verify user account', 'error');
                }
            }
			else
			{
                $this->setMessage('Could not find a valid user for that token.', 'error');
            }
        }
	}
	// END verify


}
