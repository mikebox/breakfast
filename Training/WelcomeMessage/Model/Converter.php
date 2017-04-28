<?php

namespace Training\WelcomeMessage\Model;

class Converter implements \Magento\Framework\Config\ConverterInterface
{
    public function convert($source)
    {
        $result = [];

        foreach ($source->documentElement->getElementsByTagName('country') as $country)
        {
            $code = $country->getAttribute('code');
            $result[$code] = [];
            $result[$code]['default'] = $country->getElementsByTagName('default')[0]->textContent;

            foreach ($country->getElementsByTagName('state') as $state)
            {
                $result[$code][$state->getAttribute('code')] = $state->textContent;
            }
        }

        return $result;
    }
}