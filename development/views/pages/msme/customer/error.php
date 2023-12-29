<rn:meta title="#rn:msg:ERROR_LBL#" template="standardlogincust.php" login_required="false" />
<?list($errorTitle, $errorMessage) = \RightNow\Utils\Framework::getErrorMessageFromCode(\RightNow\Utils\Url::getParameter('error_id'));?>
<h1><?=$errorTitle;?></h1>
<p><?=$errorMessage;?></p>
