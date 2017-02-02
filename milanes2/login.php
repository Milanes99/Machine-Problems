
<!DOCTYPE html>
<html>
<head>
	<title>Library</title>
	<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 50px 0 12px 0;
}

img.avatar {
    width: 60%;
    border-radius: 45%;
}

.container {
    padding: 30px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
body {
    background-color: skyblue;
}
</style>

</head>
<body>
<h1>Online Library</h1>

<form method="post", action="#">
  <div class="imgcontainer"> 
    <img src="books.gif" alt="Avatar" class="avatar">
  </div>

  <div class="container">
  
    <label class="w3-margin-left">Username :</label>
    <input type="text", name="username", placeholder="Enter Username"/> <br>
    <label class="w3-margin-left">Password :</label>
    &nbsp&nbsp<input type="password", name="password", placeholder="Enter Password"/> <br>
    <input type="submit", name="submit",value="submit"/> <br>
</div>
    </form>
    <?php 
    $c = oci_connect("Milanes","milanes","localhost/xe");
    if (!$c) {
            $e = oci_error();
                trigger_error('Could not Connect to Database:'. $e['message'], E_USER_ERROR);
        }   

          if(isset($_POST['submit'])){
           $c_username = addslashes($_POST['username']);
           $c_password= addslashes($_POST['password']);
           $sel_c = "select * from USERS where password = '".$c_password ."' AND username='".$c_username."'";
           $run_c = oci_parse($c,$sel_c);
           $exec = oci_execute($run_c);
           $arr = oci_fetch_array($run_c);
           $check_num = oci_num_rows($run_c);
           echo $check_num;

           while (($row = oci_fetch_array($run_c,OCI_ASSOC + OCI_RETURN_NULLS))!=False) {
           }
           if ($check_num == 0 ) {
                echo "<script>alert('username or password is incorrect')</script>";
           }else{
            header("Location: index.php");
           }
        }
     ?>

</body>
</html>