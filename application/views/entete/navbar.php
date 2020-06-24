<div class="header-middle"><!--header-middle-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="logo">
                <a href="<?php echo base_url('/'); ?>"><img src="<?php echo base_url('assets/uploads/'); ?><?php echo get_option('site_logo'); ?>" alt="" /></a>
            </div>
				<div class="logo pull-left">
					<a href="<?php echo base_url();?>"><img src="<?php echo base_url()?>assets/public/images/home/logo.png" alt="" /></a>
				</div>
				<div class="btn-group pull-right">
				    <div class="btn-group">
					</div>
							
					<div class="btn-group">
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="shop-menu pull-right">
					<ul class="nav navbar-nav">
								
						<li><a href="#"><i class="fa fa-user"></i> Account</a></li>
						<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
							<?php $customer_id = $this->session->userdata('cus_id');?>
							<?php $shipping_id = $this->session->userdata('shipping_id');?>

							<?php if($this->cart->total_items()!=Null && $customer_id!=NULL && $shipping_id!=NULL){
										?>
						<li>
							<a href="<?php echo base_url()?>payment"><i class="fa fa-crosshairs"></i> Checkout</a>

						</li>
							<?php }elseif($this->cart->total_items()!=Null && $customer_id!=NULL){?>

						<li>
							<a href="<?php echo base_url()?>billing"><i class="fa fa-crosshairs"></i> Checkout</a>

						</li>

							<?php }else{?>
						<li>
						   <a href="<?php echo base_url()?>checkout"><i class="fa fa-crosshairs"></i> Checkout</a>

						</li>
							<?php } ?>
						<li>
							<?php if($this->cart->total_items()!=Null && $customer_id!=NULL && $shipping_id!=NULL){?>
							<a href="<?php echo base_url()?>payment"><i class="fa fa-credit-card"></i>Payment</a>
							<?php } ?>
						</li>
						<li>	
							<a href="<?php echo base_url()?>show-cart"><i class="fa fa-shopping-cart"></i>
							   <?php $cart_items =  $this->cart->total_items();
									if($cart_items>0){
									?> 
									 Cart(<?php echo $cart_items;?>)
									 <?php }else{?>
									  Panier(vide)
									 <?php } ?>
									</a>

								</li>
								<?php 
									
								if($customer_id){?>
								<li>
									<a href="<?php echo base_url()?>logout"><i class="fa fa-lock"></i> Logout</a>
								</li>
								<?php }else{ ?>
								<li>
									<a href="<?php echo base_url()?>checkout"><i class="fa fa-lock"></i> Login</a>
								</li>
								<?php } ?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?php echo base_url();?>" class="active">Accueil</a></li>
								<li class="dropdown"><a href="#">Boutique<i class="fa fa-angle-down"></i></a>
								</li> 
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form action="<?php echo base_url()?>search" method="post">
							<input type="text" name="search" placeholder="search" />							
							</form>
						</div> 
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
