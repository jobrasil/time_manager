<?php

/**
 * This is the model class for table "tm_difficulties".
 *
 * The followings are the available columns in table 'tm_difficulties':
 * @property integer $diff_id
 * @property integer $diff_tydi_id
 * @property string $diff_description
 *
 * The followings are the available model relations:
 * @property TmTypeDifficulties $diffTydi
 */
class Difficulty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tm_difficulties';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('diff_tydi_id, diff_description', 'required'),
			array('diff_tydi_id', 'numerical', 'integerOnly'=>true),
			array('diff_description', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('diff_id, diff_tydi_id, diff_description', 'safe', 'on'=>'search'),
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
			'diffTydi' => array(self::BELONGS_TO, 'TmTypeDifficulties', 'diff_tydi_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'diff_id' => 'Diff',
			'diff_tydi_id' => 'Diff Tydi',
			'diff_description' => 'Diff Description',
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

		$criteria->compare('diff_id',$this->diff_id);
		$criteria->compare('diff_tydi_id',$this->diff_tydi_id);
		$criteria->compare('diff_description',$this->diff_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Difficulty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
