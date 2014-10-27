<?php
/**
 * @author macseem
 * @email lugamax@gmail.com
 * @date 29/09/2014 21:05
 */

namespace app\commands;

use app\models\Product;
use yii\base\Exception;
use yii\console\Controller;
use yii\web\XmlResponseFormatter;
use app\models\Category;
/**
 * Parse xml file. Usage: parse-xml-feed </path/to/file>
 * @author macseem <lugamax@gmail.com>
 */
class ParseXmlFeedController extends Controller
{

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex($path = null)
    {
        $xml = $this->getData($path);
        echo $path . " ". file_exists($path)."\n";
    }

    private function getData($file)
    {
        if(is_null($file)) {
            $file = __DIR__ . '/../xml-feed.xml';
        }
        try {
            if(!file_exists($file)) {
                throw new Exception("No such file or permission denied. '$file'\n", 500);
            }
        }
        catch(Exception $e) {
            print_r($e->getCode());
            print_r($e->getMessage());
            throw new Exception('Get Data Exception', 500, $e);
        }
        $xml = simplexml_load_file($file);
        /* @var \SimpleXMLElement $categories */
        return $xml;
    }

    public function actionImportCategories($path)
    {
        $xml = $this->getData($path);
        $this->importCategories($xml);
    }

    public function actionImportProducts($path = null)
    {
        $xml = $this->getData($path);
        $this->importProducts($xml);
    }

    private function importCategories(\SimpleXMLElement $xml)
    {
        $categories = $xml->children()->children()->categories->children();
        foreach($categories as $category) {
            $model = new Category();
            /* @var \SimpleXMLElement $category */
            $model->feed_id = $category['id']->__toString();
            $model->name = $category->__toString();
            $model->save();
            unset($model);
        }
        foreach($categories as $category) {
            $model = new Category();
            $cat = $model->findOne(['feed_id' => $category['id']->__toString()]);
            $parentId = $model->findOne(['feed_id' => $category['parentId']->__toString() ]);
            if(! $parentId instanceof Category ) {
                continue;
            }
            $parentId = $parentId->id;
            $cat->parent_id = $parentId;
            $cat->save();
            unset($model);
        }
    }

    private function importProducts(\SimpleXMLElement $xml)
    {
        /* @var \SimpleXMLElement $products */
        $products = $xml->children()->children()->offers->children();
        foreach($products as $product) {
            $model = new Product();
            $model->category_id = Category::findOne([
                'feed_id' => $product->categoryId->__toString()
            ])->getPrimaryKey();
            $model->name = $product->name->__toString();
            $model->url = $product->url->__toString();
            $model->img = $product->picture->__toString();
            $model->desc = $product->description->__toString();
            $model->price = $product->price->__toString();
            $model->currency = 'UAH';
            $model->save();
            sleep(0.1);
            unset($model);
        }
    }
}
