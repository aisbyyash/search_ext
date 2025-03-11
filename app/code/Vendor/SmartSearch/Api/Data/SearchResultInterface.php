<?php
namespace Vendor\SmartSearch\Api\Data;

/**
 * Interface SearchResultInterface
 */
interface SearchResultInterface
{
    /**
     * Get search query
     *
     * @return string
     */
    public function getQuery();
    
    /**
     * Set search query
     *
     * @param string $query
     * @return $this
     */
    public function setQuery($query);
    
    /**
     * Get product results
     *
     * @return mixed[]
     */
    public function getProducts();
    
    /**
     * Set product results
     *
     * @param mixed[] $products
     * @return $this
     */
    public function setProducts(array $products);
    
    /**
     * Get category results
     *
     * @return mixed[]
     */
    public function getCategories();
    
    /**
     * Set category results
     *
     * @param mixed[] $categories
     * @return $this
     */
    public function setCategories(array $categories);
    
    /**
     * Get CMS page results
     *
     * @return mixed[]
     */
    public function getCms();
    
    /**
     * Set CMS page results
     *
     * @param mixed[] $cmsPages
     * @return $this
     */
    public function setCms(array $cmsPages);
    
    /**
     * Get popular searches
     *
     * @return string[]
     */
    public function getPopularSearches();
    
    /**
     * Set popular searches
     *
     * @param string[] $searches
     * @return $this
     */
    public function setPopularSearches(array $searches);
    
    /**
     * Get result count
     *
     * @return int
     */
    public function getResultCount();
    
    /**
     * Set result count
     *
     * @param int $count
     * @return $this
     */
    public function setResultCount($count);
}