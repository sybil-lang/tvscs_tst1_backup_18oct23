<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard"/>
<head>
<meta charset="utf-8"/>
<title>
<rn:page_title/>
</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
<rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
<rn:head_content/>
<link rel="icon" href="/euf/assets/images/favicon.png" type="image/png"/>
<rn:widget path="utils/ClickjackPrevention"/>
<rn:widget path="utils/AdvancedSecurityHeaders"/>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--Css and Javascript files starts here-->
<!-- Bootstrap -->
<link href="/euf/assets/themes/standard/css/bootstrap.min.css" rel="stylesheet">
<link href="/euf/assets/themes/standard/css/bootstrap-theme.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:/ -->
<!--[if lt IE 9]>
      <script src="https:/oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https:/oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="/euf/assets/themes/standard/js/admin/js.js"></script>
<script src="/euf/assets/themes/standard/js/jquery-1.11.3.min.js"></script>
<script src="/euf/assets/themes/standard/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/euf/assets/themes/standard/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="/euf/assets/themes/standard/ckeditor/contents.css">
<link rel="stylesheet" href="/netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
<script src="/euf/assets/themes/standard/js/raphael-min.js"></script>
<rn:theme path="/euf/assets/themes/standard" css="custom.css"/>
<!--Css and Javascript files ends here-->

</head>
<body class="yui-skin-sam yui3-skin-sam" itemscope itemtype="http://schema.org/WebPage">
<a href="#rn_MainContent" class="rn_SkipNav rn_ScreenReaderOnly">#rn:msg:SKIP_NAVIGATION_CMD#</a>
<header> </header>
<div class="rn_Body">
  <div class="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
    <rn:page_content/>
  </div>
</div>
<footer class="rn_Footer">
  <div class="rn_Container">
    <div class="rn_Misc">
      <!--<rn:widget path="utils/OracleLogo"/>-->
    </div>
  </div>
</footer>
<!--Css and Javascript file starts here-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/euf/assets/themes/standard/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/euf/assets/themes/standard/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/euf/assets/themes/standard/css/datetimepicker.css">
<script type="text/javascript" src="/euf/assets/themes/standard/js/datetimepicker.js"></script>
<!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/js/datetime/DateTimePicker-ltie9.css" />
    <script type="text/javascript" src="/euf/assets/themes/standard/js/datetime/DateTimePicker-ltie9.js"></script>
<![endif]-->
<link rel="stylesheet" href="/euf/assets/themes/standard/css/jquery.dataTables.min.css" />
<script src="/euf/assets/themes/standard/js/jquery-1.12.3.js"></script>
<script src="/euf/assets/themes/standard/js/jquery.dataTables.min.js"></script>

<script src="/euf/assets/themes/standard/js/dataTables.responsive.min.js"></script>
<script src="/euf/assets/themes/standard/js/responsive.bootstrap.min.js"></script>
<link rel="stylesheet" href="/euf/assets/themes/standard/css/datetimepicker.css">
<script type="text/javascript" src="/euf/assets/themes/standard/js/datetimepicker.js"></script>

<!--<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script language="javascript">
jQuery(document).ready(function() {
	if(document.getElementById('chk_view_all')){
		jQuery("#chk_view_all").click(function(){  //"select all" change
			var status = this.checked; // "select all" checked status
			jQuery('.chk_view_all').each(function(){ //iterate all listed checkbox items
				this.checked = status; //change ".checkbox" checked status
			});
		});
	}
	if(document.getElementsByClassName('dtBox')){
		jQuery(".dtBox").DateTimePicker();
	}
});
</script>
<!--Css and Javascript file ends here-->
</body>
</html>
