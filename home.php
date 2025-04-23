<?php
session_start(); // Start session to check login status

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$userId = $isLoggedIn ? $_SESSION['user_id'] : null; // Assuming user_id is stored in the session
$userName = $isLoggedIn ? $_SESSION['username'] : null; // Assuming user contains the username
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="home.css">
</head>
<body>
    <section class="home">
        <!-- Header -->
        <div class="header">
            <a href="#" class="logo"><img src="image/dyscover.png" alt="Logo"></a>
            <i class='bx bx-menu' id="menu-icon"></i>
            <nav class="navbar">
                <a href="home.php">Home</a>
                <a href="#features">Features</a>
                <a href="#test">Element</a>
                <a href="forum.php">Forum</a>
                <a href="#" id="subscribe-btn">Subscribe</a>
                <?php if ($isLoggedIn): ?>
                    <a href="logout.php">Logout</a>
                    <span>Welcome, <?php echo htmlspecialchars($userName); ?> (ID: <?php echo htmlspecialchars($userId); ?>)!</span>
                <?php else: ?>
                    <a href="login.html">Login</a>
                <?php endif; ?>
            </nav>
        </div>

        <!-- Home Content -->
        <div class="text-box">
            <?php if ($isLoggedIn): ?>
                <h1>Welcome back, <?php echo htmlspecialchars($userName); ?>!</h1>
                <p>Your User ID is <strong><?php echo htmlspecialchars($userId); ?></strong>. Explore your personalized features and resources to enhance your learning journey.</p>
            <?php else: ?>
                <h1>Welcome to Dyscover!</h1>
                <p>Please <a href="login.html">log in</a> to access personalized features and resources.</p>
            <?php endif; ?>
        </div>

        <div class="animated_image">
            <img src="image/ali1.png" class="Ali">
            <img src="image/Gita00.png" class="Gita">
            <img src="image/DYSCOVER.png" class="dys">
        </div>
    </section>
<div class="popup" id="subscribe-popup">
    <div class="popup-content">
        <span class="close-btn" id="close-popup">&times;</span>
        <h2>Subscribe</h2>
        <form action="subscribe.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
        </form>
    </div>
</div>
    <!-- Video Section -->
    <section id="video">
        <div class="video-container">
            <video class="mp4" controls>
                <source src="image/3d_kid.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>

    <!-- Other sections (Features, Framework, Testimonial, etc.) remain unchanged -->
    <section id="features">
    <div class="feature-title">
        <h1>It's Not Just a Game—It's the Future of Learning!</h1>
        <p>Imagine a tool that helps uncover hidden learning challenges in a way thats fun and engaging. This 3D game goes beyond traditional testing, identifying math difficulties while your child enjoys the experience. With early detection and personalized support, it opens the door to tailored learning strategies that make a real difference. Ready to give your child the best chance at success? The future of learning is here!</p>
    </div>
    <div class="features-container">
        <div class="feature-item">
            <img src="./image/fea1.png" alt="Feature 1">
          
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat nobis veniam magni earum.</p>
          
        </div>
        <div class="feature-item">
            
            <h3>Petri-Net Digital Storytelling Structure</h3>
            <p>Identifies and analyzes students mathematical challenges during gameplay, offering stress-free assessment through engaging storytelling.</p>
          
        </div>
       
        <div class="feature-item">
            
            <h3>Comprehensive Screening Feature</h3>
            <p>Tracks and records interactions to provide detailed reports on problem-solving approaches and misconceptions.</p>
           
        </div> 
        <div class="feature-item">
            <img src="./image/fea2.png" alt="Feature 2">
           
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat nobis veniam magni earum.</p>
            
        </div>
        <div class="feature-item">
            <img src="./image/fea3.png" alt="Feature 3">
          
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat nobis veniam magni earum.</p>
          
        </div>
        <div class="feature-item">
            
            <h3>Engagement through Gamification:</h3>
            <p>Combines a 3D virtual environment with a captivating narrative to make learning enjoyable and boost participation.</p>
          
        </div>
       
        <div class="feature-item">
            
            <h3>Early Detection and Personalized Support</h3>
            <p>TDetects dyscalculia early and enables tailored educational strategies to address individual needs.</p>
           
        </div> 
        <div class="feature-item">
            <img src="./image/fea4.png" alt="Feature 4">
           
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat nobis veniam magni earum.</p>
            
        </div>
        <div class="feature-item">
            <img src="./image/kid.png" alt="Feature 5">
          
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat nobis veniam magni earum.</p>
          
        </div>
        <div class="feature-item">
            
            <h3>Cost-Effectiveness</h3>
            <p> Affordable and scalable, making advanced diagnostic tools accessible to a wider audience.</p>
          
        </div>
       
</div>



</div>
  
</section>
<!-- 3D DIG Framework Section -->
<section id="3D-DIG-framework" class="framework-section">
    <div class="framework-container">
        <div class="top-image">
            <img src="image/img1.png" alt="Top Image" class="framework-img">
            <div class="text-content">
                <h3>3D-DIG Framework: A Dyscalculia Assessment Tool in Game-Based Learning</h3>
                <p>The 3D game, built on the 3D-DIG framework, provides an engaging dyscalculia assessment tool for students, offering 8 levels that can be played in any order. </p>
                <p>It identifies potential dyscalculia by analyzing student answers, misconceptions, problem-solving duration, and recorded video of both their face and screen during gameplay. </p>
                    <p> Additionally, the game incorporates data such as Norm Characteristics of Dyscalculia, findings from testing at SD Kemala Bhayangkari, and sample data collected from the same institution to enhance its effectiveness.</p>
            </div>
        
        </div>
        <div class="row-images">
            <img src="image/img2.png" alt="Image 1" class="framework-img">
            <img src="image/img3.png" alt="Image 2" class="framework-img">
            <img src="image/img4.png" alt="Image 3" class="framework-img">
        </div>
    </div>
</section>
<section id="test">
    <!-- Element testimonial -->
    <div class="testimonial-header">
        <div class="slide-container">
            <div class="nav-icon left" onclick="showPreviousSlide()">&#10094;</div>
            <div class="nav-icon right" onclick="showNextSlide()">&#10095;</div>
            <div class="testimonial-container">
                <div class="testimonial-box">
                    <img src="image/p1.png" class="testimonial-img">
                    <p class="quote">
                        The 3D-DIG Framework completely changed how we approach dyscalculia assessment in our school. Students feel at ease while playing the game, and teachers gain valuable insights effortlessly. It’s a win-win!
                    </p>
                    <p class="author">-Sophia Carter, Primary School Teacher</p>
                </div>
                <div class="testimonial-box">
                    <img src="image/p2.png" class="testimonial-img">
                    <p class="quote">
                        As a parent, I was amazed at how engaging and effective this tool is. My child didnt even realize they were being assessed, and the results helped us understand their unique learning needs. Highly recommended!
                    </p>
                    <p class="author">-Sarah Tan, Parent</p>
                </div>
                <div class="testimonial-box">
                    <img src="image/p3.png" class="testimonial-img">
                    <p class="quote">
                        The 3D-DIG game has been a breakthrough in our classroom. Not only does it make learning enjoyable, but it also provides accurate data to guide our teaching strategies. It’s a must-have for educators!
                    </p>
                    <p class="author">-Dr. James Bennett, School Principal</p>
                </div>
                <div class="testimonial-box">
                    <img src="image/p4.png" class="testimonial-img">
                    <p class="quote">
                        This framework is a lifesaver! It's innovative, fun, and packed with valuable features. We've already seen significant improvements in identifying and supporting students with learning difficulties.
                    </p>
                    <p class="author">-Sophia Davis, Educational Psychologist</p>
                </div>
            </div>
        </div>
        <div class="test-title">
            <h1 class="testimonial">Testimonial</h1>
            <h3 class="des-testimonial">Join the countless individuals who have already experienced the transformative benefits of the 3D-DIG Framework! This innovative tool has helped many uncover and address learning challenges in a fun and stress-free way. Be part of the success story today!</h3>
        </div>
    </div>
</section>

  <!--element case study-->
  <div class="casestudy__container">
  
        <h1 class="showtest">Testing at SK Tun Syed Ahmad Shahabudin: Insights from 37 Participants</h1>
       
    
    <div class="card__container">
        <article class="card__article">
            <img src="image/s1.png" class="card__img">
            <div class="card__data">
                <span class="card__description"></span>
          
               
            </div>

        </article>

        <article class="card__article">
            <img src="image/s2.png" class="card__img">
            <div class="card__data">
                <span class="card__description"></span>
              
             
            </div>

          
        </article>

        <article class="card__article">
            <img src="image/s3.png" class="card__img">
           
            <div class="card__data">
                <span class="card__description"></span>
           
              
            </div>

        </article>

        <article class="card__article">
            <img src="image/s4.png" class="card__img">
            <div class="card__data">
                <span class="card__description"></span>
             
             
            </div>

          
        </article>
    </div>
</div>
    <!-- Footer Section -->
    <section class="footer">
        <footer>
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>

            <ul class="social_icon">
                <li><a href="#"><i class='bx bxl-facebook-circle'></i></a></li>
                <li><a href="#"><i class='bx bxl-linkedin-square'></i></a></li>
                <li><a href="#"><i class='bx bxl-twitter'></i></a></li>
                <li><a href="#"><i class='bx bxl-instagram-alt'></i></a></li>
            </ul>
            <ul class="menu">
                <li><a href="home.php">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#test">Element</a></li>
                <?php if (!$isLoggedIn): ?>
                    <li><a href="login.html">Login/Register</a></li>
                <?php endif; ?>
            </ul>
            <p>@2024 lollllllll | All Right Reserved</p>
        </footer>
    </section>

    <script src="home.js"></script>
</body>
</html>