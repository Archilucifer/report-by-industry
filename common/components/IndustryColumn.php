<?php

namespace common\components;

use common\models\Industry;
use kartik\grid\DataColumn;
use yii\helpers\Html;

class IndustryColumn extends DataColumn
{
    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index): string
    {
        $industryId = $this->getDataCellValue($model, $key, $index);
        if ($industryId === null) {
            return $this->grid->emptyCell;
        }

        $industry = Industry::findOne(['id' => $industryId]);

        if ($industry === null) {
            return Html::tag('span', Html::encode($industryId));
        }
        return Html::a(
            $industry->getName() . ' (' . $industry->getId() . ')',
            ['#', 'id' => $industry->getId()]
        );
    }
}