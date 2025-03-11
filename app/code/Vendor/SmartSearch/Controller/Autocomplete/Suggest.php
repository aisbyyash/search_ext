<?php
namespace Vendor\SmartSearch\Controller\Autocomplete;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Helper\Image;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Pricing\Helper\Data as PriceHelper;

class Suggest implements HttpGetActionInterface
{
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ProductCollectionFactory
     */
    private $productCollectionFactory;

    /**
     * @var Image
     */
    private $imageHelper;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var PriceHelper
     */
    private $priceHelper;

    /**
     * Suggest constructor.
     *
     * @param JsonFactory $resultJsonFactory
     * @param RequestInterface $request
     * @param ProductCollectionFactory $productCollectionFactory
     * @param Image $imageHelper
     * @param StoreManagerInterface $storeManager
     * @param PriceHelper $priceHelper
     */
    public function __construct(
        JsonFactory $resultJsonFactory,
        RequestInterface $request,
        ProductCollectionFactory $productCollectionFactory,
        Image $imageHelper,
        StoreManagerInterface $storeManager,
        PriceHelper $priceHelper
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->imageHelper = $imageHelper;
        $this->storeManager = $storeManager;
        $this->priceHelper = $priceHelper;
    }

    /**
     * Execute action
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $query = $this->request->getParam('q', '');
        $result = $this->resultJsonFactory->create();

        // For now, use dummy data instead of actual search
        $response = $this->getDummyResults($query);

        return $result->setData($response);
    }

    /**
     * Get dummy search results for testing
     *
     * @param string $query
     * @return array
     */
    private function getDummyResults($query)
    {
        $query = strtolower($query);
        
        // Simple products based on query match
        $productResults = [];
        $dummyProducts = $this->getDummyProducts();
        
        foreach ($dummyProducts as $product) {
            if (empty($query) || strpos(strtolower($product['name']), $query) !== false) {
                $productResults[] = $product;
            }
            
            // Limit to 5 products
            if (count($productResults) >= 5) {
                break;
            }
        }
        
        // Categories
        $categoryResults = $this->getDummyCategories($query);
        
        // CMS pages
        $cmsResults = $this->getDummyCmsPages($query);
        
        // Popular searches
        $popularSearches = [
            'black dress',
            'summer shoes',
            'yoga pants',
            'phone case',
            'wireless headphones'
        ];
        
        return [
            'query' => $query,
            'products' => $productResults,
            'categories' => $categoryResults,
            'cms' => $cmsResults,
            'popularSearches' => $popularSearches,
            'resultCount' => count($productResults) + count($categoryResults) + count($cmsResults)
        ];
    }
    
    /**
     * Get dummy product data
     *
     * @return array
     */
    private function getDummyProducts()
    {
        $storeUrl = $this->storeManager->getStore()->getBaseUrl();
        
        return [
            [
                'name' => 'Fusion Backpack',
                'sku' => 'MB04',
                'url' => $storeUrl . 'fusion-backpack.html',
                'image' => $storeUrl . 'media/catalog/product/m/b/mb04-black-0.jpg',
                'price' => '$59.99',
                'description' => 'The Fusion Backpack is perfect for the school or work commute, with a dedicated laptop section, plenty of pockets, and room for everything you need.',
                'rating' => 4.5,
                'inStock' => true
            ],
            [
                'name' => 'Yoga Jacket',
                'sku' => 'WJ09',
                'url' => $storeUrl . 'yoga-jacket.html',
                'image' => $storeUrl . 'media/catalog/product/w/j/wj09-green_main.jpg',
                'price' => '$39.00',
                'description' => 'A versatile jacket for your yoga practice or any outdoor activity, with moisture-wicking fabric and a flattering fit.',
                'rating' => 5.0,
                'inStock' => true
            ],
            [
                'name' => 'Sprite Yoga Companion Kit',
                'sku' => 'Kit123',
                'url' => $storeUrl . 'sprite-yoga-companion-kit.html',
                'image' => $storeUrl . 'media/catalog/product/kit-sprite.jpg',
                'price' => '$77.00',
                'description' => 'Everything you need to get started with yoga, including a mat, block, and strap.',
                'rating' => 4.0,
                'inStock' => true
            ],
            [
                'name' => 'Dash Digital Watch',
                'sku' => 'DW123',
                'url' => $storeUrl . 'dash-digital-watch.html',
                'image' => $storeUrl . 'media/catalog/product/dash-watch.jpg',
                'price' => '$92.00',
                'description' => 'A sleek digital watch with all the features you need for tracking your workouts and daily activities.',
                'rating' => 4.2,
                'inStock' => false
            ],
            [
                'name' => 'Endeavor Daytrip Backpack',
                'sku' => 'MB06',
                'url' => $storeUrl . 'endeavor-daytrip-backpack.html',
                'image' => $storeUrl . 'media/catalog/product/m/b/mb06-gray-0.jpg',
                'price' => '$33.00',
                'description' => 'Perfect for day trips and short hikes, with comfortable straps and a durable design.',
                'rating' => 3.8,
                'inStock' => true
            ],
            [
                'name' => 'Crown Summit Backpack',
                'sku' => 'MB01',
                'url' => $storeUrl . 'crown-summit-backpack.html',
                'image' => $storeUrl . 'media/catalog/product/m/b/mb01-blue-0.jpg',
                'price' => '$38.00',
                'description' => 'A sturdy backpack designed for hiking and outdoor adventures.',
                'rating' => 4.1,
                'inStock' => true
            ],
            [
                'name' => 'Wayfarer Messenger Bag',
                'sku' => 'MB02',
                'url' => $storeUrl . 'wayfarer-messenger-bag.html',
                'image' => $storeUrl . 'media/catalog/product/m/b/mb02-gray-0.jpg',
                'price' => '$45.00',
                'description' => 'A versatile messenger bag for work or school.',
                'rating' => 4.7,
                'inStock' => true
            ]
        ];
    }
    
    /**
     * Get dummy category data
     *
     * @param string $query
     * @return array
     */
    private function getDummyCategories($query)
    {
        $storeUrl = $this->storeManager->getStore()->getBaseUrl();
        $categories = [
            [
                'name' => 'Women',
                'url' => $storeUrl . 'women.html',
                'productCount' => 218
            ],
            [
                'name' => 'Men',
                'url' => $storeUrl . 'men.html',
                'productCount' => 156
            ],
            [
                'name' => 'Gear',
                'url' => $storeUrl . 'gear.html',
                'productCount' => 32
            ],
            [
                'name' => 'Fitness Equipment',
                'url' => $storeUrl . 'fitness-equipment.html',
                'productCount' => 22
            ],
            [
                'name' => 'Bags',
                'url' => $storeUrl . 'bags.html',
                'productCount' => 14
            ]
        ];
        
        if (empty($query)) {
            return array_slice($categories, 0, 3);
        }
        
        $result = [];
        foreach ($categories as $category) {
            if (strpos(strtolower($category['name']), strtolower($query)) !== false) {
                $result[] = $category;
            }
            
            if (count($result) >= 3) {
                break;
            }
        }
        
        return $result;
    }
    
    /**
     * Get dummy CMS pages
     *
     * @param string $query
     * @return array
     */
    private function getDummyCmsPages($query)
    {
        $storeUrl = $this->storeManager->getStore()->getBaseUrl();
        $pages = [
            [
                'title' => 'About Us',
                'url' => $storeUrl . 'about-us',
                'type' => 'cms_page'
            ],
            [
                'title' => 'Customer Service',
                'url' => $storeUrl . 'customer-service',
                'type' => 'cms_page'
            ],
            [
                'title' => 'Returns Policy',
                'url' => $storeUrl . 'returns-policy',
                'type' => 'cms_page'
            ],
            [
                'title' => 'Shipping Information',
                'url' => $storeUrl . 'shipping-information',
                'type' => 'cms_page'
            ],
            [
                'title' => 'Privacy Policy',
                'url' => $storeUrl . 'privacy-policy-cookie-restriction-mode',
                'type' => 'cms_page'
            ]
        ];
        
        if (empty($query)) {
            return [];
        }
        
        $result = [];
        foreach ($pages as $page) {
            if (strpos(strtolower($page['title']), strtolower($query)) !== false) {
                $result[] = $page;
            }
            
            if (count($result) >= 2) {
                break;
            }
        }
        
        return $result;
    }
}