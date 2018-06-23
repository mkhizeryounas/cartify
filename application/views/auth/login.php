<?php include 'includes/header.php' ?>
<h1><a href="./">cartify </a></h1>
<script type="text/javascript">
	window.localStorage.removeItem('ngStorage-public_key');
</script>
		<div class="login-bottom">
			<h2>Login</h2>
			<?php echo form_open(uri_string()); ?>
			<?php echo $this->session->flashdata('new_store'); ?>
			<?php echo $this->session->flashdata('error_pwd'); ?>
			<div class="col-md-12">
				<?php echo form_error('email', '<small style="color: red !important;">', '</small>'); ?>
				<div class="login-mail">
					<input type="text" placeholder="Email" name="email" value="<?php echo set_value('email') ?>">
					<i class="fa fa-envelope"></i>
				</div>
				<?php echo form_error('pwd', '<small style="color: red !important;">', '</small>'); ?>
				<div class="login-mail">
					<input type="password" placeholder="Password" name="pwd">
					<i class="fa fa-lock"></i>
				</div>			
			</div>
			<div class="clearfix"></div>
			<div class="col-md-6 ">
				<small class=""><a href="<?php echo base_url(); ?>app/signup">Signup for a new account?</a></small>
			</div>
			<div class="col-md-6 login-do">
				<label class="hvr-shutter-in-horizontal login-sub pull-right">
					<input type="submit" value="login" name="hms-btn">
				</label>
			</div>


			
			<div class="clearfix"> </div>
			</form>
		</div>
<?php include 'includes/footer.php' ?>
