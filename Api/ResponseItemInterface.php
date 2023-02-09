<?php

namespace Osc\SampleApi\Api;

interface ResponseItemInterface
{
    const DATA_ID = 'id';

    const DATA_SKU = 'sku';

    const DATA_NAME = 'name';

    const DATA_PRICE = 'price';

    const DATA_DESCRIPTION = 'description';

    const DATA_MEDIA_ENTRIES = 'media_entries';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getSku();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getPrice();

    /**
     * @return string|null
     */
    public function getDescription();

    /**
     * @return \Magento\Catalog\Api\Data\ProductAttributeMediaGalleryEntryInterface[]|null
     */
    public function getMediaGalleryEntries();

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id);

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku(string $sku);

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

    /**
     * @param $price
     * @return $this
     */
    public function setPrice($price);

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description);

    /**
     * @param array|null $mediaGalleryEntries
     * @return $this
     */
    public function setMediaGalleryEntries(array $mediaGalleryEntries = null);
}
