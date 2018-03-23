<?php


namespace Cleargo\Clearomni\Model\Data;


class ProductOption extends \Magento\Framework\Model\AbstractModel implements \Cleargo\Clearomni\Api\Data\ProductOptionInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME,$name);
    }

    public function getNameId()
    {
        return $this->getData(self::NAME_ID);
    }

    public function setNameId($nameId)
    {
        return $this->setData(self::NAME_ID,$nameId);
    }

    public function getValue()
    {
        return $this->getData(self::VALUE);
    }

    public function setValue($value)
    {
        return $this->setData(self::VALUE,$value);
    }

    public function getValueId()
    {
        return $this->getData(self::VALUE_ID);
    }

    public function setValueId($valueId)
    {
        return $this->setData(self::VALUE_ID,$valueId);
    }
    public function getDefaultName()
    {
        return $this->getData(self::DEFAULT_NAME);
    }

    public function setDefaultName($value)
    {
        return $this->setData(self::DEFAULT_NAME,$value);
    }
    public function getDefaultValue()
    {
        return $this->getData(self::DEFAULT_VALUE);
    }

    public function setDefaultValue($value)
    {
        return $this->setData(self::DEFAULT_VALUE,$value);
    }

}
