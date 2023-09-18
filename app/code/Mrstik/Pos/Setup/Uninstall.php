<?php

namespace Mrstik\Pos\Setup;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;
use Magento\Config\Model\ResourceModel\Config\Data;
use Magento\Config\Model\ResourceModel\Config\Data\CollectionFactory;


/**
 * @codeCoverageIgnore
 */
class Uninstall implements UninstallInterface
{

    protected $collectionFactory;

    protected $configResource;


    public function __construct(
        CollectionFactory $collectionFactory,
        Data $configResource
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->configResource    = $configResource;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.Generic.CodeAnalysis.UnusedFunctionParameter)
     */
    // @codingStandardsIgnoreStart
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    // @codingStandardsIgnoreEnd
    {
        if ($setup->tableExists('pos_entity')) {
            $setup->getConnection()->dropTable('pos_entity');
        }

        $collection = $this->collectionFactory->create()
            ->addPathFilter('mrstik_pos');
        foreach ($collection as $config) {
            $this->deleteConfig($config);
        }
    }

    protected function deleteConfig(AbstractModel $config)
    {
        $this->configResource->delete($config);
    }
}
