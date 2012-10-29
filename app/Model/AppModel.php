<?PHP
App::uses('Model', 'Model');
App::uses('CakeTime', 'Utility');
class AppModel extends Model
{
    public static $currentUser = null;
    public static $currentProperty = null;
    public static $controller = null;
    public static $action = null;
    public $cacheQueries = true;
    public $assocs = array();
    public $paranoid = true;
   	public $recursive = -1;
	public $actsAs = array('Containable');

	/**
	 *
	 *	beforeDelete
	 *
	 *	Lets be paranoid and not actually allow data to be deleted.
	 *	Just set the deleted field to the date item was deleted.
	 *
	 *	@param <Boolean> $cascade
	 *
	 **/
	function beforeDelete($cascade)
	{
		if ( $this->paranoid )
		{
			parent::save(array($this->alias=>array('id'=>$this->id, 'deleted'=>date('Y-m-d H:i:s'))), false);
			return false; // <- CakePHP really has some issues with doing things like this.
		}

		return true;
	}
	// END beforeDelete


	/**
	 *
	 *	beforeFind
	 *
	 *	In addition to setting deleted date we also need to be sure they never show up
	 *	afterward
	 *
	 *	@param <Array>
	 *	@return <Boolean>
	 *
	 **/
	public function beforeFind($data)
	{
		// This allows us to override the model's paranoid flag in our find() statements.
		if ( isset($data['paranoid']) && ($data['paranoid'] === false) )
		{
			return $data;
		}
		else
		{
			if ( $this->paranoid && $this->useTable !== false)
			{
				$data['conditions'][] = $this->alias . '.deleted IS NULL';
			}
		}

		return $data;
	}
	// END beforeFind
}
