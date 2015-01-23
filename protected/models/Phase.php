<?php

/**
 * This is the model class for table "tm_phases".
 *
 * The followings are the available columns in table 'tm_phases':
 * @property integer $phas_id
 * @property string $phas_date_start
 * @property string $phas_date_end
 * @property string $phas_name
 * @property string $phas_description
 * @property integer $phas_proj_id
 * @property integer $phas_end
 * @property integer $phas_stat_id
 *
 * The followings are the available model relations:
 * @property TmActivities[] $tmActivities
 * @property TmProjects $phasProj
 * @property TmStatus $phasStat
 */
class Phase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tm_phases';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('phas_name, phas_proj_id, phas_stat_id', 'required'),
			array('phas_proj_id, phas_end, phas_stat_id', 'numerical', 'integerOnly'=>true),
			array('phas_name', 'length', 'max'=>45),
			array('phas_date_start, phas_date_end, phas_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('phas_id, phas_date_start, phas_date_end, phas_name, phas_description, phas_proj_id, phas_end, phas_stat_id', 'safe', 'on'=>'search'),
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
			'tmActivities' => array(self::HAS_MANY, 'TmActivities', 'acti_phas_id'),
			'phasProj' => array(self::BELONGS_TO, 'TmProjects', 'phas_proj_id'),
			'phasStat' => array(self::BELONGS_TO, 'TmStatus', 'phas_stat_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'phas_id' => 'Phas',
			'phas_date_start' => 'Phas Date Start',
			'phas_date_end' => 'Phas Date End',
			'phas_name' => 'Phas Name',
			'phas_description' => 'Phas Description',
			'phas_proj_id' => 'Phas Proj',
			'phas_end' => 'Phas End',
			'phas_stat_id' => 'Phas Stat',
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

		$criteria->compare('phas_id',$this->phas_id);
		$criteria->compare('phas_date_start',$this->phas_date_start,true);
		$criteria->compare('phas_date_end',$this->phas_date_end,true);
		$criteria->compare('phas_name',$this->phas_name,true);
		$criteria->compare('phas_description',$this->phas_description,true);
		$criteria->compare('phas_proj_id',$this->phas_proj_id);
		$criteria->compare('phas_end',$this->phas_end);
		$criteria->compare('phas_stat_id',$this->phas_stat_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Phase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
