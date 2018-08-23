<?php

/**
 * This is the model class for table "tbl_books".
 *
 * The followings are the available columns in table 'tbl_books':
 * @property integer $id
 * @property string $name
 * @property string $longname
 * @property string $annotation
 * @property integer $published_year
 * @property string $book_url
 * @property string $cover_erl
 * @property integer $author_count
 * @property integer $page_count
 * @property string $active
 * @property string $deleted
 *
 *
 * @property  TblAuthors[] $authors
 */
class TblBooks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_books';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, longname', 'required'),
			array('published_year, author_count, page_count', 'numerical', 'integerOnly'=>true),
			array('name, longname, book_url, cover_erl', 'length', 'max'=>255),
			array('active, deleted', 'length', 'max'=>3),
			array('annotation', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, longname, annotation, published_year, book_url, cover_erl, author_count, page_count, active, deleted', 'safe', 'on'=>'search'),
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
            'authors'=>array(self::MANY_MANY, 'TblAuthors',
                'lnk_book_author(book_id, author_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Названия',
			'longname' => 'Полное названия',
			'annotation' => 'Анотация',
			'published_year' => 'Год публикации',
			'book_url' => 'Book Url',
			'cover_erl' => 'Обложка',
			'author_count' => 'Количество авторов',
			'page_count' => 'Количество страниц',
			'active' => 'Active',
			'deleted' => 'Deleted',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('longname',$this->longname,true);
		$criteria->compare('annotation',$this->annotation,true);
		$criteria->compare('published_year',$this->published_year);
		$criteria->compare('book_url',$this->book_url,true);
		$criteria->compare('cover_erl',$this->cover_erl,true);
		$criteria->compare('author_count',$this->author_count);
		$criteria->compare('page_count',$this->page_count);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('deleted',$this->deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    /**
     * @param null|bool $type
     * @return array|null|string
     */
	public function getAuthors($type = null){

	    if(!empty($this->authors)){
	        $authors = [];
            foreach ($this->authors as $author) {
                $authors[] = $author->fullname;
	        }
	        // modifier return type
	        if($type == null)
	            return implode(', ',$authors);
            else
                return $authors;


        } else {
            return null;
        }
    }


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblBooks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


}
