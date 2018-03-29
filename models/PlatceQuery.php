<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Platce]].
 *
 * @see Platce
 */
class PlatceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Platce[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Platce|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
