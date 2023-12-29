<rn:meta title="#rn:msg:SUPPORT_HISTORY_LBL#" template="dealer_header.php" clickstream="incident_list" login_required="true" force_https="true" />
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('dealer');

?>
<style>
.rn_Hero .rn_HeroInner .rn_SearchControls .rn_SearchInput
    {
       margin-right: -0.64235%;

    }
    
    .rn_PaginationLinks ul {
    list-style-type: none;
   
  

    background-color: #333333;
}

.rn_PaginationLinks li {
    float: left;
}

.rn_PaginationLinks li a , .rn_PaginationLinks li span{
    display: block;
  padding-left:10px;
      padding-right:10px;
    text-align: center;
   
    text-decoration: none;
}

 .rn_PaginationLinks li a:hover {
  
}
</style>
<rn:container report_id="100415">
<div class="rn_Hero">
    <div class="rn_HeroInner">
        <div class="rn_SearchControls">
            <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
            <form onsubmit="return false;" class="translucent">
                <div class="rn_SearchInput">
                    <rn:widget path="search/KeywordText" label_text="#rn:msg:SEARCH_YOUR_SUPPORT_HISTORY_CMD#" label_placeholder="#rn:msg:SEARCH_YOUR_SUPPORT_HISTORY_CMD#" initial_focus="true"/>
                </div>
                <rn:widget path="search/SearchButton"/>
            </form>
            <div class="rn_SearchFilters">
               <!-- <rn:widget path="search/ProductCategorySearchFilter" />-->
                <rn:widget path="search/ProductCategorySearchFilter" filter_type="Category"/>
            </div>
        </div>
    </div>
</div>
<div class="rn_PageContent rn_Container">
    <h2 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_RESULTS_CMD#</h2>
    <rn:widget path="reports/ResultInfo"/>
    <rn:widget path="reports/Grid" label_caption="<span class='rn_ScreenReaderOnly'>#rn:msg:SEARCH_YOUR_SUPPORT_HISTORY_CMD#</span>"/>
    <rn:widget path="reports/Paginator"/>
</div>
</rn:container>
