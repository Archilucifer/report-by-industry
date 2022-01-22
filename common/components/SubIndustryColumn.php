<?php

namespace common\components;

use common\models\SubIndustry;
use kartik\grid\DataColumn;
use yii\helpers\Html;

class SubIndustryColumn extends DataColumn
{
    /**
     * @inheritdoc
     */
    public function getDataCellValue($model, $key, $index): string
    {
        $industryId = parent::getDataCellValue($model, $key, $index);
        if ($industryId === null) {
            return $this->grid->emptyCell;
        }

        $industry = SubIndustry::findOne(['id' => $industryId]);

        if ($industry === null) {
            return Html::tag('span', Html::encode($industryId));
        }

        return $industry->getName() . ' (' . $industry->getId() . ')';
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index): string
    {
        $industryId = parent::getDataCellValue($model, $key, $index);
        if ($industryId === null) {
            return $this->grid->emptyCell;
        }

        $industry = SubIndustry::findOne(['id' => $industryId]);

        if ($industry === null) {
            return Html::tag('span', Html::encode($industryId));
        }

        return Html::a(
            $industry->getName() . ' (' . $industry->getId() . ')',
            ['/industry/view-sub', 'id' => $industry->getId()]
        );
    }
}