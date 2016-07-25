<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 25.07.16
 * Time: 18:06
 */

namespace Page;


class CheckOutPage
{


    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }

    public static $URL = '/';
    public static $URL1 = '/cart';
    public static $URL2 = '/cart/checkout';

    //Checkout page
    public static $firstNameField = './/*[@id=\'user_first_name\']';
    public static $lastNameField = './/*[@id=\'user_last_name\']';
    public static $emailField = './/*[@id=\'account_email\']';
    public static $passwordField = './/*[@id=\'account_password\']';
    public static $reEnterPassField = './/*[@id=\'account_password_confirmation\']';
    public static $singUpButton = './/*[@id=\'newUser\']/div[4]/input';
    public static $msgSuccess ='.//*[@id=\'flash_success\']/strong';


    public function signUpANewUser($firstName,$lastName,$email,$pass){
        $I = $this->tester;
        $I->fillField(self::$firstNameField,$firstName);
        $I->fillField(self::$lastNameField,$lastName);
        $I->fillField(self::$emailField,$email);
        $I->fillField(self::$passwordField,$pass);
        $I->fillField(self::$reEnterPassField,$pass);
        $I->click(self::$singUpButton);
        $I->waitForElementVisible(self::$msgSuccess);
    }


    public static $telephoneField = './/*[@id=\'account_phone\']';
    public static $checkoutButton = './/*[@id=\'checkoutCart\']';
    public static $addShippingMethod = './/*[@id=\'add_shipping_address\']';
    public static $shippingAttentionField = './/*[@id=\'shipping_address_name\']';
    public static $shippingAddress1Field = './/*[@id=\'shipping_address_address1\']';
    public static $shippingCityField = './/*[@id=\'shipping_address_city\']';
    public static $addThisAddressButton = './/*[@id=\'shipping_address_textbox\']/div[2]/input[1]';

    public function postTheOrder ($telephone,$addressName,$address1,$city){
        $I = $this->tester;
        $I->click(self::$addShippingMethod);
        $I->waitForElementVisible(self::$shippingAddress1Field);
        $I->fillField(self::$shippingAttentionField,$addressName);
        $I->fillField(self::$shippingAddress1Field,$address1);
        $I->fillField(self::$shippingCityField,$city);
        $I->click(self::$addThisAddressButton);
        $I->waitForElementNotVisible(self::$shippingAddress1Field);
        $I->fillField(self::$telephoneField,$telephone);
        $I->click(self::$checkoutButton);
        $I->waitForElementVisible(self::$msgSuccess);

    }



}