<?php $gitcommit = str_replace("\n", "", file_get_contents('../.git/ORIG_HEAD'));?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/reset.css?<?php echo $gitcommit ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/themes/<?php echo sfConfig::get('sf_app') ?>.css?<?php echo $gitcommit ?>" />
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap-icons.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/global.css?<?php echo $gitcommit ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/chosen.css?<?php echo $gitcommit ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/admin.css?<?php echo $gitcommit ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/jquery-ui.min.css?<?php echo $gitcommit ?>" />
        <link rel="stylesheet" type="text/css" media="print" href="/css/globalprint.css?<?php echo $gitcommit ?>" />
        <script type="text/javascript" src="/js/jquery-1.7.2.min.js?<?php echo $gitcommit ?>"></script>
        <script type="text/javascript" src="/js/jquery-ui.min.js?<?php echo $gitcommit ?>"></script>
        <script type="text/javascript" src="/js/jquery.plugins.min.js?<?php echo $gitcommit ?>"></script>
        <script type="text/javascript" src="/js/datepicker-fr.js?<?php echo $gitcommit ?>"></script>
        <script type="text/javascript" src="/js/chosen.jquery.min.js?<?php echo $gitcommit ?>"></script>
        <script type="text/javascript" src="/js/chartjs4-4-2/dist/chart.umd.js"></script>
        <script type="text/javascript" src="/js/chartjs-adapter-date-fns.bundle.min.js"></script>
        <script type="text/javascript" src="/js/global.js?<?php echo $gitcommit ?>"></script>
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
      <header class="mb-3">
        <div id="navbar" style="height: 42px;">
          <div class="d-flex align-items-center container h-100">
            <a href="<?php echo url_for('@homepage') ?>" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
              <span class="bi bi-person-square fs-6"> <?php echo ($sf_user->isAuthenticated())? $sf_user->getGuardUser()->getFirstName() : 'Connexion' ?></span>
            </a>
            <?php if ($sf_user->isAuthenticated()): ?>
            <ul class="nav col-12 col-lg-auto">
              <li class="nav-item me-1">
                <a class="btn btn-light btn-sm<?php if (sfContext::getInstance()->getModuleName() == 'activite'): ?> active<?php endif; ?>" href="<?php echo url_for('@activite') ?>">Commercial Activity</a>
              </li>
              <li class="nav-item me-1">
                <a class="btn btn-light btn-sm<?php if (sfContext::getInstance()->getModuleName() == 'client'): ?> active<?php endif; ?>" href="<?php echo url_for('@client') ?>">Clients</a>
              </li>
              <li class="nav-item me-1">
                <a class="btn btn-light btn-sm<?php if (sfContext::getInstance()->getModuleName() == 'fournisseur'): ?> active<?php endif; ?>" href="<?php echo url_for('@fournisseur') ?>">Fournisseurs</a>
              </li>
              <li class="nav-item me-1">
                <a class="btn btn-light btn-sm<?php if (sfContext::getInstance()->getModuleName() == 'commercial'): ?> active<?php endif; ?>" href="<?php echo url_for('@commercial') ?>">Commerciaux</a>
              </li>
              <li class="nav-item me-1">
                <a class="btn btn-light btn-sm<?php if (sfContext::getInstance()->getModuleName() == 'sfGuardUser'): ?> active<?php endif; ?>" href="<?php echo url_for('@sf_guard_user') ?>">Administrateurs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white px-0" href="<?php echo url_for('@sf_guard_signout') ?>"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
              </li>
            </ul>
            <?php endif; ?>
          </div>
        </div>
        <div class="bg-body-tertiary border-bottom border-5 border-secondary-subtle" style="height: 100px;">
          <div class="d-flex align-items-center container h-100">
            <a href="<?php echo url_for('@homepage') ?>" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none" >
              <img style="max-height: 60px;" alt="" src="<?php echo '/images/'.sfConfig::get('sf_app').'.png' ?>" />
            </a>
            <?php if ($sf_user->isAuthenticated()): ?>
            <ul class="nav col-12 col-lg-auto">
              <li class="nav-item me-1">
                <a style="min-width: 120px" class="py-2 px-3 border btn btn-light<?php if (sfContext::getInstance()->getModuleName() == 'coupe'): ?> active<?php endif; ?>" href="<?php echo url_for('@coupe') ?>"><i class="bi bi-scissors fs-4"></i><br /><small>Coupe</small></a>
              </li>
              <li class="nav-item me-1">
                  <a style="min-width: 120px" class="py-2 px-3 border btn btn-light<?php if (in_array(sfContext::getInstance()->getModuleName(), ['production', 'productiondetails'])): ?> active<?php endif; ?>" href="<?php echo url_for('@collection_detail') ?>"><i class="bi bi-asterisk fs-4"></i><br /><small>Production</small></a>
              </li>
              <li class="nav-item me-1">
                <a style="min-width: 120px" class="py-2 px-3 border btn btn-light<?php if (sfContext::getInstance()->getModuleName() == 'facure' || sfContext::getInstance()->getModuleName() == 'facure_payee'): ?> active<?php endif; ?>" href="<?php echo url_for('@facture') ?>"><i class="bi bi-file-earmark-text fs-4"></i><br /><small>Factures</small></a>
              </li>
              <li class="nav-item me-1">
                <a style="min-width: 120px" class="py-2 px-3 border btn btn-light<?php if (sfContext::getInstance()->getModuleName() == 'credit'): ?> active<?php endif; ?>" href="<?php echo url_for('@credit') ?>"><i class="bi bi-currency-euro fs-4"></i><br /><small>Notes de crédits</small></a>
              </li>
              <li class="nav-item me-1">
                <a style="min-width: 120px" class="py-2 px-3 border btn btn-light<?php if (sfContext::getInstance()->getModuleName() == 'bon'): ?> active<?php endif; ?>" href="<?php echo url_for('@bon') ?>"><i class="bi bi-bar-chart-fill fs-4"></i><br /><small>Statistiques</small></a>
              </li>
              <li class="nav-item me-1">
                <a style="min-width: 120px" class="py-2 px-3 border btn btn-light<?php if (sfContext::getInstance()->getModuleName() == 'commande'): ?> active<?php endif; ?>" href="<?php echo url_for('@commande') ?>"><i class="bi bi-bar-chart-fill fs-4"></i><br /><small class="mt-2">Statistiques Com.</small></a>
              </li>
              <li class="nav-item me-1">
                <span style="min-height: 63px" class=" pt-3 px-3 border btn btn-light" title="<?php echo Change::getInfos() ?>"><i class="bi bi-currency-exchange fs-2"></i></span>
              </li>

            </ul>
            <?php endif; ?>
          </div>
        </div>
      </header>
    	<div class="container">
        	<div id="pageContent">
          	<?php echo $sf_content ?>
          </div>
      </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
