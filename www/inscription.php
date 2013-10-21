<?php
	
    include('inc/header.php');
?>


    <div class="container" style="margin-top:100px;">
      <div class="row">
        <div class="col-lg-9">
			<?php
				$db = connect_webannonces_db();
			?>
			<h2>Inscription</h2>
			
<?php
			
			
    $errors = array();
	 $form = array();
	if(isset($_POST['submit_signin']))
	{
		$form['username'] = addslashes($_POST['form_username']);
		$form['email'] = addslashes($_POST['form_email']);
		$form['pwd1'] = $_POST['form_pwd1'];
		$form['pwd2'] = $_POST['form_pwd2'];
		
		echo 'username :'.$form['username'].'<br>';
		echo 'email :'.$form['email'].'<br>';
		$is_username_exists = is_username_already_exists($db, $form['username']);
		$is_email_exists = is_email_already_exists($db, $form['email']);
		
		//name field
		if(strlen($form['username']) == 0)
		{
			$errors[] = array('message' => 'error on username field - mandatory field', 'field' => 'username');
		}
		elseif(strlen($form['username']) > 40)
		{
			$errors[] = array('message' => 'error on username field - max character : 40', 'field' => 'username');
		}
		
		elseif ($is_username_exists)
		{
			$errors[] = array('message' => 'error on username field - username already exists', 'field' => 'username');
		}
		
		//email field
		
		if(strlen($form['email']) == 0)
		{
			$errors[] = array('message' => 'error on email field - mandatory field', 'field' => 'email');
		}
		elseif(strlen($form['email']) > 100)
		{
			$errors[] = array('message' => 'error on email field - max character : 100' , 'field' => 'email');
		}
		elseif(strpos($form['email'], '@') === false) // [false = @ not found ]or [@ in first position strpos return 0]
		{
			$errors[] = array('message' => 'error on email field - @ missing' , 'field' => 'email');
		}
		
		elseif(strpos($form['email'], '.') === false) // [false = . not found ]or [. in first position strpos return 0]
		{
			$errors[] = array('message' => 'error field - . missing' , 'field' => 'email');
		}
		elseif ($is_email_exists)
		{
			$errors[] = array('message' => 'error on email field - email already exists', 'field' => 'email');
		}
		
		// password fields
		if(strlen($form['pwd1']) < 6)
		{
			$errors[] = array('message' => 'error on password field - mandatory field', 'field' => 'pwd1');
		}
		if(strlen($form['pwd1']) > 40)
		{
			$errors[] = array('message' => 'error on password field - mandatory field', 'field' => 'pwd1');
		}
		if($form['pwd1'] != $form['pwd2'])
		{
			$errors[] = array('message' => 'error on password field - passwords do not match', 'field' => 'pwd1');
		}
		
		// error checkbox
	}
if ((count($errors) == 0) && (isset($_POST['submit_signin'])))
{
	$pwd = md5($form['pwd1']);
	add_newuser($db, $form['username'], $pwd, $form['email']);
	 //add_newuser($db, $form['name'], $user,  $form['description']);
}
	
?>	
		  
			<p>Thanks to subscribe to Trello Like</p>
<?php
if (count($errors) > 0)
{
?>
			<div class="alert alert-warning">
				<strong>errors : </strong>
				<ul>
			
			<?php
			foreach($errors as $error)
			{
			?>
				<li><?php echo $error['message']; ?> </li>
			<?php
			}
			?>
				</ul>
			</div>
<?php
}
?> 
			<form method="post" action=""  class="form-horizontal" role="form">
  
				<div class="form-group
					<?php 
						if(count(error_by_field($errors, 'username')) > 0)
						{
							echo' has-error';
						}
						elseif((count(error_by_field($errors, 'username')) == 0) && (isset($_POST['submit_signin']))) 
						{
							echo' has-success';
						}
				
			?>">
					<label for="inputUsername" class="col-lg-3 control-label">Username</label>
					<div class="col-lg-9">
						<input type="text" name="form_username" class="form-control" id="inputUsername" placeholder="Enter Username" value="<?php 
				if(isset($_POST['reset_signin']))
				{
					echo "";
				}
				else 
				{
					echo save_origin_value_from_form($form, 'username'); 
				}
				?>" />
					</div>
				</div>
				<div class="form-group
				<?php 
						if(count(error_by_field($errors, 'email')) > 0)
						{
							echo' has-warning';
						}
						elseif((count(error_by_field($errors, 'email')) == 0) && (isset($_POST['submit_signin']))) 
						{
							echo' has-success';
						}
				
			?>">
					<label for="inputEmail1" class="col-lg-3 control-label">Email</label>
					<div class="col-lg-9">
						<input type="email" name="form_email" class="form-control" id="inputEmail" placeholder="Email" value="<?php 
				if(isset($_POST['reset_signin']))
				{
					echo "";
				}
				else 
				{
					echo save_origin_value_from_form($form, 'email'); 
				}
				?>" />
					</div>
				</div>
				<div class="form-group
				<?php 
						if(count(error_by_field($errors, 'pwd1')) > 0)
						{
							echo' has-error';
						}
						elseif((count(error_by_field($errors, 'pwd1')) == 0) && (isset($_POST['submit_signin']))) 
						{
							echo' has-success';
						}
				
			?>">
					<label for="inputPassword1" class="col-lg-3 control-label">Password</label>
					<div class="col-lg-9">
						<input type="password" name="form_pwd1" class="form-control" id="inputPassword1" placeholder="Password" value="<?php 
				if(isset($_POST['reset_signin']))
				{
					echo "";
				}
				else 
				{
					echo save_origin_value_from_form($form, 'pwd1'); 
				}
				?>" />
					</div>
				</div>
				<div class="form-group
				<?php 
						if(count(error_by_field($errors, 'pwd1')) > 0)
						{
							echo' has-error';
						}
						elseif((count(error_by_field($errors, 'pwd1')) == 0) && (isset($_POST['submit_signin']))) 
						{
							echo' has-success';
						}
				
			?>">
					<label for="inputPassword2" class="col-lg-3 control-label">Confirm Password</label>
					<div class="col-lg-9">
						<input type="password" name="form_pwd2" class="form-control" id="inputPassword2" placeholder="Password" value="<?php 
				if(isset($_POST['reset_signin']))
				{
					echo "";
				}
				else 
				{
					echo save_origin_value_from_form($form, 'pwd2'); 
				}
				?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-3 col-lg-9">
						<div class="checkbox">
							<label><input type="checkbox"> Accept General Conditions
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<input id="submit_signin" name="submit_signin" type="submit" class="btn btn-success" value="Sign in" />
						<input id="reset_signin" name="reset_signin" type="submit" class="btn btn-default" value="Cancel" />
					</div>
				</div>
			</form>
		</div>
        <div class="col-lg-3 well">
			<h3>Dernières annonces</h3>

			<div class="row" style="border-bottom:3px dashed #fff;">
				<div class="col-lg-6"><a href="annonce.php?id=0">Chaise longue <span class="label label-warning">42 €</span></a></div>
				<div class="col-lg-6"><em>A vendre chaise longue neuve encore emballée, tombé d'un camion</em></div>
			</div>
			
			<div class="row" style="border-bottom:3px dashed #fff;">
				<div class="col-lg-6"><a href="annonce.php?id=0">Iphone 5S <span class="label label-warning">2000 €</span></a></div>
				<div class="col-lg-6"><em>A vendre Iphone 5S vitre brisée, locké opérateur Joe Mobile</em></div>
			</div>
			
			<div class="row" style="border-bottom:3px dashed #fff;">
				<div class="col-lg-6"><a href="annonce.php?id=0">4L 1984 <span class="label label-warning">1300 €</span></a></div>
				<div class="col-lg-6"><em>CT OK, 4 roues motrices</em></div>
			</div>
			
			<p style="margin-top:10px;" class="text-center"><a class="btn btn-success btn-lg" href="annonces.php">
				<span class="glyphicon glyphicon-hand-right"></span> Voir toutes les annonces</a></p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Cours Html 2013</p>
      </footer>
    </div> <!-- /container -->
		  
		  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>