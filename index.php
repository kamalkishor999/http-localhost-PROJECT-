<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Template</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style.css">
</head> 
<body>
<nav class="navbar navbar-expand-lg bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
            <img src="./images/newlogo" alt="Logo" width="100" height="100" class="d-inline-block">
        </a>
        <span class="navbar-text me-auto">
            <h2 class="m-0">ABHISHEK STORE</h2>
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="navbar-nav ms-auto">
            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
            <a class="nav-link" href="#sectionthree">About Us</a>
            <a class="nav-link" href="#sectiontwelve">Contact Us</a>
            <a class="nav-link" href="./login.php">Login</a>
            <a class="nav-link" href="./loginall.php">All Data</a>
        </div>
    </div>
</nav>


<div class="main">
    <div class="container">
        <div class="sectionone" id="sectionone">
            <div class="bg">
                <div class="circle">
                    <h2>ENHANCE YOUR NATURAL BEAUTY</h2>
                    <button><a href="./book.php">EXPLORE NOW</button> </a>
                </div>
            </div>
        </div>
        <div class="sectiontwo" id="sectiontwo">
    <div class="bgtwo">
        <div class="headingtwo">
            <h2>VIDEO</h2>
            <p>Check out these great videos</p>
        </div>
        <div class="video-container">
            <iframe src="https://www.youtube.com/embed/s7ehCYyEmVw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <iframe src="https://www.youtube.com/embed/LQI28ucBl3w" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <iframe src="https://www.youtube.com/embed/ca9Dt3-0pg8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <iframe src="https://www.youtube.com/embed/rTBS8j5UdwU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <iframe src="https://www.youtube.com/embed/9L6Z14M6Hc8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <iframe src="https://www.youtube.com/embed/Rumba7KDLpI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>


        <div class="sectionthree" id="sectionthree">
            <div class="bgthree">
                <div class="headingthree">
                    <h2>ABHISHEK STORE</h2>
                </div>
                <div class="three">
                    <div class="threeleft">
                        <img src="./images/ukraien.jpg" alt="Store Image">
                    </div>
                    <div class="threeright">
                        <h4>WELCOME TO ABHISHEK STORE</h4>
                        <p>Explore a variety of products designed to enhance your natural beauty.
                        A noun describing an incredibly pleasing or harmonious quality or feature, 
                        beauty is hard to describe. Sure, super models and classical paintings exhibit beauty. 
                        But so do well designed sports cars and perfectly executed soccer goals. 
                        </p>
                    </div>
                </div>
                <div class="categories">
                    <h4>Our Categories</h4>
                    <ul>
                        <li><a href="#sectionsix"><strong>Skincare</strong></a></li>
                        <li><a href="#sectionseven"><strong>Makeup</strong></a></li>
                    </ul>
                </div>
            </div>
        </div>
       
        <div class="sectionfour" id="sectionfour">
            <div class="bgfour">
                <div class="headingfour">
                    <h2>GLIMPSE INTO OUR WORLD OF BEAUTY GALLERY</h2>
                </div>
                <div class="four">
                    <div class="slider">
                        <img id="main-image" src="./images/one.jpg" alt="Slider Image">
                    </div>
                    <div class="thumbnail-container">
                        <img class="thumbnail" src="./images/one.jpg" alt="Thumbnail 1" onclick="changeImage('./images/one.jpg')">
                        <img class="thumbnail" src="./images/two.jpg" alt="Thumbnail 2" onclick="changeImage('./images/two.jpg')">
                        <img class="thumbnail" src="./images/three.jpg" alt="Thumbnail 3" onclick="changeImage('./images/three.jpg')">
                        <img class="thumbnail" src="./images/four.jpg" alt="Thumbnail 4" onclick="changeImage('./images/four.jpg')">
                    </div>
                    <h5>DISCOVER THE BEAUTY OF ABHISHEK STORE TODAY!</h5>
                </div>
            </div>
        </div>
        <div class="sectionfive" id="sectionfive">
            <div class="bgfive">
                <div class="headingfive">
                    <h2>POPULAR ITEMS</h2>
                </div>
                <div class="five">
                    <div class="fiveone">
                        <img src="./images/api.jpg" alt="New Product">
                        <h4>NEW PRODUCTS</h4>
                        <p>Check out our arrivals cater to all your beauty needs.</p>
                    </div>
                    <div class="fivetwo">
                        <img src="./images/bpi.jpg" alt="Most Popular">
                        <h4>MOST POPULAR</h4>
                        <p>Explore the best-selling items loved by our customers.</p>
                    </div>
                    <div class="fivethree">
                        <img src="./images/cpi.jpg" alt="Best Value">
                        <h4>BEST VALUE</h4>
                        <p>Get the best quality products at unbeatable prices.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="sectionsix" id="sectionsix">
            <div class="bgsix">
                <div class="headingsix">
                    <a href="#skincare">
                        <h2>SKINCARE</h2>
                    </a>
                    <p>Revitalize your skin with our natural skincare line.</p>
                </div>
                <div class="six">
                    <div class="column">
                        <img src="./images/dpi.jpg" alt="Skincare Item 1">
                        <h3>Moisturizing Cream</h3>
                        <p>Deep hydration for radiant skin. ₹600</p>
                    </div>
                    <div class="column">
                        <img src="./images/epi.jpg" alt="Skincare Item 2">
                        <h3>Sunscreen SPF 50</h3>
                        <p>Protect your skin from harmful UV rays. ₹800</p>
                    </div>
                    <div class="column">
                        <img src="./images/fpi.jpg" alt="Skincare Item 3">
                        <h3>Revitalizing Serum</h3>
                        <p>Restore your skin's natural glow. ₹1,200</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="sectionseven" id="sectionseven">
            <div class="bgseven">
                <div class="headingseven">
                    <a href="#makeup">
                        <h2>MAKEUP</h2>
                    </a>
                    <p>Unleash your creativity with our vibrant makeup collection.</p>
                </div>
                <div class="seven">
                    <div class="column">
                        <img src="./images/two.jpg" alt="Makeup Item 1">
                        <h3>Matte Lipstick</h3>
                        <p>Long-lasting and bold colors. ₹500</p>
                    </div>
                    <div class="column">
                        <img src="./images/two.jpg" alt="Makeup Item 2">
                        <h3>Eyeshadow Palette</h3>
                        <p>Versatile shades for every occasion. ₹1,000</p>
                    </div>
                    <div class="column">
                        <img src="./images/three.jpg" alt="Makeup Item 3">
                        <h3>Foundation Cream</h3>
                        <p>Flawless coverage for a natural look. ₹800</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="sectioneight">
            <div class="bgeight">
                <div class="abs">
                    <div class="firstheading">
                        <h2>LOVE LETTERS</h2>
                    </div>
                    <div class="secbutton">
                        <button>Reviews coming soon!</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="sectionnine">
            <div class="bgnine">
                <div class="abs">
                    <div class="firstheading">
                        <h2>MY BLOG</h2>
                    </div>
                    <div class="secbutton">
                        <button>Posts coming soon!</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="sectionten">
        <div class="bgten">
                <h2>All Products</h2>
            </div>
            <div class="buttonui">
                <button>New products are coming soon!</button>
            </div>
        </div>
        <div class="sectioneleven">
            <div class="bgeleven">
                <h1>HAPPINESS IS THE SECRET TO ALL BEAUTY. THERE IS NO BEAUTY WITHOUT HAPPINESS.</h1>
                <p>Christian Dior</p>
            </div>
        </div>
        <div class="sectiontwelve" id="sectiontwelve">
            <div class="bgtwelve">
                <div class="twelve">
                    <div class="twelveleft">
                        <h3>CONTACT US</h3>
                        <h5>QUESTIONS OR COMMENTS</h5>
                        <p>We'd love to hear from you!</p>
                        <address>
                            <h5>KAMALKISHOR STORE</h5>
                            <p>1687, Behind Mandir, Phase -5, Sector 59, Sahibzada Ajit Nagar, Chandigarh.</p>
                            <i class="fa-regular fa-envelope"></i>&nbsp;&nbsp;&nbsp;<a href="https://mail.google.com/mail/u/0/#inbox?compose=new">kamalkishor999k@gmail.com</a><br>
                            <h4>HOURS:</h4>
                            <p>Open Today 09:00 AM to 05:00 PM.</p>
                        </address>
                    </div>
                    <div class="twelveright">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d315811.9994727935!2d76.6560949!3d30.7046486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fee906da6f81f%3A0x512998f16ce508d8!2sSahibzada%20Ajit%20Singh%20Nagar%2C%20Punjab!5e0!3m2!1sen!2sin!4v1632901541037!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="sectionthirteen">
    <div class="bgthirteen">
        <h1>SUBSCRIBE</h1>
        <form onsubmit="return showAlert()">
            <input type="email" id="email" name="email" placeholder="Email Address" required>
            <button type="submit">SIGN UP</button>
        </form>
    </div>
    <div class="lastone">
        <p>Get 10% off on your first purchase when you sign up for the Newsletter.</p>
    </div>
</div>


        <div class="sectionfourteen" id="sectionfourteen">
            <div class="bgfourteen">
                <h1>ONLINE APPOINTMENT</h1>
            </div>
            <div class="fourteen">
                <h3>FASHION HUB</h3>
                <p>1hr | ₹ <?php echo(rand(1000,3000));?></p>
                <a href="./book.php">
                <button>Book</button>
            </a>
            </div>
        </div>
        <div class="fourteenbuy">
    <a href="#sectiontwelve">
        <button>Contact us</button>
    </a>
    <a class="nav-link" href="#sectionthree">
        <button>About us</button>
    </a>
</div>
    </div>
</div>
<div class="sectionlast">
    <footer class="bg-dark text-white text-center py-3">
        <div class="bglast">
            <p class="mb-0">Copyright 2024 Abhishek Store - All Rights Reserved</p>
            <p class="mb-0">Powered By - Abhishek</p>
        </div>
    </footer>
</div>

<script src="./script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

