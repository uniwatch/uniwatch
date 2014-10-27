<?php
/**
 * Created by PhpStorm.
 * User: macseem
 * Date: 9/30/14
 * Time: 8:46 PM
 */

namespace app\controllers\api;
use Yii;
use yii\rest\Controller;
use app\models\Product;

/**
 * Class CatalogController
 * @package app\controllers\api
 */
class CatalogController extends Controller
{
    public $layout = false;

    public function actionIndex($page = 1, $name = null, $category = null, $priceFrom = null, $priceTo = null)
    {
        $this->layout=false;
        $data = Product::getProducts(
            $page,
            20,
            $category,
            $name,
            $priceFrom,
            $priceTo
        );
        return $this->renderFile('@app/views/catalog/list.php',['items'=>$data,'wrapper' => false]);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['rateLimiter']);
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
     /*       'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],*/
        ];
    }
} 