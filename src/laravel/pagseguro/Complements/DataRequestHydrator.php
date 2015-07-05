<?php

namespace laravel\pagseguro\Complements;

trait DataRequestHydrator
{

    public function separatorDataRequest($data)
    {
        return array_merge($this->setDataPagSeguro($data), $this->getItemsSeparator($data));
    }

    private function getItemsSeparator($data)
    {
        $numberItem = 0;
        foreach ($data->data['items'] as $key => $value) {
            $numberItem++;
            $dataItem["itemId$numberItem"] = (array_key_exists($key, $value) ? $value[$key] : null);
            $dataItem["itemDescription$numberItem"] = (array_key_exists("itemDescription$numberItem", $value) ? $value["itemDescription$numberItem"] : null);
            $dataItem["itemQuantity$numberItem"] = (array_key_exists("itemQuantity$numberItem", $value) ? $value["itemQuantity$numberItem"] : null);
            $dataItem["itemWeight$numberItem"] = (array_key_exists("itemWeight$numberItem", $value) ? $value["itemWeight$numberItem"] : null);
            $dataItem["itemShippingCost$numberItem"] = (array_key_exists("itemShippingCost$numberItem", $value) ? $value["itemShippingCost$numberItem"] : null);
            $dataItem["itemAmount$numberItem"] = (array_key_exists("itemAmount$numberItem", $value) ? $value["itemAmount$numberItem"] : null);
        }
        return $dataItem;
    }

    protected function setDataPagSeguro($data)
    {
        $this->extractSenderName($data->data);
        $this->clearArrObjectRequest($data->data, ['sender', 'address']);
        return array_filter($data->data);
    }

    private function extractSenderName(&$data)
    {
        $keys = array_fill_keys(['senderName'], null);
        $keySender = array_intersect_key($data['sender'], $keys);
        $data['senderName'] = (array_key_exists('senderName', $keySender) ? $keySender['senderName'] : null);
    }

    private function clearArrObjectRequest(&$data, $arrClear)
    {
        foreach ($arrClear as $value) {
            unset($data[$value]);
        }
    }

}