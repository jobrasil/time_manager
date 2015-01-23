<?php

/**
 * This is the model class for table "tm_activities".
 *
 * The followings are the available columns in table 'tm_activities':
 * @property integer $acti_id
 * @property string $acti_description
 * @property integer $acti_phas_id
 * @property string $acti_date_start
 * @property string $acti_date_end
 * @property integer $acti_stat_id
 *
 * The followings are the available model relations:
 * @property TmPhases $actiPhas
 * @property TmStatus $actiStat
 * @property TmOccupation[] $tmOccupations
 */
class Activitie extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tm_activities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('acti_description, acti_phas_id, acti_date_start, acti_stat_id', 'required'),
			array('acti_phas_id, acti_stat_id', 'numerical', 'integerOnly'=>true),
			array('acti_description', 'length', 'max'=>45),
			array('acti_date_end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('acti_id, acti_description, acti_phas_id, acti_date_start, acti_date_end, acti_stat_id', 'safe', 'on'=>'search'),
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
			'actiPhas' => array(self::BELONGS_TO, 'TmPhases', 'acti_phas_id'),
			'actiStat' => array(self::BELONGS_TO, 'TmStatus', 'acti_stat_id'),
			'tmOccupations' => array(self::HAS_MANY, 'TmOccupation', 'occu_acti_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'acti_id' => 'Acti',
			'acti_description' => 'Acti Description',
			'acti_phas_id' => 'Acti Phas',
			'acti_date_start' => 'Acti Date Start',
			'acti_date_end' => 'Acti Date End',
			'acti_stat_id' => 'Acti Stat',
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

		$criteria->compare('acti_id',$this->acti_id);
		$criteria->compare('acti_description',$this->acti_description,true);
		$criteria->compare('acti_phas_id',$this->acti_phas_id);
		$criteria->compare('acti_date_start',$this->acti_date_start,true);
		$criteria->compare('acti_date_end',$this->acti_date_end,true);
		$criteria->compare('acti_stat_id',$this->acti_stat_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Activitie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
