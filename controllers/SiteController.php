<?php

namespace app\controllers;

use app\models\Catalog;
use app\models\CatalogLevel;
use app\models\CatalogPhoto;
use app\models\CatalogPhotoBlur;
use app\models\product\Product;
use app\models\product\ProductParamsLib;
use app\models\ProductsCatalog;
use app\models\RegForm;
use app\models\User;
use app\models\UserBuyLevels;
use app\models\UserRoot;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserBuy;

class SiteController extends appController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $catalog = new Catalog();
        $level = new CatalogLevel();
        $blur = new CatalogPhotoBlur();

        if(isset($_POST['buy-lvl'])){
            $session = Yii::$app->session;
            $buy = new UserBuyLevels();
            $buy->user_id = $session['__id'];
            $buy->level_id = $_GET['lvl'];
            $buy->time = date('Y-m-d H:i:s');
            $buy->save();
        }

        return $this->render('index', ['catalog'=>$catalog, 'level'=>$level, 'blur'=>$blur]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $root = new UserRoot();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $root->checkAdmin();
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionReg()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->registration();
            $model->login();

            return $this->goBack();
        }

        $model->password = '';
        return $this->render('reg', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionAdmin()
    {
        if(!User::isAdmin()){
            $this->goHome();
        }

        return $this->render('admin');
    }


    //католог товаров
    public function actionCatalog(){


        $search = new ProductsCatalog();
        $product = new Product();
        $lib = new ProductParamsLib();
        $buy = new UserBuy();
        $dataProvider = $search->search($this->request->get());

        if(isset($_POST['buy']))
            $buy->addBuy($_POST['buy']);

        return $this->render('catalog', [
            'lib' => $lib,
            'search' => $search,
            'product' => $product,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionBusket(){

        $model = new Product();
        $modelBuy = new UserBuy();

        if(isset($_POST['buy-delete-button']))
            $modelBuy->deleteProductSessionBuy($_POST['buy-delete-button']);

        return $this->render('busket', [
            'model' => $model,
            'modelBuy' => $modelBuy,
        ]);
    }

    public function actionPhotosets(){

        $catalog = new Catalog();
        $level = new CatalogLevel();

        return $this->render('photosets', ['catalog'=>$catalog, 'level' => $level]);
    }

    public function actionPhotosetview(){

        $catalog = new Catalog();
        $level = new CatalogLevel();
        $photo = new CatalogPhoto();

        return $this->render('photosetview', [ 'photo' => $photo ,'catalog'=>$catalog, 'level' => $level]);
    }
}
