<?php
namespace Vendor\SmartSearch\Model;

use Vendor\SmartSearch\Api\Data\SearchResultInterface;
use Magento\Framework\DataObject;

class SearchResult extends DataObject implements SearchResultInterface
{
    /**
     * Get search query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->getData('query');
    }
    
    /**
     * Set search query
     *
     * @param string $query
     * @return $this
     */
    public function setQuery($query)
    {
        return $this->setData('query', $query);
    }
    
    /**
     * Get product results
     *
     * @return mixed[]
     */
    public function getProducts()
    {
        return $this->getData('products') ?: [];
    }
    
    /**
     * Set product results
     *
     * @param mixed[] $products
     * @return $this
     */
    public function setProducts(array $products)
    {
        return $this->setData('products', $products);
    }
    
    /**
     * Get category results
     *
     * @return mixed[]
     */
    public function getCategories()
    {
        return $this->getData('categories') ?: [];
    }
    
    /**
     * Set category results
     *
     * @param mixed[] $categories
     * @return $this
     */
    public function setCategories(array $categories)
    {
        return $this->setData('categories', $categories);
    }
    
    /**
     * Get CMS page results
     *
     * @return mixed[]
     */
    public function getCms()
    {
        return $this->getData('cms') ?: [];
    }
    
    /**
     * Set CMS page results
     *
     * @param mixed[] $cmsPages
     * @return $this
     */
    public function setCms(array $cmsPages)
    {
        return $this->setData('cms', $cmsPages);
    }
    
    /**
     * Get popular searches
     *
     * @return string[]
     */
    public function getPopularSearches()
    {
        return $this->getData('popular_searches') ?: [];
    }
    
    /**
     * Set popular searches
     *
     * @param string[] $searches
     * @return $this
     */
    public function setPopularSearches(array $searches)
    {
        return $this->setData('popular_searches', $searches);
    }
    
    /**
     * Get result count
     *
     * @return int
     */
    public function getResultCount()
    {
        return (int) $this->getData('result_count');
    }
    
    /**
     * Set result count
     *
     * @param int $count
     * @return $this
     */
    public function setResultCount($count)
    {
        return $this->setData('result_count', (int) $count);
    }
}