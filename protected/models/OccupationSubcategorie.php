<?php

/**
 * This is the model class for table "tm_occupation_subcategories".
 *
 * The followings are the available columns in table 'tm_occupation_subcategories':
 * @property integer $ocsu_id
 * @property integer $ocsu_occa_id
 * @property string $ocsu_description
 *
 * The followings are the available model relations:
 * @property TmOccupation[] $tmOccupations
 * @property TmOccupationCategories $ocsuOcca
 */
class OccupationSubcategorie extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tm_occupation_subcategories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ocsu_occa_id, ocsu_description', 'required'),
			array('ocsu_occa_id', 'numerical', 'integerOnly'=>true),
			array('ocsu_description', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ocsu_id, ocsu_occa_id, ocsu_description', 'safe', 'on'=>'search'),
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
			'tmOccupations' => array(self::HAS_MANY, 'TmOccupation', 'occu_ocsu_id'),
			'ocsuOcca' => array(self::BELONGS_TO, 'TmOccupationCategories', 'ocsu_occa_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ocsu_id' => 'Ocsu',
			'ocsu_occa_id' => 'Ocsu Occa',
			'ocsu_description' => 'Ocsu Description',
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

		$criteria->compare('ocsu_id',$this->ocsu_id);
		$criteria->compare('ocsu_occa_id',$this->ocsu_occa_id);
		$criteria->compare('ocsu_description',$this->ocsu_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OccupationSubcategorie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
