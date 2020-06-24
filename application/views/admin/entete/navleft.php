 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url('assets/admin/dist/img/AdminLTELogo.png');?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Broken Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('assets/admin/dist/img/user2-160x160.jpg');?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Boris Sylvanus</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-tags fa-fw"></i>
              <p>
                Option Catégories
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/newCategory'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nouvelle catégorie</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/allCategories'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Voir la liste des catégories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/newSubCategory'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ajouter une Sous catégories</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/allSubCategories'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Voir la liste des Sous catégories</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-product-hunt fa-fw"></i>
              <p>
                Option Produits
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/newProduct'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nouveau produit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/allProducts'); ?>" class="nav-link">
                  <i class="far fa-angle-left pull-right"></i>
                  <p>Voir la liste des produits</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-bar-chart-o fa-fw"></i>
              <p>
                Models
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/newModel'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nouveau model</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/allModels'); ?>" class="nav-link">
                  <i class="far fa-angle-left pull-right"></i>
                  <p>Voir la liste des models</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                specs
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/newSpec'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nouveau spec</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/allSpecs'); ?>" class="nav-link">
                  <i class="far fa-angle-left pull-right"></i>
                  <p>Voir la liste des specs</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="hidden-tablet"></i><span class="hidden-tablet">
              Option Slider</span>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/newSlider'); ?>" class="nav-link">
                  <i class="icon-font"></i>
                  <span class="hidden-tablet">Nouveau slider</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/allSlider'); ?>" class="nav-link">
                  <i class="icon-picture"></i>
                  <span class="hidden-tablet">Voir la liste des slider</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="hidden-tablet"></i><span class="hidden-tablet">
              Option Marques</span>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/newBrand'); ?>" class="nav-link">
                  <i class="icon-edit"></i>
                  <span class="hidden-tablet">Nouvelle Marque</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('index.php/admin/allBrand'); ?>" class="nav-link">
                  <i class="icon-list-alt"></i>
                  <span class="hidden-tablet">Voir la liste des Marques</span>
                </a>
              </li>
            </ul>
          </li>

          <li>
            <a href="<?php echo base_url('index.php/admin/themeOption');?>" class="nav-link" ><i class="icon-align-justify"></i><span class="hidden-tablet">Paramètres du site</span></a>
          </li>
          
          <li>
            <a href="<?php echo base_url('index.php/admin/manageOrder');?>" class="nav-link"><i class="fa fa-flask fa-fw"></i>Gestion des commandes</a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>