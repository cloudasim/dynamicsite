<?php include_once('includes/include-head.php'); ?>
<?php 
    $day = date('l');
    $time = date('H');

    // 
    $contacts = array(
        'Asim' => '9876543212',
        'John' => '1234567890',
        'Testname' => '9870987654',
        'Gopal' => '765432124',
        'Hari' => '3456789089',
        );

    // Connect to db here
    $message = '';
     $db = new mysqli($server, $username, $password, $dbname);
    if ($db->connect_error) {
        $message = $db->connect_error;
    }
    else{
        $sql = 'SELECT * FROM contacts ORDER BY savedon';
        $result = $db->query($sql);
        if($db->error){
            $message = $db->error;
        }
    }

?>
    <div id="main-wrapper">
        <?php include_once('includes/include-header.php'); ?>

        <div class="welcome-screen">
            <div class="container">
                <div class="row">
                    <div class=" col-xs-12">
                        <?php
                            if ($time > 0 && $time < 12) {
                                echo "<h1> Good Morning ! </h1>";
                            }
                            elseif ($time >= 12 && $time < 18) {
                                echo "<h1> Good Afternoon ! </h1>";
                            }
                            elseif ($time >= 18 && $time < 20) {
                                echo "<h1> Good Evening ! </h1>";
                            }
                            else{
                                echo "<h1> Good Night ! </h1>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <h4>Recently Added</h4>
                    <hr>
                    <?php if($message){
                        echo $message;
                    } else{ ?>
                    <ul class="list-group">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <li class='list-group-item'> <?php echo $row['name']; ?> <small> <?php echo $row['contact'];  ?></small> <a href="tel:<?php echo $row['contact']; ?>" class="label label-success pull-right"><i class="fa fa-phone"></i></a> </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>

                <div class="col-sm-5">
                    <form action="" method="get">
                        <div class="form-group">
                            <input type="text" name="searchname" placeholder="Search Name">
                            <input type="submit" class="btn btn-primary" value="Find &rarr;">
                        </div>
                    </form>
                    <hr>
                    <?php
                        // $searcheditem = $_GET['searchname'];
                        if (isset($_GET['searchname'])) {
                            echo "<h1>You Searched for " . $_GET['searchname'] ."</h1>";

                            if (array_key_exists($_GET['searchname'], $contacts)){
                                echo "<i class='fa fa-check text-primary'></i>" . $_GET['searchname'] . " Found";
                            }
                            else{
                                echo "<i class='fa fa-times text-danger'></i>" . $_GET['searchname'] . " Not Found";
                            }
                        }
                    ?>
                    <div></div>

                </div>
            </div>   
        </div>

    </div>
<?php include_once('includes/include-footer.php'); ?>