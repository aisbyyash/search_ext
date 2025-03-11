<?php
namespace Vendor\SmartSearch\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Data\Form\FormKey;

class Autocomplete extends Template
{
    /**
     * @var FormKey
     */
    protected $formKey;
    
    /**
     * @param Context $context
     * @param FormKey $formKey
     * @param array $data
     */
    public function __construct(
        Context $context,
        FormKey $formKey,
        array $data = []
    ) {
        $this->formKey = $formKey;
        parent::__construct($context, $data);
    }
    
    /**
     * Get form key
     *
     * @return string
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
    
    /**
     * Get autocomplete config
     *
     * @return array
     */
    public function getConfig()
    {
        return [
            'searchFieldSelector' => '#search',
            'minQueryLength' => 2,
            'debounceTime' => 300,
            'displayThumbnails' => true,
            'displayPrice' => true,
            'displayDescription' => true,
            'showPopularSearches' => true,
            'showCategoryResults' => true,
            'maxResults' => 10,
            'maxCategoryResults' => 3,
            'maxPopularSearches' => 5,
            'suggestUrl' => $this->getUrl('smartsearch/autocomplete/suggest')
        ];
    }
    
    /**
     * Get JSON encoded config
     *
     * @return string
     */
    public function getJsonConfig()
    {
        return json_encode($this->getConfig());
    }
}