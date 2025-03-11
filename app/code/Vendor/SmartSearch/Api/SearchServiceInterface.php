<?php
namespace Vendor\SmartSearch\Api;

/**
 * Interface SearchServiceInterface
 */
interface SearchServiceInterface
{
    /**
     * Perform a search
     *
     * @param \Vendor\SmartSearch\Api\Data\SearchQueryInterface $searchQuery
     * @return \Vendor\SmartSearch\Api\Data\SearchResultInterface
     */
    public function search($searchQuery);
    
    /**
     * Get popular searches
     *
     * @param int $limit
     * @return string[]
     */
    public function getPopularSearches($limit = 5);
    
    /**
     * Get trending products
     *
     * @param int $limit
     * @return mixed[]
     */
    public function getTrendingProducts($limit = 5);
}