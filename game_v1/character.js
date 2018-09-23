var temp_dialog_width = $("#dialgo").css("width");
var temp_dialog_height = $("#dialgo").css("heigth");
// var temp_vertical = 0;
// var temp_horizontal = 0;

function character(v, h, dialgo_count = 0) {
    temp_dialog_width = $("#dialgo").css("width");
    temp_dialog_height = $("#dialgo").css("height");
    console.log("dd");

    $.getJSON("http://gamemapmove.riitei.com/game_v1/json/dialgo.json",
        function (data) {

            //
            if (73 <= v && v <= 75 && 74 <= h && h <= 76) {
                $("#mess").empty();
                console.log("*** " + v + " , " + h + "***");
                console.log("dialgo_count=> " + dialgo_count);
                // 存放未移動舊座標位置
                //
                //
                $("#mess",parent.document).append(data["Character_01"]["dialgo"][dialgo_count]);
                //
                $("iframe", parent.document).remove();
                //
                trajectory_status = "character_01";


                console.log("===============================");
//----------------------------------

                $("#btn_down").click(function () {
                     $("#mess").empty();
                    //
                    dialgo_count = dialgo_count + 1;
                    console.log("btn mess show => " + dialgo_count);
                    // console.log("--> btn_down ---> " + $("#btn_down").val());
                    // $("#btn_down").val(dialgo_count);
                    //
                    $("#mess").append(data["Character_01"]["dialgo"][dialgo_count]);
                    console.log("mess =>> " + data["Character_01"]["dialgo"][dialgo_count]);
                    // 判斷是否有 iframe 標籤
                    var iframe_tag = document.getElementById("mess").getElementsByTagName("iframe");
                    if (iframe_tag.length > 0) {
                        // 重新繪製div 長 與 寬
                        // dialgo_count = dialgo_count + 1;
                        $("#dialgo").css('width', $("iframe").css('width'));
                        $("#dialgo").css('height', $("iframe").css('height'));
                        dialgo_count = dialgo_count + 1;// 下一句先計算
                        $("#btn_down").val(dialgo_count);
                    }
                    //
                    console.log("------------------->> down_end");

                });
//----------------------------------

                $("#btn_up").click(function () {
                    dialgo_count = dialgo_count - 1;
                    // console.log("--> btn_down ---> " + $("#btn_down").val());
                    // $("#btn_down").val(dialgo_count);
                    $("#mess").empty();
                    //
                    $("#mess").append(data["Character_01"]["dialgo"][dialgo_count]);

                    // 判斷是否有 iframe 標籤
                    var iframe_tag = document.getElementById("mess").getElementsByTagName("iframe");
                    if (iframe_tag.length > 0) {
                        // 重新繪製div 長 與 寬
                        // dialgo_count = dialgo_count + 1;
                        $("#dialgo").css('width', $("#example_topic").css('width'));
                        $("#dialgo").css('height', $("#example_topic").css('height'));
                        dialgo_count = dialgo_count - 1;// 下一句先計算
                        $("#btn_down").val(dialgo_count);
                    }
                    //


                });
//----------------------------------
                //

            }

            $("#dialgo").css("display", "inline");

        });

    return 1;

}


function down() {

}
