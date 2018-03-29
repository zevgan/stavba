<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DetailPlatby]].
 *
 * @see DetailPlatby
 */
class DetailPlatbyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return DetailPlatby[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DetailPlatby|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
