<?php
    include('inc/header.php');
	include('inc/tools.php');
	function error_by_field($errors, $field)
	{
		$result = array();
		foreach($errors as $error)
		{
			if ($error['field']=== $field)
			{
				$result[]=$error['message'];
			}
		}
		return $result;
	}

	function save_origin_value_from_form($form, $field)
	{
		$retour = '';
		if(isset($form[$field]))
		{
			$retour = stripslashes($form[$field]);
		}
		return $retour;
	}
?>

    <div class="container" style="margin-top:100px;">
      <div class="row">
        <div class="col-lg-9">
          <h1>Contactez  nous</h1>
<?php
     $errors = array();
	 $form = array();
	if(isset($_POST['submit_contact']))
	{
	    // echo 'Formulaire envoy&eacute;';
		
		$form['nom'] = addslashes($_POST['form_nom']);
		$form['email'] = addslashes($_POST['form_email']);
		$form['message'] = addslashes($_POST['form_message']);
		
		//name field
		if(strlen($form['nom']) == 0)
		{
			$errors[] = array('message' => 'error name field - mandatory field', 'field' => 'nom');
			//echo 'error name field - mandatory field <br>';
		}
		elseif(strlen($form['nom']) > 40)
		{
			$errors[] = array('message' => 'error name field - max character : 40', 'field' => 'nom');
			//echo 'error name field - max character : 40 <br>';
		}
		
		//email field
		
		if(strlen($form['email']) == 0)
		{
			$errors[] = array('message' => 'error field - mandatory field', 'field' => 'email');
			//echo 'error field email vide - mandatory field <br>';
		}
		elseif(strlen($form['email']) > 100)
		{
			$errors[] = array('message' => 'error field - max character : 100' , 'field' => 'email');
			//echo 'error email field - max character : 100 <br>';
		}
		elseif(strpos($form['email'], '@') === false) // [false = @ not found ]or [@ in first position strpos return 0]
		{
			$errors[] = array('message' => 'error field - @ missing' , 'field' => 'email');
			//echo 'error email field - @ character is mandatory';
		}
		
		//message field
		
		if(strlen($form['message']) == 0)
		{
			$errors[] = array('message' => 'error message - mandatory field',  'field' => 'message');
			//echo 'error name field - mandatory field <br>';
		}
		
		
		// Debug
		// echo '<pre>';
		// print_r($form);
		// echo '</pre>';
		if (count($errors) == 0)
		{
			// insert DB
			$date_envoi = new DateTime();
			$query = 'INSERT INTO contact (nom, message, email, date_envoi)
				VALUES (\''.$form['nom'].'\',
						\''.$form['message'].'\',
						\''.$form['email'].'\',
						\''.$date_envoi->format('Y-m-d H:i:s').'\')';
						
			//$db->exec($query);
			
			//insert DB 2
			
			$query_prepare = 'INSERT INTO contact (nom, message, email, date_envoi)
				VALUES (:nom, :message, :email, :date_envoi)';
			$requete= $db->prepare($query_prepare);
			$date_envoi = new DateTime();
			$requete->execute(array(
								'nom' => $form['nom'],
								'message' => $form['message'],
								'email' => $form['email'],
								'date_envoi' => $date_envoi->format('Y-m-d H:i:s')
								  ));
			
		}
	}
	
?>
		  <p>Merci d'utiliser ce formulaire pour nous contacter</p>

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
				<div class="form-group<?php if(count(error_by_field($errors, 'nom')) > 0)
				{
					echo' has-error';
				}
				elseif((count(error_by_field($errors, 'nom')) == 0) && (isset($_POST['submit_contact']))) 
				{
					echo' has-success';
				}
				?>">
					<label for="inputNom" class="col-lg-2 control-label">Nom</label>
					<div class="col-lg-10">
					  <input type="text" name="form_nom" class="form-control" id="inputNom" placeholder="Nom" value="<?php echo save_origin_value_from_form($form, 'nom'); ?>" />
					  
					</div>
				</div>
				<div class="form-group<?php if(count(error_by_field($errors, 'email')) > 0)
				{
					echo' has-warning';
				}
				elseif(count((error_by_field($errors, 'email')) == 0) && (isset($_POST['submit_contact'])))
				{
					echo' has-success';
				}
				?>">
					<label for="inputEmail" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
					  <input type="email" name="form_email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo save_origin_value_from_form($form, 'email'); ?>" />
					</div>
				</div>
				<div class="form-group<?php if(count(error_by_field($errors, 'message')) > 0)
				{
					echo' has-warning';
				}
				elseif((count(error_by_field($errors, 'message')) == 0) && (isset($_POST['submit_contact'])))
				{
					echo' has-success';
				}
				?>">
					<label for="inputMessage" class="col-lg-2 control-label">Message</label>
					<div class="col-lg-10">
					  <textarea class="form-control" name="form_message" id="inputMessage" placeholder="Message"  /><?php echo save_origin_value_from_form($form, 'message'); ?></textarea>
					</div>
				</div>
			  <div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
				  <input id="submit_contact" name="submit_contact" type="submit" class="btn btn-success" value="Envoyer" />
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

<?php
    include('inc/footer.php');
?>