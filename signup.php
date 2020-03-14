<html>
    <head>
        <style>
        body{
            background-image: url("background2.jpg");
            background-repeat: no-repeat;
            background-size: 100%;
            background-attachment: fixed;
            backface-visibility: visible;
            margin: auto;
        }
        .main{
            top:0;
            bottom:0;
            left:0;
            right:0;
            margin:auto;
            position:absolute;
            text-align: center;
            height:75%;
            width:30%;
            background-color:lightgoldenrodyellow;
            border-radius: 10%;
            
        }
        .main{
            padding-top: 0.5%;
            overflow: auto;
        }
        input{
            height:10%;
            font-size: 1.8em;
            width: 100%;
            opacity: 1;
            border-radius: 10px;
            outline: none;
        }
        td{
            padding:10px;
        }
        .forgot{
            text-align: left;
            margin-left: 100px;
        }
        h1{
            font-size: 2.5em;
        }
        font{
            align-content: left;
            font-size:2em;
        }
        #signup{
            backface-visibility:visible;
            background-color: transparent;
            border-style:solid;
            border-width: 3px;
            border-color: black;
        }
        a{
            text-decoration:none;
        }
        /* unvisited link */
        a:link {
            color: black;
        }

        /* visited link */
        a:visited {
            color: black;
        }

        /* mouse over link */
        a:hover {
            color: black;
        }

        /* selected link */
        a:active {
            color: black;
        }
        .continue{
            color:black;
            font-weight:bold;
            display: block;
            margin:auto;
            bottom:0;
            left:35%;
            position:absolute;
        }
        </style>
    </head>
    <body>
        <div class=main>
            <h1 ><u>SIGN-UP PORTAL</u></h1>
            <br><br>
            <form  method="POST">
                <table>
                    <tr>
                        <td><font><b>Name : </b></font></td>
                        <td><input type='text' name='name' id='name' value=""></td>
                    </tr>
                    <tr>
                        <td><font><b>E-Mail : </b></font></td>
                        <td><input type='email' name='email' id='email' value=""></td>
                    </tr>
                    <tr>
                        <td><font><b>Mobile : </b></font></td>
                        <td><input type='number' name='mobile' id='mobile' value=""></td>
                    </tr>
                    <tr>
                        <td><font><b>Branch : </b></font></td>
                        <td><input type='text' name='branch' id='branch' value=""></td>
                    </tr>
                    <tr>
                        <td><font><b>Username : </b></font></td>
                        <td><input type='text' pattern='[0-9]{2}[A-Z]{3}[0-9]{4}' name='username' id='username' value=""></td>
                    </tr>
                    <tr>
                        <td><font><b>Password : </b></font></td>
                        <td><input type='password' name='pass' id='pass' value=""></td>
                    </tr>
                    <tr>
                        <td><font><b>Confirm : </b></font></td>
                        <td><input type='password' name='confirm' id='confirm' value=""></td>
                    </tr>
                </table>
                <br><br>
                <input type="submit" style="width:30%;" name='signup' value="SIGN-UP">
            </form>
        </div>
        <div class="continue">
            <center><u><a href="login.php"><h1>CONTINUE WITHOUT SIGNUP<h1></a></u></center>    
        </div>
         <?php
            if(isset($_POST['signup'])){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "dbmsj";
            $name=$_POST['name'];
            $email=$_POST['email'];
            $mobile=$_POST['mobile'];
            $branch=$_POST['branch'];
            $user=$_POST['username'];
            $pass=$_POST['pass'];
            $conf=$_POST['confirm'];
            if($pass==$conf){
            // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                
                $query = mysqli_query($conn,"SELECT * FROM users WHERE email = '". $email ."' or username = '". $user ."'");
                $query2 =mysqli_query($conn,"SELECT * FROM users");
                $rows= mysqli_num_rows($query2)+1;
                if (mysqli_num_rows($query) > 0)
                {
                    echo "<script>alert('Email Address or Username Already In Use.')</script>";
                }
                else{
                    $query3=mysqli_query($conn,"INSERT INTO users values($rows,'$name','$email',$mobile,'$branch','$user','$pass')");
                    header("Location:login.php");
                    
                }
                mysqli_close($conn);
            }
            else{
                echo "<script>alert('Password Confirmation Fail')</script>";
            }
        }	
            ?>
    </body>

</html>