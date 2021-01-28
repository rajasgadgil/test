<?php
/* Template Name: Supplier Registration Page */
?>


<?php get_header(); ?>

<?php
    global $wpdb;



    $email = $wpdb->escape($_POST['txtEmail']);
    $password = $wpdb->escape($_POST['txtPassword']);
    $confirm_password = $wpdb->escape($_POST['txtConfirmPassword']);
    $username = $wpdb->escape($_POST['txtEmail']);
    $firstname = $wpdb->escape($_POST['txtFirstname']);

    $error = array();

    if(!is_email($email)){
        $error['email_valid'] = "Email has no valid value";
    }

    if(email_exists($email)){
         $error['email_existance'] = "Email already exists";
    }

    if(strcmp($password, $confirm_password) !== 0){
        $error['password'] = "Password Didn't matched";
    }

    if(count($error) == 0){
        $user_id   = wp_create_user($username, $password, $email, $firstname);
        $user_id = new WP_User($user_id);
        $user_id->set_role('myteklist_admin');

        update_user_meta($user_id,"first_name",$firstname);

        // add_user_meta( $user_id, "first_name", $name, false );
        //add_user_meta( $user_id, "company", $companyName, false );
        // $user_id_role = new WP_User($user_id);
        // $user_id_role->set_role('supplier');
        do_action( 'registered_user_send_verification_email' );
        exit();
    }else{
    }
?>
<form class="card col-md-6 offset-md-3 p-0" method="post">
    <div class="card-header">
    <h3>Registration</h3>
    </div>
    <div class="card-body">


    <p>
<label>First Name</label>
<div>
<input type="text" id="txtFirstname" name="txtFirstname" class="form-control">
</div>
</p>


<p>
<label>Your Email</label>
<div>
<input type="text" id="txtEmail" name="txtEmail" class="form-control">
</div>
</p>

<p>
<label>Password</label>
<div>
<input type="password" id="txtPassword" name="txtPassword" class="form-control">
</div>
</p>


<p>
<label>Confirm Password</label>
<div>
<input type="password" id="txtConfirmPassword" name="txtConfirmPassword" class="form-control">
</div>
</p>



<input type="submit" value="Register" class="btn btn-success">

    </div>
</form>
<?php get_footer(); ?>