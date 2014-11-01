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

    public function actionImportProducts($path = null)
    {
        $xml = $this->getData($path);
        $this->importProducts($xml);
    }

    private function importProducts(\SimpleXMLElement $xml)
    {
        /* @var \SimpleXMLElement $products */
        $products = $xml->children()->children()->offers->children();
        $i=0;
        $productAR = new Product();
        foreach($products as $product) {
            if($i++==45) {
                break;
            }
            $productAR->isNewRecord = true;
            $productAR->id=null;
            $productAR->name = $product->name->__toString();
            $productAR->desc = $product->description->__toString();
            $productAR->img = $product->picture->__toString();
            $productAR->price = $product->price->__toString();
            $productAR->orders = 0;
            $productAR->carts = 0;
            $productAR->views = 0;
            if(!$productAR->save())
                throw new Exception("Can't save product: ".json_encode($product),500);
            sleep(0.1);
        }
    }
}
