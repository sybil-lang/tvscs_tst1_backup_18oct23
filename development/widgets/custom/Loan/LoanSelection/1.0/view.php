
<link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
<div class="widgetbody">
	<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">

	<?php 
$CI=&get_instance();
$countTL=0;
$countOD=0;
$countBD=0;
      $contact_id=$CI->session->getProfileData("c_id");

      $fetched_contact=\RightNow\Connect\v1_3\Contact::fetch( $contact_id );
      // $report_id=100705;
//       $msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
// // $report_id=$msg->Value;
//       if($report_id>0){
// 		$filter=array('Contact ID'=>$fetched_contact->ID);
// 		// print_r($filter);
// 		$report_result=report_result($report_id,$filter);
// 		// print_r($report_result);
// 		if(count($report_result) > 0)
// 		{
//             // echo       '<pre>';
// 			// print_r($report_result);
			

// 			for($i=0;$i<count($report_result);$i++)
// 			{
// 				if($report_result[$i]['loan_sub_type']=="TL")
// 				{
//                    $countTL++;
// 				}
// 				elseif($report_result[$i]['loan_sub_type']=="OD")
// 				{
//                    $countOD++;
// 				}
// 				elseif($report_result[$i]['loan_sub_type']=="BD")
// 				{
//                    $countBD++;
// 				}

// 			}
// 			// echo $countTL.$countOD.$countBD;

					


// 		}
// 	}
      // echo       '<pre>';

      // echo 'Contact ID'.$this->data['attrs']['your_condition'];

	 ?>

			<style type="text/css">
				
				
			      #bdodtl input[type=radio] {
					    border: 0px;
					    width: 5%;
					    height: 2em;
					}
					/*.in
					{
						display: flex;
					}*/
					label
					{
						font-size: x-large;
					}
					.col
					{
						width:30%
					}
					.container_select
					{
						display: flex;
					}
					.mar-b20px
					{
                       margin-bottom: 20px;
					}
					     

					 @media only screen and (max-width: 800px) {
						
						.container_select
							{
								display: block !important;
							}
							.in
							{
								margin-left: 25px !important;
							}
						}
					/*#bdodtl div
					{ 
						display: none;
					}
*/
					
			</style>
			<div id="bdodtl">
				<div>
					<h4 align="center" style="margin-top:15px;">Please Select an option </h4>
				</div>
				<div class="container_select">


					<!-- <div> -->
					<div id="TL-hidden_div" class="col hidden">
						<!-- <script type="text/javascript">console.log('inside')</script> -->
							<div class="in mar-b20px"><input type="radio" name="radio" id="TL_id<?php echo $this->data['attrs']['your_condition']; ?>"><label>TL</label></div>
							<div id="<?php echo $this->data['attrs']['your_condition'] ;?>_TL">
								<!-- <input type="text" id="in_tl" name="TL" value="TL">   --> 
								
							</div>
						</div>
				
						<div id="OD-hidden_div" class="col hidden">
							<div class="in mar-b20px"><input type="radio" name="radio" id="OD_id<?php echo $this->data['attrs']['your_condition']; ?>"  ><label>OD</label></div>
							<div id="<?php echo $this->data['attrs']['your_condition'] ;?>_OD">
								<!-- <input type="hidden" id="in_od" name="TL" value="OD"> -->

								
							</div>
						</div>
					<div id="BD-hidden_div" class="col hidden">
							<div class="in mar-b20px"><input type="radio" name="radio" id="BD_id<?php echo $this->data['attrs']['your_condition']; ?>"  ><label>BD</label></div>
							<div id="<?php echo $this->data['attrs']['your_condition'] ;?>_BD">
								
							</div>
						</div>
					<!-- </div> -->
				</div>
			</div>

	</div>
</div>

<script type="text/javascript">
""
var id = "<?php echo $this->data['attrs']['your_condition'] ;?>"

									 $('#TL_id'+id).change(function()
                                                   {      document.getElementById(id+'_OD').style.display="none";
                                                          document.getElementById(id+'_BD').style.display="none";
                                                          document.getElementById(id+'_TL').style.display="block";

                                                          checking();
                                                    });  
                                                   $('#OD_id'+id).change(function()
                                                   {
                                                           document.getElementById(id+'_OD').style.display="block";
                                                          document.getElementById(id+'_TL').style.display="none";
                                                          document.getElementById(id+'_BD').style.display="none";
                                                          checking();
                                                    });
                                                   $('#BD_id'+id).change(function()
                                                   {
                                                          document.getElementById(id+'_OD').style.display="none";
                                                          document.getElementById(id+'_BD').style.display="block";
                                                          document.getElementById(id+'_TL').style.display="none";
                                                          checking();
                                                    });
</script>
<script type="text/javascript">
					var countTL=0;
var countOD=0;
var countBD=0;
	 	       $.post( "/cc/AjaxCustom/initialloanamount_accordin", {contact_id : '<?php echo $contact_id;?>',flag :'true' })
                           .done(function( data ) {
                           	var main_data=JSON.parse(data);
                             if(main_data.length > 0)
		{
           
             // console.log('data',JSON.parse(data));



                     for(var i=0;i<main_data.length;i++)
                         {
                         
                              if(main_data[i]["agrrementNumberList"]){
                                for(var j=0;j<main_data[i].productDetailsList.length;j++)
                                   {
                                      for(var k=0;k<main_data[i].productDetailsList[j].agreementDetailList.length;k++)
                                      {
                                       
                                        if(main_data[i].productDetailsList[j].agreementDetailList[k].productCode=='TL')
                                        {
                                           countTL++;
                                        }
                                        if(main_data[i].productDetailsList[j].agreementDetailList[k].productCode=='OD')
                                        {
                                            countOD++;
                                        }
                                        if(main_data[i].productDetailsList[j].agreementDetailList[k].productCode=='BD')
                                        {
                                            countBD++;
                                        }
                                      }
                                   }
                         }
                     }


                     if(countTL)
                     {
                     	$('#TL-hidden_div').removeClass('hidden');
                     	// $('#OD-hidden_div').addClass('hidden');
                     	// $('#BD-hidden_div').addClass('hidden');


                     }
                      if(countOD)
                     {
                     	$('#OD-hidden_div').removeClass('hidden');
                     	// $('#BD-hidden_div').addClass('hidden');
                     	// $('#TL-hidden_div').addClass('hidden');
                     }
                      if(countBD)
                     {
                     	$('#BD-hidden_div').removeClass('hidden');
                     	// $('#TL-hidden_div').addClass('hidden');
                     	// $('#OD-hidden_div').addClass('hidden');
                     }

                     console.log(countTL,countOD,countBD)
            // echo       '<pre>';
			// print_r($report_result);
			

			// for(var i=0;i<;i++)
			// {
			// 	if($report_result[$i]['loan_sub_type']=="TL")
			// 	{
   //                 $countTL++;
			// 	}
			// 	elseif($report_result[$i]['loan_sub_type']=="OD")
			// 	{
   //                 $countOD++;
			// 	}
			// 	elseif($report_result[$i]['loan_sub_type']=="BD")
			// 	{
   //                 $countBD++;
			// 	}

			// }

                        }

                        else
{
                     // console.log(countTL,countOD,countBD)
                     document.getElementById('bdodtl').innerHTML="No Data Found"

}

                           });</script>


		<script src="/euf/assets/themes/standard/js/images.js"></script>
		<script src="/euf/assets/themes/standard/js/md5.js"></script>
		<script src="/euf/assets/themes/standard/js/main.js"></script>