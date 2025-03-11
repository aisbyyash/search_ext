<?php
namespace Vendor\SmartSearch\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Vendor\SmartSearch\Api\Data\SearchConfigInterface;

class Config implements SearchConfigInterface
{
    /**
     * Config paths
     */
    const XML_PATH_ENABLED = 'smartsearch/general/enabled';
    const XML_PATH_MIN_QUERY_LENGTH = 'smartsearch/general/min_query_length';
    const XML_PATH_MAX_RESULTS = 'smartsearch/general/max_results';
    const XML_PATH_DEBOUNCE_TIME = 'smartsearch/general/debounce_time';
    const XML_PATH_DISPLAY_THUMBNAILS = 'smartsearch/display/display_thumbnails';
    const XML_PATH_DISPLAY_PRICE = 'smartsearch/display/display_price';
    const XML_PATH_DISPLAY_DESCRIPTION = 'smartsearch/display/display_description';
    const XML_PATH_SHOW_POPULAR_SEARCHES = 'smartsearch/display/show_popular_searches';
    const XML_PATH_SHOW_CATEGORY_RESULTS = 'smartsearch/display/show_category_results';
    const XML_PATH_MAX_POPULAR_SEARCHES = 'smartsearch/display/max_popular_searches';
    
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    
    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }
    
    /**
     * Check if the extension is enabled
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isEnabled($storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
    
    /**
     * Get minimum query length
     *
     * @param int|null $storeId
     * @return int
     */
    public function getMinQueryLength($storeId = null)
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_MIN_QUERY_LENGTH,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: 2;
    }
    
    /**
     * Get maximum number of results
     *
     * @param int|null $storeId
     * @return int
     */
    public function getMaxResults($storeId = null)
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_MAX_RESULTS,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: 10;
    }
    
    /**
     * Get debounce time
     *
     * @param int|null $storeId
     * @return int
     */
    public function getDebounceTime($storeId = null)
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_DEBOUNCE_TIME,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: 300;
    }
    
    /**
     * Check if product thumbnails should be displayed
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isDisplayThumbnails($storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_DISPLAY_THUMBNAILS,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
    
    /**
     * Check if product price should be displayed
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isDisplayPrice($storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_DISPLAY_PRICE,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
    
    /**
     * Check if product description should be displayed
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isDisplayDescription($storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_DISPLAY_DESCRIPTION,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
    
    /**
     * Check if popular searches should be displayed
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isShowPopularSearches($storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SHOW_POPULAR_SEARCHES,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
    
    /**
     * Check if category results should be displayed
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isShowCategoryResults($storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SHOW_CATEGORY_RESULTS,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
    
    /**
     * Get maximum number of popular searches
     *
     * @param int|null $storeId
     * @return int
     */
    public function getMaxPopularSearches($storeId = null)
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_MAX_POPULAR_SEARCHES,
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: 5;
    }
}