<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 20/3/17
 * Time: 5:14 PM
 */

namespace Training\RetailerAdmin\Model\Source;


use Magento\Framework\Data\OptionSourceInterface;

class Region implements OptionSourceInterface
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
            ['label' => 'California', 'value' => '12'],
            ['label' => 'Alaska', 'value' => '2'],
            ['label' => 'New York', 'value' => '43'],
            ['label' => 'Quebec', 'value' => '76'],
            ['label' => 'Ontario', 'value' => '74']
        ];

        return $this->options;
    }
}