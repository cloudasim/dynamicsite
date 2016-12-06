<?php include_once('includes/include-head.php'); ?>
<?php
    $aaja= date("Y-m-d h:i:s");
?>
    <div id="main-wrapper">
        <?php include_once('includes/include-header.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Add Contact</h4>
                    <hr>
                    <form action="" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="fullname" class="col-sm-2">Full Name: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contactno" class="col-sm-2">Contact Number: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-primary">
                                <input type="hidden" value="<?php echo $aaja; ?>" name="savedon">
                            </div>
                        </div>
                    </form>
                    <?php
                        $fullname = $contact = $savedon = "";

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $fullname = $_POST["fullname"];
                            $contact = $_POST["contactno"];
                            $savedon = $_POST["savedon"];
                        }

                        echo $fullname. "<br>". $contact . "<br>" . $savedon;
                    ?>
                </div>
            </div>   
        </div>

    </div>
<?php include_once('includes/include-footer.php'); ?>