<?php
namespace Vendor\SmartSearch\Api\Data;

/**
 * Interface SearchQueryInterface
 */
interface SearchQueryInterface
{
    /**
     * Get search query text
     *
     * @return string
     */
    public function getQuery();
    
    /**
     * Set search query text
     *
     * @param string $query
     * @return $this
     */
    public function setQuery($query);
    
    /**
     * Get search options
     *
     * @return mixed[]
     */
    public function getOptions();
    
    /**
     * Set search options
     *
     * @param mixed[] $options
     * @return $this
     */
    public function setOptions(array $options);
    
    /**
     * Get user context
     *
     * @return mixed[]
     */
    public function getContext();
    
    /**
     * Set user context
     *
     * @param mixed[] $context
     * @return $this
     */
    public function setContext(array $context);
    
    /**
     * Get recent searches
     *
     * @return string[]
     */
    public function getRecentSearches();
    
    /**
     * Set recent searches
     *
     * @param string[] $searches
     * @return $this
     */
    public function setRecentSearches(array $searches);
}