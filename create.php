<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $description = $price = "";
$name_err = $description_err = $price_err = "";

// $target_file = $target_dir . basename($profileImageName);

// Processing form data when form is submitted
if (isset($_POST['submit'])) {
    $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
    $target_dir = 'img/' . $profileImageName;
    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (preg_match('/^[a-zA-Z0-9]+$/', $input_name)) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate description
    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Please enter an description.";
    } else {
        $description = $input_description;
    }

    // Validate price
    $input_price = trim($_POST["price"]);
    if (empty($input_price)) {
        $price_err = "Please enter the price amount.";
    } elseif (!ctype_digit($input_price)) {
        $price_err = "Please enter a positive integer value.";
    } else {
        $price = $input_price;
    }
    
    // Check input errors before inserting in database
    if (empty($name_err) && empty($description_err) && empty($price_err) && move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_dir)) {
        // Prepare an insert statement
        $sql = "INSERT INTO phone (name, description, price, profile_image) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_description, $param_price,$profileImageName);

            // Set parameters
            $param_name = $name;
            $param_description = $description;
            $param_price = $price;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: products.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "Something's wrong with the query: " . mysqli_error($link);
        }

        
    }

    // Close connection
    mysqli_close($link);
}
?>

<?php
include('session.php');
    if(!isset($_SESSION['Logged'])){
        header("location: login.html");
    }
    else if(!isset($_SESSION['Admin'])){
        header("location: redirect.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <style type="text/css">
        .wrapper {
            width: 500px;
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


    </ul>


    
    <div class="container">
        <h1>Welcome to the Phone Shop</h1>
    </div>
    <div class="container">
        <h2>Enjoy online shopping</h2>
    </div>

    <div class="flex-container">
        <h4>Products</h4>
    </div>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add Phone</h2>
                    </div>
                    <p>Please fill this form and submit to add phone record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                            <label>description</label>
                            <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                            <span class="help-block"><?php echo $description_err; ?></span>
                        </div>

                        <div class = "form-group">
                        <label>Profile Image</label>
                        <input type="file" name="profileImage" id="profileImage" class="form-control" >
                        

                        </div>


                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $price_err; ?></span>
                        </div>
                        <input type="submit" name = "submit" class="btn btn-primary" value="Submit">
                        <a href="redirect.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>