<?php


/**
 * Catalog data helper
 */
namespace Cleargo\Clearomni\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Util extends AbstractHelper
{
    const ORDER_TYPE_CNR='reserve';
    const ORDER_TYPE_CNC='collect';
    const ORDER_TYPE_NORMAL='normal';

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
    protected $orderRepository;

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
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
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
        $this->connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection();
        $this->orderRepository=$orderRepository;
        parent::__construct($context);
    }

    public function getOrderType($order){
        $shippingMethod=$order->getShippingMethod();
        $paymentMethod=$order->getPayment()->getMethod();
        if($shippingMethod=='smilestoredelivery_smilestoredelivery'){
            if($paymentMethod=='clickandreserve'){
                return self::ORDER_TYPE_CNR;
            }else{
                return self::ORDER_TYPE_CNC;
            }
        }
        return self::ORDER_TYPE_NORMAL;
    }
}