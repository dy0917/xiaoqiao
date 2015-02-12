<?php

/**
 * This is the model class for table "Blog".
 *
 * The followings are the available columns in table 'Blog':
 * @property integer $Blogid
 * @property string $title
 * @property integer $BlogType
 * @property string $FeatureIamge
 * @property integer $CreatebyUser
 * @property string $body
 * @property string $createTime
 * @property string $LastUpdateTime
 *
 * The followings are the available model relations:
 * @property User $createbyUser
 */
class Blog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Blog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('BlogType, CreatebyUser', 'numerical', 'integerOnly'=>true),
			array('title, body,FeatureIamge', 'length', 'max'=>65535),
			array('createTime, LastUpdateTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Blogid, title, BlogType, FeatureIamge, CreatebyUser, body, createTime, LastUpdateTime', 'safe', 'on'=>'search'),
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
			'createbyUser' => array(self::BELONGS_TO, 'User', 'CreatebyUser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Blogid' => 'Blogid',
			'title' => 'Title',
			'BlogType' => 'Blog Type',
			'FeatureIamge' => 'Feature Iamge',
			'CreatebyUser' => 'Createby User',
			'body' => 'Body',
			'createTime' => 'Create Time',
			'LastUpdateTime' => 'Last Update Time',
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

		$criteria->compare('Blogid',$this->Blogid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('BlogType',$this->BlogType);
		$criteria->compare('FeatureIamge',$this->FeatureIamge,true);
		$criteria->compare('CreatebyUser',$this->CreatebyUser);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('LastUpdateTime',$this->LastUpdateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Blog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}