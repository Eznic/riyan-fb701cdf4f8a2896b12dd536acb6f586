$(document).ready(() =>{
    var userData = {};

    // Login Handle
    $("#lsub").click(() => {

        // Get Data In Login Form
        let data = { login : true, u : val("lun"), p : val("lpw") };

        $.post(
            basepath() + "back-end/core.php",
            data,
            (data,response) => {

                console.log(data);

                if(typeof data.status != 'undefined')
                {
                    alert("Username / Password Salah")
                }
                else
                {
                    window.localStorage.setItem('user', JSON.stringify(data));
                    window.localStorage.setItem('session', data.name);
                    // Login Success
                    window.location.href = "home.html";
                    console.log(data);
                }

            }
        );
    });

    // Register Handler
    $("#rsub").click(() => {

        let data = { register : true, n: val("rn"), u : val("run"), p : val("rpw"), pr : val("rpwr") };

        if(data.pr != data.p)
        {
            alert("Password Tidak Sama");
        }
        else
        {
            let foo = $.post(
                basepath() + "back-end/core.php",
                data,
                (data,response) => {
    
                    if(data == null)
                    {
                        alert("Register Gagal");
                    }
                    else
                    {
                        // Register Success
                        window.location.href = "login.html";
                    }
    
                }
            );

            console.log(foo);
        }
        

    });

    $("#logout").click(() => {

        window.localStorage.removeItem("session");
        window.localStorage.removeItem("user");
        window.location.href = "login.html";

    });

    $("#btn").click(() => {

        let userData = JSON.parse(window.localStorage.getItem('user'));

        alert("Hai " + userData.name + ", waktu login anda " + userData.login_time);

    });

    // getValue
    const val = (id) => {
        // id : string
        return $(`#${id}`).val();
    }

    // Get Basepath
    const basepath = () => {
        
        // Origin
        let origin = window.location.origin;

        // BaseFolder
        let baseFolder = window.location.pathname.split("front-end")[0];

        return origin + baseFolder;

    }

});