<?php
include("connection.php");
if (!isset($_GET["b_i"])) {
    echo "<script> location.href = 'index.php'</script>";
}
$blog_sql = $sql->prepare("SELECT `blog_id`, `blog`.`cate_id`, `blog_title`, `blog_disc`, `blog_img`, `blog_date`,`cate`.`cate_name` AS cate_name
FROM `blog`
LEFT JOIN `cate` ON `blog`.`cate_id` = `cate`.`cate_id`
WHERE blog_id = ? ORDER BY blog_id DESC LIMIT 12");
$blog_sql->bind_param('s',$_GET["b_i"]);
$blog_sql->execute();
$blog_result = $blog_sql->get_result();
$blog = $blog_result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $blog["blog_title"]; ?></title>
    <?php include("head.php"); ?>
</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="blog_post_sec block">
        <div class="single_blog_details">
            <div class="categories_sec2">
                <a href="#">
                    <p class="categorys categorys_sel"><?php echo $blog["cate_name"]; ?></p>
                </a>
            </div>
            <p id="blog_date"><?php echo date("F j, Y ", strtotime($blog["blog_date"]));  ?></p>
            <h3 class="blog_post_box_title2"><?php echo $blog["blog_title"]; ?></h3>
            <img src="<?php echo $blog["blog_img"]; ?>" alt="" class="blog_post_box_img2" />
        </div>
        <div class="blog_part">
            <p id="blog_post_box_p2"><?php echo $blog["blog_disc"]; ?></p>
            <div class="blog_single_post_featured">
                <?php
                $fblog_sql = $sql->prepare("SELECT `blog_id`, `blog`.`cate_id`, `blog_title`, `blog_disc`, `blog_img`,`cate`.`cate_name` AS cate_name
            FROM `blog`
            LEFT JOIN `cate` ON `blog`.`cate_id` = `cate`.`cate_id`
            ORDER BY blog_id DESC LIMIT 3");
                $fblog_sql->execute();
                $fblog_result = $fblog_sql->get_result();
                while ($fblog = $fblog_result->fetch_assoc()) { ?>
                    <div class="blog_post_box1">
                        <div class="blog_post_img_sec">
                            <img src="<?php echo $fblog["blog_img"]; ?>" alt="" class="blog_post_box_img" />
                            <p class="category"><?php echo $fblog["cate_name"]; ?></p>
                        </div>
                        <div class="special_blog_post_2">
                            <a href="single_post.php?bn=<?php echo $fblog["blog_title"]; ?>&b_i=<?php echo $fblog["blog_id"]; ?>">
                                <h3 class="blog_post_box_title"><?php echo $fblog["blog_title"]; ?></h3>
                            </a>
                            <p id="blog_post_box_p"><?php echo $fblog["blog_disc"]; ?></p>
                        </div>
                    </div>
                <?php  }
                ?>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>