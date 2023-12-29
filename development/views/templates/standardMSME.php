<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard" />

<head>
    <meta charset="utf-8" />
    <title>
        TVS Credit MSME
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
    <rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
    <rn:theme path="/euf/assets/themes/standard/css" css="site.css,style.css,styles.css,style-product.css,customerlogin-style.css,custom_dashboard.css,select.dataTables.min.css,dataTables.bootstrap.min.css
,buttons.dataTables.min.css" />
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <link rel="stylesheet" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/euf/assets/themes/standard/css/font-awesome.min.css">
    <!-- <script type="text/javascript" src="/euf/assets/themes/standard/js/jquery-1.10.2.min.js"></script> -->
    <!--<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap.js"></script>-->
    <link rel="stylesheet" href="/euf/assets/themes/standard/css/site.css">
    <link rel="stylesheet" href="/euf/assets/themes/standard/css/style.css">
    <link href="https://fonts.cdnfonts.com/css/gotham" rel="stylesheet">
    <rn:head_content />
    <link rel="icon" href="/euf/assets/themes/standard/Images-new/favicon.png" type="image/png" />
    <rn:widget path="utils/ClickjackPrevention" />
    <rn:widget path="utils/AdvancedSecurityHeaders" />
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"/> -->
    <!--<link rel="stylesheet" href="/euf/assets/themes/standard/css/custom-style.css"/>-->
    <script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>
    <link href="/euf/assets/Images-new/favicon.png" rel="shortcut icon">
    <script src="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">

    <!-- Google Fonts -->
    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700" rel="stylesheet">
    <link href="/euf/assets/themes/standard/css/style.css" rel="stylesheet">
    <link href="/euf/assets/themes/standard/css/style-product.css" rel="stylesheet">
    <link href="/euf/assets/themes/standard/css/customerlogin-style.css" rel="stylesheet">

    <style type="text/css">
        :root {
            font-family: 'Gotham', sans-serif;
            font-family: 'Gotham Black', sans-serif;
            font-family: 'Gotham Light', sans-serif;
            font-family: 'Gotham Thin', sans-serif;
            font-family: 'Gotham XLight', sans-serif;
            font-family: 'Gotham Book', sans-serif;
            font-family: 'Gotham Ultra', sans-serif;
        }

        .login {
            padding: 0px;
        }

        .card-block a {
            color: #0e8943;
        }

        /*.notification-heading h4 a, .notification-footer h4 a
        {
            color:#337ab7;
        }
        #dropacc
        {
                left: 21px;
        }
        #soacc
        {
            left: 0px;
        }
        .rn_LoginStatus
        {
            border: solid 1px black;
            height: 42px;
            border-radius: 5px;
        }

        .rn_SubNavigation, .rn_SubNavigation li
        {
                background: white;
            right:0px !important;

        }
        .rn_SubNavigation li a
        {
            color:black !important;
        }
       .rn_AccountDropdownTrigger
        {
            overflow:hidden;
            height:40px;
        }
        .rn_AccountDropdown{
            margin-right: 30px
        }*/
        /*.form-group .select_wrapper span, .form-group .select_wrapper ul,.form-group .select_wrapper li
        {
            display:none !important;
        }
        .form-group .select_wrapper select
        {
            display:block !important;
        }*/
        .in {
            background: none !important;
        }

        .customers_login #header1 #logo img {
            width: 200px;
        }

        .customers_login #header1 #logo {
            margin-top: 5px;
            margin-left: 85px;
        }

        #nav-menu-container {
            top: 1% !important;
            left: 25% !important;
        }

        .modal-content {
            height: 400px;
            overflow-y: scroll;
            position: fixed;
            top: -30px;
            width: 95%;
        }

        .setp {
            padding: 10px 0 13px 22px !important;
            border-radius: 50px !important;
            background: #fff !important;
            box-shadow: 5.634px 10.595px 30px rgba(0, 0, 0, 0.1) !important;
            border: none !important;
            height: 40px !important;
            width: 280px !important;
            font-size: 14px;
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
            /*margin-left: 20px; */
        }

        #myModal {
            overflow-y: auto;
            overflow-x: hidden;

        }

        #myModal div.timepicker-picker table.table-condensed tbody tr td button.button.btn.btn-primary,
        div.timepicker-picker table.table-condensed tbody tr td button.btn-primary.disabled {
            width: 8px !important;
        }

        .divider {
            position: initial !important;
        }

        .glyphicon-circle-arrow-right {
            position: initial !important;
        }

        .menu-title a {
            color: #337ab7;
        }

        .notifications .notifications-wrapper .content,
        .notification {
            right: 0% !important;
        }

        .notifications .notifications-wrapper .content .notification-item-read p.item-info {
            color: #337ab7;
        }

        .notifications .notifications-wrapper h5 {
            color: #337ab7;
            padding-bottom: 16px;
            font-size: 1.3em;
        }

        .nav-menu,
        .nav-menu * {
            right: 0%;
        }

        /*#rn_AccountDropdown_3_SubNavigation{
            background-color: #3e74ae;
        }*/
        @media (min-device-width: 1024px) {
            .customer_loginimg figure {
                width: 510px !important;
            }

            .image-blurred-edge {
                height: 340px !important;
            }
        }
    </style>

    <?php
    $CI = &get_instance();
    $CI->load->helper('report');
    $contact_id = $CI->session->getProfileData("c_id");
    //$bundle=$CI->session->getSessionData("previouslySeenEmail");
    $userProfile = $CI->session->getSessionData("userProfile");
    // echo"login".$userProfile['loginType'];
    // exit;
    if ($userProfile['loginType'] != "MSME" || $userProfile['loginType'] == "") {
        header('location:/app/customer/error/error_id/6');
        exit;
    }


    $getloan_filter = new RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
    $getloan_filter->Name = "ContactId";
    $getloan_filter->Values = array($contact_id);
    $status_filter = new RightNow\Connect\v1_3\AnalyticsReportSearchFilter;

    $filters = new RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
    $filters[0] = $getloan_filter;

    $ar = RightNow\Connect\v1_3\AnalyticsReport::fetch(100794);
    $arr = $ar->run(0, $filters);
    $getLoans_count = $arr->count();

    $bd = 0;

    if ($getLoans_count > 0) {
        $row = $arr->next();
        for ($ii = 0; $ii++ < $getLoans_count; $row = $arr->next()) {
            if ($row["BD Count"] != 0) {
                $bd++;
            }
        }
    }
    if ($bd > 0) {
        header("location:/app/msme/customer/logout/msg_code/1");
        exit;
    }


    $msg = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_LOAN_NOTIFICATIONS);
    $report_id = $msg->Value;



    //$contact_id=$bundle['sess_contact_id'];
    //$filter=array('Contact ID'=>7);
    // $notifications_count = 0;
    // if (strlen($contact_id)) {
    //  $filter = array('Contact ID' => $contact_id);
    //  $notificationResponse = report_result($report_id, $filter);
    //  //print_r($notificationResponse);
    //  $notifications_count = count($notificationResponse);
    // }
    // //echo "<h2>Notifications Details</h2><br><br>";
    // $notification_text = '';
    // $notification_counter = 0;
    // $notification_text .= '<div class="notification-item">
    //                                                      <p class="item-info">Our toll free no. has been changed. New no. is 1800 103 5005</p>
    //                                                    </div>
    //                                                    ';
    // if ($notifications_count > 0) {
    //  for ($i = 0; $i < $notifications_count && $i <= 10; $i++) {

    //      if (!empty($notificationResponse[$i]['Bounce Date'])) {
    //          if (strtolower($notificationResponse[$i]['Bounce Notification Read']) != 'yes') {
    //              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1"> 

    //                                                     <div class="notification-item">
    //                                                      <h4 class="item-title">Your Bounce Date is ' . ($notificationResponse[$i]['Bounce Date']) . '</h4>
    //                                                      <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
    //                                                    </div>

    //                                                  </a>';
    //              $notification_counter += 1;
    //          } else {
    //              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

    //                                                     <div class="notification-item-read">
    //                                                      <h4 class="item-title">Your Bounce Date is ' . ($notificationResponse[$i]['Bounce Date']) . '</h4>
    //                                                      <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
    //                                                    </div>

    //                                                  </a>';
    //          }
    //      }

    //      if (!empty($notificationResponse[$i]['Insurance Renewal Date'])) {
    //          if (strtolower($notificationResponse[$i]['Insurance Notification Read']) != 'yes') {
    //              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

    //                                             <div class="notification-item">
    //                                              <h4 class="item-title">Your Insurance Renewal Date is ' . ($notificationResponse[$i]['Insurance Renewal Date']) . '</h4>
    //                                              <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
    //                                            </div>

    //                                          </a>';
    //              $notification_counter += 1;
    //          } else {
    //              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

    //                                             <div class="notification-item-read">
    //                                              <h4 class="item-title">Your Insurance Renewal Date is ' . ($notificationResponse[$i]['Insurance Renewal Date']) . '</h4>
    //                                              <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
    //                                            </div>

    //                                          </a>';
    //          }
    //      }

    //      if (!empty($notificationResponse[$i]['Receipt Date'])) {
    //          if (strtolower($notificationResponse[$i]['Receipt Notification Read']) != 'yes') {
    //              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

    //                                                 <div class="notification-item">
    //                                                  <h4 class="item-title">Your Receipt Date is ' . ($notificationResponse[$i]['Receipt Date']) . '</h4>
    //                                                  <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
    //                                                </div>

    //                                              </a>';
    //              $notification_counter += 1;
    //          } else {
    //              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

    //                                                 <div class="notification-item-read">
    //                                                  <h4 class="item-title">Your Receipt Date is ' . ($notificationResponse[$i]['Receipt Date']) . '</h4>
    //                                                  <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
    //                                                </div>

    //                                              </a>';
    //          }
    //      }
    //      if (!empty($notificationResponse[$i]['Presentation Date'])) {
    //          if (strtolower($notificationResponse[$i]['Presentation Notification Read']) != 'yes') {

    //              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

    //                                             <div class="notification-item">
    //                                              <h4 class="item-title">Your Presentation Date is ' . ($notificationResponse[$i]['Presentation Date']) . ' </h4>
    //                                              <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
    //                                            </div>

    //                                          </a>';
    //              $notification_counter += 1;
    //          } else {
    //              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

    //                                             <div class="notification-item-read">
    //                                              <h4 class="item-title">Your Presentation Date is ' . ($notificationResponse[$i]['Presentation Date']) . ' </h4>
    //                                              <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
    //                                            </div>

    //                                          </a>';
    //          }
    //      }
    //  }
    // }
    ?>
    <!-- Google Tag Manager -->

    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':

                    new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],

                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =

                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);

        })(window, document, 'script', 'dataLayer', 'GTM-KBWP7ZJ');
    </script>

    <!-- End Google Tag Manager -->
</head>
<?php
// $CI = &get_instance();
// $CI->load->helper('report');

// //$bundle=$CI->session->getSessionData("previouslySeenEmail");
// $userProfile = $CI->session->getSessionData("userProfile");
// $msg = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_LOAN_NOTIFICATIONS);
// $report_id = $msg->Value;
// $contact_id = $CI->session->getProfileData("c_id");
// //$contact_id=$bundle['sess_contact_id'];
// //$filter=array('Contact ID'=>7);
// $notifications_count = 0;
// if (strlen($contact_id)) {
//  $filter = array('Contact ID' => $contact_id);
//  $notificationResponse = report_result($report_id, $filter);
//  //print_r($notificationResponse);
//  $notifications_count = count($notificationResponse);
// }
// //echo "<h2>Notifications Details</h2><br><br>";
// $notification_text = '';
// $notification_counter = 1;
// if ($notifications_count > 0) {
//  for ($i = 0; $i < $notifications_count && $i <= 10; $i++) {

//      if (!empty($notificationResponse[$i]['Bounce Date'])) {
//          if (strtolower($notificationResponse[$i]['Bounce Notification Read']) != 'yes') {
//              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

//                                                     <div class="notification-item">
//                                                      <h4 class="item-title">Your Bounce Date is ' . ($notificationResponse[$i]['Bounce Date']) . '</h4>
//                                                      <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
//                                                    </div>

//                                                  </a>';
//              $notification_counter += 1;
//          } else {
//              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

//                                                     <div class="notification-item-read">
//                                                      <h4 class="item-title">Your Bounce Date is ' . ($notificationResponse[$i]['Bounce Date']) . '</h4>
//                                                      <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
//                                                    </div>

//                                                  </a>';
//          }
//      }

//      if (!empty($notificationResponse[$i]['Insurance Renewal Date'])) {
//          if (strtolower($notificationResponse[$i]['Insurance Notification Read']) != 'yes') {
//              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

//                                             <div class="notification-item">
//                                              <h4 class="item-title">Your Insurance Renewal Date is ' . ($notificationResponse[$i]['Insurance Renewal Date']) . '</h4>
//                                              <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
//                                            </div>

//                                          </a>';
//              $notification_counter += 1;
//          } else {
//              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

//                                             <div class="notification-item-read">
//                                              <h4 class="item-title">Your Insurance Renewal Date is ' . ($notificationResponse[$i]['Insurance Renewal Date']) . '</h4>
//                                              <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
//                                            </div>

//                                          </a>';
//          }
//      }

//      if (!empty($notificationResponse[$i]['Receipt Date'])) {
//          if (strtolower($notificationResponse[$i]['Receipt Notification Read']) != 'yes') {
//              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

//                                                 <div class="notification-item">
//                                                  <h4 class="item-title">Your Receipt Date is ' . ($notificationResponse[$i]['Receipt Date']) . '</h4>
//                                                  <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
//                                                </div>

//                                              </a>';
//              $notification_counter += 1;
//          } else {
//              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

//                                                 <div class="notification-item-read">
//                                                  <h4 class="item-title">Your Receipt Date is ' . ($notificationResponse[$i]['Receipt Date']) . '</h4>
//                                                  <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
//                                                </div>

//                                              </a>';
//          }
//      }
//      if (!empty($notificationResponse[$i]['Presentation Date'])) {
//          if (strtolower($notificationResponse[$i]['Presentation Notification Read']) != 'yes') {

//              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

//                                             <div class="notification-item">
//                                              <h4 class="item-title">Your Presentation Date is ' . ($notificationResponse[$i]['Presentation Date']) . ' </h4>
//                                              <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
//                                            </div>

//                                          </a>';
//              $notification_counter += 1;
//          } else {
//              $notification_text .= '<a class="content" href="' . $site_url . '/app/msme/customer/selfserviceview/notification/1">

//                                             <div class="notification-item-read">
//                                              <h4 class="item-title">Your Presentation Date is ' . ($notificationResponse[$i]['Presentation Date']) . ' </h4>
//                                              <p class="item-info">For Agreement No ' . $notificationResponse[$i]['Agreement No'] . '</p>
//                                            </div>

//                                          </a>';
//          }
//      }
//  }
// }
?>

<body>
    <!-- Google Tag Manager (noscript) -->

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBWP7ZJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <!-- End Google Tag Manager (noscript) -->
    <div id="wrapper" class="customers_login">
        <header id="header1">
            <div class="container1">
                <div id="logo" class="pull-left">
                    <a class="" href="http://183.87.127.174:8787/"><img src="/euf/assets/themes/standard/Images-new/TVSCSlogo.png" alt="TVS Credits" /s></a>
                    <!-- Uncomment below if you prefer to use a text image -->
                    <!--<h1><a href="#hero">Header 1</a></h1>-->
                </div>
                <div class="pull-right login-search-panel">
                    <ul class="nav-menu navbar-right primary-menu">
                        <li class="dropdown search-slide" id="soacc">
                            <div class="social-statuses"><span> </span><a href="https://www.facebook.com/TVSCREDIT" target="_blank"><i class="fa fa-facebook round facebook"></i></a> <a href="https://twitter.com/TVSCredit" target="_blank"><i class="fa fa-twitter round twitter"></i></a> <a href="https://www.linkedin.com/company-beta/1481214?pathWildcard=1481214" target="_blank"><i class="fa fa-linkedin round linkedin"></i></a>
                            </div>
                        </li>
                        <li id="dropacc">
                            <div class="rn_LoginStatus">
                                <rn:condition logged_in="true">
                                    <!-- "#rn:msg:ACCOUNT_OVERVIEW_LBL# -->
                                    <rn:widget path="login/AccountDropdown" subpages=" Profile Information > msme/account/overview, #rn:msg:SUPPORT_HISTORY_LBL# > msme/account/questions/list, #rn:msg:ACCOUNT_SETTINGS_LBL# > msme/account/profile" />
                                    <script type="text/javascript">
                                        var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
                                        $(document).ready(function() {
                                            if (width <= 480) {
                                                $('.rn_DisplayName').html('<i class="fa fa-user-circle testcs" aria-hidden="true" style="font-size:20px"></i>');
                                                $("#soacc").css("display", "none");
                                                // $('.testcs').css("display","none");
                                            }
                                        });
                                    </script>
                                </rn:condition>
                            </div>
                        </li>
                        <li id="notacc">
                            <rn:condition logged_in="true">

                                <div class="dropdowns">
                                    <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                                        <div class="notification"></div>
                                    </a>
                                    <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">

                                        <div class="notification-heading">
                                            <h4 class="menu-title">Notifications</h4>
                                            <!-- <h4 class="menu-title pull-right"><a href="#">View all</a><i class="glyphicon glyphicon-circle-arrow-right"></i></h4> -->
                                        </div>
                                        <li class="divider"></li>
                                        <div class="notifications-wrapper" style="height: fit-content;word-break: normal;white-space: normal;margin:10px;">

                                            <?php echo "<br/><h5>Hi! Now get your loan related information, download statements, apply for a new loan and do much more anytime, anywhere with our new WhatsApp Chatbot services. <a href='https://wa.me/916385172692' style='padding:1px !important;color:blue;font-weight:bold;font-size:14px;' target='_blank'>Click to explore</a> or save our WhatsApp no. 6385172692. Start by saying Hi.</h5>";
                                            echo "<hr/><br/><h5>Go Green. Go paperless! We have introduced E-receipt. Now get payment confirmation receipt through SMS on your registered number instead of paper receipt.</h5>";
                                            echo "<hr/><br><h5>Our toll free no. has been changed. New no. is 1800 103 5005.</h5>" . $notification_text; ?>

                                        </div>
                                        <li class="divider"></li>
                                        <div class="notification-footer">
                                            <h4 class="menu-title"><a href="#">View all</a><i class="glyphicon glyphicon-circle-arrow-right"></i></h4>
                                        </div>
                                        <!-- <?php echo $site_url; ?>/app/msme/customer/selfserviceview/notification/1 -->
                                    </ul>
                                </div>
                            </rn:condition>
                        </li>

                        <li class="dropdown login-dropdown logins-dropdown hover-dropdown customermain_login  hidden-md visible-sm visible-xs">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="/euf/assets/themes/standard/Images-new/mobile_icon/dropdown icon.png" class="img-responsive hovers-back" alt="dots">
                                <img src="/euf/assets/themes/standard/Images-new/mobile_icon/dropdown icons.png" class="img-responsive hovers-no" alt="dots" style="display:none">
                                <span class="mobile-nav-title"></span>
                            </a>
                            <ul class="dropdown-menu slide-animate" style="margin-right:2px;">
                                <li>
                                    <div class="contact-info">
                                        <div class="contacts">
                                            <p id="a"><img src="/euf/assets/themes/standard/Images-new/mobile_icon/contact-us icon.png">Contact Us: <a href="callto://+18001035005">1800 103 5005</a></p> (Toll Free)
                                        </div>
                                    </div>
                                </li>
                                <!-- <li><div class="contact-info">
 <div class="contacts"><p> <img src="/euf/assets/themes/standard/Images-new/mobile_icon/message-icon.png"><a href="mailto:Helpdesk@tvscredit.com">Helpdesk@tvscredit.com</a></p>
      </div>
      </div></li>-->
                                <li>
                                    <div class="contact-info  text-capitalize">
                                        <div class="contacts">
                                            <p><a href="https://wa.me/916385172692">WhatsApp no. : 6385172692 (Say "Hi")</a></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-info  text-capitalize">
                                        <div class="contacts">
                                            <p><a href="http://183.87.127.174:8484/about-us/">about us</a></p>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="contact-info text-capitalize">
                                        <div class="contacts">
                                            <p> <a href="http://183.87.127.174:8484/investor/"> investors</a></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-info text-capitalize">
                                        <div class="contacts">
                                            <p> <a href="http://183.87.127.174:8484/careers/">careers</a></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <nav id="nav-menu-container" class="hidden-xs ">
                    <div class="row">
                        <div class="contact-info">
                            <div class="contacts">
                                <p><img src="/euf/assets/themes/standard/Images-new/contact-us icon.png">Contact Us: <a href="callto://+18001035005">1800 103 5005</a></p> (Toll Free)
                            </div>
                        </div>
                        <div class="contact-info">
                            <div class="contacts">
                                <p><img src="/euf/assets/themes/standard/Images-new/time-icon.png"><span id="reg">9:00AM to 7:00PM
                                    </span></p>
                            </div>
                        </div>
                        <div class="contact-info">
                            <div class="contacts">
                                <p><i class="fa fa-whatsapp" aria-hidden="true" style="font-size: 18px;opacity: 0.45;"></i><span id="reg">WhatsApp no. : 6385172692 (Say "Hi")
                                    </span></p>
                            </div>
                        </div>
                        <div class="contact-info">
                            <div class="contacts">
                                <p> <img src="/euf/assets/themes/standard/Images-new/message-icon.png"><a href="mailto:helpdesk@tvscredit.com">helpdesk@tvscredit.com</a></p>
                            </div>
                        </div>

                    </div>
                </nav>
                <!--  <nav id="secondary-nav" class="hidden-xs hidden-sm">

      <div class="row">

      <div class="inline-block">
 <div class="contacts"><p> <a href="http://183.87.127.174:8484/about-us/">about us</a></p>
      </div>
      </div>

        <div class="inline-block">
 <div class="contacts"><p> <a href="http://183.87.127.174:8484/investor/"> investors</a></p>
      </div>
      </div>
         <div class="inline-block">
<div class="contacts"><p> <a href="http://183.87.127.174:8484/careers/">careers</a></p>  </div>
      </div>


      </div>


      </nav>-->
            </div>
        </header>
        <div class="second-nav customer-service-info">
            <div class="row">

                <!--div class="wrapper"-->


                <!-- Start Chat -->
                <div class="col-md-offset-4 col-md-3">
                    <style type="text/css">
                        .rn_Chat {
                            margin-left: 10px;
                        }
                    </style>
                    <!-- <rn:widget path="chat/ConditionalChatLink" /> -->
                    <!-- <rn:widget path="chat/ConditionalChatLink" min_sessions_avail="1" chat_login_page="/app/msme/chat/chat_launch" label_default="Chat directly with a member of our support team." sub_id="conditionalChat"/>-->
                    <!-- <script id="gs-sdk" src='//www.buildquickbots.com/botwidget/v3/demo/static/js/sdk.js?v=3' key="048009c1-d806-4932-b4ce-a5a248921c9a" callback="tAInit"></script> -->
                    <script type="text/javascript">
                        window.ymConfig = {
                            "bot": "x1661764681102",
                            "host": "https://chatbotcld.tvscredit.com"
                        };
                        (function() {

                            var w = window,
                                ic = w.YellowMessenger;
                            if ("function" === typeof ic) ic("reattach_activator"), ic("update", ymConfig);
                            else {

                                var d = document,
                                    i = function() {
                                        i.c(arguments)
                                    };

                                function l() {

                                    var e = d.createElement("script");
                                    e.type = "text/javascript", e.async = !0, e.src = "https://chatbotcld.tvscredit.com/assets/plugin/widget-v2/latest/dist/main.min.js";
                                    var

                                        t = d.getElementsByTagName("script")[0];
                                    t.parentNode.insertBefore(e, t)

                                }
                                i.q = [], i.c = function(e) {
                                    i.q.push(e)
                                }, w.YellowMessenger = i, w.attachEvent ? w.attachEvent("onload", l) : w.addEventListener("load", l, !1)

                            }

                        })();
                    </script>

                </div>
                <!-- End Chat -->

                <!-- Start Search -->
                <div class="col-sm-12 col-md-12 col-lg-12" style="display:flex;justify-content:flex-end;">
                    <div class="rn_SearchControls">
                        <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
                        <form method="get" action="/app/msme/results">
                            <rn:container source_id="KFSearch">
                                <div class="rn_SearchInput">
                                    <rn:widget path="searchsource/SourceSearchField" initial_focus="true" />

                                </div>
                                <rn:widget path="searchsource/SourceSearchButton" search_results_url="/app/msme/results" />
                            </rn:container>
                        </form>
                    </div>
                </div>

                <!-- End OF Search -->
            </div>
        </div>

        <rn:condition logged_in="true">
            <?php
            if ($userProfile['cType'] == 'Customer') { ?>
                <header>
                    <style type="text/css">
                        @media screen and (max-device-width: 480px) and (orientation: portrait) {
                            .row {
                                margin-left: 0px !important;
                                margin-right: 0px !important;
                            }

                            #rn_NavigationMenuButtonToggle {
                                display: none;
                            }

                            .nav-menu li {
                                float: left;
                            }

                            .table>thead:first-child>tr:first-child>th {
                                color: white;
                            }

                            .customers_login #header1 #logo {
                                margin-top: 5px;
                            }

                            .customers_login #header1 .container1 {
                                background: url(/euf/assets/themes/standard/Images-new/navbar1.png) 70px -38px no-repeat;
                            }

                            .customers_login #header1 #logo img {
                                width: 160px;
                                margin-left: 0px;
                            }

                            /*#btnsubmit{
                    margin-left:20px;
                }*/

                            #menub {
                                overflow: hidden;
                                max-height: 0;
                                padding: 0;
                                margin: 0 auto;
                                transition: all 0.3s ease;
                                -webkit-transition: all 0.3s ease;
                            }

                            #frmreferral {
                                margin-left: 20px;
                            }

                            #rn_NavigationMenuButtonToggle:checked+#menub {
                                max-height: 500px;
                            }

                            .rn_NavigationMenuButton {
                                cursor: pointer;
                            }

                            .primary-menu .dropdown-menu {
                                margin-right: -58px;
                            }

                            .dropdown-menu .notifications {
                                margin-right: -40px !important;
                                top: 6px !important;
                            }

                            .notifications {
                                min-width: 355px !important;
                            }

                            .dropdown-menu .notifications .notification-heading {
                                transform: scale(0.8);
                            }

                            .notifications-wrapper {
                                transform: scale(0.8);
                            }

                            .notification-footer {
                                transform: scale(0.8);
                            }

                            article {
                                display: block;
                                text-align: left;
                                width: 100% !important;
                                margin: 0 auto;
                                margin-left: 30px !important;
                            }
                        }

                        header nav .rn_NavigationBar .rn_NavigationMenu li a.rn_SelectedTab {
                            color: #FFF;
                            border: 0px solid #313e52;
                            text-align: center;
                        }

                        .adjustment {
                            float: right;
                            clear: both;
                            position: absolute;
                            padding-top: 5px;
                        }

                        .adjustment:hover {
                            color: white;
                        }
                    </style>
                    <nav>
                        <div class="rn_NavigationBar">
                            <label class="rn_NavigationMenuButton" for="rn_NavigationMenuButtonToggle"> #rn:msg:MENU_LWR_LBL# </label>
                            <input type="checkbox" id="rn_NavigationMenuButtonToggle" class="rn_ScreenReaderOnly" />
                            <ul class="rn_NavigationMenu" id="menub">
                                <!-- <li>
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <rn:widget path="navigation/NavigationTab" label_tab="Home" link="/app/msme/#rn:config:CP_HOME_URL#" pages="home"/>
                        </li> -->
                                <li>
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url; ?>/app/msme/customer/dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-share-alt-square" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url; ?>/app/msme/customer/selfserviceview">Self-Service</a>
                                </li>
                                <li>
                                    <i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url; ?>/app/msme/customer/value-added">Value-Added Services</a>
                                </li>
                                <!-- <li>
                            <i class="fa fa-google-wallet" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url; ?>/app/msme/customer/wallet">Wallet</a>
                        </li> -->
                                <li>
                                    <i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url; ?>/app/msme/account/profile">Profile</a>
                                </li>
                                <li>
                                    <i class="fa fa-question" aria-hidden="true"></i>&nbsp;
                                    <rn:widget path="navigation/NavigationTab" label_tab="Support" link="/app/msme/raisequery" pages="raisequery, ask_confirm" />
                                </li>
                                <!--<li>
                            <i class="fa fa-question-circle-o" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url; ?>/app/msme/answers/list">FAQ</a>
                        </li>-->
                                <!-- <li>
                            <i class="fa fa-phone"></i>&nbsp;<a href="javascript:void();"data-toggle="modal" data-target="#myModal">Call me Back</a>
                        </li> -->
                            </ul>
                        </div>

                        <!--  <rn:condition hide_on_pages="home, public_profile, results, answers/list, social/questions/list">
            <div class="rn_SearchBar">
                <rn:widget path="search/SimpleSearch" report_page_url="/app/msme/results"/>
            </div>
        </rn:condition>-->
                    </nav>
                </header>
    </div>
<?php } ?>
</rn:condition>

<rn:widget path="utils/CapabilityDetector" />

<div class="rn_Body">
    <div class="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
        <rn:page_content />
    </div>
</div>
<footer class="rn_Footer">
    <style type="text/css">
        .icon .fa {
            position: relative;
            top: 0px;
            font-size: 20px;
        }

        @media screen and (max-device-width: 480px) and (orientation: portrait) {
            #newi {
                float: left;
                padding: 0px !important;
                width: 100%;
                margin-left: 20px;
            }

            #newd {
                margin: 0px 11px 0px 0px;
            }

            .col-md-4 .rn_SearchControls .rn_SourceSearchButton .rn_SubmitButton {
                margin-right: 4%;
            }

            .row {
                margin-left: 0px !important;
                margin-right: 0px !important;
            }

            .deals {
                margin: 10px;
            }

            .form-group input {
                width: 100% !important;
            }

            .z-container {
                min-height: 500px !important;
            }

            .form-group .verifyotp {
                left: 270px !important;
            }

            div.dataTables_wrapper div.dataTables_filter input {
                width: 80%;
                background-position: center right;
                padding: 0 0 !important;
                margin-left: 0px !important;
            }

            .full_width {
                width: 100% !important;
            }

            .rn_AccountDropdown .rn_SubNavigation {
                background-color: #164e89;
            }

            .bootbox-body {
                margin-top: 100px
            }

            .rn_FormSubmit {
                padding-top: 0px;
            }

            .rn_FormSubmit button {
                width: 100%;
                margin: 10px 35px !important;
            }

            .rn_AccountDropdown .rn_SubNavigation>li:hover {
                background-color: white;
                color: #164e89;
            }

            #logo {
                margin-left: 85px;
            }

            .rn_LoginForm .input,
            .login span.icon {
                vertical-align: inherit;
                margin-top: 11px;
                margin-left: 0px;
            }

            .paginate_button a {
                margin-right: 0px !important;
                margin-left: 0px !important;
            }

            div.dataTables_wrapper div.dataTables_paginate {
                margin: 0;
                white-space: nowrap;
                /*text-align: right;*/
            }
        }

        .login span.icon {
            width: 34px;
            transition: all 800ms;
            text-align: center;
            color: #fff;
            height: 40px;
            border-radius: 0 3px 3px 0;
            background: #054fa4;
            height: 28px;
            line-height: 27px;
            display: inline-block;
            border: solid 1px #054fa4;
            border-left: none;
            font-size: 14px;
        }

        .verifyotp {
            left: 230px;
        }

        .rn_LoginOtp .btn {
            width: 325px !important;
        }

        .rn_LoginOtp h3 {
            position: relative;
            left: 0px !important;
            width: 212px;
            margin: 0 auto;
        }

        input[type="search"] {
            margin-right: 20px;
        }

        form>button[type=submit] {
            width: 280px !important;
            margin-left: 48px;
            border-radius: 25px;
            color: white;
            line-height: 27px;
            font-size: larger;
            height: 40px;
            background-color: #0e8943;
        }

        .customer_loginimg figure {
            width: auto;
        }

        .rn_LoginForm .btn {
            border: none;
            outline: none;
            background: #054fa4;
            border-bottom: solid 1px #054fa4;
            font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, ' sans-serif';
            margin: 0 auto;
            display: block;
            height: 30px;
            float: left;
            width: 56%;
            border-radius: 4px;
            font-size: 14px;
            color: #FFF;
            padding: 0px 3px;
        }

        .rn_LoginOtp .input {
            width: 325px !important;
        }

        .rn_StandardLogin {
            /*transform: scale(0.90);*/
        }

        .col-md-4 .rn_SearchControls .rn_SourceSearchButton .rn_SubmitButton:active {
            width: 33px !important;
        }

        .rn_LoginForm .input {
            background: #fff;
            transition: all 800ms;
            width: 88%;
            border-radius: 3px 0 0 3px;
            font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, ' sans-serif';
            border: solid 1px #054fa4;
            border-right: none;
            outline: none;
            color: #000000;
            height: 27px;
            line-height: 27px;
            display: inline-block;
            padding-left: 5px;
            font-size: 14px;
        }

        .rn_SourceSearchField {
            width: 360px;
            padding: 0 !important;
            margin-top: 10px !important;
        }

        input[type=text],
        input[type=password],
        .btn {
            margin-top: 2px;
            border-radius: 5px;
            width: 95%;
        }

        .icon .fa {
            position: relative;
            top: 0px;
        }

        .rn_SearchControls .rn_SearchInput {
            float: unset;
            display: block;
            margin-right: 0;
            width: auto;
        }

        .rn_SourceSearchField input {
            /*width: auto !important;*/
            padding: 13px 0 13px 22px !important;
            border-radius: 50px !important;
            background: #fff !important;
            /* box-shadow: 0 20px 30px 0 rgba(0, 0, 0, .03)!important; */
            border: none !important;
            background-color: #f3f3f3 !important;
            height: 40px !important;
            float: right;
        }

        input[type=file] {
            width: 280px !important;
            background-color: rgba(69, 124, 181, .51);
            color: #fff;
            opacity: 1;
        }

        .rn_SideRail {
            width: auto;
        }

        .rn_SearchControls .rn_SourceSearchButton .rn_SubmitButton {
            position: absolute;
            top: 13px;
            right: 0px;
            padding: 10px 13px;
            background-image: -moz-linear-gradient(135deg, #6296ce 0, #114984 100%);
            background-image: -webkit-linear-gradient(135deg, #6296ce 0, #114984 100%);
            background-image: -ms-linear-gradient(135deg, #6296ce 0, #114984 100%);
            box-shadow: none;
            border-radius: 100px;
            text-align: center;
            background-image: url(/euf/assets/themes/standard/Images-new/Search-icon.png);
            height: 33px;
            width: 33px;
            background-position: 384px -1px;
            border: none;
            display: inline;
            bottom: 0;
        }

        .customers_login #header1 .container1 {
            background: url(/euf/assets/themes/standard/Images-new/navbar1.png) 70px -38px no-repeat;
            height: 81px;
            background-color: white;
            margin-left: -90px;
            /* background-size: 100% 100%; */
        }

        ul.nav-menu li.search-slide {
            right: 0px;
        }

        .nav-menu {
            margin: 0;
            padding: 0;
            list-style: none;
            right: 7%;
        }

        #header1 li.login-dropdown {
            float: right !important;
            /*right: -10px;*/
            margin-top: -1px;
        }

        .customers_login #header1 #logo img {
            max-height: 42px;
            width: 160px;
        }

        #supportchatwidget .rectangular-widget {
            width: 250px;
            border-radius: 10px !important;
            height: 65px;
            position: fixed;
            bottom: 25px;
            right: 25px;
            text-align: left;
            line-height: 65px;
            cursor: pointer;
            background-color: #3498db;
            color: #000000;
            font-weight: 700;
            font-size: 14px;
            z-index: 10000;
        }

        .nav-menu li.login-dropdown>a:hover {
            background-color: #114984;
        }

        .rn_LoginOtp {
            width: 100%;
            background: #000;
            margin-top: 40px;
            margin-bottom: 20px;
            background: #ffffff;
            overflow: hidden;
            border-radius: 7px;
            z-index: 999;
            float: none;
            margin-left: -15px;
        }

        .float input[type="text"] {
            color: black;
        }

        .form-group {
            margin-top: 2px !important;
            margin-bottom: 2px !important;
            padding-left: 0px !important;
        }

        .modal-content {
            height: 400px;
            overflow-y: scroll;
            position: fixed;
            top: -30px;
            width: 390px;
        }

        #call-back {
            margin-right: 10px;
        }

        .image-blurred-edge {
            background-image: url(/euf/assets/themes/standard/Images-new/Customer_Login.png);
            height: 241px !important;
            box-shadow: 0 0 8px 8px #fefefe inset;
            background-size: 100%;
            background-repeat: no-repeat;
            margin-left: 29px;
            margin-top: 10px;
        }

        #contact_number {
            width: 100% !important;
        }

        .modal-header .close {
            margin-top: 10px;
        }

        #newd {
            float: right;
            padding-left: 4%;
            padding-bottom: 5%;
        }

        .rn_SourceSearchField input[type="search"] {
            position: unset !important;
            margin-right: 20%;
        }

        .login-search-panel {
            margin-right: 0;
            margin-top: 4px;
        }

        .slide-animate li {
            /*position: relative;*/
            left: -50px;
        }

        .login-dropdown .contacts {
            margin: 0 35px;
            color: #000;
            font-size: 12px;
        }

        .rn_TextInput {
            margin-left: 20px;
        }

        /*.rn_Email{
                width: 280px !important;
            }*/
        .dropdown-menu .notifications {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row-reverse;
        }

        .notification-heading>.menu-title {
            transform: scale(0.9);
        }

        .notification-wrapper {
            transform: scale(0.75);
        }

        /*select{
                background-color: white;
                border: 0px;
                box-shadow: 2px 2px 10px 2px rgba(0, 0, 0, 0.14)!important;
                border-radius: 30px;
            }*/
        select {
            background-color: white;
            border: 0px;
            box-shadow: 2px 2px 10px 2px rgba(0, 0, 0, 0.14) !important;
            border-radius: 30px;
            width: 280px !important;

        }

        .btn-group,
        .btn-group-vertical {
            position: relative;
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
        }

        .customer_loginimg figure {
            width: auto;
        }

        .rn_SearchInput input[type="search"] {
            width: 280px !important;
        }

        }

        .nav-menu,
        .nav-menu * {
            margin: 0;
            padding: 0;
            list-style: none;
            right: 0px !important;
        }

        .rn_SubNavigation {
            background-color: #3e75af;
        }

        .rn_SubNavigation>li>a {
            width: 100%;
        }
    </style>
    <rn:condition logged_in="true">
        <style type="text/css">
            thead {
                background-color: #114984 !important;
            }

            a {
                color: #114984;
            }

            div.notification.notify.show-count::after {
                background-color: #0e8943;
            }

            .rn_Footer {
                background-color:
            }

            @media screen and (max-device-width: 480px) and (orientation: portrait) and (min-device-width: 360px) {

                html,
                body {
                    height: 100%;
                    margin: 0;
                }

                thead {
                    background-color: #114984 !important;
                }

                .deals {
                    margin: 10px;
                }

                #initialloanamount {
                    background-color: inherit;
                }

                #instrumentdetails_docs .row {
                    margin-right: 0px;
                    margin-left: 0px;
                    text-align: center;
                }

                #instrumentdetails_docs .row .col-md-4 {
                    margin-top: 20px;
                }

                .modal-content {
                    width: 340px;
                }

                .rn_Input {
                    margin-left: 20px;
                }

                .testcs {
                    display: inline-block !important;
                }

                fieldset {
                    height: auto;
                }

                .login-search-panel {
                    margin-right: 0;
                    margin-top: 5px;
                }

                .nav-menu,
                .nav-menu * {
                    margin: 0;
                    padding: 0;
                    list-style: none;
                    right: 0px !important;
                }

                .nav-menu.primary-menu a.active,
                .nav-menu.primary-menu a:hover {
                    opacity: 1;
                    background: #1d67b5;
                    color: white;
                    /* color: #114984; */
                    /* padding: 10px 18px; */
                }

                #soacc {
                    margin-right: 55px;
                    margin-top: 5px;
                }

                #dropacc {
                    margin-top: 3px;
                }

                #notacc {
                    margin-top: -4px;
                }

                .rn_FormSubmit button {
                    background-color: #0e8943;
                    opacity: 1;
                    width: 280px;
                    height: 40px;
                    border: 2px solid rgba(0, 0, 0, .03);
                    border-radius: 25px;
                    color: #fff;
                    font-size: 13px;
                    text-transform: uppercase;
                    transition: all .45s ease-in-out 0s;
                    margin-left: 50px;
                }

                .dropdown-menu .notifications {
                    display: flex;
                    flex-wrap: wrap;
                    flex-direction: row-reverse;
                }

                .notification-heading>.menu-title {
                    transform: scale(0.9);
                }

                .notification-wrapper {
                    transform: scale(0.75);
                }

                input[type=file],
                input[type=text] {
                    width: 280px !important;
                    background-color: rgba(255, 255, 255, .51);
                    color: #000;
                    opacity: 1;
                    margin-bottom: 10px;
                }

                .rn_SideRail {
                    width: auto !important;
                }

                #rn_CreateAccount button[type=submit] {
                    width: 87% !important;
                    margin-left: 48px;
                    border-radius: 25px;
                    color: white;
                    line-height: 27px;
                    font-size: larger;
                    height: 40px;
                    background-color: #0e8943;
                }

                /*#strLoginAgrmnt,#refProduct{
                    border-radius: 30px 0px 0px 30px;
                }*/
                select {
                    background-color: white;
                    border: 0px;
                    box-shadow: 2px 2px 10px 2px rgba(0, 0, 0, 0.14) !important;
                    border-radius: 30px;
                    max-width: 280px;
                }

            }

            @media screen and (min-device-width: 768px) {
                .customers_login #nav-menu-container {
                    left: 18% !important;
                }

                .contacts p,
                .contacts {
                    margin: 0 4px !important;
                }
            }

            #wrapper,
            body {
                font-family: Gotham Light !important;
            }

            #reg {
                font-family: Gotham Light !important;
            }

            .fa-share-alt-square:before,
            .fa-tachometer:before,
            .fa-line-chart:before,
            .fa-vcard-o:before,
            .fa-address-card-o:before,
            .fa-question:before {
                font-size: 20px;
            }

            .rn_SearchControls .rn_SourceSearchButton .rn_SubmitButton {
                top: 14px;
                right: 90px;
            }
        </style>
    </rn:condition>
    <div class="rn_Container">
        <div class="footer-bottom text-center">
            <div class="container">
                <div class="pull-center">
                    <div class="row">
                        <ul>
                            <li class="pull-left"><a href="http://www.tvscredit.co.in/termsandcondition.aspx" target="_blank">Terms and Conditions</a>| <a href="http://www.tvscredit.co.in/privacypolicy.aspx" target="_blank">Privacy Policy</a></li>
                            <li><a href="/#" style="pointer-events:none;">
                                    Copyright © 2018 All rights reserved by TVS Credit Services Limited. </a></li>
                            <li class="pull-right"><a href="mailto:helpdesk@tvscredit.com"> helpdesk@tvscredit.com </a></li>

                        </ul>
                    </div>
                </div>
                <!--<div class="row">
                          <div class="col-md-12">
                            <ul>



                            </ul>
                          </div>
                        </div>-->
            </div>
        </div>
    </div>
</footer>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">TVS - Call Request</h4>
            </div>
            <p id="response_text"></p>
            <form id="frmcall" name="frmcall" method="post">
                <div class="modal-body" id="model_body">

                    <div class="form-group" id="agrsel">
                        <!--<label for="exampleSelect1">Agreement Number</label>-->
                        <rn:widget path="custom/input/agreementSelect/" name="agreementno" required="true" label_input="Agreement Number" />
                    </div>
                    <div class="form-group" id="pcon">
                        <label for="exampleInputEmail1">Preferred contact no.</label>
                        <input type="number" class="form-control" id="contact_number" name="contact_number" maxlength="10" required>
                        <small id="emailHelp" class="form-text text-muted">&nbsp;</small>
                    </div>


                    <!-- <div class="form-group" id="dtsp">
                                <label for="datetimepicker">Preferred Date/Time to speak</label>
                                <div class='input-group date' id='datetimepicker8'>
                                    <input type='text' class="form-control" name="datetime_speak" id="datetime">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar">
                                        </span>
                                    </span>
                                </div>

                        <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker8').datetimepicker({
                                    icons: {
                                        time: "fa fa-clock-o",
                                        date: "fa fa-calendar",
                                        up: "fa fa-arrow-up",
                                        down: "fa fa-arrow-down"
                                    },
                                    minDate : 'now'
                                });
                            });
                        </script>
                    </div> -->

                    <div class="form-group" id="areq">
                        <label for="exampleTextarea">Assistance required</label>
                        <textarea class="form-control" id="assistance" name="assistance" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer" id="modal-button">
                    <button type="button" class="btn btn-success" style="margin:2px; border-radius: 30px;" id="call_back">Submit</button>
                    <style type="text/css">
                        .btn-default {
                            background-color: black;
                            color: white;
                        }

                        .btn-default:hover {
                            color: black;
                            background-color: white;
                        }
                    </style>
                    <button type="button" class="btn btn-danger" style="border-radius: 30px;" data-dismiss="modal">Close</button>

                </div>
                <div id="after-submit" style="display:none;"><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button></div>
            </form>
        </div>

    </div>
</div>
<!-- Modal -->

<style type="text/css">
    .datepicker-months,
    .datepicker-years {
        color: #114984;
        background color: white;
    }

    .datepicker-months table thead tr th {
        color: white !important;

    }

    .datepicker table tr td,
    .datepicker table tr th {
        border: none;
        border-radius: 0px;
    }
</style>

<!-- script for modal -->
<script>
    var validFlag = false;
    $("#call_back").click(function() {
        //alert( "Handler for .click() called." );
        if ($('#rn_agreementSelect_42_agreementno').val() == '-1') {
            alert("Please select Agreement No");
            validFlag = true;
        } else if ($('#contact_number').val() == '') {
            alert("Please Enter valid Mobile No");
            validFlag = true;
        } else {
            validFlag = false;
        }

        if (!validFlag) {
            $("#response_text").html("Logging Request......");
            $.ajax({
                url: "/cc/AjaxCustom/create_inc",
                type: "post",
                data: $('#frmcall').serialize(),
                success: function(response) {
                    //alert(d);
                    var obj = jQuery.parseJSON(response);
                    //var html_txt = '<p>Thanks for submitting your Request. Your request is logged and our representative will call you back ASAP! <br />Use this reference number for follow up: <b><a href="/app/msme/account/questions/detail/i_id/'+obj[0].value_id+'">'+obj[0].value_refno+'</a>.</b></p>';
                    //$( "#response_text" ).html( html_txt );
                    //$('#model_body').hide();
                    //$('#modal-button').hide();
                    //$('#after-submit').show();
                    if (obj[0].value_id != "") {
                        window.location.href = '/app/msme/ask_confirm/i_id/' + obj[0].value_id;
                    }
                }
            });
        }
    });
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>-->

<!--   <script src="js/main.js"></script>
  <script src="js/custom.js"></script>
    script for modal -->
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">

<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript">
    if ($('.notification').length) {
        var el = document.querySelector('.notification');

        //document.querySelector('button').addEventListener('click', function(){//
        var count = Number('<?php echo $notification_counter; ?>') || 0;
        el.setAttribute('data-count', count);
        el.classList.remove('notify');
        el.offsetWidth = el.offsetWidth;
        el.classList.add('notify');
        //  alert(count);
        if (count != 0) {
            el.classList.add('show-count');
        }
    }
    $("#dLabel").click(function() {
        el.classList.add('show-count');
    });
    //}, false);

    $(document).ready(function() {
        $('.rn_DisplayName').addClass('adjustment');
    });
</script>
<!--  -->
<!-- <script type="text/javascript">
  $(document).ready(function() {

    var x=document.referrer;
    if (localStorage.getItem("TypeOFLogin")=="RETAIL") {
      alert("your url contains the name RETAIL");
    }
    else
    {
     localStorage.setItem("TypeOFLogin", "MSME")

    }
  });
</script> -->
</body>

</html>