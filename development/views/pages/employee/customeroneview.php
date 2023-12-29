<?php
$CI = &get_instance();
$CI->load->helper('report');
checkCustomerType('internal employee');
$userProfile = $CI->session->getSessionData('userProfile');
$agreement = $userProfile['agg_no'];
$c_id = $CI->session->getProfileData("c_id");
$contact = \RightNow\Connect\v1_3\Contact::fetch($c_id);
$employeeCode = $contact->CustomFields->c->employee_code;
// uat
?>

<html>

<head>
    <style type="text/css">
        p {
            text-align: center;
            margin-top: 80px;
            font-weight: bold;
        }

        .btn:focus {
            outline: none;
        }

        .btn {
            border: none;
            background-color: #114984;
            color: white;
            outline: none;
            display: block;
            margin: 0 auto;
            margin-top: 10px;
            transition: transform 0.2s ease;
        }

        .btn:hover {
            background-color: #114984 !important;
            color: white;
            transform: scale(1.1);
        }

        .white-text {
            color: white !important;
        }
    </style>
</head>

<body>
    <p>Click the below button for customer one view</p>
    <button type="submit" id="myButton" class="btn">Customer one view</button>

    <script>
        var employeecode = <?php echo $employeeCode; ?>;
        console.log(employeecode);
        var ag = "<?php echo $agreement; ?>";
        console.log(ag);
        var myButton = document.getElementById("myButton");

        myButton.addEventListener("click", function() {
            myButton.classList.add("white-text");
            console.log("Button is clicked!");

            $.post("/cc/AjaxCustom/CustomerOneView", {
                employeecode: employeecode,
                ag:ag
            }).done(
                function(data) {
                    console.log(data);
                    try {
                        let tokenWithoutBearer = data.replace("Bearer ", "").replace(/\s/g, "");
                        console.log(tokenWithoutBearer);
                        var viewlink = "https://crmuat.tvscredit.com/oneview/#/main?token=" + tokenWithoutBearer;
                        console.log(viewlink);
                        window.open(viewlink, '_blank');
                    } catch (err) {
                        console.log(err.message);
                    }
                }
            );
        });
    </script>
</body>

</html>