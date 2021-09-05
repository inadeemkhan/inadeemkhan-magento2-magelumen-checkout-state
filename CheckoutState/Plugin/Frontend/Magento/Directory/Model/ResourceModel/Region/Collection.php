<?php
declare(strict_types=1);

namespace Magelumen\CheckoutState\Plugin\Frontend\Magento\Directory\Model\ResourceModel\Region;

class Collection
{

    /*
     * @var \Magento\Framework\App\Config\ScopeConfigInterface 
     */
    protected $_scopeConfig;
    /*
     * @var array
     */
    protected $_allowedUsStates;

    /*
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig 
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ){
        $this->_scopeConfig = $scopeConfig;
    }
    
    public function afterToOptionArray(
        \Magento\Directory\Model\ResourceModel\Region\Collection $subject,
        $options
    ) {
        $allowedStates = $this->_scopeConfig->getValue('checkout/state_filter/us_state_filter', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $this->_allowedUsStates = explode(",", $allowedStates);

        $result = array_filter($options, function ($option) {
            if(isset(($option['label']))) {
                return in_array($option['label'], $this->_allowedUsStates);
            }
            return true;
        });
        return $result;
    }
}

