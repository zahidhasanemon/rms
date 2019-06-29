<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<div class="brand">
		<a href="{{ url('/') }}">
			<img src="{{ asset('images/brandimage.jpg') }}" class="" alt="{{ config('app.name', 'JU') }}">
		</a>
	</div>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class
			with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="{{ url('/home') }}" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
		
				<li class="{{ \Request::is('user/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-users"></i>
						<p>
							Users
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('user') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Users</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('user.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add User</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('lab/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-users"></i>
						<p>
							Labs
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('lab') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Labs</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('lab.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add Lab</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('unit/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-users"></i>
						<p>
							Units
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('unit') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Units</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('unit.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Make New</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('product/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-shopping-cart"></i>
						<p>
							Products
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('product') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Products</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('product.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add Product</p>
							</a>
						</li>
					</ul>
				</li>
				
				{{-- Component --}}
				<li class="nav-item">
					<a href="{{ url('component') }}" class="{{ \Request::is('component/*') ? 'nav-link active' : 'nav-link'  }}">
						<i class="nav-icon fa fa-shopping-cart"></i>
						<p>
							Components
						</p>
					</a>
				</li>

				<li class="{{ \Request::is('supplier/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-users"></i>
						<p>
							Suppliers
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('supplier') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Suppliers</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('supplier.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add Supplier</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('category/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-th"></i>
						<p>
							Categories
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('category') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Caregories</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('category.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add Category</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('sub-category/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-th"></i>
						<p>
							Sub Categories
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('sub-category') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Sub Caregories</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('sub-category.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add Sub Category</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('store/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-hdd-o"></i>
						<p>
							Store
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('store') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Previous List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('store.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add to Store</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('requisition/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-gear"></i>
						<p>
							Requisitions
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('requisition') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Requisitions</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('requisition.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Make Requisition</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-pie-chart"></i>
						<p>
							Report
						</p>
					</a>
				</li>
			</ul>
		</nav>
	<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
