// --------Serach--prevent---refresh----
$("#search_form").submit(function (e) {
    e.preventDefault();
});
$(".categorys").click(function () {
    var cate_id = $(this).data('cate_id');
    $.ajax({
        url: "include/cate_load.php",
        type: "POST",
        data: { cate_id: cate_id },
        error: function () {
            alert("Failed!");
        },
        success: function (data) {
            if (!$.trim(data)) {
            } else {
                $("#blog_posts_box_Sec").html(data);
            }
        },
        timeout: 8000,
    });
    // ------color and selected change------------------------
    $(".categorys").removeClass("categorys_sel");
    $(this).toggleClass("categorys_sel");
});
// Search---------
$("#search_btn").click(function () {
    var search = document.getElementById("search_input").value;
    $.ajax({
        url: "include/search.php",
        type: "POST",
        data: { search: search},
        error: function () {
            alert("Failed!");
        },
        success: function (data) {
            if (!$.trim(data)) {
                alert("No data found");
            } else {
                $("#blog_posts_box_Sec").html(data);
            }
        },
        timeout: 8000,
    });
    // ------color and selected change------------------------
    $(".categorys").removeClass("categorys_sel");
    $(this).toggleClass("categorys_sel");
});
// samplecomment