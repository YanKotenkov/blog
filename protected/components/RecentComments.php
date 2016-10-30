<?php

Yii::import('zii.widgets.CPortlet');

class RecentComments extends CPortlet
{
    public $title='Recent Comments';
    public $maxComments = 10;

    /**
     * @return array|static[]
     */
    public function getRecentComments()
    {
        var_dump($this->maxComments);
        return Comment::model()->findRecentComments($this->maxComments);
    }

    protected function renderContent()
    {
        $this->render('recentComments');
    }
}