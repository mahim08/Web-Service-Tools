<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <!-- <link rel="stylesheet" href="style.css"/> -->
    <style>
        @import url(https://fonts.googleapis.com/css?family=Varela);

html {
  height: 100%;
}

body {
  background: #f2f2f2;
  font-family: 'Varela', sans-serif;
  font-size: 14px;
  line-height: 1.5;
  color: #333;
  min-height: 100%;
  position: relative;
}

label {
  margin-top: 6px;
  line-height: 17px;
}

a {
  color: #fff;
}

a:focus,
a:hover {
  color: #008080;
}

.checkbox-inline+.checkbox-inline,
.radio-inline+.radio-inline {
  margin-top: 6px;
}

/******* Login Page *******/

body.login {
  background: rgba(241, 242, 181, 1);
  background: -moz-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(19, 80, 88, 1) 100%);
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(255, 255, 255, 1)), color-stop(100%, rgba(19, 80, 88, 1)));
  background: -webkit-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(19, 80, 88, 1) 100%);
  background: -o-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(19, 80, 88, 1) 100%);
  background: -ms-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(19, 80, 88, 1) 100%);
  background: radial-gradient(ellipse at center, rgba(255, 255, 255, 1) 0%, rgba(19, 80, 88, 1) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#f1f2b5', endColorstr='#135058', GradientType=1);
}

.relative {
  position: relative;
}

.login-container-wrapper .logo,
.login-container-wrapper .welcome {
  margin: 0 0 20px 0;
  font-size: 16px;
  color: #fff;
  text-align: center;
  letter-spacing: 1px;
}

.login-container-wrapper .logo {
  text-align: center;
  position: absolute;
  top: -42px;
  margin: 0 auto;
  width: 25%;
  left: 37.5%;
  border-radius: 50%;
  background-color: #344455;
  padding: 25px;
  box-shadow: 0px 0px 9px 2px #344454;
}

.login-container-wrapper {
  max-width: 400px;
  margin: 10% auto 8%;
  padding: 40px;
  box-sizing: border-box;
  background: rgba(57, 89, 116, 0.8);
  box-shadow: 1px 1px 10px 1px #000000, 8px 8px 0px 0px #344454, 12px 12px 10px 0px #000000;
  position: relative;
  padding-top: 80px;
}

.logo .fa {
  font-size: 50px;
}
.login input:focus + .fa{
  color:#fff;
}
.login-form .form-group {
  margin-right: 0;
  margin-left: 0;
}

.login-form i {
  position: absolute;
  top: 18px;
  right: 20px;
  color: #93a5ab;
}

.login-form .input-lg {
  font-size: 16px;
  height: 52px;
  padding: 10px 25px;
  border-radius: 0;
}

.login input[type="email"],
.login input[type="password"],
.login input:focus {
  background-color: rgba(40, 52, 67, 0.75);
  border: 1px solid #4a525f;
  color: #eee;
  border-left: 4px solid #93a5ab;
}

.login input:focus {
  border-left: 4px solid #ccd8da;
}

input:-webkit-autofill,
textarea:-webkit-autofill,
select:-webkit-autofill {
  background-color: rgba(40, 52, 67, 0.75)!important;
  background-image: none;
  color: rgb(0, 0, 0);
  border-color: #FAFFBD;
}

.login .checkbox label,
.login .checkbox a {
  color: #ddd;
}

.btn-success {
  background-color: transparent;
  background-image: none;
  padding: 8px 50px;
  border-radius: 0;
  border: 2px solid #93a5ab;
  box-shadow: inset 0 0 0 0 #7692A7;
  -webkit-transition: all ease 0.8s;
  -moz-transition: all ease 0.8s;
  transition: all ease 0.8s;
}

.btn-success:focus,
.btn-success:hover,
.btn-success.active,
.btn-success:active {
  background-color: transparent;
  border-color: #fff;
  box-shadow: inset 0 0 100px 0 #7692A7;
  color: #FFF;
}
#particles-js {
/*   background: cornflowerblue; */
  width:100%;
  height:100%;
  position:absolute;
  z-index:-1;
}
    </style>    
</head>
<div id="particles-js"></div>
<body class="login">

<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
           
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <!-- <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
  </form> -->


  
	<div class="container">
		<div class="login-container-wrapper clearfix">
			<div class="logo">
				<i class="fa fa-sign-in"></i>
			</div>
			<div class="welcome"><strong>Welcome,</strong> please login</div>

			<form  method="post" name="login" class="form-horizontal login-form">
				<div class="form-group relative">
					<input id="login_username" name="username" class="form-control input-lg" placeholder="Username" required>
					<i class="fa fa-user"></i>
				</div>
				<div class="form-group relative password">
					<input id="login_password" class="form-control input-lg" name="password" type="password" placeholder="Password" required>
					<i class="fa fa-lock"></i>
				</div>
			  <div class="form-group">
			    <button type="submit" value="Login" name="submit" class="btn btn-success btn-lg btn-block">Login</button>
			  </div>
        <div class="checkbox pull-left">
			    <label><input type="checkbox"> Remember</label>
			  </div>
			  <div class="checkbox pull-right">
			    <label> <a class="forget" href="registration.php" title="forget">Create an Account</a> </label>
			  </div>
			</form>
		</div>
    
    
	</div>


<?php
    }
?>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js" defer data-deferred="1"></script>
<script>
    /* ---- particles.js config ---- */

window.addEventListener('DOMContentLoaded', (event) => {
  /* ---- particles.js config ---- */

  particlesJS("particles-js", {
    "particles": {
      "number": {
        "value": 380,
        "density": {
          "enable": true,
          "value_area": 3600
      }
    },
    "color": {
      "value":  ["#344455", "#ffffff"]
    },
    "shape": {
      "type": "edge",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 4,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 50,
      "color": "#fff",
      "opacity": 0.5,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 3,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "retina_detect": true
});


/* ---- stats.js config ---- */

var count_particles, stats, update;
stats = new Stats;
stats.setMode(0);
stats.domElement.style.position = 'absolute';
stats.domElement.style.left = '0px';
stats.domElement.style.top = '0px';
document.body.appendChild(stats.domElement);
count_particles = document.querySelector('.js-count-particles');
update = function() {
  stats.begin();
  stats.end();
  if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
    count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
  }
  requestAnimationFrame(update);
};
requestAnimationFrame(update);
</script>
</body>
</html>
