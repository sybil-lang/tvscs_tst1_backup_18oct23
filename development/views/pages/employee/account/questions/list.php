<rn:meta title="#rn:msg:SUPPORT_HISTORY_LBL#" template="employee_header.php" clickstream="incident_list" login_required="true" force_https="true" />
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');

?>
<style type="text/css">
.yui3-datatable-table th{
background-color: #3B6DB1;
color: #ffffff;
	}
.rn_SearchButton
    {
            position: relative;
    right: 26px;
    }
</style>
<rn:container report_id="196">
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
<div id="inci_table" class="rn_PageContent rn_Container">
    <h2 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_RESULTS_CMD#</h2>
    <rn:widget path="reports/ResultInfo"/>
    <rn:widget path="reports/Grid" label_caption="<span class='rn_ScreenReaderOnly'>#rn:msg:SEARCH_YOUR_SUPPORT_HISTORY_CMD#</span>"/>
    <rn:widget path="reports/Paginator"/>
</div>
<script type="text/javascript">
                    $(document).ready(function()
                                                    {
                                                        var a= document.getElementById('inci_table');
                                                        var ah = a.getElementsByTagName('a');
                                                        // ah[0].href="VM5133:3 https://tvscs--tst1.custhelp.com/app/msme/account/questions/detail/i_id/5979829";
                                                        for(var k=0;k<ah.length;k++)
                                                        {
                                                              // console.log(ah[k].href);
                                                              var href = ah[k].href.replace("app", "app/employee");
                                                              ah[k].href=href;
                                                              // console.log(ah[k].href);


                                                        }
                  
                                                    });
        </script>
</rn:container>
