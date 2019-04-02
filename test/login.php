<?php
    require_once ('core/init.php');

    if(Input::exists()){
        if(Token::check(Input::get('token'))){

            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array('required' => true),
                'password' => array('required' => true)
            ));

            if($validation->passed()){
                $user = new User();

                $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login(Input::get('username'), Input::get('password'), $remember);

                if($login){
                    Redirect::to('index.php');
                } else{
                    echo '<p>Sorry, logging in failed.</p>';
                }
            }else{
                foreach($validation->errors() as $error){
                    echo $error, '<br>';
                }
            }
        }
    }
?>

  <link rel="stylesheet" href="./assets/css/styleform.css">
	<link rel="stylesheet" href="./assets/css/buttons.css">
	<link rel="stylesheet" href="./assets/css/main.css">

<form action="" method="post">

				<div id="loginform" class="loginform">
					<h1>Login</h1>
                    <div class="logo"><img src="./assets/img/logo.png" width="38px" height="28px"></div>
					<div class="tire2"></div>
					<input type="email" name="username" placeholder="Email*" autocomplete="off"/><img src="./assets/img/ic_mail.png"><br><br>
					<input type="password" name="password" placeholder="Password*"autocomplete="off"/><img src="./assets/img/ic_lock.png"><br>

                  Remember me<input type="checkbox" name="remember" id="remember" >
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"><br>
                        <button>LOGIN</button>

				</div>
</form>
