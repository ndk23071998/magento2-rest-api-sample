<?php

namespace Osc\SampleApi\Api;

interface ProductRepositoryInterface
{
    /**
     * Return a filtered product.
     *
     * @param int $id
     * @return \Osc\SampleApi\Api\ResponseItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id);

    /**
     * Set descriptions for the products.
     *
     * @param int $id
     * @param string $attributeCode
     * @param mixed $value
     * @return void
     */
    public function setAttribute(int $id, string $attributeCode, $value);
}
