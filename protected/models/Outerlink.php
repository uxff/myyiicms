<?php

/**
 * This is the model class for table "{{Outerlink}}".
 *
 * The followings are the available columns in table '{{Outerlink}}':
 * @property string $id
 * @property string $domain
 * @property string $link
 * @property string $name
 * @property string $status
 * @property string $owner
 * @property string $create_time
 */
class Outerlink extends CActiveRecord
{
    CONST STATUS_OK = 1;
    CONST STATUS_OFF = 9;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{outerlink}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain, name', 'length', 'max'=>64),
			array('link', 'length', 'max'=>256),
			array('owner', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, domain, link, name, status, owner, create_time', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('model','outerlink_id'),
			'domain' => Yii::t('model','outerlink_domain'),
			'link' => Yii::t('model','outerlink_link'),
			'name' => Yii::t('model','outerlink_name'),
			'status' => Yii::t('model','outerlink_status'),
			'owner' => Yii::t('model','outerlink_owner'),
			'create_time' => Yii::t('model','create_time'),
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
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('link',$this->link,true);
		
		$criteria->compare('domain',$this->domain,true);

		$criteria->compare('status',$this->status,true);

		$criteria->compare('owner',$this->owner,true);

		$criteria->compare('create_time',$this->create_time,true);


		return new CActiveDataProvider('Menu', array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * 父级分类不能和本分类相同
	 * !CodeTemplates.overridecomment.nonjd!
	 * @see CActiveRecord::beforeSave()
	 */
	public function beforeSave(){
		return true;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
}