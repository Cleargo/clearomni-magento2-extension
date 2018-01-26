<?php


/**
 * Catalog data helper
 */
namespace Cleargo\Clearomni\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper implements \Cleargo\Clearomni\Helper\ClearomniHelperInterface
{
    const XML_EMAIL_EXCHANGE_SUCCESS = 'clearomni/clearomni/exchange_success';
    const XML_EMAIL_REFUND_SUCCESS = 'clearomni/clearomni/refund_success';
    const XML_EMAIL_EXCHANGE_REQUESTED = 'clearomni/clearomni/exchange_requested';
    const XML_EMAIL_EXCHANGE_REJECTED = 'clearomni/clearomni/exchange_rejected';
    const XML_EMAIL_EXCHANGE_ACKNOWLEDGED = 'clearomni/clearomni/exchange_acknowledged';
    const XML_EMAIL_PENDING_TRANSFER = 'clearomni/clearomni/pending_transfer';
    const XML_EMAIL_EXPIRED = 'clearomni/clearomni/expired';
    const XML_EMAIL_CANCELED = 'clearomni/clearomni/canceled';
    const XML_EMAIL_READY_TO_PICK = 'clearomni/clearomni/ready_to_pick';

    const XML_BASEURL_PATH = 'clearomni_general/general/base_url';
    const XML_MAXRESERVE = 'clearomni_general/general/max_reserve';

    protected $_objectManager;
    protected $_filesystem;


    protected $curl;
    protected $scopeConfig;
    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $timezone;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;
    protected $quoteRepository;
    protected $connection;
    protected $customerSession;
    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    protected $_inlineTranslation;

    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * @var \Cleargo\Clearomni\Helper\ClearomniHelperInterface
     */
    protected $externalClearomniHelper;

    /**
     * @param Magento\Framework\App\Helper\Context $context
     * @param Magento\Framework\ObjectManagerInterface $objectManager
     * @param Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param Magento\Store\Model\StoreManagerInterface $storeManager
     * @param Session $customerSession
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Customer\Model\Session $customerSession,
        \Cleargo\Clearomni\Helper\ClearomniHelperInterface $externalClearomniHelper
    )
    {
        $this->_objectManager = $objectManager;
        $this->_filesystem = $filesystem;
        $this->curl = $curl;
        $this->scopeConfig = $scopeConfig;
        $this->timezone = $timezone;
        $this->storeManager = $storeManager;
        $this->checkoutSession = $checkoutSession;
        $this->quoteRepository = $quoteRepository;
        $this->customerSession = $customerSession;
        $this->_inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection();
        $this->externalClearomniHelper = $externalClearomniHelper;
        parent::__construct($context);
    }

    public function getMaxReserve()
    {
        return $this->scopeConfig->getValue(
            self::XML_MAXRESERVE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getBaseUrl()
    {
        return $this->scopeConfig->getValue(
            self::XML_BASEURL_PATH,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getExchangeSuccess()
    {
        return $this->scopeConfig->getValue(
            self::XML_EMAIL_EXCHANGE_SUCCESS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

    }

    public function getRefundSuccess()
    {
        return $this->scopeConfig->getValue(
            self::XML_EMAIL_REFUND_SUCCESS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getExchangeRequested()
    {
        return $this->scopeConfig->getValue(
            self::XML_EMAIL_EXCHANGE_REQUESTED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getExchangeRejected()
    {
        return $this->scopeConfig->getValue(
            self::XML_EMAIL_EXCHANGE_REJECTED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getExchangeAcknowledged()
    {
        return $this->scopeConfig->getValue(
            self::XML_EMAIL_EXCHANGE_ACKNOWLEDGED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getPendingTransfer()
    {
        return $this->scopeConfig->getValue(
            self::XML_EMAIL_PENDING_TRANSFER,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getExpired()
    {
        return $this->scopeConfig->getValue(
            self::XML_EMAIL_EXPIRED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getCanceled()
    {
        return $this->scopeConfig->getValue(
            self::XML_EMAIL_CANCELED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getReadyToPick()
    {
        return $this->scopeConfig->getValue(
            self::XML_EMAIL_READY_TO_PICK,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function sendEmail($emailId, $order)
    {
        /**
         * @var $order \Magento\Sales\Model\Order
         */
        $store = $this->storeManager->getStore()->getId();
        $transport = $this->_transportBuilder->setTemplateIdentifier($emailId)
            ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
            ->setTemplateVars(
                [
                    'store' => $this->storeManager->getStore(),
                ]
            )
            ->setFrom('general')
            // you can config general email address in Store -> Configuration -> General -> Store Email Addresses
            ->addTo($order->getCustomerEmail(), $order->getShippingAddress()->getName())
            ->getTransport();
        $transport->sendMessage();
        return $this;
    }

    public function request($url, $returnArray = true)
    {
        $this->curl->get($this->getBaseUrl() . $url);
        $response = json_decode($this->curl->getBody(), $returnArray);
        return $response;
    }

    public function getCartAvailableInStore($type)
    {
        return $this->externalClearomniHelper->getCartAvailableInStore($type);
    }

    public function getProductAvailableInStore($productSku, $type = 'cnr')
    {
        return $this->externalClearomniHelper->getProductAvailableInStore($productSku, $type);
    }

    public function getProductAvailability($productId, $storeCode = false, $sku = false, $type = 'cnr')
    {
        return $this->externalClearomniHelper->getProductAvailability($productId, $storeCode, $sku, $type);
    }
    
    


}