$(document).ready(function () {
    $("#buttonSubmit").click(function (e) {

        var name        = $('#name').val();
        var email       = $('#emailRegister').val();
        var telp        = $('#telp').val();
        var password    = $('#passwordRegister').val();
        var rePassword  = $('#RePasswordRegister').val();

        if(name.length == 0 || email.length == 0 || password.length == 0 || telp.length == 0 ){
            alert("Data masih ada yang kosong");
        }

        else if(telp.length < 11){
            alert("telp minimal 11 karakter");
        }

        else if(!CekEmail(email)){
            alert("email tidak valid");
        }

        else if(password.length <8){
            alert("Password minimal 8 karakter");
        }

        else if(password != rePassword){
            alert("Password anda tidak sesuai");
        }

        else{

           var temp =  confirm("Pastikan data yang anda masukan sudah benar. ");

           if (temp == true){
                document.getElementById("buttonSubmit").type = 'submit';
           }

        }



        function CekEmail(email){
            var emailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            return emailRegex.test(email);
        }

    });
});
