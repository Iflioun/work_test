<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">

	<link rel="stylesheet" href="./assets/css/styleform.css">
	<link rel="stylesheet" href="./assets/css/buttons.css">
	<link rel="stylesheet" href="./assets/css/main.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="./assets/js/main.js"></script>

		<title>test</title>
</head>
<body style="background-image: url(./assets/img/Birds.jpg);width: 1360px; height: 800px; background-size: cover; margin: auto;">


		<div class="box">
			<div id="main" class="main">

<form action="login.php" method="post">
				<div id="loginform" class="loginform">
					<h1>Login</h1>
                    <div class="logo"><img src="./assets/img/logo.png" width="38px" height="28px"></div>
					<div class="tire2"></div>

                        <button>LOGIN</button>

				</div>
</form>

<?php
    require_once ('core/init.php');

    if(Input::exists()){
        if(Token::check(Input::get('token'))){


        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'
    ),
            'password' => array(
                'required' => true,
                'min' => 6,
    ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
    ),
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
    ),
        ));
        if($validation->passed()){
            $user = new User();

            $salt = Hash::salt(32);


            try{

                $user->create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'name' => Input::get('name'),
                    'joined' => date('Y-m-d H:i:s'),
                    'groupNumber' => 1

                ));

                Session::flash('home', 'You have been registered and can now log in!');
                Redirect::to('index.php');

            } catch(Exception $e){
                die($e->getMessage());
            }
        } else {
            foreach($validation->errors() as $error){
                echo $error, '<br>';
            }
        }

        }
    }
?>



<form action="" method="post">
				<div id="signupform" class="signupform">
					<h1>Sign Up</h1>
					<div class="logo"><img src="./assets/img/logo.png" width="38px" height="28px"></div>
					<div class="tire2"></div>
					<input type="text" name="name" placeholder="Full Name*"/><img src="./assets/img/ic_user.png"><br><br>
					<input type="email" name="username" placeholder="Email*"/><img src="./assets/img/ic_mail.png"><br><br>
					<input type="password" name="password" placeholder="Password*"/><img src="./assets/img/ic_lock.png"><br>
					<input type="password" name="password_again" placeholder="Repeat a password*">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <button>SIGN UP</button>
                    </div>
</form>

			</div>


			<div class="signup_msg">Don't have an Account? </div>
			<div class="text">
      <div class="tire"></div>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>

            <div class="login_msg">Have an Account?</div>
            <div class="text2">
            <div class="tire3"></div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
			<button id="login_btn" class="signup_btn">LOGIN</button>
			<button id="signup_btn" class="signup_btn" style="">SIGN UP</button>

		</div>

</body>
</html>
