<?php

/**
 * This is the model class for table "tm_projects".
 *
 * The followings are the available columns in table 'tm_projects':
 * @property integer $proj_id
 * @property string $proj_date_start
 * @property string $proj_date_end
 * @property string $proj_name
 * @property string $proj_objective
 * @property integer $proj_stat_id
 * @property integer $proj_user_id
 * @property integer $proj_time_manager
 *
 * The followings are the available model relations:
 * @property TmPhases[] $tmPhases
 * @property TmStatus $projStat
 * @property TmUsers $projUser
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tm_projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('proj_name, proj_stat_id, proj_user_id, proj_time_manager', 'required'),
			array('proj_stat_id, proj_user_id, proj_time_manager', 'numerical', 'integerOnly'=>true),
			array('proj_name', 'length', 'max'=>45),
			array('proj_objective', 'length', 'max'=>100),
			array('proj_date_start, proj_date_end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('proj_id, proj_date_start, proj_date_end, proj_name, proj_objective, proj_stat_id, proj_user_id, proj_time_manager', 'safe', 'on'=>'search'),
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
			'Phase' => array(self::HAS_MANY, 'Phase', 'phas_proj_id'),
			'Status' => array(self::BELONGS_TO, 'Status', 'proj_stat_id'),
			'User' => array(self::BELONGS_TO, 'User', 'proj_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'proj_id' => 'Id',
			'proj_date_start' => 'Date Start',
			'proj_date_end' => 'Date End',
			'proj_name' => 'Project Name',
			'proj_objective' => 'Objective',
			'proj_stat_id' => 'Status',
			'proj_user_id' => 'User',
			'proj_time_manager' => 'Time Manager',
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

		$criteria->compare('proj_id',$this->proj_id);
		$criteria->compare('proj_date_start',$this->proj_date_start,true);
		$criteria->compare('proj_date_end',$this->proj_date_end,true);
		$criteria->compare('proj_name',$this->proj_name,true);
		$criteria->compare('proj_objective',$this->proj_objective,true);
		$criteria->compare('proj_stat_id',$this->proj_stat_id);
		$criteria->compare('proj_user_id',$this->proj_user_id);
		$criteria->compare('proj_time_manager',$this->proj_time_manager);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
