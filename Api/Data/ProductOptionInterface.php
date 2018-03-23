<?php


namespace Cleargo\Clearomni\Api\Data;

interface ProductOptionInterface
{

    const NAME="name";
    const NAME_ID="name_id";
    const VALUE="value";
    const VALUE_ID="value_id";
    const DEFAULT_NAME="default_name";
    const DEFAULT_VALUE="default_value";


    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Cleargo\Clearomni\Api\Data\ProductOptionInterface
     */
    public function setName($name);

    /**
     * Get name_id
     * @return string|null
     */
    public function getNameId();

    /**
     * Set name_id
     * @param string $order_item_id
     * @return \Cleargo\Clearomni\Api\Data\ProductOptionInterface
     */
    public function setNameId($nameId);

    /**
     * Get value
     * @return string|null
     */
    public function getValue();

    /**
     * Set value
     * @param string $order_id
     * @return \Cleargo\Clearomni\Api\Data\ProductOptionInterface
     */
    public function setValue($value);

    /**
     * Get value_id
     * @return string|null
     */
    public function getValueId();

    /**
     * Set value_id
     * @param string $qty_clearomni_reserved
     * @return \Cleargo\Clearomni\Api\Data\ProductOptionInterface
     */
    public function setValueId($valueId);

    /**
     * Get default_value
     * @return string|null
     */
    public function getDefaultValue();

    /**
     * Set default_value
     * @param string $value
     * @return \Cleargo\Clearomni\Api\Data\ProductOptionInterface
     */
    public function setDefaultValue($value);

    /**
     * Get default_name
     * @return string|null
     */
    public function getDefaultName();

    /**
     * Set default_name
     * @param string $name
     * @return \Cleargo\Clearomni\Api\Data\ProductOptionInterface
     */
    public function setDefaultName($name);
}
