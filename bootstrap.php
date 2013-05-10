<?php
/* EWSWrapper Bootstrap
 * ====================================================
 * @author Michal Korzeniowski <mko_san@lafiel.net>
 * @version 0.1
 * @date 08-2011
 * @website http://ewswrapper.lafiel.net/
 * ====================================================
 * Desciption
 * Autoload php-EWS classes
 * 
 * ==================================================*/
/**
 * Load Core Classes
 */
 
/* no longer required due to composer suppoer */
 
return;
 
include "EWSType.php";
include "NTLMSoapClient.php";
include "NTLMSoapClient/Exchange.php";
/**
 * Load All Types
 */
foreach ( glob( "EWSType/*.php" ) as $filename ) {
    include $filename ;
}
