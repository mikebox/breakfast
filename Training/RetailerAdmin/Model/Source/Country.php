<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 20/3/17
 * Time: 5:14 PM
 */

namespace Training\RetailerAdmin\Model\Source;


use Magento\Framework\Data\OptionSourceInterface;

class Country implements OptionSourceInterface
{

    protected $options;

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        if ($this->options !== null) {
            return $this->options;
        }

        $this->options = [
            ['label' => 'United States', 'value' => 'US'],
            ['label' => 'Canada', 'value' => 'CA'],
            ['label' => 'United Kingdom', 'value' => 'GB']
        ];

        return $this->options;
    }
}