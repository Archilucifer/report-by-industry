<?php

namespace app\controllers;

use common\models\Industry;
use common\models\SubIndustry;
use Prophecy\Exception\Doubler\ClassNotFoundException;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
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

    public function actionCreate()
    {
        $model = new Industry();

        if ($model->load(\Yii::$app->request->post()) && $model->save()){
            return $this->redirect('index');
        }

        return $this->render('create', [
           'model' => $model
        ]);
    }

    public function actionCreateSub()
    {
        $model = new SubIndustry();

        if ($model->load(\Yii::$app->request->post()) && $model->save()){
            return $this->redirect('index');
        }

        return $this->render('/sub-industry/create', [
            'model' => $model
        ]);
    }

    public function actionViewSub(int $id)
    {
        $model = SubIndustry::findOne(['id' => $id]);
        if ($model === null) {
            throw new ClassNotFoundException(sprintf('No model by id : %d', $id), SubIndustry::class);
        }

        return $this->render('/sub-industry/view', [
            'model' => $model,
            'mainIndustry' => $model->industries
        ]);
    }
}