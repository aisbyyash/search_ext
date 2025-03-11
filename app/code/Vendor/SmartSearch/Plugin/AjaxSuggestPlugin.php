<?php
namespace Vendor\SmartSearch\Plugin;

use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Search\Model\QueryFactory;
use Magento\Store\Model\StoreManagerInterface;
use Vendor\SmartSearch\Api\Data\SearchConfigInterface;

class AjaxSuggestPlugin
{
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;
    
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
     * AjaxSuggestPlugin constructor.
     *
     * @param JsonFactory $resultJsonFactory
     * @param QueryFactory $queryFactory
     * @param StoreManagerInterface $storeManager
     * @param SearchConfigInterface $searchConfig
     */
    public function __construct(
        JsonFactory $resultJsonFactory,
        QueryFactory $queryFactory,
        StoreManagerInterface $storeManager,
        SearchConfigInterface $searchConfig
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->queryFactory = $queryFactory;
        $this->storeManager = $storeManager;
        $this->searchConfig = $searchConfig;
    }
    
    /**
     * Around execute method
     *
     * @param \Magento\Search\Controller\Ajax\Suggest $subject
     * @param callable $proceed
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function aroundExecute(
        \Magento\Search\Controller\Ajax\Suggest $subject,
        callable $proceed
    ) {
        // Check if the extension is enabled
        if (!$this->searchConfig->isEnabled()) {
            return $proceed();
        }
        
        // If enabled, we'll let the custom controller handle it
        // Just forward to our own controller
        $resultRedirect = $this->resultJsonFactory->create();
        
        // For now, just allow original behavior to proceed
        // In a full implementation, this would redirect to our custom search
        return $proceed();
    }
}