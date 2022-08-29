<?php
namespace Subscriber\Notlogin\Model\Indexer;

class Getsubscriber implements \Magento\Framework\Indexer\ActionInterface, \Magento\Framework\Mview\ActionInterface
{
	/**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $_resource;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Action
     */
    private $action;

    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected $_connection;

    public function __construct(
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Catalog\Model\ResourceModel\Product\Action $action
    )
    {
        $this->_resource = $resource;
        $this->action = $action;
    }
	/*
	 * Used by mview, allows process indexer in the "Update on schedule" mode
	 */
	public function execute($ids){

		//code here!
	}

	/*
	 * Will take all of the data and reindex
	 * Will run when reindex via command line
	 */
	public function executeFull(){
			$connection = $this->_getConnection();
            $select = "SELECT newsletter_subscriber.subscriber_id, sales_order.customer_email, sales_order.customer_firstname, sales_order.customer_lastname FROM sales_order left JOIN newsletter_subscriber ON sales_order.customer_email = newsletter_subscriber.subscriber_email WHERE newsletter_subscriber.customer_id = 0 GROUP BY sales_order.customer_email";
        
        $data = $connection->fetchAll($select);


        $connection->fetchAll("ALTER TABLE `notlogin_customrule` AUTO_INCREMENT = 1");
		$connection->delete('notlogin_customrule');
		//print_r($data);
		$tableName = 'notlogin_customrule';
		$connection->insertMultiple($tableName, $data);

	}
   
   /**
     * Retrieve connection instance
     *
     * @return bool|\Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected function _getConnection()
    {
        if (null === $this->_connection) {
            $this->_connection = $this->_resource->getConnection();
        }
        return $this->_connection;
    }
   
	/*
	 * Works with a set of entity changed (may be massaction)
	 */
	public function executeList(array $ids){
		//code here!
	}
   
   
	/*
	 * Works in runtime for a single entity using plugins
	 */
	public function executeRow($id){
		//code here!
	}
}