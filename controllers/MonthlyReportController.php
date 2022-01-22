<?php

namespace app\controllers;

use common\models\MonthlyReport;
use yii\web\Controller;

class MonthlyReportController extends Controller
{
    /**
     * @return string|\yii\web\Response
     *
     * Можно сделать еще редактирование отчета, на будущее
     */
    public function actionCreate()
    {
        $model = new MonthlyReport();

        if ($model->load(\Yii::$app->request->post()) && $model->save()){
            return $this->redirect('/reports/monthly');
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }
}