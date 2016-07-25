<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 25.07.16
 * Time: 18:04
 */

namespace Page;
use Exception;


class CartPage
{

    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }

    public static $URL = '/';
    public static $URL1 = '/cart';
    public static $URL2 = '/cart/checkout';



    // Shopping Cart link

    public static $header = './/*[@id="inner-container"]/div/div[2]/div[1]/h1';
    public static $shippingMethodEurope = './/*[@id="shipping_select"]/option[5]';
    public static $removeItemLink2 = '//*[@class="cart"]//tr[2]//a';

    public static $nodeField = './/*[@id=\'client_note\']';
    public static $accountPaymentMethod = './/*[@id=\'po_option_account\']';
    public static $checkOutButton = './/*[@id=\'cart\']/div[5]/div/a/span';
    public static $shippingCost = './/*[@id=\'shipping_cost\']';



    public function removeItem()
    {
        try{
            $I = $this->tester;
            $I->amOnPage(self::$URL1);
            $I->waitForElementVisible(self::$header);
            $I->see('Cart', self::$header);
            $I->click(self::$shippingMethodEurope);
            $I->wait(3);
            $I->see('$42',self::$shippingCost);
            $I->click(self::$removeItemLink2);
            $I->canSeeInPopup('Are you sure you want to remove this item?');
            $I->acceptPopup();
            $I->wait(4);
            $I->see('$31',self::$shippingCost);
        } catch (Exception $e){
            $I->wait(3);
            $I->see('$31',self::$shippingCost);
        }
    }

    public function addNodeSelectShoppingMethod($node){
        $I = $this->tester;
        $I->wait(3);
        //    $I->amOnPage(self::$URL);
        $I->fillField(self::$nodeField,$node);
        $I->click(self::$accountPaymentMethod);
        $I->click(self::$checkOutButton);
    }


    public function checkoutUser(){
        $I = $this->tester;
        $I->wait(2);
        $I->amOnPage(self::$URL1);
        $I->waitForElementVisible(self::$shippingMethodEurope);
        $I->click(self::$shippingMethodEurope);
        $I->click(self::$accountPaymentMethod);
        $I->click(self::$checkOutButton);
    }


}