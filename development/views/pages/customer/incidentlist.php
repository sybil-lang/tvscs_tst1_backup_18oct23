<?php
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');
?>
<html>
<head>
<!-- <style>
.rn_AccountOverview h2{
padding: 0px !important;
}
th{
background-color: #3B6DB1;
color: #ffffff;
	}
</style> -->
</head>
<body>
<div class="rn_PageContent rn_AccountOverview rn_Container ">
    <div class="rn_ContentDetail full_width">
        <div class="rn_Questions">
            <rn:container report_id="196" per_page="4">
                <div class="rn_HeaderContainer">
						<div class="col-md-6">
								<h2><a class="rn_Questions" href="/app/account/questions/list#rn:session#">My Incidents List</a></h2>
						</div>
						<div class="col-md-6">
								<p style="padding-top:10px !important;float:right;">
									<a href="/app/raisequery"><button type="button" class="btn btn-primary btn-lg">Raise a Query</button></a>
								</p>
						</div>
                </div>
				<div class="col-xs-12 col-md-12">
					<rn:widget path="reports/Grid" label_caption="<span class='rn_ScreenReaderOnly'>#rn:msg:YOUR_RECENTLY_SUBMITTED_QUESTIONS_LBL#</span>"/>
				</div>
			<div class="col-xs-12 col-md-12">
                <a href="/app/account/questions/list#rn:session#">#rn:msg:SEE_ALL_MY_SUPPORT_QUESTIONS_LBL#</a>
			</div>
            </rn:container>
        </div>
        <!--<div class="rn_Discussions">
            <rn:container report_id="15156" per_page="4">
                <div class="rn_HeaderContainer">
                    <h2><a class="rn_Discussions" href="/app/social/questions/list/author/#rn:profile:socialUserID#/kw/*#rn:session#">#rn:msg:MY_DISCUSSION_QUESTIONS_LBL#</a></h2>
                </div>
                <rn:widget path="reports/Grid" static_filter="User=#rn:profile:socialUserID#" label_caption="<span class='rn_ScreenReaderOnly'>#rn:msg:YOUR_RECENTLY_SUBMITTED_DISCUSSIONS_LBL#</span>"/>
                <a href="/app/social/questions/list/author/#rn:profile:socialUserID#/kw/*#rn:session#">#rn:msg:SEE_ALL_MY_DISCUSSION_QUESTIONS_LBL#</a>
            </rn:container>
        </div>-->
    </div>
    
</div>
</body>
</html>