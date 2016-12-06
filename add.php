<?php include_once('includes/include-head.php'); ?>
<?php
    session_start();
    $aaja= date("Y-m-d h:i:s");
    $db = new mysqli($server, $username, $password, $dbname);
    // connect to db
    if ($db->connect_error) {
        $message = $db->connect_error;
    }

    // define errors
    $nameError = $contactError = "";
    $fullname = $contact = $savedon = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // set variables from form elements
        $fullname = $_POST["fullname"];
        $contact = $_POST["contactno"];
        $savedon = $_POST["savedon"];

        // Check for Errors
        if (empty($fullname)) {
            $nameError = "<span class='text-danger'>Enter Name</span>";
        }elseif(!preg_match("/[a-z | A-Z]{3}/", $fullname)){
            $nameError = "<span class='text-danger'>Name is Valid Words with min 3 Chars!</span>";
            $_SESSION['$fullname'] = $_POST["fullname"];
        }else{
            $fullname = $fullname;
        }

        if (empty($contact)) {
            $contactError = "<span class='text-danger'> Enter Contact </span>";
        }elseif(!preg_match("/\d{10}/", $contact)) {
            $contactError = "<span class='text-danger'> Phone No. is 10 digit NUMBER only!</span>";
            $_SESSION['$contact'] = $_POST["$contactno"];
        }else{
            $contact = $contact;
        }
    }
    
    if (isset($_POST['submit']) and (!$nameError and !$contactError) ){
        $sql = "INSERT INTO contacts (name, contact, savedon) VALUES ('$fullname', '$contact', '$savedon')";
        if($db->query($sql) === TRUE){
            echo "<div class='form-msg'>New contact Added</div>";
            session_unset();
            session_destroy();
        }
        if($db->error){
            echo "<br>" . $db->error;
        }
    }
    

?>
    <div id="main-wrapper">
        <?php include_once('includes/include-header.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Add Contact</h4>
                    <hr>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="fullname" class="col-sm-2">Full Name: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" value="<?php if( isset($_SESSION['$fullname'])){echo $_SESSION['$fullname'];} ?>">
                            </div>
                            <div class="col-sm-4">
                                * <?php echo $nameError; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contactno" class="col-sm-2">Contact Number: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact Number" value="<?php if( isset($_SESSION['$contact'])){echo $_SESSION['$contact'];} ?>">
                            </div>
                            <div class="col-sm-4">
                                * <?php echo $contactError; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-primary">
                                <input type="hidden" value="<?php echo $aaja; ?>" name="savedon">
                            </div>
                        </div>
                    </form>
                </div>
            </div>   
        </div>

    </div>
<?php include_once('includes/include-footer.php'); ?>