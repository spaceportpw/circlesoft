<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 25.07.16
 * Time: 16:21
 */

namespace Page;
use Exception;


class MainPage
{

    public static $signInLink = '//*[@id="navMenu"]/ul/li[6]/a';

    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }


    public static $addItem1Button = '//*[@id="inner-container-home"]/div[2]/div[2]/div[4]/div/div[1]/div[3]//a';
    public static $addItem2Button = './/*[@id="inner-container-home"]/div[2]/div[2]/div[4]/div/div[2]/div[3]//a';
    public static $addItem3Button = './/*[@id="inner-container-home"]/div[2]/div[2]/div[4]/div/div[3]/div[3]//a';
    public static $URL = '/';
    public static $URL1 = '/cart';
    public static $URL2 = '/cart/checkout';



// Shopping Cart link

    public static $header = './/*[@id="inner-container"]/div/div[2]/div[1]/h1';
    public static $shippingMethodBankDeposit = './/*[@id="shipping_select"]/option[4]';
    public static $removeItemLink2 = '//*[@class="cart"]//tr[2]//a';

    public static $nodeField = './/*[@id=\'client_note\']';
    public static $accountPaymentMethod = './/*[@id=\'po_option_account\']';
    public static $checkOutButton = './/*[@id=\'cart\']/div[5]/div/a/span';

    public function addItem()
    {
        $I = $this->tester;
        $I->amOnPage(self::$URL);
        $I->scrollTo(self::$addItem1Button);
        $I->click(self::$addItem1Button);
        $I->wait(1);
        $I->click(self::$addItem2Button);
        $I->wait(1);
        $I->click(self::$addItem3Button);
        $I->wait(1);
       // $I->click('Cart');
    }

    public function removeItem()
    {
    try{
        $I = $this->tester;
        $I->amOnPage(self::$URL1);
        $I->waitForElementVisible(self::$header);
        $I->see('Cart', self::$header);
        $I->click(self::$shippingMethodBankDeposit);
        $I->wait(5);
        $I->click(self::$removeItemLink2);
        $I->canSeeInPopup('Are you sure you want to remove this item?');
        $I->acceptPopup();
    } catch (Exception $e){
        $I->wait(3);

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
       // $I->amOnPage(self::$URL2);
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

    public function checkoutUser(){
        $I = $this->tester;
        $I->wait(2);
        $I->amOnPage(self::$URL1);
        $I->waitForElementVisible(self::$shippingMethodBankDeposit);
        $I->click(self::$shippingMethodBankDeposit);
        $I->click(self::$accountPaymentMethod);
        $I->click(self::$checkOutButton);
    }


}