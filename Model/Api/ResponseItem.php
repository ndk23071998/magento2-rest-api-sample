<?php

namespace Osc\SampleApi\Model\Api;

use Osc\SampleApi\Api\ResponseItemInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Pricing\Helper\Data as PriceHelper;

/**
 * Class ResponseItem
 */
class ResponseItem extends DataObject implements ResponseItemInterface
{

    /**
     * @var PriceHelper
     */
    protected PriceHelper $priceHelper;

    /**
     * @param PriceHelper $priceHelper
     */
    public function __construct(
        PriceHelper $priceHelper
    )
    {
        $this->priceHelper = $priceHelper;
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->_getData(self::DATA_ID);
    }

    /**
     * @return string
     */
    public function getSku() : string
    {
        return $this->_getData(self::DATA_SKU);
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->_getData(self::DATA_NAME);
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->priceHelper->currency($this->_getData(self::DATA_PRICE), true, false);
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->_getData(self::DATA_DESCRIPTION);
    }

    /**
     * @return \Magento\Catalog\Api\Data\ProductAttributeMediaGalleryEntryInterface[]|null
     */
    public function getMediaGalleryEntries()
    {
        return $this->_getData(self::DATA_MEDIA_ENTRIES);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
        return $this->setData(self::DATA_ID, $id);
    }

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku(string $sku)
    {
        return $this->setData(self::DATA_SKU, $sku);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        return $this->setData(self::DATA_NAME, $name);
    }

    /**
     * @param $price
     * @return $this
     */
    public function setPrice($price)
    {
        return $this->setData(self::DATA_PRICE, $price);
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description)
    {
        return $this->setData(self::DATA_DESCRIPTION, $description);
    }

    /**
     * @param array|null $mediaGalleryEntries
     * @return $this
     */
    public function setMediaGalleryEntries(array $mediaGalleryEntries = null)
    {
        return $this->setData(self::DATA_MEDIA_ENTRIES, $mediaGalleryEntries);
    }
}
