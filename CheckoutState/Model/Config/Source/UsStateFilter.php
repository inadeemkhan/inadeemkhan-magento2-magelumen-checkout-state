<?php
declare(strict_types=1);

namespace Magelumen\CheckoutState\Model\Config\Source;

class UsStateFilter implements \Magento\Framework\Option\ArrayInterface
{

    /*
     * @var \Magento\Directory\Api\CountryInformationAcquirerInterface 
     */
    protected $_countryInformationAcquirer;

    /*
     * @param \Magento\Directory\Api\CountryInformationAcquirerInterface $countryInformationAcquirer 
     */
    public function __construct(
        \Magento\Directory\Api\CountryInformationAcquirerInterface $countryInformationAcquirer
    ){
        $this->_countryInformationAcquirer = $countryInformationAcquirer;
    }
    
    
    public function toOptionArray()
    {
        $countries = $this->_countryInformationAcquirer->getCountriesInfo();
        foreach ($countries as $country) {
            $regions = [];
            if($availableRegions = $country->getAvailableRegions()){
                foreach ($availableRegions as $region) {
                    $regions[] = [
                        'value' => $region->getName(),
                        'label' => $region->getName()
                    ];
                }
            }
        }
        return $regions;
    }
}

