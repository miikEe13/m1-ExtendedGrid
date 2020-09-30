<?php

class Atwix_ExtendedGrid_Model_Observer
{
    /**
     * Joins extra tables for adding custom columns to Mage_Adminhtml_Block_Sales_Order_Grid
     * @param Varien_Object $observer
     * @return Atwix_Exgrid_Model_Observer
     */
    public function salesOrderGridCollectionLoadBefore($observer)
    {
        $collection = $observer->getOrderGridCollection();
        $select = $collection->getSelect();
        $fromData = $select->getPart('from');
        if (!array_key_exists('sales_order', $fromData)) {
           $select->joinLeft(
              array('sales_order' => $collection->getTable('sales/order')),
              'sales_order.entity_id=main_table.entity_id',
              array('coupon_code' => 'coupon_code')
           );
        }
    }
}
