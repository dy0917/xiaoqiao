<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $messageid
 * @property string $owner
 * @property string $body
 * @property integer $Blogid
 * @property string $createtime
 *
 * The followings are the available model relations:
 * @property Blog $blog
 */
class Message extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Blogid', 'numerical', 'integerOnly'=>true),
			array('owner', 'length', 'max'=>255),
			array('body, createtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('messageid, owner, body, Blogid, createtime', 'safe', 'on'=>'search'),
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
			'blog' => array(self::BELONGS_TO, 'Blog', 'Blogid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'messageid' => 'Messageid',
			'owner' => 'Owner',
			'body' => 'Body',
			'Blogid' => 'Blogid',
			'createtime' => 'Createtime',
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

		$criteria->compare('messageid',$this->messageid);
		$criteria->compare('owner',$this->owner,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('Blogid',$this->Blogid);
		$criteria->compare('createtime',$this->createtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Message the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}