<?php 
    require_once('inc/config.inc.php'); 
    
    $query_1 = "SELECT * FROM airport";
    $result_1 = mysqli_query($connection, $query_1);

    
    if($result_1){
        $airport_list = '';
        while($row = mysqli_fetch_assoc($result_1)) {
            $airport_id = $row['airport_id'];
            $airport_name = $row['airport_name'];
            $airport_list .= "<option value=\"$airport_id\">$airport_name</option>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyBooker</title>
    <link rel="icon" type="image/x-icon" href="img/icons8-flight-100.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="hero bg">

        <div class="header">
            <nav>
                <div class="nav_logo"><a href="index.php">SkyBooker.</a></div>
                <ul class="nav_links">
                    <li class="link"><a href="index.php">Home</a></li>
                    <li class="link"><a href="about.php">About</a></li>
                    <li class="link"><a href="contact.php">Contact</a></li>
                </ul>
                <?php
                    if(!isset($_SESSION['user_id'])){
                        ?> <a class="btn-login" href="login.php">Login</a> <?php
                    }else{
                        ?><div><a class="btn-login" href="profile.php">Profile</a>|<a class="btn-login" href="logout.php">Logout</a></div><?php
                    }
                ?>
            </nav>
        </div>

        <div class="container">
            <div class="header_content" style="max-width: 400px;">
                <div>
                    <h1>Where would you<br>like to go?</h1>
                    <form action="search.php">

                        <div class="mb-1">
                            <label for="cars">From:</label>
                            <select name="from" id="from" required>
                                <option value="">Open this select menu</option>
                                <?php if(isset($airport_list)){echo $airport_list;}?>
                            </select>
                        </div>

                        <div class="mb-1">
                            <label for="to">To:</label>
                            <select name="to" id="to" required>
                                <option value="">Open this select menu</option>
                                <?php if(isset($airport_list)){echo $airport_list;}?>
                            </select>
                        </div>

                        <div class="mb-1" style="display: grid;grid-template-columns: repeat(2, 1fr);gap: 1rem;">
                            <div>
                                <label for="date">Date:</label>
                                <input type="date" name="date" id="date" required>
                            </div>
                            <div>
                                <label for="count">Passenger:</label>
                                <input type="number" name="count" id="count" required>
                            </div>
                        </div>

                        <button type="submit" class="section_btn mb-1">Search</button>
                    </form>
                </div>
            </div>
            <div class="header_image">
                <img src="img/Asset 4@4x.png" alt="header" />
            </div>
        </div>

        <div class="split-color"></div>

    </div>

    <div class="section">
        <div class="container">

            <div class="section_header">
                <h2 class="section_title">Value Added Services</h2>
                <p class="section_subtitle">
                    We provide many additional services at a reasonable price. They are shown below.
                </p>
            </div>

            <div class="card_grid">

                <div class="card">
                    <img src="img/Meal-served-on-board-of-airplane.jpg" alt="trip" />
                    <div class="card-info">
                        <p>Pre Order Extra Meals</p>
                        <div class="booking_price">
                            <div class="price"><span>From</span> $20</div>
                            <button class="btn-info">More Info</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="img/Zurich_Duty_Free_shop.jpg" alt="trip" />
                    <div class="card-info">
                        <p>Pre Order shopping</p>
                        <div class="booking_price">
                            <div class="price"><span>From</span> $100</div>
                            <button class="btn-info">More Info</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="img/istockphoto-1073261410-612x612.jpg" alt="trip" />
                    <div class="card-info">
                        <p>Bid for business class</p>
                        <div class="booking_price">
                            <div class="price"><span>From</span> $1000</div>
                            <button class="btn-info">More Info</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="section bg">
        <div class="container">
            <div class="section_header">
                <h2 class="section_title">Book your ticket now</h2>
                <p class="section_subtitle">
                    Book your flight ticket today with great discounts with our reliable company for over 25 years.
                </p>
                <button class="section_btn">Book Now</button>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">

            <div class="section_header">
                <h2 class="section_title">Popular Trips</h2>
                <p class="section_subtitle">
                    Below are the most popular flights according to the latest worldwide rankings.
                </p>
            </div>

            <div class="card_grid">
                <div class="card">
                    <img src="img/eiffel-tower-paris-night-city-lights-115703161081bzp0gvtcz.jpg" alt="" />
                    <div class="card-info">
                        <p>Top - 1 Travel To Paris</p>
                        <div class="rating">4.2</div>
                        <div class="booking_price">
                            <div class="price"><span>From</span> $3000</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="img/sydney-nsw-5-720.jpg" alt="" />
                    <div class="card-info">
                        <p>Top - 2 Travel To Australia</p>
                        <div class="rating">4.2</div>
                        <div class="booking_price">
                            <div class="price"><span>From</span> $4000</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="img/jll-singapore-property-market-watch-2023-social-1200x628.jpg" alt="" />
                    <div class="card-info">
                        <p>Top - 3 Travel To Singapore</p>
                        <div class="rating">4.2</div>
                        <div class="booking_price">
                            <div class="price"><span>From</span> $2000</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="img/Taiwan-58b9d0fb5f9b58af5ca84819.jpg" alt="" />
                    <div class="card-info">
                        <p>Top - 4 Travel To Taiwan</p>
                        <div class="rating">4.2</div>
                        <div class="booking_price">
                            <div class="price"><span>From</span> $1000</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="img/Lotus-Tower-2.jpg" alt="" />
                    <div class="card-info">
                        <p>Top - 5 Travel To Sri Lanka</p>
                        <div class="rating">4.2</div>
                        <div class="booking_price">
                            <div class="price"><span>From</span> $1000</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="img/anantara_dhigu_island_aerial_header_1920x1080.jpg" alt="" />
                    <div class="card-info">
                        <p>Top - 6 Travel To Maldives</p>
                        <div class="rating">4.2</div>
                        <div class="booking_price">
                            <div class="price"><span>From</span> $1500</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer bg">
        <div class="row_1">
            <h2 class="section_title">Safe Flight Safe Travel</h2>
            <p class="section_subtitle">
                All rights reserved. © 2024 SkyBooker. Designed and developed by SLIIT UG Students 2023 Group 04.01 - 10
            </p>
            <div class="social-links">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </div>

</body>

</html>