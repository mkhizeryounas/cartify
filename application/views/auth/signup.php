<?php include 'includes/header.php' ?>
		<div class="login-bottom">
			<h2>Sign up for cartify</h2>
			<?php echo form_open(uri_string()); ?>
			<?php echo $this->session->flashdata('error_pwd'); ?>
			<div class="col-md-12">
					<?php echo form_error('name', '<small style="color: red !important;">', '</small>'); ?>
				<div class="login-mail">
					<input type="text" placeholder="Full Name" name="name" required="" value="<?php echo set_value('name') ?>">
					<i class="fa fa-user"></i>
				</div>
					<?php echo form_error('email', '<small style="color: red !important;">', '</small>'); ?>
				<div class="login-mail">
					<input type="text" placeholder="Email" name="email" required="" value="<?php echo set_value('email') ?>">
					<i class="fa fa-envelope"></i>
				</div>
					<?php echo form_error('store', '<small style="color: red !important;">', '</small>'); ?>
				<div class="login-mail">
					<input type="text" placeholder="Store Name" name="store" required=""  value="<?php echo set_value('store') ?>">
					<i class="fa fa-bank"></i>
				</div>	
					<?php echo form_error('pwd', '<small style="color: red !important;">', '</small>'); ?>
				<div class="login-mail">
					<input type="password" placeholder="Password" name="pwd" required="">
					<i class="fa fa-lock"></i>
				</div>
					<?php echo form_error('repwd', '<small style="color: red !important;">', '</small>'); ?>
				<div class="login-mail">
					<input type="password" placeholder="Re-type Password" name="repwd" required="">
					<i class="fa fa-lock"></i>
				</div>	

			</div>
			<div class="clearfix"></div>
			<div class="col-md-6">
				<small class=""><a href="<?php echo base_url(); ?>app/login">Already have an account?</a></small>
			</div>
			<div class="col-md-6 login-do">

				<label class="hvr-shutter-in-horizontal login-sub pull-right">
					<input type="submit" value="Sign up" name="hms-btn">
				</label>
			</div>
			<div class="clearfix"> </div>
			</form>
		</div>
<?php include 'includes/footer.php' ?>
