<?php $dbconfig = \PHPArcade\Core::getDBConfig(); ?>

<div class="omb_login">
	<h3 class="omb_authTitle">
		<?php echo gettext('loginsignup'); ?>
	</h3>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#login" role="tab" data-toggle="tab">
				<?php echo gettext('login'); ?>
			</a>
		</li>
		<li role="presentation">
			<a href="#forgot" role="tab" data-toggle="tab">
				<?php echo gettext('passwordrecovery'); ?>
			</a>
		</li>
		<li role="presentation">
			<a href="#register" role="tab" data-toggle="tab"><?php echo gettext('register'); ?></a>
		</li>
	</ul>
	<!-- End Nav tabs -->
	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="login">
			<p>&nbsp;</p>
			<div class="row omb_row-sm-offset-3">
				<div class="col-xs-12 col-md-6">
					<form class="omb_loginForm" autocomplete="off" action="<?php echo SITE_URL; ?>"
					      method="post">
						<div class="input-group">
							<span class="input-group-addon"><?php echo PHPArcade\Core::showGlyph('user', '1x', 'false');?></span>
							<input class="form-control" id="username" name="username"
                                   placeholder="User name">
						</div>
						<span class="help-block"></span>
						<div class="input-group">
							<span class="input-group-addon"><?php echo PHPArcade\Core::showGlyph('lock', '1x', 'false');?></span>
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
						<span class="help-block"></span>
						<button class="btn btn-lg btn-primary btn-block" name="params" value="login/login">
							<?php echo gettext('login'); ?>
						</button>
					</form>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="forgot">
			<p>&nbsp;</p>
			<div class="row omb_row-sm-offset-3">
				<div class="col-xs-12 col-md-6">
					<?php PHPArcade\Core::showWarning(gettext('recoveryinstructions')); ?>
					<form class="omb_loginForm" autocomplete="off" action="<?php echo SITE_URL; ?>" method="post">
						<div class="input-group">
							<span class="input-group-addon"><?php echo PHPArcade\Core::showGlyph('user', '1x', 'false');?></span>
							<input class="form-control" id="username" name="username" placeholder="User name">
						</div>
						<span class="help-block"></span>
						<div class="input-group">
							<span class="input-group-addon"><?php echo PHPArcade\Core::showGlyph('envelope', '1x', 'false');?></span>
							<input type="email" class="form-control" name="email" placeholder="Email Address">
						</div>
						<span class="help-block">&nbsp;</span>
						<button class="btn btn-lg btn-primary btn-block" name="params" value="login/recover/do">
							<?php echo gettext('recoverpassword'); ?>
						</button>
					</form>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="register">
			<div class="row omb_row-sm-offset-3">
				<div class="col-xs-12 col-md-6">
					<form class="omb_loginForm" autocomplete="off" action="<?php echo SITE_URL; ?>" method="post">
						<div class="text-uppercase help-block">
							<?php echo gettext('validemail'); ?>
						</div><?php
                        $execstatus = $execstatus ?? '';
                        if ($execstatus == 'success') {
                            /** @noinspection PhpUndefinedVariableInspection */
                            switch ($status) {
                                case '':
                                    echo 'eek';
                                    break;
                                case 'confirmed':
                                    PHPArcade\Core::doEvent('register_confirm');
                                    PHPArcade\Core::showSuccess(gettext('registerconfirm'));
                                    break;
                                case 'emailconf':
                                    PHPArcade\Core::showSuccess(gettext('emailconf'));
                                    break;
                                case 'passwordchangedsent':
                                    PHPArcade\Core::showSuccess(gettext('passwordchangedsent'));
                                    break;
                                case 'recoveryemailsent':
                                    PHPArcade\Core::showSuccess(gettext('recoveryemailsent'));
                                    break;
                                case 'emailinvalid':
                                    PHPArcade\Core::showError(gettext('emailinvaliderror'));
                                    break;
                                case 'generic':
                                    PHPArcade\Core::showError(gettext('genericerror'));
                                    break;
                                case 'notallfields':
                                    PHPArcade\Core::showWarning(gettext('allfieldserror'));
                                    break;
                                case 'usertaken':
                                    PHPArcade\Core::showWarning(gettext('usertaken'));
                                    break;
                                default:
                            }
                        } ?>
						<div class="input-group">
							<span class="input-group-addon"><?php echo PHPArcade\Core::showGlyph('user', '1x', 'false');?></span>
							<input class="form-control" id="username" name="username" placeholder="User name">
						</div>
						<span class="help-block"></span>
						<div class="input-group">
							<span class="input-group-addon"><?php echo PHPArcade\Core::showGlyph('envelope', '1x', 'false');?></span>
							<input type="email" class="form-control" name="email" placeholder="Email Address">
						</div>
						<span class="help-block"></span>
						<div class="g-recaptcha" data-sitekey="<?php echo $dbconfig['google_recaptcha_sitekey'];?>"></div>
						<span class="help-block"></span>

                        <!-- CloudFlare Server-side Exclude hides the registration button for suspicious visitors -->
                        <!--sse-->
						<button class="btn btn-lg btn-primary btn-block" name="params" value="register/regdone">
							<?php echo gettext('register'); ?>
						</button>
                        <!--/sse-->
					</form>
				</div>
			</div>
		</div>
	</div>
</div>