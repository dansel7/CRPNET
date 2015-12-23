<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<style>
.container{width:300px}   

.form-horizontal .control-label {
    width: auto;
    float: left
}  
body.site {
    background-color: #10223e;
}
footer{
    color:white;
}
img{
    margin-left: 25px;
}
.btn-primary {
    color: #fff;
    text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
    background-color: #1d6cb0;
    background-image: -moz-linear-gradient(top,#2384d3,#15497c);
    background-image: -webkit-gradient(linear,0 0,0 100%,from(#2384d3),to(#15497c));
    background-image: -webkit-linear-gradient(top,#2384d3,#15497c);
    background-image: -o-linear-gradient(top,#2384d3,#15497c);
    background-image: linear-gradient(to bottom,#2384d3,#15497c);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff2384d3', endColorstr='#ff15497c', GradientType=0);
    border-color: #15497c #15497c #0a223b;
    filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
}
</style>    
<div class="login<?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	</div>
	<?php endif; ?>

	<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
	<div class="login-description">
	<?php endif; ?>

		<?php if ($this->params->get('logindescription_show') == 1) : ?>
			<?php echo $this->params->get('login_description'); ?>
		<?php endif; ?>

		<?php if (($this->params->get('login_image') != '')) :?>
			<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JText::_('COM_USERS_LOGIN_IMAGE_ALT')?>"/>
		<?php endif; ?>

	<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
	</div>
	<?php endif; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate form-horizontal well">

		<fieldset>
			
					
				        <div class="control-group input-prepend input-append">
						<div class="control-label">
						<span class="add-on">
						<span class="icon-user hasTooltip" title="" data-original-title="Usuario"></span>
						<label for="username" class="element-invisible">
							Usuario						</label>
                                                </span>
                                                </div>
						<div class="control-label">
						<input type="text" name="username" id="username" value="" class="validate-username required" size="25"  required="" aria-required="true" autofocus="">						
                                                </div>
					</div>
                    <br>
                                        <div class="control-group input-prepend input-append">
						<div class="control-label">
						<span class="add-on">
						<span class="icon-lock hasTooltip" title="" data-original-title="Contraseña"></span>
						<label for="password" class="element-invisible">
							Contraseña						</label>
                                                </span>
                                                </div>
						<div class="control-label">
						<input type="password" name="password" id="password" value="" class="validate-password required" size="25"  maxlength="99" required="" aria-required="true">						
                                                </div>
					</div>

			<?php if ($this->tfa): ?>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getField('secretkey')->label; ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getField('secretkey')->input; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
			<div  class="control-group">
				<div class="control-label"><label><?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME') ?></label></div>
				<div class="controls"><input id="remember" type="checkbox" name="remember" class="inputbox" value="yes"/></div>
			</div>
			<?php endif; ?>

			<div class="control-group">
				<div class="">
					<button type="submit" style="background-color:#15497c" class="btn btn-primary btn-block btn-large">
						<?php echo JText::_('JLOGIN'); ?>
					</button>
				</div>
			</div>

			<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return'))); ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</fieldset>
	</form>
</div>
<div>
	<ul class="nav nav-tabs nav-stacked">
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
			<?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></a>
		</li>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
			<?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?></a>
		</li>
		<?php
		$usersConfig = JComponentHelper::getParams('com_users');
		if ($usersConfig->get('allowUserRegistration')) : ?>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
				<?php echo JText::_('COM_USERS_LOGIN_REGISTER'); ?></a>
		</li>
		<?php endif; ?>
	</ul>
</div>
