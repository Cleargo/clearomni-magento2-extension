<?php


namespace Cleargo\Clearomni\Model;


class ApiResult extends \Magento\Framework\Model\AbstractModel implements \Cleargo\Clearomni\Api\Data\ApiResultInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
    }

    /**
     * Get message
     * @return string
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * Set message
     * @param string $message
     * @return \Cleargo\Clearomni\Api\Data\ApiResultInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * Get data
     * @return string
     */
    public function getDataa()
    {
        return $this->getData(self::DATA);
    }

    /**
     * Set data
     * @param string $data
     * @param string $value
     * @return \Cleargo\Clearomni\Api\Data\ApiResultInterface
     */
    public function setDataa($data)
    {
        return $this->setData(self::DATA, $data);
    }

    /**
     * Get result
     * @return string
     */
    public function getResult()
    {
        return $this->getData(self::RESULT);
    }

    /**
     * Set result
     * @param string $result
     * @return \Cleargo\Clearomni\Api\Data\ApiResultInterface
     */
    public function setResult($result)
    {
        return $this->setData(self::RESULT, $result);
    }
}
