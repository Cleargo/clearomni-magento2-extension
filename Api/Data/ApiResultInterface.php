<?php


namespace Cleargo\Clearomni\Api\Data;

use Magento\Payment\Gateway\Command\NullCommand;

interface ApiResultInterface
{

    const DATA = 'dataa';
    const RESULT = 'result';
    const MESSAGE = 'message';

    /**
     * Get data
     * @return string|null
     */
    public function getDataa();

    /**
     * Set data
     * @param string $data
     * @return \Cleargo\Clearomni\Api\Data\ApiResultInterface
     */
    public function setDataa($data);

    /**
     * Get result
     * @return boolean|null
     */
    public function getResult();

    /**
     * Set result
     * @param string $result
     * @return \Cleargo\Clearomni\Api\Data\ApiResultInterface
     */
    public function setResult($result);

    /**
     * Get message
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message
     * @param string $message
     * @return \Cleargo\Clearomni\Api\Data\ApiResultInterface
     */
    public function setMessage($message);

}
