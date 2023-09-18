<?php
namespace Mrstik\Pos\Api\Data;

interface PosInterface
{
    const POS_ID = 'pos_id';
    const NAME = 'name';
    const ADDRESS = 'address';
    const IS_AVAILABLE = 'is_available';

    public function getId();

    public function getName();

    public function getAddress();

    public function getIsAvailable();

    public function setId($id);

    public function setName($name);

    public function setAddress($address);

    public function setIsAvailable($isAvailable);
}
