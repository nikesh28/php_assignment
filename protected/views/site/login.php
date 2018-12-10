<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/pages/signin.css" rel="stylesheet" type="text/css" />
<div class="account-container">
    
    <div class="content clearfix">
        <?php if($flogin){ ?>
        <div class="alert">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <strong>Error!</strong> Incorrect username or password.
        </div>
        <?php } ?>
        <form action="<?php echo $this->createUrl("site/login"); ?>" method="post">

            <h1>Admin Login</h1>

            <div class="login-fields">

                <p>Please provide your details</p>

                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="LoginForm[username]" value="" placeholder="Username" class="login username-field" />
                </div> <!-- /field -->

                <div class="field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="LoginForm[password]" value="" placeholder="Password" class="login password-field"/>
                </div> <!-- /password -->

            </div> <!-- /login-fields -->

            <div class="login-actions">

                <span class="login-checkbox">
                    <input id="ytLoginForm_rememberMe" type="hidden" name="LoginForm[rememberMe]" value="0">
                    <input id="Field" name="LoginForm[rememberMe]" type="checkbox" class="field login-checkbox" value="1" tabindex="4" />
                    <label class="choice" for="Field">Keep me signed in</label>
                </span>

                <input type="submit" class="button btn btn-success btn-large" value="Sign In" />

            </div> <!-- .actions -->



        </form>

    </div> <!-- /content -->

</div> <!-- /account-container -->


<div class="login-extra">
    <br />
</div> <!-- /login-extra -->