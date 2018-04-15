<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: autoload.php
 * Create: 2018/4/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

require( __DIR__ . '/BASE/SMBCRequest.php' );
require( __DIR__ . '/BASE/SMBCResponse.php' );
require( __DIR__ . '/BASE/SMBCNodeResponse.php' );
require( __DIR__ . '/BASE/SMBCContractResponse.php' );
require( __DIR__ . '/BASE/SMBCTransferResponse.php' );

require( __DIR__ . '/DATA/SMBCAccount.php' );
require( __DIR__ . '/DATA/SMBCContractTemplate.php' );
require( __DIR__ . '/DATA/SMBCContract.php' );
require( __DIR__ . '/DATA/SMBCTask.php' );
require( __DIR__ . '/DATA/SMBCBusinessHost.php' );
require( __DIR__ . '/DATA/SMBCAdministrator.php' );

require( __DIR__ . '/CONTRACT/SMBCToken.php' );
require( __DIR__ . '/CONTRACT/SMBCAssetToken.php' );
require( __DIR__ . '/CONTRACT/SMBCCurrencyToken.php' );
require( __DIR__ . '/CONTRACT/TokenDistributor.php' );
require( __DIR__ . '/CONTRACT/TokenSubscriber.php' );