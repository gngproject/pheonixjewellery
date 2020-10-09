
    // $(document).ready(function(){
    //   $("#filter").keyup(function(){
    //     var str = $("filter").val();
    //     if(str == ""){
    //       $("#txtHint").html("seacrh information will be listed here....");
    //     } else {
    //       $.get( "{{ url('/Search/Data?id=') }}"+str, function(data){
    //         $("#txtHint").html(data);
    //       });
    //     }
    //   });
    // });

    // var filter = document.getElementById('filter');
    //   filter.addEventListener('keyup',function(){
    //     console.log("test");
    // });

    $(document).ready(function(){
        //event ketika keyword ditulis
        $('#filter').on('keyup', function(){
            $('#container').load('/Product-All?filter=' + $('#filter').val());
        });
    });