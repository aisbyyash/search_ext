<?php
namespace Vendor\SmartSearch\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Vendor\SmartSearch\Model\Config;

class Data extends AbstractHelper
{
    /**
     * @var Config
     */
    private $config;
    
    /**
     * Data constructor.
     *
     * @param Context $context
     * @param Config $config
     */
    public function __construct(
        Context $context,
        Config $config
    ) {
        $this->config = $config;
        parent::__construct($context);
    }
    
    /**
     * Check if the module is enabled
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isEnabled($storeId = null)
    {
        return $this->config->isEnabled($storeId);
    }
    
    /**
     * Get configuration value or default
     *
     * @param string $path
     * @param string $default
     * @param int|null $storeId
     * @return mixed
     */
    public function getConfigValue($path, $default = '', $storeId = null)
    {
        $value = $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
        
        return $value !== null ? $value : $default;
    }
    
    /**
     * Format product data for search results
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @return array
     */
    public function formatProductData($product, $imageHelper, $priceHelper)
    {
        return [
            'name' => $product->getName(),
            'sku' => $product->getSku(),
            'url' => $product->getProductUrl(),
            'image' => $imageHelper->init($product, 'product_thumbnail_image')->getUrl(),
            'price' => $priceHelper->currency($product->getFinalPrice(), true, false),
            'description' => $this->getProductShortDescription($product),
            'rating' => $this->getProductRating($product),
            'inStock' => $product->isAvailable()
        ];
    }
    
    /**
     * Get product short description
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     */
    private function getProductShortDescription($product)
    {
        $shortDescription = $product->getShortDescription();
        if (empty($shortDescription)) {
            $shortDescription = $product->getDescription();
        }
        
        if (empty($shortDescription)) {
            return '';
        }
        
        // Strip HTML tags and truncate
        $shortDescription = strip_tags($shortDescription);
        if (strlen($shortDescription) > 120) {
            $shortDescription = substr($shortDescription, 0, 120) . '...';
        }
        
        return $shortDescription;
    }
    
    /**
     * Get product rating
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return float|null
     */
    private function getProductRating($product)
    {
        // For now we return a random rating for demo purposes
        // In a real implementation, this would pull from review ratings
        return round(mt_rand(30, 50) / 10, 1);
    }
}