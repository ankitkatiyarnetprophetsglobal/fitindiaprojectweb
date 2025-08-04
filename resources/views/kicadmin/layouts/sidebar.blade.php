<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/mobileapplogo.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Session::get('fullName'); }}</a>

        </div>
      </div>
      <nav class="mt-2">
        @php
            $route = Route::current();
            $routename = $route->getName();
        @endphp
        {{-- {{ dd($routename); }} --}}
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

		  <li class="nav-item has-treeview menu-open">
				<a href="#" class="nav-link active">
				    <i class="nav-icon fas fa-tachometer-alt"></i>
				<p>
					Web Portal
					<i class="right fas fa-angle-left"></i>
				</p>
				</a>

            <ul class="nav nav-treeview">
					<li class="nav-item">
						{{-- <a href="{{ route('admin.users.index') }}" class="nav-link"> --}}
                            <a href="{{ route('kicadmin.kicform') }}" class="nav-link @if($routename =='kicadmin.kicform') {{ 'active' }} @endif">
						<i class="nav-icon fas fa-users"></i>
						<p>KIC</p>
						</a>
					</li>
					{{-- <li class="nav-item">
						<a href="#" class="nav-link">
						<i class="nav-icon fas fa-calendar"></i>
						<p> Events <i class="fas fa-angle-left right"></i> </p>
						</a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.events.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Events</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.eventcats.index') }}">
                                <i class="nav-icon fas fa fa-cogs"></i>
                                <p> Event Category </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.eventarchive.index') }}" class="nav-link">
                                <i class="nav-icon fas fa fa-archive" aria-hidden="true"></i>
                                <p> Event Archive </p>
                                </a>
                            </li>
                        </ul>
				    </li> --}}


					{{-- <li class="nav-item ">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa fa-clone"></i>
							<p>
								General
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.states.index') }}" class="nav-link">
								<i class="nav-icon fas fa fa-flag"></i>
								<p>State</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{ route('admin.districts.index') }}" class="nav-link">
								<i class="nav-icon fas fa fa-sitemap"></i>
								<p>District</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.blocks.index') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Block</p>
								</a>
							</li>
						</ul>
					</li> --}}
            </ul>
          </li>

		  <!-- </ul> -->
		</li>
		</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- <style>
.nav-sidebar .nav-treeview .nav-item{
  padding-left:30px !important;
}
</style> -->
