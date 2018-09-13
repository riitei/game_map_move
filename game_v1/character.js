function character(v, h) {

    $.getJSON("http://gamemapmove.riitei.com/game_v1/json/dialgo.json",
        function (data) {
            // $.each(data, function (index, value) {
            //     console.log(index + ' , ' + value);
            // })
            // var d = JSON.parse(data);
            if (73 <= v && v <= 75 && 74 <= h && h <= 76) {
                var dialgo_count = 0;
                console.log("*** " + v + " , " + h + "***");

                console.log(">>>>>>>>>>>>> in");
                // 存放未移動舊座標位置
                $("#mess").empty();
                //

//----------------------------------

                $("#btn_down").click(function () {
                    dialgo_count = dialgo_count + 1;

                    console.log("--> btn_down ---> " + $("#btn_down").val());
                    $("#btn_down").val(dialgo_count);
                    $("#mess").empty();

                    $("#mess").append(data["Character_01"]["dialgo"][dialgo_count]);

                    if ($("#example_topic").attr('width')) {
                        // 重新繪製div 長 與 寬
                        $(".example").css('width', $("#example_topic").css('width'));
                        $(".example").css('height', $("#example_topic").css('height'));
                        // if (code1submit() == 1) {
                            $("#sub").click(function () {
                                console.log("作答結束-> "+dialgo_count );

                            });




                        // } else {
                        //     console.log("沒作答-> " + code1submit());
                        // }
                    }

                });
//----------------------------------

                $("#btn_up").click(function () {
                    dialgo_count = dialgo_count - 1;

                    console.log("--> btn_up ---> " + $("#btn_up").val());

                    $("#btn_up").val(dialgo_count);
                    $("#mess").empty();
                    $("#mess").append(data["Character_01"]["dialgo"][dialgo_count]);
                    if ($("#example_topic").attr('width')) {
                        // 重新繪製div 長 與 寬
                        $(".example").css('width', $("#example_topic").css('width'));
                        $(".example").css('height', $("#example_topic").css('height'));


                    }

                });
//----------------------------------
                console.log("--> btn value ==> " + $("#btn_down").val());

                console.log("mess=> " + data["Character_01"]["dialgo"][dialgo_count]);
                $("#mess").append(data["Character_01"]["dialgo"][0]);
                if ($("#example_topic").attr('width')) {
                    // 重新繪製div 長 與 寬
                    $(".example").css('width', $("#example_topic").css('width'));
                    $(".example").css('height', $("#example_topic").css('height'));

                }
                $("#dialgo").css("display", "inline");


                trajectory_status = "character_01";
            }


        });

    return 1;

}


function down() {

}
