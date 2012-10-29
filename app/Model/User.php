<?PHP
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel
{
    public $name = 'User';
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        )
    );

    public $virtualFields = array(
    	'fullname' => 'CONCAT(User.first_name, " ", User.last_name)'
    );


 	public function beforeFind($data)
 	{
		if ( isset($this->data[$this->alias]['password']) )
		{
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return parent::beforeFind($data);
 	}

	public function beforeSave($data)
	{
		if ( isset($this->data[$this->alias]['password']) )
		{
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return parent::beforeSave($data);
	}

}
