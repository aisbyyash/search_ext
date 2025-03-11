<?php
namespace Vendor\SmartSearch\Plugin;

use Magento\Framework\App\RequestInterface;
use Magento\Search\Model\QueryFactory;
use Magento\Store\Model\StoreManagerInterface;
use Vendor\SmartSearch\Api\Data\SearchConfigInterface;

class SearchTermLogPlugin
{
    /**
     * @var RequestInterface
     */
    private $request;
    
    /**
     * @var QueryFactory
     */
    private $queryFactory;
    
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    
    /**
     * @var SearchConfigInterface
     */
    private $searchConfig;
    
    /**
     * SearchTermLogPlugin constructor.
     *
     * @param RequestInterface $request
     * @param QueryFactory $queryFactory
     * @param StoreManagerInterface $storeManager
     * @param SearchConfigInterface $searchConfig
     */
    public function __construct(
        RequestInterface $request,
        QueryFactory $queryFactory,
        StoreManagerInterface $storeManager,
        SearchConfigInterface $searchConfig
    ) {
        $this->request = $request;
        $this->queryFactory = $queryFactory;
        $this->storeManager = $storeManager;
        $this->searchConfig = $searchConfig;
    }
    
    /**
     * After execute method - log search terms
     *
     * @param \Magento\Search\Controller\Term\Popular $subject
     * @param mixed $result
     * @return mixed
     */
    public function afterExecute(
        \Magento\Search\Controller\Term\Popular $subject,
        $result
    ) {
        // Check if the extension is enabled
        if (!$this->searchConfig->isEnabled()) {
            return $result;
        }
        
        // This would be where we log search terms to our custom analytics
        // For now, this is just a placeholder
        
        return $result;
    }
}