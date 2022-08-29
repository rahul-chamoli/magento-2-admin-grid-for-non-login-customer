<?php
/**
 * Module notlogin Resource Model
 * @package Subscriber/Notlogin
 */
declare(strict_types=1);

namespace Subscriber\Notlogin\Model\ResourceModel;

class CustomRule extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('notlogin_customrule', 'customrule_id');
    }
}
