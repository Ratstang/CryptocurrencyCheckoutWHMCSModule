<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}
/**
 * Module Meta Data
 *
 * @return array
 */
function cryptocurrencycheckout_MetaData()
{
    return array(
        'DisplayName' => 'CryptocurrencyCheckout',
        'APIVersion' => '1.1', // Use API Version 1.1
        'DisableLocalCredtCardInput' => true,
        'TokenisedStorage' => false,
    );
}
/**
 * Define gateway configuration options.
 *
 * @return array
 */
function cryptocurrencycheckout_config()
{
    return array(
        // the friendly display name for a payment gateway should be
        // defined here for backwards compatibility
        'FriendlyName' => array(
            'Type' => 'System',
            'Value' => 'CryptocurrencyCheckout',
        ),

        // a text field type allows for single line text input
        'PayNow' => array(
            'FriendlyName' => 'Pay Button',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Pay Now Button Text',
        ),

        // a text field type allows for single line text input
        'StoreName' => array(
            'FriendlyName' => 'Store Name',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your Unique Store Identifier',
        ),

        // a text field type allows for single line text input
        'StoreID' => array(
            'FriendlyName' => 'Store ID',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your Store ID here',
        ),

        // a password field type allows for masked text input
        'ConnectionID' => array(
            'FriendlyName' => 'Connection ID',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Enter your Connection ID  here',
        ),

        // a password field type allows for masked text input
        'APIToken' => array(
            'FriendlyName' => 'API Token',
            'Type' => 'text',
            'Size' => '100',
            'Description' => 'Enter your API Token  here',
        ),

        // a password field type allows for masked text input
        'btcAddress' => array(
            'FriendlyName' => 'BTC Address',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Must Match CryptocurrencyCheckout Dashboard',
        ),

        // a password field type allows for masked text input
        'ethAddress' => array(
            'FriendlyName' => 'ETH Address',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Must Match CryptocurrencyCheckout Dashboard',
        ),

        // a password field type allows for masked text input
        'ltcAddress' => array(
            'FriendlyName' => 'LTC Address',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Must Match CryptocurrencyCheckout Dashboard',
        ),
        // a password field type allows for masked text input
        'dashAddress' => array(
            'FriendlyName' => 'DASH Address',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Must Match CryptocurrencyCheckout Dashboard',
        ),
        // a password field type allows for masked text input
        'sendAddress' => array(
            'FriendlyName' => 'SEND Address',
            'Type' => 'text',
            'Size' => '25',
            'Default' => '',
            'Description' => 'Must Match CryptocurrencyCheckout Dashboard',
        ),
    );
}
/**
 * Payment link.
 *
 * @param array $params Payment Gateway Module Parameters
 *
 * @return string
 */
function cryptocurrencycheckout_link($params)
{
    // Gateway Configuration Parameters
    $StoreID = $params['StoreID'];
    $StoreName = $params['StoreName'];
    $ConnectionID = $params['ConnectionID'];
    $APIToken = $params['APIToken'];
    $PayNow = $params['PayNow'];
    $btcAddress = $params['btcAddress'];
    $ethAddress = $params['ethAddress'];
    $ltcAddress = $params['ltcAddress'];
    $dashAddress = $params['dashAddress'];
    $sendAddress = $params['sendAddress'];

    // Invoice Parameters
    $invoiceId = $params['invoiceid'];
    $amount = $params['amount'];

    // POST Fields
    $url = 'https://cryptocurrencycheckout.com/validation';
    $postfields = array();
    $postfields['CC_STORE_NAME'] = $StoreName;
    $postfields['CC_STORE_ID'] = $StoreID;
    $postfields['CC_CONNECTION_ID'] = $ConnectionID;
    $postfields['CC_API_TOKEN'] = $APIToken;
    $postfields['CC_ORDER_ID'] = $invoiceId;
    $postfields['CC_GRANDTOTAL'] = $amount;
    $postfields['CC_BTC_ADDRESS'] = $btcAddress;
    $postfields['CC_ETH_ADDRESS'] = $ethAddress;
    $postfields['CC_LTC_ADDRESS'] = $ltcAddress;
    $postfields['CC_DASH_ADDRESS'] = $dashAddress;
    $postfields['CC_SEND_ADDRESS'] = $sendAddress;

    $htmlOutput = '<form method="POST" action="' . $url . '">';
    foreach ($postfields as $k => $v) {
        $htmlOutput .= '<input type="hidden" name="' . $k . '" value="' . $v . '">';
    }
    $htmlOutput .= '<input type="submit" value="' . $PayNow . '">';
    $htmlOutput .= '</form>';

    return $htmlOutput;
}
