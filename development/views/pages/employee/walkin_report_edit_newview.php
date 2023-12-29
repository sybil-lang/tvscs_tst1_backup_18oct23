<?php
$tokenrequestid = $_GET['TokenRequestId'];

$ei_id = \RightNow\Utils\Url::getParameter('i_id');
$incident = RightNow\Connect\v1_3\Incident::fetch($ei_id);
// var_dump($incident);
$inc = $incident->ReferenceNumber;
// echo
// $incident->ReferenceNumber;
// echo $ei_id;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TVS Credit</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        div {
            text-align: center;
            margin-top: 1vh;
        }

        h1 {
            color: green;
            font-size: 4em;
        }

        p {
            font-size: 2.2em;
        }

        button {
            color: white;
            background-color: red;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.3em
        }
    </style>

    <script>
        setTimeout(function() {
            window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/walkin_reports";
        }, 3000);
    </script>

</head>

<body>
    <div>
        <h1>Success!!!</h1>
        <p>Thanks for submitting your Request. Use this reference number for follow up: <?php echo $inc; ?></p>
        <!-- <p>Your service request Id <?php echo $tokenrequestid; ?> has been closed successfully.</p> -->
        <button onclick="window.location.href = 'https://tvscs--tst1.custhelp.com/app/employee/walkin_reports'">Go To Dashboard</button>
    </div>
</body>

</html>