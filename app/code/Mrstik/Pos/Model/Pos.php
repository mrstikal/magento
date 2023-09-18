<?php

namespace Mrstik\Pos\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Filter\FilterManager;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Mrstik\Pos\Api\Data\PosInterface;
use Mrstik\Pos\Model\Pos\Url;
use Mrstik\Pos\Model\ResourceModel\Pos as PosResourceModel;
use Mrstik\Pos\Model\Routing\RoutableInterface;
use Mrstik\Pos\Model\Source\AbstractSource;


class Pos extends AbstractModel implements PosInterface, RoutableInterface
{
    const STATUS_AVAILABLE = 1;

    const STATUS_UNAVAILABLE = 0;

    protected $urlModel;

    const CACHE_TAG = 'mrstik_pos_pos';

    protected $_cacheTag = 'mrstik_pos_pos';

    protected $_eventPrefix = 'mrstik_pos_pos';

    protected $filter;

    protected $outputProcessor;

    protected $optionProviders;

    public function __construct(
        Context $context,
        Registry $registry,
        Output $outputProcessor,
        FilterManager $filter,
        Url $urlModel,
        array $optionProviders = [],
        array $data = [],
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null
    )
    {
        $this->outputProcessor = $outputProcessor;
        $this->filter          = $filter;
        $this->urlModel        = $urlModel;
        $this->optionProviders = $optionProviders;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init(PosResourceModel::class);
    }
    public function setName($name)
    {
        return $this->setData(PosInterface::NAME, $name);
    }

    public function setAddress($address)
    {
        return $this->setData(PosInterface::ADDRESS, $address);
    }

    public function getName()
    {
        return $this->getData(PosInterface::NAME);
    }

    public function getAddress()
    {
        return $this->getData(PosInterface::ADDRESS);
    }

    public function getIsAvailable()
    {
        return $this->getData(PosInterface::IS_AVAILABLE);
    }

    public function setIsAvailable($isAvailable)
    {
        return $this->setData(PosInterface::IS_AVAILABLE, $isAvailable);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    /**
     * @return bool
     */
    public function isAvailable()
    {
        return (bool)$this->getIsAvailable();
    }

    public function getAttributeText($attribute)
    {
        if (!isset($this->optionProviders[$attribute])) {
            return '';
        }
        if (!($this->optionProviders[$attribute] instanceof AbstractSource)) {
            return '';
        }
        return $this->optionProviders[$attribute]->getOptionText($this->getData($attribute));
    }
}
