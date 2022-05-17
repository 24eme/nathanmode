<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
        <link href="/css/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
    	<div id="wrapper">
          	<?php if ($sf_user->isAuthenticated()): ?>
          	<div id="header">
            	<div class="account"><?php echo $sf_user->getGuardUser()->getFirstName() ?>,</div>
                <a class="logOut" href="<?php echo url_for('@sf_guard_signout') ?>">Déconnexion</a>  
                <div class="btHead">
                	<div class="btRight">
                		<a class="addHead<?php if (sfContext::getInstance()->getModuleName() == 'activite'): ?> active<?php endif; ?>" href="<?php echo url_for('@activite') ?>">Commercial Activity</a>
                        <a class="addHead<?php if (sfContext::getInstance()->getModuleName() == 'lab_dip'): ?> active<?php endif; ?>" href="<?php echo url_for('@lab_dip') ?>">Lab dip</a>
                        <a class="addHead<?php if (sfContext::getInstance()->getModuleName() == 'qualite'): ?> active<?php endif; ?>" href="<?php echo url_for('@qualite') ?>">Qualité</a> 
                        <a class="addHead<?php if (sfContext::getInstance()->getModuleName() == 'client'): ?> active<?php endif; ?>" href="<?php echo url_for('@client') ?>">Clients</a>                
                        <a class="addHead<?php if (sfContext::getInstance()->getModuleName() == 'fournisseur'): ?> active<?php endif; ?>" href="<?php echo url_for('@fournisseur') ?>">Fournisseurs</a>
                        <a class="addHead<?php if (sfContext::getInstance()->getModuleName() == 'commercial'): ?> active<?php endif; ?>" href="<?php echo url_for('@commercial') ?>">Commerciaux</a>
                        <a class="addHead<?php if (sfContext::getInstance()->getModuleName() == 'sfGuardUser'): ?> active<?php endif; ?>" href="<?php echo url_for('@sf_guard_user') ?>">Administrateurs</a>
                    </div>
                </div>
                <div class="navigation">
                	<div class="logo">
                		<a href="<?php echo url_for('@homepage') ?>"><img width="290" alt="" src="/images/nathanmode.png" /></a>
                	</div>
                    <div class="setNav">
                        <a class="coupe<?php if (sfContext::getInstance()->getModuleName() == 'collection'): ?> active<?php endif; ?>" href="<?php echo url_for('@coupe') ?>">&nbsp;</a>
                        <a class="prix<?php if (sfContext::getInstance()->getModuleName() == 'prix_special'): ?> active<?php endif; ?>" href="<?php echo url_for('@prix_special') ?>">&nbsp;</a>
                        <a class="prod<?php if (sfContext::getInstance()->getModuleName() == 'production'): ?> active<?php endif; ?>" href="<?php echo url_for('@collection_production') ?>">&nbsp;</a>
                        <a class="facture_np<?php if (sfContext::getInstance()->getModuleName() == 'facure' || sfContext::getInstance()->getModuleName() == 'facure_payee'): ?> active<?php endif; ?>" href="<?php echo url_for('@facture') ?>">&nbsp;</a>
                        <!-- <a class="facture<?php if (sfContext::getInstance()->getModuleName() == 'facure_payee'): ?> active<?php endif; ?>" href="<?php echo url_for('@facture_facure_payee') ?>">&nbsp;</a> -->
                        <a class="notecredit<?php if (sfContext::getInstance()->getModuleName() == 'credit'): ?> active<?php endif; ?>" href="<?php echo url_for('@credit') ?>">&nbsp;</a>
                        <a class="stat<?php if (sfContext::getInstance()->getModuleName() == 'bon'): ?> active<?php endif; ?>" href="<?php echo url_for('@bon') ?>">&nbsp;</a>
                        <a class="statCommande<?php if (sfContext::getInstance()->getModuleName() == 'commande'): ?> active<?php endif; ?>" href="<?php echo url_for('@commande') ?>">&nbsp;</a>
                    </div>
            	</div>
            </div>
            <?php else: ?>
          	<div id="header">
            	<div class="account">Connexion</div>
                <div class="navigation">
                	<div class="logo">
                		<a href="<?php echo url_for('@sf_guard_signin') ?>"><img width="290" alt="" src="/images/nathanmode.png" /></a>
                	</div>
            	</div>
            </div>
          	<?php endif; ?>
          	<div id="pageContent">
            	<?php echo $sf_content ?>
            </div>
        </div>
        <div></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
