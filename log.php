    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Tracko-Track the changes</title>
    
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-6f59b77e-213b-44d8-888e-5dff20beff09"></div> <!--Stylesheet-->
        <style media="screen">
        *,
    *:before,
    *:after{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    body{
        background-color: #080710;
    }
    .background{
        width: 430px;
        height: 520px;
        position: absolute;
        transform: translate(-50%,-50%);
        left: 50%;
        top: 50%;
    }
    .background .shape{
        height: 200px;
        width: 200px;
        position: absolute;
        border-radius: 50%;
    }
    
    form{
        height: 520px;
        width: 400px;
        background-color: rgba(255,255,255,0.13);
        position: absolute;
        transform: translate(-50%,-50%);
        top: 50%;
        left: 20%;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255,255,255,0.1);
        box-shadow: 0 0 40px rgba(8,7,16,0.6);
        padding: 50px 35px;
    }
    form *{
        font-family: 'Poppins',sans-serif;
        color: #ffffff;
        letter-spacing: 0.5px;
        outline: none;
        border: none;
    }
    form h3{
        font-size: 32px;
        font-weight: 500;
        line-height: 42px;
        text-align: center;
    }

    label{
        display: block;
        margin-top: 30px;
        font-size: 16px;
        font-weight: 500;
    }
    input{
        display: block;
        height: 50px;
        width: 100%;
        background-color: rgba(255,255,255,0.07);
        border-radius: 3px;
        padding: 0 10px;
        margin-top: 8px;
        font-size: 14px;
        font-weight: 300;
    }
    ::placeholder{
        color: #e5e5e5;
    }
    #submit{
        margin-top: 50px;
        width: 100%;
        background-color: #ffffff;
        color: #080710;
        padding: 15px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }
    .social{
    margin-top: 30px;
    display: flex;
    }
    .social div{
    background: red;
    width: 150px;
    border-radius: 3px;
    padding: 5px 10px 10px 5px;
    background-color: rgba(255,255,255,0.27);
    color: #eaf0fb;
    text-align: center;
    }
    .social div:hover{
    background-color: rgba(255,255,255,0.47);
    }
    .social .fb{
    margin-left: 25px;
    }
    .social i{
    margin-right: 4px;
    }

        </style>
    </head>
    <body>
        <img src="tracko_desc3.png" height=50% width=100%>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form action="authentication.php" method ="post" onsubmit = "return validation()" name="f1">
            <h3>Login Here</h3>

            <label for="username">Username</label>
            <input type="text" placeholder="username" id="username" name = "user">

            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password" name ="pass">

            <input type = "submit" id ="submit">
            
        </form>
        <script>  
                function validation()  
                {  
                    var id=document.f1.user.value;  
                    var ps=document.f1.pass.value;  
                    if(id.length=="" && ps.length=="") {  
                        alert("User Name and Password fields are empty");  
                        return false;  
                    }  
                    else  
                    {  
                        if(id.length=="") {  
                            alert("User Name is empty");  
                            return false;  
                        }   
                        if (ps.length=="") {  
                        alert("Password field is empty");  
                        return false;  
                        }  
                    }                             
                }  
            </script>  
    </body>
    </html>
