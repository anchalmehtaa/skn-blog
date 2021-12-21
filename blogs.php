<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blogs</title>
    <?php include("head.php"); ?>
</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="blog_banner_sec block">
        <form action="" id="search_form">
            <div class="input_box">
                <input type="text" name="" id="search_input" placeholder="Search something..." />
                <button type="submit" id="search_btn">Go</button>
            </div>
        </form>
    </div>
    <div class="categories_sec block">
        <p class="categorys categorys_sel" data-cate_id="0">ALL</p>
        <?php
          $cate_sql = $sql->prepare("SELECT `cate_id`, `cate_name` FROM `cate`");
          $cate_sql->execute();
          $cate_result = $cate_sql->get_result();
          while ($cate = $cate_result->fetch_assoc()) { ?>
        <p class="categorys" data-cate_id="<?php echo $cate["cate_id"]; ?>"><?php echo $cate["cate_name"]; ?></p>
        <?php 
          } 
        ?>
    </div>
    <div class="blog_posts_box_Sec block" id="blog_posts_box_Sec">
        <?php
          $blog_sql = $sql->prepare("SELECT `blog_id`, `blog`.`cate_id`, `blog_title`, `blog_disc`, `blog_img`,`cate`.`cate_name` AS cate_name
          FROM `blog`
          LEFT JOIN `cate` ON `blog`.`cate_id` = `cate`.`cate_id`
          ORDER BY blog_id DESC LIMIT 12");
          $blog_sql->execute();
          $blog_result = $blog_sql->get_result();
          while ($blog = $blog_result->fetch_assoc()) { ?>
        <div class="blog_post_box1">
            <div class="blog_post_img_sec">
                <img src="<?php echo $blog["blog_img"]; ?>" alt="" class="blog_post_box_img" />
                <p class="category"><?php echo $blog["cate_name"]; ?></p>
            </div>
            <div class="special_blog_post_2">
                <a href="single_post.php?bn=<?php echo $blog["blog_title"]; ?>&b_i=<?php echo $blog["blog_id"]; ?>">
                    <h3 class="blog_post_box_title"><?php echo $blog["blog_title"]; ?></h3>
                </a>
                <p id="blog_post_box_p"><?php echo $blog["blog_disc"]; ?></p>
            </div>
        </div>
        <?php 
          } 
          ?>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>