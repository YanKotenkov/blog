<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 *
 * The followings are the available model relations:
 * @property Post $post
 */
class Comment extends CActiveRecord
{
    /** Id ожидающего комментария */
    const STATUS_PENDING = 1;
    /** Id одобренного комментария */
    const STATUS_APPROVED = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{comment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['content, author, email','required'],
            ['author, email, url','length','max' => 128],
            ['status','in','range' => [1,2]],
            ['email','email'],
            ['url','url'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'post' => [self::BELONGS_TO,'Post','post_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'content' => 'Comment',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'author' => 'Name',
            'email' => 'Email',
            'url' => 'Website',
            'post_id' => 'Post',
        ];
    }

    /**
     * Approves a comment.
     */
    public function approve()
    {
        $this->status = Comment::STATUS_APPROVED;
        $this->update(['status']);
    }

    /**
     * Post the post that this comment belongs to. If null, the method
     * will query for the post.
     * @param $post mixed
     * @return string the permalink URL for this comment
     */
    public function getUrl($post = null)
    {
        if ($post === null) {
            $post = $this->post;
        }
        return $post->url . '#c' . $this->id;
    }

    /**
     * @return string the hyperlink display for the current comment's author
     */
    public function getAuthorLink()
    {
        if (!empty($this->url)) {
            return CHtml::link(CHtml::encode($this->author), $this->url);
        } else {
            return CHtml::encode($this->author);
        }
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('post_id', $this->post_id);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * @return integer the number of comments that are pending approval
     */
    public function getPendingCommentCount()
    {
        return $this->count('status=' . self::STATUS_PENDING);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Записывает время создания комментария
     * @return bool
     */
    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->create_time = time();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param int $limit
     * @return static[]
     */
    public function findRecentComments($limit = 10)
    {
        return $this->with('post')->findAll([
            'condition' => 't.status=' . self::STATUS_APPROVED,
            'order' => 't.create_time DESC',
            'limit' => $limit,
        ]);
    }
}
