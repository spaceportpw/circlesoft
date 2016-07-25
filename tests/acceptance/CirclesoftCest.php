<?php

/**
 * Created by PhpStorm.
 * User: obana
 * Date: 25.07.16
 * Time: 16:40
 */
class CirclesoftCest
{



    function T1Test( \Page\MainPage $mainPage , \Page\CheckOutPage $checkOutPage , \Page\CartPage $cartPage ) {
        $mainPage ->addItem();
        $cartPage->removeItem();
        $cartPage->addNodeSelectShoppingMethod('test node1');
        $checkOutPage->signUpANewUser('First','Last','test_1@test.test','123456');
        $cartPage->checkoutUser();
        $checkOutPage->postTheOrder('123456782229','TEST123','test address','Test321');
    }

}