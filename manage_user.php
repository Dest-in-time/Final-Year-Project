<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
$type = array("","users","faculty_list","student_list");
$user = $conn->query("SELECT * FROM {$type[$_SESSION['login_type']]} where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	<div id="msg"></div>
	
	<form class="ui form" id="manage-user">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="field">
			<div class="form-group d-flex justify-content-center">
				<img src="<?php echo isset($meta['avatar']) ? 'assets/uploads/'.$meta['avatar'] :'' ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
			</div>
			<p id="inline_txt">Change your profile image above</p>
		</div>
		<div class="field">
			<label for="name">First Name</label>
			<input type="text" name="firstname" placeholder="First Name" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
		</div>
		<div class="field">
			<label for="name">Last Name</label>
			<input type="text" name="lastname" placeholder="Last Name" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
		</div>
		<div class="field">
			<label for="email">Email</label>
			<input type="text" name="email" placeholder="Email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required  autocomplete="off">
		</div>
		<div class="field">
			<label for="password">Password</label>
			<input type="password" name="password" placeholder="Password" id="password" class="form-control" value="" autocomplete="off">
			<small><i>Leave this blank if you dont want to change the password.</i></small>
		</div>
		<input id="select_img" type="file" name="img" style="display: none;" onchange="displayImg(this,$(this))">
	</form>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}

	#inline_txt {
		text-align: center;
		margin-top: 23px;
		margin-bottom: 23px;
		font-weight: 600;
	}
</style>
<script>
	function displayImg(input,_this) {
		var url = _this.val();
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
	    if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")){
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    } else {
			$('#cimg').attr('src', "<?php echo isset($meta['avatar']) ? 'assets/uploads/'.$meta['avatar'] :'' ?>");
		}
	}

	$('#cimg').click(function(){
		$('#select_img').click();
	})

	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=update_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
				}
			}
		})
	})
</script>