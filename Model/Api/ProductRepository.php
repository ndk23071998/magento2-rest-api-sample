<?php

namespace Osc\SampleApi\Model\Api;

use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Osc\SampleApi\Api\ProductRepositoryInterface;
use Osc\SampleApi\Api\ResponseItemInterface;
use Osc\SampleApi\Api\ResponseItemInterfaceFactory;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ResourceModel\Product\Action;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class ProductRepository
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Action
     */
    private $productAction;

    /**
     * @var CollectionFactory
     */
    private $productCollectionFactory;

    /**
     * @var ResponseItemInterfaceFactory
     */
    private $responseItemFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Action $productAction
     * @param CollectionFactory $productCollectionFactory
     * @param ResponseItemInterfaceFactory $responseItemFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Action $productAction,
        CollectionFactory $productCollectionFactory,
        ResponseItemInterfaceFactory $responseItemFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->productAction = $productAction;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->responseItemFactory = $responseItemFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritDoc}
     *
     * @param int $id
     * @return ResponseItemInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id) : ResponseItemInterface
    {
        $collection = $this->getProductCollection()
            ->addAttributeToFilter('entity_id', ['eq' => $id]);
        /** @var ProductInterface $product */
        $product = $collection->getFirstItem();
        if (!$product->getId()) {
            throw new NoSuchEntityException(__('Product not found'));
        }
        return $this->getResponseItemFromProduct($product);
    }

    /**
     * @param ProductInterface $product
     * @return ResponseItemInterface
     */
    private function getResponseItemFromProduct(ProductInterface $product) : ResponseItemInterface
    {
        /** @var ResponseItemInterface $responseItem */
        $responseItem = $this->responseItemFactory->create();
        $responseItem->setId($product->getId())
            ->setSku($product->getSku())
            ->setName($product->getName())
            ->setPrice($product->getPrice())
            ->setDescription($product->getDescription())
            ->setMediaGalleryEntries($product->getMediaGalleryEntries());
        return $responseItem;
    }

    /**
     * @return Collection
     */
    private function getProductCollection() : Collection
    {
        /** @var Collection $collection */
        $collection = $this->productCollectionFactory->create();
        $collection
            ->addAttributeToSelect(
                [
                    'entity_id',
                    ProductInterface::SKU,
                    ProductInterface::NAME,
                    ProductInterface::PRICE,
                    'description',
                    ProductInterface::MEDIA_GALLERY
                ],
                'left'
            )->addMediaGalleryData();
        return $collection;
    }

    /**
     * {@inheritDoc}
     *
     * @param int $id
     * @param string $attributeCode
     * @param mixed $value
     * @return void
     * @throws \Exception
     */
    public function setAttribute(int $id, string $attributeCode, $value) : void
    {
        $this->productAction->updateAttributes(
            [$id],
            [$attributeCode => $value],
            $this->storeManager->getStore()->getId()
        );
    }
}
