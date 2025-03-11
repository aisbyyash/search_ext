<?php
namespace Vendor\SmartSearch\Api\Data;

/**
 * Interface SearchConfigInterface
 */
interface SearchConfigInterface
{
    /**
     * Check if the extension is enabled
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isEnabled($storeId = null);
    
    /**
     * Get minimum query length
     *
     * @param int|null $storeId
     * @return int
     */
    public function getMinQueryLength($storeId = null);
    
    /**
     * Get maximum number of results
     *
     * @param int|null $storeId
     * @return int
     */
    public function getMaxResults($storeId = null);
    
    /**
     * Get debounce time
     *
     * @param int|null $storeId
     * @return int
     */
    public function getDebounceTime($storeId = null);
    
    /**
     * Check if product thumbnails should be displayed
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isDisplayThumbnails($storeId = null);
    
    /**
     * Check if product price should be displayed
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isDisplayPrice($storeId = null);
    
    /**
     * Check if product description should be displayed
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isDisplayDescription($storeId = null);
    
    /**
     * Check if popular searches should be displayed
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isShowPopularSearches($storeId = null);
    
    /**
     * Check if category results should be displayed
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isShowCategoryResults($storeId = null);
    
    /**
     * Get maximum number of popular searches
     *
     * @param int|null $storeId
     * @return int
     */
    public function getMaxPopularSearches($storeId = null);
}