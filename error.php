<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <style type="text/css">
        .wrapper{
            width: 750px;
            margin: 0 auto;
        }
    </style>
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
    <li class="li-bar"><a href="signup.html">Sign Up</a></li>
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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Invalid Request</h1>
                    </div>
                    <div class="alert alert-danger fade in">
                        <p>Sorry, you've made an invalid request. Please <a href="index.php" class="alert-link">go back</a> and try again.</p>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>