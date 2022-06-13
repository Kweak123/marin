<?php

namespace app\controllers;

use app\models\Catalog;
use app\models\CatalogLevel;
use app\models\CatalogLevelAssoc;
use app\models\CatalogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\CatalogPhotoBlur;


/**
 * CatalogController implements the CRUD actions for Catalog model.
 */
class CatalogController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Catalog models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CatalogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Catalog model.
     * @param int $Id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id),
        ]);
    }

    /**
     * Creates a new Catalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Catalog();
        $blur = new CatalogPhotoBlur();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->photo_directory = $model->label;
                $model->photo_preview = UploadedFile::getInstance($model, 'photo_preview')->name;
                if ($model->validate()) {

                    if (!is_dir("images/{$model->photo_directory}")){
                        mkdir("images/{$model->photo_directory}", 0777);
                    }

                    $model->photo_preview = UploadedFile::getInstance($model, 'photo_preview');
                    $model->photo_preview->saveAs("images/{$model->photo_directory}/{$model->photo_preview->baseName}.{$model->photo_preview->extension}");
                    $model->save(false);

                    $blur->photo = UploadedFile::getInstance($blur, 'photo');
                    $blur->photo->saveAs("images/{$model->photo_directory}/{$blur->photo->baseName}.{$blur->photo->extension}");
                    $blur->catalog_id = $model->Id;
                    $blur->save(false);

                    if (isset($_GET['lvl'])) {
                        $lvl_assoc = new CatalogLevelAssoc();
                        $lvl_assoc->level_id = $_GET['lvl'];
                        $lvl_assoc->catalog_id = $model->Id;
                        $lvl_assoc->save();
                    }
                }
                return $this->redirect(['view', 'Id' => $model->Id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model, 'blur' => $blur,
        ]);
    }

    /**
     * Updates an existing Catalog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id)
    {
        $model = $this->findModel($Id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id' => $model->Id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Catalog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id)
    {
        $this->findModel($Id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Catalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return Catalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id)
    {
        if (($model = Catalog::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
