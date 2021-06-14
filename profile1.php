<?php
error_reporting(0);
$valid=0; 
if(isset($_POST["btn"]))
{
//validation for first name
  if(empty($_POST["fname"]))
  {
    $errorfname="First name is required.";
    $valid=0;
  }
  else
  {
    if(preg_match("/^[A-Za-z]+$/",$_POST["fname"]))
    {
      $errorfname="only alphabets allowed.";
      $valid=1;
    }
    else{
      $valid=0;
    }
  }
//validation for last name  
    if(preg_match("/^[A-Za-z]+$/",$_POST["lname"]))
    {
      $valid=1;
    }
    else
    {
      $errorlname="only alphabets allowed.";
      $valid=0;
    }
  
//validation for email
  if(empty($_POST["email"]) )
  {
    $erroremail= "Email Is Required";
    $valid=0;
  }
  else
  {
    if(preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/",$_POST["email"]))
    {
      $valid=1;
    }
    else{
      $erroremail= "Email is Not Allowed";
      $valid=0;
    }
  }
//validation for phone number
  $len=strlen($_POST["pnumber"]);
  if((is_numeric($_POST["pnumber"]) && $len==10))
  {
    $valid=1;
  }
  else
  {
    $errorpnumber="phone number should be in number format with 10 digit in it ";
    $valid=0;
  }
//validation for city
  if(empty($_POST["city"]))
  {
    $errorcity= "City Name cannot be blank.";
    $valid=0;
  }
  else
  {
      if(preg_match("/^[A-Za-z]+$/",$_POST["city"]))
    {
      $valid=1;
    }
    else{
      $errorcity= "Only alphabets Allowed.";
      $valid=1;
    }
  }
//validation for photo
    $extensionsarray=array('jpeg','png','gif','jpg','bmp','PNG','JPEG','JPG','GIF','BMP');
    $fileextension=pathinfo($_FILES["uploadedfiles"]["name"],PATHINFO_EXTENSION); 
    if(! in_array($fileextension,$extensionsarray))
      {
      $errorphoto="*Please upload file with extension jpeg/bmp/png/gif/jpg.";
      $valid=0;
    }
    else
    {
      $valid=1;
    }
//validation for graduation
    if(empty($_POST["graduation"]))
    {
      $error="Please Select Graduation.";
      $valid=0;
    }
    else
    {
      $valid=1;
    }
//validation for year
    if(empty($_POST["year"]))
    {
      $erroryear="Please Select Year.";
      $valid=0;
    }
    else
    {
      $valid=1;
    }
//validation for specialization
   if(empty($_POST["special"]))
    {
      $errorspecial= "Specialization cannot be blank.";
      $valid=0;
    }
    else
    {
        if(preg_match("/^[A-Za-z\s]+$/",$_POST["special"]))
      {
        $valid=1;
      }
      else{
        $errorspecial= "Only alphabets and space Allowed.";
        $valid=0;
      }
    }
//validation for clg name
     if(empty($_POST["clg"]))
    {
      $errorclg="collge/university name is required";
      $valid=0;
    } 
    else
    {
      if(preg_match("/^[A-Za-z\s.]+$/",$_POST["clg"]))
      {
        $valid=1;
      }
      else{
        $errorclg= "Only alphabets,space,dot Allowed.";
        $valid=0;
      }
    }
//validation for Primary skills
    if(empty($_POST["primary"]))
    {
      $errorprim="Primary skills are Compulsory.";
      $valid=0;
    }
    else
    {
      if(preg_match("/^[A-Za-z,]+$/",$_POST["primary"]))
        $valid=1;
      else{
        $errorprim= "Only alphabets and comma Allowed.";
        $valid=0;
      }
    }
//validation for secondary skills
    if(empty($_POST["second"]))
    {
      $errorsec="";
      $valid=1;
    } 
    else
    {
    if(preg_match("/^[A-Za-z,]+$/",$_POST["second"]))
        $valid=1;
      else{
        $errorsec= "Only alphabets and comma Allowed.";
        $valid=0;
      }
    }
//validation for pitch
    if(empty($_POST["pit"]))
    {
      $errorpit="Please Write Pitch.";
      $valid=0;
    }
    else $valid=1;   
//validation for gender
  if(isset($_POST["gender"]))
  {
    $valid=1;
  }
  else
  {
    $errorgender="Please select gender.";
    $valid=0;
  }
}
//insert into database
  if($valid==1)
  {
  $filename=$_FILES['uploadedfiles']['name'];
  $tempname=$_FILES['uploadedfiles']['tmp_name'];
  $folder = "userprofile/".$filename;
  move_uploaded_file($tempname,$folder);
  $con=mysqli_connect("localhost","root","","pixel6");
  $sql=mysqli_query($con,"select * from profileinfo where email='".$_POST["email"]."'");
    if(mysqli_num_rows($sql)>0)
    {
    echo"Email id already exit";
      exit;
    }
    $query="insert into profileinfo (`firstname`, `lastname`, `gender`, `email`, `phone`, `state`, `city`, `photo`, `graduation`, `grade`, `year`, `special`, `college`, `primary`, `secondary`, `certificate`, `pit`) values('".$_POST["fname"]."','".$_POST["lname"]."','".$_POST["gender"]."','".$_POST["email"]."','".$_POST["pnumber"]."','".$_POST["state"]."','".$_POST["city"]."','$filename','".$_POST["graduation"]."','".$_POST["perc"]."','".$_POST["year"]."','".$_POST["special"]."','".$_POST["clg"]."','".$_POST["primary"]."','".$_POST["second"]."','".$_POST["certi"]."','".$_POST["pit"]."')";
    if (mysqli_query($con, $query))
    {   
      $url="userprofile1.php?firstname='".$_POST["fname"]."'&Lastname='".$_POST["lname"]."'&email='".$_POST["email"]."'";
      header ("Location:$url");
      exit();
    }
    else
    {
      echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main1.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
  <div class="container">
  <div class="title"> CREATE YOUR PROFILE PAGE</div>
  <div class="content">
  <form method="post" enctype="multipart/form-data">
      <!-- Personal Fields -->
    <h2>Personal</h2>
    <p style="color: red">
     *required field
    </p>
    <div style="border-top: solid;">
      <div class="user-details">
        <div class="input-box">
          <span class="details">First Name:</span>
          <input type="text" id="fname" name ="fname" value="<? echo $_POST["fname"]; ?>" placeholder="Enter your First name" pattern="^[A-Za-z]+$" required=""/>
          <p style="color: red">*
            <?php
            if(isset($errorfname)){
             echo $errorfname;
            }
            ?>
          </p>
        </div>
        <div class="input-box">
          <span class="details">Last Name:</span>
          <input type="text" id="lname"name="lname" value="<? echo $_POST["lname"]; ?>" placeholder="Enter your Last Name" pattern="^[A-Za-z]+$"/>
          <p style="color: red">
            <?php
            if(isset($errorlname)){
             echo $errorlname;
            }
            ?>
          </p>
        </div>
      </div>
      <div class="user-email">
        <div class="input-box">
          <span class="details">Email:</span>
          <input type="email" name="email" value="<? echo $_POST["email"]; ?>" placeholder="example@gmail.com" required/>
         <p style="color: red">*
            <?php
            if(isset($erroremail)){
             echo $erroremail;
            }
            ?>
          </p>
        </div>
      </div>
      <div class="gender-details">
        <span class="gender-title">Gender:</span>
        <input type="radio"  name="gender" value="male" id="dot-1"/>
        <input type="radio"  name="gender" value="female" id="dot-2"/>
        <div class="category">
          <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
        </div>
        <p style="color: red">*
          <?php
          if(isset($errorgender)){
           echo $errorgender;
          }
        ?>
        </p>
      </div>
      <div class="user-details">
        <div class="input-box">
          <span class="details">Phone Number:</span>
          <input type="tel" name="pnumber" pattern="[0-9]{10}" value="<?php echo $_POST["pnumber"]; ?>" placeholder="Enter Your 10 digit Phone number"/>
           <p style="color: red">
            <?php
            if(isset($errorpnumber)){
             echo $errorpnumber;
            }
            ?>
          </p>
        </div>
        <div class="input-box">
          <span class="details">City:</span>
          <input type="text" name="city" pattern="^[A-Za-z]+$" value="<? echo $_POST["city"]; ?>" placeholder="Enter your city name" required=""/>
           <p style="color: red">*
            <?php
            if(isset($errorcity)){
             echo $errorcity;
            }
            ?>
          </p>
        </div>
      </div>
      <div class="user-details">
        <div class="input-box">
          <span>State:</span>
          <select id ="state" name="state" value="<? echo $_POST["state"]; ?>">
            <option value="">--select--</option>
            <option value="maharashtra">Maharashtra</option>
            <option value="goa">Goa</option>
            <option value="kerala">kerala</option>
            <option value="delhi">Delhi</option>
            <option value="gujarat">Gujarat</option>
          </select>
        </div>
        <div class="input-box">
        <span>Photo: </span>
        <input type="file" name="uploadedfiles" value="<? echo $_POST["uploadedfiles"]; ?>"/>
         <p style="color: red">
            <?php
            if(isset($errorphoto)){
             echo $errorphoto;
            }
            ?>
          </p>
        </div>
      </div>
    </div>  

    <!-- Educational fields -->
    <h1 style="font-size: 25px;">Education</h1>
    <div style="border-top: solid;">
      <div class="user-details">
        <div class="input-box">
          <span>Graduation:</span>
          <select id ="graduation" name="graduation" value="<? echo $_POST["graduation"];?>" required="">
            <option value="">--select--</option>
            <option value="mba">MBA</option>
            <option value="mcs">MCS</option>
            <option value="mca">MCA</option>
            <option value="be">B.E</option>
            <option value="btech">B.Tech</option>
          </select>
          <p style="color: red">*
            <?
            if(isset($error))
            {
             echo $error;
            }
            ?>
          </p>
        </div>
        <div class="input-box">
          <span>Year:</span>
          <select id ="year" name="year" value="<? echo $_POST["year"]; ?>" required="">
            <option value="">--select--</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2018">2018</option>
            <option value="2017">2017</option>
            <option value="2016">2016</option>
          </select>
          <p style="color: red">*
            <?
            if(isset($erroryear))
            {
             echo $erroryear;
            }
            ?>
          </p>
        </div>
      </div>
      <div class="user-details">
        <div class="input-box">
          <span class="details">Graduation Grade/Percentage:</span>
          <input type="text" name="perc" placeholder="eg.78% / 8.0CGPA" value="<? echo $_POST["perc"];?>"/>
        </div>
        <div class="input-box">
          <span class="details">Specialization:</span>
          <input type="text"name="special" pattern="^[A-Za-z\s]+$" value="<? echo $_POST["special"]; ?>" placeholder="Your Specialization" required=""/>
          <p style="color: red">*
            <?php
            if(isset($errorspecial)){
             echo $errorspecial;
            }
            ?>
          </p>
        </div>
        <div class="input-box">
          <span class="details">College/University:</span>
          <input type="text" name="clg" pattern="^[A-Za-z\s,]+$" placeholder="college/university" value="<? echo $_POST["clg"] ?>" />
          <p style="color: red">*
            <?php
            if(isset($errorclg)){
             echo $errorclg;
            }
            ?>
          </p>
        </div>
      </div>
    </div>
    <!-- Skills -->
    <h1 style="font-size: 25px;">Skills</h1>
    <div style="border-top: solid;">
      <div class="user-details">
        <div class="input-box">
          <span class="details">Primary:</span>
          <input type="text"name="primary" pattern="^[A-Za-z,]+$" value="<? echo $_POST["primary"]; ?>" placeholder="eg.english,marathi" required=""/>
          <p style="color: red">*
            <?php
            if(isset($errorprim)){
             echo $errorprim;
            }
            ?>
          </p>
        </div>
        <div class="input-box">
          <span class="details">Secondary:</span>
          <input type="text" name="second" pattern="^[A-Za-z,]+$" placeholder="secondarys skills" value="<? echo $_POST["second"] ?>" />
         <p style="color: red">
            <?php
            if(isset($errorsec)){
             echo $errorsec;
            }
            ?>
          </p>
        </div>
        <div class="input-box">
          <span class="details">Certification:</span>
          <input type="text" name="certi" placeholder="certification in eg.CDAC" value="<? echo $_POST["certi"] ?>" />
        </div>
      </div>
    </div>
    <!-- pitch -->
    <h1 style="font-size: 25px;">Pitch</h1>
    <div style="border-top: solid;">
      <div class="user-details">
        <div class="input-box">
          <span class="details">Pitch:</span>
          <textarea name="pit" rows="8" cols="50" minlength="20" value="<? echo $_POST["pit"]; ?>" placeholder="write something" required=""></textarea>
          <p style="color: red">*
            <?php
            if(isset($errorpit)){
             echo $errorpit;
            }
            ?>
          </p>
        </div>
      </div>
    </div>
    <!-- submit button -->
    <div class="button">
      <input type="submit" name="btn" value="CREATE"/>
    </div>
  </form>
  </div>
  </div>
</body>
</html>