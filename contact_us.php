<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <?php include("head.php"); ?>
</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="form_area">
        <div class="form_area_title_sec block">
            <p id="banner_heading" style="text-align: center">Contact Us</p>
            <h2 id="blog_banner_h2" style="text-align: center">
                We want to hear you
            </h2>
            <?php
            if (isset($_POST["submit_btn"])) {
                $c_name= $_POST["c_name"];
                $c_mail= $_POST["c_mail"];
                $c_desc= $_POST["c_desc"];
                $c_sql = $sql->prepare("INSERT INTO `contact_us`(`c_name`, `c_mail`, `c_desc`) VALUES (?,?,?)");
                $c_sql->bind_param('sss',$c_name,$c_mail,$c_desc);
                $c_sql->execute();
                if ($c_sql->affected_rows > 0) { ?>
                    <p id="banner_heading" style="text-align: center; color: #0BE52E;">Thanks for contacting us.</p>
                <?php }
            }
            ?>
            <form action="" method="POST" class="contact_from">
                <div class="single_input">
                    <p class="input_title">Full name</p>
                    <input type="text" name="c_name" placeholder="Enter your name" required />
                </div>
                <div class="single_input">
                    <p class="input_title">Email</p>
                    <input type="email" name="c_mail" placeholder="Enter your email" required />
                </div>
                <div class="single_input">
                    <p class="input_title">Description</p>
                    <textarea id="big_input" name="c_desc" type="text" placeholder="Enter your motive" required></textarea>
                </div>
                <button class="form_submit_btn" name="submit_btn">Submit</button>
            </form>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>