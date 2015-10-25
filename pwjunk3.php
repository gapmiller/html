<!--
Iclude here boottram css file you can get good result

from http://code.runnable.com/VgVPteEBQ_ABJUVB/php-simple-login

-->

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <i class="fa fa-user"> </i>  Admin Login  </h3>
                    </div>
                    <div class="panel-body">
                        <form role="form"  action="index.php" name="login" method="post">
                            <fieldset>
                                <div class="form-group">
								    <input class="form-control" placeholder="Username" name="admin_name" type="text" autofocus>
                                </div>
                                <div class="form-group">
								<input class="form-control"  type="password" name="admin_pass" placeholder="Password" value=""/>
                            
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
								 <input type="submit" name="admin_login" class="btn btn-lg btn-success btn-block" value="login" />
                                     
                              	 
                            </fieldset>
                        </form>  
                        
                        
