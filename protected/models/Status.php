<?php

/**
 * This is the model class for table "tm_status".
 *
 * The followings are the available columns in table 'tm_status':
 * @property integer $stat_id
 * @property string $stat_description
 *
 * The followings are the available model relations:
 * @property TmActivities[] $tmActivities
 * @property TmPhases[] $tmPhases
 * @property TmProjects[] $tmProjects
 */
class Status extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tm_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stat_description', 'required'),
			array('stat_description', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stat_id, stat_description', 'safe', 'on'=>'search'),
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
			'tmActivities' => array(self::HAS_MANY, 'TmActivities', 'acti_stat_id'),
			'tmPhases' => array(self::HAS_MANY, 'TmPhases', 'phas_stat_id'),
			'tmProjects' => array(self::HAS_MANY, 'TmProjects', 'proj_stat_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stat_id' => 'Stat',
			'stat_description' => 'Stat Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('stat_id',$this->stat_id);
		$criteria->compare('stat_description',$this->stat_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Status the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
