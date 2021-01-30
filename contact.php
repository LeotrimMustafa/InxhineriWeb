<!DOCTYPE html>
<html>

<head>
    <title>Get in touch!</title>
    <link rel="stylesheet" href="css/contactus.css">
    <script  src="js/cripts.js"></script>


</head>

<body>

    <ul class="nav-bar">
    <?php

include('session.php');
if(isset($_SESSION['User'])){
    echo '<li class="li-bar"><a href="Logged-In.php">Home</a></li>
    <li class="li-bar"><a href="contact.php">Contact</a></li>
    <li class="li-bar"><a href="about.php">About</a></li>
    ';
}
else if(isset($_SESSION['Admin'])){
    echo '<li class="li-bar"><a href="Logged-In.php">Home</a></li>
    <li class="li-bar"><a href="contact.php">Contact</a></li>
    <li class="li-bar"><a href="about.php">About</a></li>
    <li class="li-bar"><a href="create.php">Add Phone</a></li>
    <li class="li-bar"><a href="products.php">All Phones</a></li>
    ';
}
else{
    echo '<li class="li-bar"><a href="index.php">Home</a></li>
    <li class="li-bar"><a href="contact.php">Contact</a></li>
    <li class="li-bar"><a href="about.php">About</a></li>
    <li class="li-bar"><a href="login.html">Login</a></li>
    <li class="li-bar"><a href="signup.html">Register</a></li>
    ';
}






?>
        <li class="li-bar"><a href="news.html">News</a></li>

        <li class="lisrch">
            <div class="searchi"><input type="text" id="fname" name="firstname" placeholder="Search"></div>
        </li>


        <li class="lisrch">

         <div class="navbar">
        
             <div class="dropdown">
                 <?php

                    include('session.php');
                    if(isset($_SESSION['User'])){
                        
                        echo '<button class="dropbtn">
                        <i> '.$login_session.' </i>
                           <i class="fa fa-caret-down"></i>
                         </button>
                         <div class="dropdown-content">
                            <a href="logout.php">Logout</a>
                                    <!-- <a href="#">Link 2</a>
                                    <a href="#">Link 3</a> -->
                         </div>';
                    
                    }


                 ?>
            
             </div>
             </div>
        
        </li>

    </ul>

   <div class="headd">
       <h1 class="mix">Get in touch!</h1>
       <p>Ideas for better business? Feel free to contact us!</p>
   </div>


    <div class="wrapper">
     
        <div id="error_message">

        </div>
        <form action="" id="myform" onsubmit="return validate();">
            <div class="input_field">
                <input type="text" placeholder="Full Name" id="name">
            </div>
            <div class="input_field">
                <input type="text" placeholder="Email" id="email">
            </div>
            <div class="input_field">
                <textarea placeholder="Message" id="message"></textarea>
            </div>
            <div class="btn">
                <input type="submit">
            </div>
        </form>
    </div>


</body>

</html>