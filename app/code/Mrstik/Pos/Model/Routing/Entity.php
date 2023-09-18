<?php
namespace Mrstik\Pos\Model\Routing;

use Mrstik\Pos\Model\FactoryInterface;

class Entity
{
    protected $prefixConfigPath;

    protected $suffixConfigPath;

    protected $listKeyConfigPath;

    protected $listAction;

    protected $factory;

    protected $controller;

    protected $viewAction;

    protected $param;

    public function __construct(
        $prefixConfigPath,
        $suffixConfigPath,
        $listKeyConfigPath,
        FactoryInterface $factory,
        $controller,
        $listAction = 'index',
        $viewAction = 'view',
        $param = 'id'
    ) {
        $this->prefixConfigPath = $prefixConfigPath;
        $this->suffixConfigPath = $suffixConfigPath;
        $this->listKeyConfigPath = $listKeyConfigPath;
        $this->factory = $factory;
        $this->controller = $controller;
        $this->listAction = $listAction;
        $this->viewAction = $viewAction;
        $this->param = $param;
    }

    public function getPrefixConfigPath()
    {
        return $this->prefixConfigPath;
    }

    public function getSuffixConfigPath()
    {
        return $this->suffixConfigPath;
    }

    public function getListKeyConfigPath()
    {
        return $this->listKeyConfigPath;
    }

    public function getListAction()
    {
        return $this->listAction;
    }

    public function getFactory()
    {
        return $this->factory;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getViewAction()
    {
        return $this->viewAction;
    }

    public function getParam()
    {
        return $this->param;
    }

}
