<?php

namespace app\controllers;

use common\models\Enterprise;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class EnterpriseController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render(
            'index',
            [
                'dataProvider' => new ActiveDataProvider(
                    [
                        'query' => Enterprise::find(),
                    ]
                ),
            ]
        );
    }

    public function actionCreate()
    {
        $model = new Enterprise();

        if ($model->load(\Yii::$app->request->post()) && $model->save()){
            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }
}