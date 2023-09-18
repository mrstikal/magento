<?php

namespace Mrstik\Pos\Model;

use Magento\Framework\ObjectManagerInterface;
use Mrstik\Pos\Model\Routing\RoutableInterface;

class PosFactory implements FactoryInterface
{
    protected $_objectManager = null;

    protected $_instanceName = null;

    public function __construct(ObjectManagerInterface $objectManager, $instanceName = Pos::class)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName  = $instanceName;
    }

    public function create(array $data = array())
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
