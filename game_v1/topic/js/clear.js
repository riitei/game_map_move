$(".sub_ans").click(function () {
    // var num = $(window.parent.document).find("#btn_down").val();
    // var num = $(window.parent.document).find("#dialgo").css("height");

    $("#dialgo", parent.document).css("height", window.parent.window.temp_dialog_height);// 調用父級元素並修改
    $("#dialgo", parent.document).css("width", window.parent.window.temp_dialog_width);// 調用父級元素並修改
    var dialog_count = $(window.parent.document).find("#btn_down").val();
    var vertical = window.parent.window.photo_center_vertical;
    var horizontal = window.parent.window.photo_center_horizontal;
    window.top.close();
    console.log("@@@@@@@@@@@@@@@@@@");
    // $("#mess",parent.document).empty();
    // console.log("clear");
    character(vertical, horizontal, dialog_count);

});