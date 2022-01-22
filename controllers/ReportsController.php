<?php

namespace app\controllers;

use common\models\searches\MonthlyReportSearch;
use Yii;
use yii\web\Controller;

class ReportsController extends Controller
{
    public function actionMonthly()
    {
        $searchModel = new MonthlyReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('monthly', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}