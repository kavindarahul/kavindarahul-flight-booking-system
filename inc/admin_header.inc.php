<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyBooker<?php if(isset($page_name)){echo "-$page_name";}?></title>
    <link rel="icon" type="image/x-icon" href="img/icons8-flight-100.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }


        .card-body {
            padding: 2rem;
        }

        .mt-4 {
            margin-top: 4rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .form-btn button {
            border: none;
            padding: 15px 50px;
            background: #1c255b;
            color: #fff;
            border-radius: 4px;
            font-size: 15px;
        }

        .form-input {
            width: 100%;
            padding: 14px;
            border: none;
            background: #eee;
            border-radius: 4px;
        }

        .card-head {
            padding: 1rem 2rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }

        .action button {
            padding-left: 15px;
            border: none;
            background: none;
            font-size: 15px;
            cursor: pointer;
        }

        .info {
            display: flex;
            flex-direction: row;
        }

        .info .lable {
            font-size: 15px;
            padding-right: 30px;
            font-weight: 600;
            color: #000000bd;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }


        .card-body {
            padding: 2rem;
        }

        .mt-4 {
            margin-top: 4rem;
        }

        .form-btn button {
            border: none;
            padding: 15px 50px;
            background: #1c255b;
            color: #fff;
            border-radius: 4px;
            font-size: 15px;
        }

        .form-input {
            width: 100%;
            padding: 14px;
            border: none;
            background: #eee;
            border-radius: 4px;
        }

        .card-head {
            padding: 1rem 2rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }

        .action button {
            padding-left: 15px;
            border: none;
            background: none;
            font-size: 15px;
            cursor: pointer;
        }

        .info {
            display: flex;
            flex-direction: row;
        }

        .info .lable {
            font-size: 15px;
            padding-right: 30px;
            font-weight: 600;
            color: #000000bd;
        }
    </style>
</head>

<body class="bg-2">

    <div class="header bg">
        <nav>
            <div class="nav_logo"><a href="index.php">SkyBooker.</a></div>
            <ul class="nav_links">
                <li class="link <?php if($page_title == "Dashboard"){echo "activ";} ?>"><a href="dashboard.php">Dashboard </a></li>
                <li class="link <?php if($page_title == "Schedule"){echo "activ";} ?>"><a href="schedule.php">Schedule</a></li>
                <li class="link <?php if($page_title == "Flight"){echo "activ";} ?>"><a href="flight.php">Flight</a></li>
                <li class="link <?php if($page_title == "Airport"){echo "activ";} ?>"><a href="airport.php">Airport</a></li>
                <li class="link"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>