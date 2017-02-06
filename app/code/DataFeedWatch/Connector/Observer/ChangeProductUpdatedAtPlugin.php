<?php
/**
 * Created by Q-Solutions Studio
 * Date: 31.08.16
 *
 * @category    DataFeedWatch
 * @package     DataFeedWatch_Connector
 * @author      Lukasz Owczarczuk <lukasz@qsolutionsstudio.com>
 */

namespace DataFeedWatch\Connector\Observer;

use DataFeedWatch\Connector\Helper\Data as DataHelper;
use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class ChangeProductUpdatedAtPlugin implements ObserverInterface
{
    /** @var DataHelper */
    protected $dataHelper;

    /** @var \Magento\Framework\App\ResourceConnection */
    protected $resource;

    /**
     * @param DataHelper                                $dataHelper
     * @param \Magento\Framework\App\ResourceConnection $resource
     */
    public function __construct(
        DataHelper $dataHelper,
        \Magento\Framework\App\ResourceConnection $resource
    ) {

        $this->dataHelper = $dataHelper;
        $this->resource   = $resource;
    }

    /**
     * @param EventObserver $observer
     */
    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Catalog\Model\Product $category */
        $product    = $observer->getProduct();
        $sql = sprintf(
            'UPDATE %s SET `updated_at` = \'%s\' WHERE `entity_id` = %s',
            $product->getResource()->getEntityTable(),
            gmdate('Y-m-d H:i:s'), $product->getId()
        );
        $product->getResource()->getConnection()->query($sql);
    }
}
