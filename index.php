<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />	    <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css" />
	<link rel="stylesheet" href="/Client/css/main.css" type="text/css" />
	<link rel="stylesheet" href="/Client/css/prism.css" type="text/css" />
	<title>Snippet DB</title>
</head>

<body>

<!-- Nav bar -->
	<div class="container-fluid">
    	<nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-sm">
    		<div class="container-fluid" id="nav-content">
	    		<a class="navbar-brand" href="#">
	    			<img id="logo" src="/Client/assets/codeicon.png" width="40" height="40" class="d-inline-block align-top" alt=""/>
	    			SnippetDB
	    		</a>
    		   	<div id="nav-btns" class="justify-content-end">
					<div id="logged-in-nav" class="navbar-nav" style="display:none;">
						<div class="username-display"><span id="login-indicator" style="font-weight:700;margin-right:5px;"></span></div>
						<a href="#"><div id="logout-button" class="logout-btn" ></div></a>
						<a href="#"><div class="submit-btn" data-toggle="modal" data-target="#snippetEntryModal"></div></a>
					</div>
					<div id="logged-out-nav" class="navbar-nav">
						<a href="#"><div class="login-btn" data-toggle="modal" data-target="#loginModal"></div></a>
						<a href="#"><div class="register-btn" data-toggle="modal" data-target="#registerModal"></div></a>
					</div>
				</div>
			</div>
		</nav>
	</div>

<!-- Page Content -->
    <div id="page-content-wrapper" class="container-fluid">
		<div id="page-content" class="container-fluid">

			<!-- User alerts container -->
			<div id="user-alert-container" class="row">
				<!-- Javascript adds the alert -->
			</div>

			<div class="row justify-content-center">

				<!-- Snippet view -->
				<div id="snippet-container" class="col-12 col-md-8 col-xl-6">
					<pre id="snippet-frame" class="line-numbers">
<code class="language-javascript">/*
	Welcome to SnippetDB
	Click on a row on the snippet table to see the snippet code.
*/</code><p id="snippet-date"></p>
					</pre>
					<div id="snippet-owner-controls" class="btn-group" style="display:none;">
						<button type="button" data-toggle="modal" data-target="#updateSnippetModal" class="btn btn-primary">Edit</button>
						<button type="button" class="btn btn-danger" id="deleteSnippetButton">Delete</button>
					</div>
				</div>



				<!-- Snippet table -->
    		   	<div id="snippet-list-container" class="col-12 col-xl-6">
        		   	<table id="snippets-table" class="display" cellspacing="0" width="100%">
				        <thead>
							<tr>
								<th>Id</th>
								<th>Creator</th>
								<th>Description</th>
								<th>Language</th>
							</tr>
						</thead>
						<tbody>
						<!-- Table is empty pending snippets ajax response -->
						</tbody>
					</table
    		   </div>
    		   <!-- End Snippet table -->
		   </div>
		</div>
	</div>

<!-- Modals -->
	<!-- Create Snippet Modal -->
	<div class="modal fade" id="snippetEntryModal" tabindex="-1" role="dialog" aria-labelledby="snippetEntryModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Create a snippet</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="snippetEntryForm">
						<label><b>Snippet name</b></label>
						<br/>
						<input type="text" placeholder="Enter Snippet Name" name="snippetName" required maxlength="40">
						<br/>
						<label><b>Language</b></label>
						<br/>
						<select id="languageSelect"></select>
						<br/>
						<label><b>Snippet Area</b></label>
						<br/>
						<textarea rows="10" cols = "40" placeholder="Submit Snippet" name="snippetText" class="submit-textarea" required></textarea>
						<input type="submit" id="submitSnippetHidden" style="display:none;">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" id="snippet-submit">Submit</button>
  				</div>
			</div>
		</div>
	</div>

	<!-- Register User Modal -->
	<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div id="register" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Create an account</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="registerUserForm">
						<label><b>Username</b></label>
						<br/>
						<input type="text" placeholder="Enter Username" name="email" required maxlength="15">
						<br/>
						<label><b>Password</b></label>
						<br/>
						<input type="password" placeholder="Enter Password" name="password" required>
						<br/>
						<label><b>Confirm Your Password</b></label>
						<br/>
						<input type="password" placeholder="Confirm Your Password" name="confirmPassword" required>
						<hr/>
						<h4>Security questions:</h4>
						<h6>These will be used to reset your password if you forget.</h6>
						<label><b>What city were you born in?</b></label>
						<br/>
						<input type="text" placeholder="Answer:" name="securityAnswer1" required>
						<br/>
						<label><b>What is your mother's maiden name?</b></label>
						<br/>
						<input type="text" placeholder="Answer:" name="securityAnswer2" required>
						<input type="submit" id="registerUserHidden">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" id="register-submit">Sign up</button>
  				</div>
			</div>
		</div>
	</div>

	<!-- User Login Modal -->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div id="login" class="modal-content">

				<!-- User Login Modal Content -->
				<!-- Swaps out with the Recover Password modal content -->
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Login</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="loginUserForm">
						<label><b>Username</b></label>
						<br/>
						<input type="text" placeholder="Enter Username" name="email" required>
						<br/>
						<label><b>Password</b></label>
						<br/>
						<input type="password" placeholder="Enter Password" name="password" required>
						<br/>
						<input type="submit" id="loginUserHidden" style="display:none;">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" id="forgot-password-button">Forgot your password?</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" id="login-submit">Log in</button>
  				</div>
			</div>

			<!-- Recover password modal content -->
			<!-- Swaps out with the User Login modal content -->
			<div id="recoverPassword" class="modal-content" style="display:none;">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Forgot your Password?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="recoverPasswordForm">
						<label><b>Username</b></label>
						<br/>
						<input type="text" placeholder="Username" name="email" required>
						<br/>
						<label><b>What city were you born in?</b></label>
						<br/>
						<input type="text" placeholder="Answer:" name="securityAnswer1" required>
						<br/>
						<label><b>What is your mother's maiden name?</b></label>
						<br/>
						<input type="text" placeholder="Answer:" name="securityAnswer2" required>
						<hr/>
						<h4>Pick a new password:</h4>
						<label><b>New password</b></label>
						<br/>
						<input type="password" placeholder="New Password" name="newPassword" required>
						<br/>
						<label><b>Confirm your new password</b></label>
						<br/>
						<input type="password" placeholder="Confirm Password" name="verifyNewPassword" required>
						<input type="submit" id="recoverPasswordHidden">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="back-to-login">Back</button>
					<button type="button" class="btn btn-primary" id="recover-submit">Recover your password</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Update Snippet Modal -->
	<div class="modal fade" id="updateSnippetModal" tabindex="-1" role="dialog" aria-labelledby="updateSnippetModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit a snippet</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="updateSnippetForm">
						<label><b>Snippet Name</b></label>
						<br/>
						<input type="text" placeholder="Enter Snippet Name" name="snippetName" required maxlength="40">
						<br/>
						<label><b>Snippet Code</b></label>
						<br/>
						<textarea rows="10" cols = "40" placeholder="Edit Snippet" name="snippetText" class="submit-textarea" required></textarea>
						<input type="submit" id="updateSnippetHidden" style="display:none;">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" id="update-snippet-submit">Submit</button>
  				</div>
			</div>
		</div>
	</div>

	<!--
		Scripts from top to bottom:
			JQuery 3.2.1 (latest version, upgraded from the version Mark started us with)
			popper.js, a dependency for BootstrapLove

			Bootstrap 4.0.0 beta (latest version, upgraded from the version Mark started us with)
			Datatables.js for our snippets table
			Prism.js for our code coloring & line numbers
			SnippetsModel, the model for our page's MVC
			SnippetsController, the controller for our page's MVC
	-->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="/Client/js/prism.js"></script>
	<script src="/Client/js/SnippetsModel.js"></script>
	<script src="/Client/js/SnippetsController.js"></script>
</body>
</html>
