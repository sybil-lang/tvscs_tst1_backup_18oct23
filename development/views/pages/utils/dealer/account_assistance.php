<rn:meta title="#rn:msg:ACCOUNT_ASSISTANCE_LBL#" template="dealer_login.php" login_required="false" redirect_if_logged_in="dealer/dashboard"/>
<style>
.rn_EmailCredentials form input[type="submit"]
    {
        background-color: #ed1b24;
    opacity: 1;
    width: 360px !important;
    height: 46px;
    border: 2px solid rgba(0, 0, 0, .03);
    border-radius: 25px;
    color: #fff;
    font-size: 13px;
    text-transform: uppercase;
    transition: all .45s ease-in-out 0s;
    margin: 5px 0;
    }
    .rn_EmailCredentials form input[type="text"]
    {
        margin-bottom:40px;
        padding:13px 0 13px 22px !important;
    border-radius: 50px !important;
    background: #fff!important;
    box-shadow: 5.634px 10.595px 30px rgba(0,0,0,0.1)!important;
    border: none !important;
    height: 40px !important;
    width: 360px !important;
    border: 1px solid rgba(0,0,0,0.05)!important;
    }
</style>
<div class="rn_Hero">
    <div class="rn_Container">
        <h1>#rn:msg:ACCOUNT_ASSISTANCE_LBL#</h1>
    </div>
</div>

<div class="rn_PageContent rn_Account rn_Container">
    <rn:widget path="custom/login/DealerEmailCredentials" label_input="Dealer Code" />
</div>
