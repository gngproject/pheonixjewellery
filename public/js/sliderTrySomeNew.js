
        $(document).ready(function () {
            var itemWidth = $(".slides").outerWidth();//width Per gambar + padding
            var totItem = document.getElementById("slider").childElementCount;

            var monitorWidth = screen.width;

                Notresponsive(3);

            function Notresponsive(itemWantToShow){  //itemWantToShow = item yang ditampilkan di viewport
                let viewportWidth = itemWidth*itemWantToShow;
                let index = totItem / itemWantToShow;//masih ada komanya
                let indexFix = parseInt(index,10);//ngilangin koma
                var counter = 1;

                $(".viewPort").css('width', viewportWidth);

                if(index > indexFix){
                    // alert("gesersebanyak indexfix+1");
                    indexFix = indexFix +1;

                }

                $(".right").click(function (e) {
                    if(counter < indexFix){
                        $(".slider").animate({right: "+="+viewportWidth},1000,function(){});
                        counter++;
                    }

                    else{
                        $(".slider").animate({right: "0px"},1000,function(){});
                        counter=1;
                    }
                });

                $(".left").click(function (e) {
                    if(counter != 1){
                        $(".slider").animate({right: "-="+viewportWidth},5000,function(){});
                        counter--;
                    }
                });

                // setInterval(() => {
                //     if(counter < indexFix){
                //         $(".slider").animate({right: "+="+viewportWidth},5000,function(){});
                //         counter++;
                //     }

                //     else{
                //         $(".slider").animate({right: "0px"},5000,function(){});
                //         counter=1;
                //     }
                // }, 5000);

            }

        });