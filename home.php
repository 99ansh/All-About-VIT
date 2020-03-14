<?php
    session_start();
?>
<html>
    <head>
        <style>
            
            *{
                box-sizing: border-box;
            }
            body{
                overflow-y: visible;
              
            }
            body::-webkit-scrollbar {
                width:0em;
            }
            .header{
                background-color:#4ABDAC;
                font-size: 3.5em;
                color: white;
                overflow:auto;
                margin:0 auto;
            }
            .content{
            
                
            }
            .footer{
                background-color:black;
                height:8%
            }
            .btn{
                background: transparent;
                margin: 4px 2px;
                cursor: pointer;
                border-color: black;
                border-radius: 12px;
                font-weight: bold;
                color: #4ABDAC;
                outline: none;  
                }
            .btn:hover{
                    box-shadow: 0px 0Px 5px 5px #4ABDAC;
            
                }
            .btn2{
                background: transparent;
                margin: 4px 2px;
                cursor: pointer;
                border-color: transparent;
                border-radius: 12px;
            
                color: white;
                outline: none;
                font-size: 0.8em;
            }
            body{
                margin:0;
                padding: 0;
                font-family: sans-serif;
                }

            nav ul{
        
            overflow: hidden;
            color:white;
            padding: 0;
            text-align: center;
            margin: 0;
            }
            nav ul li{
            display: inline-block;
            padding:20px;
            font-size: 1.5em;
            }
            section{
            line-height: 1.5em;
            font-size:0.9em;
        position: relative;
            width:80%;
            margin: 0 auto;
            }
            .content::-webkit-scrollbar{
                width=0em;
            }
            .sec::-webkit-scrollbar{
                width=0em;
            }
            .heading{
                text-align:center;
                height:8%;
            }
            .login{
                display: inline-block;
            }
            @media screen and (max-width:1500px){
            
            nav ul button{
                box-sizing: border-box;
                width:100%;
                padding: 15px;
                text-align: left;
            }
            .header{
                box-sizing: border-box;
                width:100%;
                
            }
            }
        </style>
            
        <script type='text/javascript' charset="utf-8">
            function home(){
                var source=document.getElementById("iframe");
                source.setAttribute("src","video.php");
            }
            function faq(){
                var source=document.getElementById("iframe");
                source.setAttribute("src","discussion_form.php");    
            }   
            function mh(){
                var source=document.getElementById("iframe");
                source.setAttribute("src","mens_hostel.php");
            }
            function lh(){
                var source=document.getElementById("iframe");
                source.setAttribute("src","ladies_hostel.php");
            }
            function restaurants(){
                var source=document.getElementById("iframe");
                source.setAttribute("src","restaurant_trial.php");    
            }
            function aboutus(){
                var source=document.getElementById("iframe");
                source.setAttribute("src","aboutus.php");    
            }
            function dashboard(){
                var source=document.getElementById("iframe");
                source.setAttribute("src","dashboard.php");    
            }   
             function login_logout(){
                var source=document.getElementById("Login");
                var myvalue=document.getElementById("logbtn");
                if(myvalue.value=="login"){
                    source.setAttribute("href","login.php");
                }
                else if(myvalue.value=="logout"){
                    var con=confirm("Are you sure you want to Logout ?");
                    if(con==true){
                        
                        source.setAttribute("href","login.php");                
                    }
                    else if (con==false){
                    }
                }
            }
        </script>
    </head>
    <body>
   <?php
/*         if(isset($_SESSION['regnum'])){
        echo "<script>alert('".$_SESSION['regnum']."');</script>";
        } */
   ?>
        <div class="header">
            <div class="heading">
            <?php
            if(isset($_SESSION['admin']) && $_SESSION['admin']!=""){
                echo "<button class='btn2' style='float:left;'>(ADMIN)</button>";
            }        
            ?>
                Welcome to VIT Vellore! 
            </div>
            <div class="login">
            <p class="btn2" style="position:absolute;top:0px;right:0px;font-size: 0.9em;">
                <!-- <a href="#" onclick="login_logout()" id="Login"> -->
                <?php
                    /* 
                    if(isset($_POST['submission'])&&isset($_SESSION['regnum'])){
                            
                            echo "<button value='logout' class='btn2' id='logbtn'>".$_SESSION['regnum']."</button><a>";
                    }        
                    else{
                        echo "<button value='login' class='btn2' id='logbtn'>".'Login'."</button></a>";
                        echo "<a href='signup.php' id='Signup'>";
                        echo "<button value='signup' class='btn2' id='signbtn'>".'Sign-up'."</button></a>";
                    }       */
                        /*         echo "<script>alert('".$_SESSION['regnum']."');</script>"      */        
                    if(isset($_SESSION['regnum']) && $_SESSION['regnum']!=""){
                        
                        echo "<button value='dashboard' class='btn2' onClick='dashboard()' style='border:1px solid white;'>Dashboard</button>";
                        echo "<a href='#' onclick='login_logout()' id='Login'>";
                        echo "<button value='logout' class='btn2' id='logbtn'>".$_SESSION['regnum']."</button></a>";
                        echo "<script>alert('".$_SESSION['regnum']."');</script>";
                        }
                    else if(isset($_SESSION['admin']) && $_SESSION['admin']!=""){
                        
                            echo "<button value='dashboard' class='btn2' onClick='dashboard()' style='border:1px solid white;'>Dashboard</button>";
                            echo "<a href='#' onclick='login_logout()' id='Login'>";
                            echo "<button value='logout' class='btn2' id='logbtn'>".$_SESSION['admin']."</button></a>";
                            echo "<script>alert('".$_SESSION['admin']."ADMIN');</script>";
                            }    
                    else{
                        echo "<a href='#' onclick='login_logout()' id='Login'>";
                        echo "<button value='login' class='btn2' id='logbtn' s>".'Login'."</button></a>";
                        echo "<a href='signup.php' id='Signup'>";
                        echo "<button value='signup' class='btn2' id='signbtn' style='border-radius:0px; border-left:6px solid black;'>".'Sign-up'."</button></a>";
                    }    
                ?>  
            </p>
            </div>
        </div>
        
        <div class="content">    
            <nav>
                <br>
                <ul>
                    <button onClick="home()" class="btn"><li>Home</li></button>
                    <button onClick="faq()" class="btn"><li>Discussion Form</li></button>
                    <button onClick="mh()" class="btn"><li>Mens Hostel</li></button>
                    <button onClick="lh()" class="btn"><li>Ladies Hostel</li></button>
                    <button onClick="restaurants()" class="btn"><li>Restaurants</li></button>
                    <!-- <button onClick="grocery()" class="btn"><li>Grocery Store</li></button> -->
                    <!-- <button onClick="gym()" class="btn"><li>Gallery</li></button> -->
                    <button onClick="aboutus()" class="btn"><li>About Us</li></button>
                </ul>
            </nav>
            <section class="sec">    
                <iframe src="video.php" id="iframe" height="150%"  width="100%" frameborder="0"></iframe>
            </section>        
        </div>
 <div class="footer">
                    bye
                </div> 
    </body>
</html>