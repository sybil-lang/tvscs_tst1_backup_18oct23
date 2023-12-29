<rn:meta title="#rn:msg:SUPPORT_HISTORY_LBL#" template="standard.php" clickstream="incident_list" login_required="true" force_https="true" />
<rn:container report_id="196">
    <style>
      .rn_PageContent
    {
        min-height:500px;
    }
    
.rn_Paginator ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
  
}

.rn_Paginator li {
    float: left;
}

.rn_Paginator li a,.rn_Paginator li span {
    display: block;
 
    text-align: center;
    padding: 16px;
    text-decoration: none;
}


    </style>
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
            <div class="rn_SearchFilters row">
              <div class="col-md-4">  <rn:widget path="search/ProductCategorySearchFilter" /></div>
              <div class="col-md-4">    <rn:widget path="search/ProductCategorySearchFilter" filter_type="Category"/></div>
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
