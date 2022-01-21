<?php

namespace app\controllers;

use common\models\Industry;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class IndustryController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render(
            'index',
            [
                'dataProvider' => new ActiveDataProvider(
                    [
                        'query' => Industry::find(),
                    ]
                ),
            ]
        );
    }
}