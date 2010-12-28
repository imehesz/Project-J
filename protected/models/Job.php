<?php

/**
 * This is the model class for table "tbl_jobs".
 *
 * The followings are the available columns in table 'tbl_jobs':
 * @property integer $id
 * @property integer $user_id
 * @property string $company
 * @property string $company_link
 * @property string $contact_email
 * @property integer $status
 * @property string $logo
 * @property integer $confidential
 * @property integer $featured
 * @property string $location
 * @property string $job_type
 * @property string $php_type
 * @property string $package_type
 * @property string $position
 * @property string $description
 * @property integer $created_at
 * @property integer $expires_at
 */
class Job extends CActiveRecord
{
    const INHOUSE   = 'IH';
    const FULLTIME  = 'FT';
    const PARTTIME  = 'PT';
    const REMOTE    = 'RM';
    const FREELANCE = 'FL';
    const CONTRACT  = 'CO';

	const PACKAGE1  = 1;
	const PACKAGE7 	= 7;
	const PACKAGE14 = 14;
	const PACKAGE30 = 30;
	const PACKAGEFEAT = 'FEAT';

	/**
	 * Returns the static model of the specified AR class.
	 * @return Job the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_jobs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company, contact_email, position', 'required'),
			array('contact_email', 'email' ),
			array('user_id, status, confidential, featured, created_at, expires_at', 'numerical', 'integerOnly'=>true),
			array('company, contact_email, logo', 'length', 'max'=>100),
			array('company_link, location, job_type', 'length', 'max'=>255),
			array('description', 'length', 'max'=>10000),
			array('php_type', 'length', 'max'=>20),
			array('package_type', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, company, company_link, contact_email, status, logo, confidential, featured, location, job_type, php_type, created_at, expires_at, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'user_id' => 'User',
			'company' => 'Company',
			'company_link' => 'Company Link',
			'contact_email' => 'Contact Email',
			'status' => 'Status',
			'logo' => 'Logo',
			'confidential' => 'Confidential',
			'featured' => 'Featured',
			'location' => 'Location',
			'job_type' => 'Job Type',
			'php_type' => 'Php Type',
			'created_at' => 'Created At',
			'expires_at' => 'Expires At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('company',$this->company,true);

		$criteria->compare('company_link',$this->company_link,true);

		$criteria->compare('contact_email',$this->contact_email,true);

		$criteria->compare('status',$this->status);

		$criteria->compare('logo',$this->logo,true);

		$criteria->compare('confidential',$this->confidential);

		$criteria->compare('featured',$this->featured);

		$criteria->compare('location',$this->location,true);

		$criteria->compare('job_type',$this->job_type,true);

		$criteria->compare('php_type',$this->php_type,true);

		$criteria->compare('created_at',$this->created_at);

		$criteria->compare('expires_at',$this->expires_at);

		return new CActiveDataProvider('Job', array(
			'criteria'=>$criteria,
		));
	}

    public function scopes()
    {
        return array(
            /**
             * a job only considered active if the 
             * status is 1 and the expires_at timestamp is larger
             * than the current timestamp
             */
            'active'    => array( 
                            'condition' => 'status=1 AND expires_at>' . time(),
                            'order'     => 'featured DESC, created_at DESC'
                           )
        );
    }

    /**
     * return all the jobs that have a specific PHP-typ
     *
     * @param $type string
     *
     * @return object DbCriteria
     */
    public function phptype( $type )
    {
        if( $type  )
        {
            $this->getDbCriteria()->mergeWith( array(
                'condition' => 'php_type="' . $type . '"'
            ) );
        }

        return $this;
    }

    /**
     * returns all the jobs that have a specific job-type or job-types
     *
     * @param $type string|array
     *
     * @return object DbCriteria
     */
    public function jobtype( $type = null )
    {
        if( $type )
        {
            if( is_array( $type ) )
            {
				$t = '';

                for( $i=0; $i<sizeof($type);$i++ )
                {
                    $t .= 'job_type LIKE ("%' .$type[$i]. '%") AND ';
                }

                $this->getDbCriteria()->mergeWith(
                    array(
                        'condition' => $t . ' 1==1'
                    )
                );
            }
            else
            {
                $this->getDbCriteria()->mergeWith(
                    array(
                        'condition' => 'job_type LIKE ("%' . $type  . '%")'
                    )
                );
            }
        }

        return $this;
    }

	public function beforeValidate()
	{
		if( $this->isNewRecord )
		{
			$this->setAttribute( 'created_at', time() );
		}

		return parent::beforeValidate();		
	}

	public function afterValidate()
	{
		parent::afterValidate();

		// let's find the user ...
		$user_obj = User::model()->findByAttributes( array( 'email' => $this->contact_email ) );
		if( ! $user_obj )
		{
			$user_obj = new User;
			$user_obj->email 	= 'aaa@aaa.com';
			$user_obj->username = 'aaaaaa' . time();
			$user_obj->password = time();
			$user_obj->activkey = 1;
			$user_obj->status 	= 1;
			$user_obj->save();
		}

		$this->user_id = $user_obj->id;
	}
}
