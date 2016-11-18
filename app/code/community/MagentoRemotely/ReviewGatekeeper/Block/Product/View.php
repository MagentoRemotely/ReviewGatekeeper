<?php
/**
 * Created by PhpStorm.
 * User: dex
 * Date: 11/17/16
 * Time: 9:55 AM
 */

class MagentoRemotely_ReviewGatekeeper_Block_Product_View extends Mage_Review_Block_Product_View
{
    public function getReviewsCollection()
    {
        $flag = Mage::getStoreConfig('reviewgate/reviewgate/reviewgate');

        if (null === $this->_reviewsCollection) {
            $this->_reviewsCollection = Mage::getModel('review/review')->getCollection()
                ->addStoreFilter(Mage::app()->getStore()->getId())
                ->addEntityFilter('product', $this->getProduct()->getId())
                ->setDateOrder();
        }

        if ( ! $flag ) {
            $this->_reviewsCollection
                ->addStatusFilter(Mage_Review_Model_Review::STATUS_APPROVED)
            ;
        }

        return $this->_reviewsCollection;
    }

}