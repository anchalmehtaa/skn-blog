<?php
include("../connection.php");
$blog_title = $_POST["search"]."%";
$blog_sql = $sql->prepare("SELECT `blog_id`, `blog`.`cate_id`, `blog_title`, `blog_disc`, `blog_img`,`cate`.`cate_name` AS cate_name
FROM `blog`
LEFT JOIN `cate` ON `blog`.`cate_id` = `cate`.`cate_id` 
WHERE `blog_title` LIKE ? ORDER BY blog_id DESC");
$blog_sql->bind_param('s', $blog_title);
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