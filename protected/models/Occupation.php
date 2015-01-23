<?php

/**
 * This is the model class for table "tm_occupation".
 *
 * The followings are the available columns in table 'tm_occupation':
 * @property integer $occu_id
 * @property integer $occu_tyoc_id
 * @property integer $occu_acti_id
 * @property integer $occu_ocsu_id
 * @property string $occu_hour
 * @property string $occu_date
 *
 * The followings are the available model relations:
 * @property TmTypeOccupation $occuTyoc
 * @property TmActivities $occuActi
 * @property TmOccupationSubcategories $occuOcsu
 */
class Occupation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tm_occupation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('occu_tyoc_id, occu_hour, occu_date', 'required'),
			array('occu_tyoc_id, occu_acti_id, occu_ocsu_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('occu_id, occu_tyoc_id, occu_acti_id, occu_ocsu_id, occu_hour, occu_date', 'safe', 'on'=>'search'),
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
			'occuTyoc' => array(self::BELONGS_TO, 'TmTypeOccupation', 'occu_tyoc_id'),
			'occuActi' => array(self::BELONGS_TO, 'TmActivities', 'occu_acti_id'),
			'occuOcsu' => array(self::BELONGS_TO, 'TmOccupationSubcategories', 'occu_ocsu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'occu_id' => 'Occu',
			'occu_tyoc_id' => 'Occu Tyoc',
			'occu_acti_id' => 'Occu Acti',
			'occu_ocsu_id' => 'Occu Ocsu',
			'occu_hour' => 'Occu Hour',
			'occu_date' => 'Occu Date',
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

		$criteria->compare('occu_id',$this->occu_id);
		$criteria->compare('occu_tyoc_id',$this->occu_tyoc_id);
		$criteria->compare('occu_acti_id',$this->occu_acti_id);
		$criteria->compare('occu_ocsu_id',$this->occu_ocsu_id);
		$criteria->compare('occu_hour',$this->occu_hour,true);
		$criteria->compare('occu_date',$this->occu_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Occupation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
