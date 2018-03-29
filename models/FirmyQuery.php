<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Firmy]].
 *
 * @see Firmy
 */
class FirmyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Firmy[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Firmy|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
