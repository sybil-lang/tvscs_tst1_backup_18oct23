<?php
$CI = &get_instance();
$CI->load->helper('report');
checkCustomerType('dealer');
$msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incident_UserStatus);
$report_id = $msg->Value;
?>
<html>
  <head>
    <style>
      .rn_AccountOverview h2{
        padding: 0px !important;
      }
      .yui3-datatable-table th{
        background-color: #3B6DB1;
        color: #ffffff;
      }

    </style>
    <style type="text/css">
      .rn_Body{
        min-height: 900px;
      }
    </style>
  </head>
  <body>
    <div class="rn_PageContent rn_AccountOverview rn_Container ">
      <div class="rn_ContentDetail full_width">
        <div class="rn_Questions">
          <rn:container report_id="100092" per_page="4">
            <div class="rn_HeaderContainer">
              <div class="col-md-6">
                <h2><a class="rn_Questions" href="/app/dealer/account/questions/list#rn:session#">Summary of WC Requests</a></h2>
              </div>
              <div class="col-md-6">
                <p style="padding-top:10px !important;float:right;">
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                  <span></span> <b class="caret"></b>
                </div>

                <script type="text/javascript">
                  var ddtable;
                  //$(function() {

                  var start = moment().subtract(29, 'days');
                  var end = moment();

                  var param = {
                    'startDate': start.toISOString(),
                    'endDate': end.toISOString()
                  }
                  function cb(start, end) {
                    var url = "/cc/DealerCustom/getWCDataList?startDate=" + start.toISOString() + "&endDate=" + end.toISOString();
                    ddtable.ajax.url(url).load();
                  }

                  $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                      'Today': [moment(), moment()],
                      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                      'This Month': [moment().startOf('month'), moment().endOf('month')],
                      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                  }, cb);
                  //cb(start, end);
                  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                  //});
                </script>
                </p>
              </div>
            </div>

            <div class="col-md-12">
                    <!--<rn:widget path="reports/Grid" label_caption="<span class='rn_ScreenReaderOnly'>#rn:msg:YOUR_RECENTLY_SUBMITTED_QUESTIONS_LBL#</span>" report_id="100092" date_format="date_time"/>-->
              <table id="ta_list" class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Incident ID</th>
                    <th>Reference #</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date Raised</th>
                    <th>Approver Status</th>
                    <th>Amount Requested</th>
                    <th>Processor Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Incident ID</th>
                    <th>Reference #</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date Raised</th>
                    <th>Approver Status</th>
                    <th>Amount Requested</th>
                    <th>Processor Status</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="col-md-12">
              <a href="/app/dealer/account/questions/list#rn:session#">#rn:msg:SEE_ALL_MY_SUPPORT_QUESTIONS_LBL#</a>
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
    <script type="text/javascript">
      console.log(param);
      ddtable = $('#ta_list').DataTable({
        "ajax": {
          url: "/cc/DealerCustom/getWCDataList",
          dataSrc: "",
          method: 'post',
          data: param
        },
        "columns": [
          {
            "data": "Incident ID",
            "defaultContent": "<i>Not set</i>"
          },
          {
            "data": "Reference #",
            "defaultContent": "<i>Not set</i>"
          },
          {
            "data": "Subject",
            "defaultContent": "<i>Not set</i>"
          },
          {
            "data": "Status",
            "defaultContent": "<i>Not set</i>"
          },
          {
            "data": "Date Raised",
            "defaultContent": "<i>Not set</i>"
          },
          {
            "data": "Approver Status",
            "defaultContent": "<i>Not set</i>"
          },
          {
            "data": "Amount Requested",
            "defaultContent": "<i>Not set</i>"
          },
          {
            "data": "Processor Status",
            "defaultContent": "<i>Not set</i>"
          }
        ],
        "bDestroy": true
      });
    </script>
  </body>
</html>