<!DOCTYPE html>
<html lang="en">
<html>
<head>
  <link rel="stylesheet" href="assets/css/41.css">
  <script src="assets/adminjs/41.js"></script>
  <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Login</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
</head>



<body>

<h1 class="title">Administrators' Web Portal<h1>
<div class="login-page">
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered?<a href="#register-form">Sign In</a></p>
    </form>
    <form class="login-form" action="assets/php/login.inc.php" method="POST">
      <input type="text" name="admin_user" placeholder="Admin Username" required/>
      <input type="password" name="password" placeholder="Password" required/>
      <button type="submit" name="submit">login</button>

    </form>
      
  </div>
  <h6>for demo purpose, the username is "teambeta", the password is "cmsc207".</h6> 
</div>
<body>
</html>
