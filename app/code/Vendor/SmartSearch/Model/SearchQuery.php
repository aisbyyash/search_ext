<?php
namespace Vendor\SmartSearch\Model;

use Vendor\SmartSearch\Api\Data\SearchQueryInterface;
use Magento\Framework\DataObject;

class SearchQuery extends DataObject implements SearchQueryInterface
{
    /**
     * Get search query text
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->getData('query') ?: '';
    }
    
    /**
     * Set search query text
     *
     * @param string $query
     * @return $this
     */
    public function setQuery($query)
    {
        return $this->setData('query', $query);
    }
    
    /**
     * Get search options
     *
     * @return mixed[]
     */
    public function getOptions()
    {
        return $this->getData('options') ?: [];
    }
    
    /**
     * Set search options
     *
     * @param mixed[] $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        return $this->setData('options', $options);
    }
    
    /**
     * Get user context
     *
     * @return mixed[]
     */
    public function getContext()
    {
        return $this->getData('context') ?: [];
    }
    
    /**
     * Set user context
     *
     * @param mixed[] $context
     * @return $this
     */
    public function setContext(array $context)
    {
        return $this->setData('context', $context);
    }
    
    /**
     * Get recent searches
     *
     * @return string[]
     */
    public function getRecentSearches()
    {
        return $this->getData('recent_searches') ?: [];
    }
    
    /**
     * Set recent searches
     *
     * @param string[] $searches
     * @return $this
     */
    public function setRecentSearches(array $searches)
    {
        return $this->setData('recent_searches', $searches);
    }
}