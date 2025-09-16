<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      @php
         $admins_role = Auth::user()->role_id;
      @endphp

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
            <img src="{{ asset('admin/dist/img/mobileapplogo.png') }}" class="img-circle elevation-2" alt="User Image">
         </div>
         <div class="info">
            <a href="{{ url('admin/home') }}" class="d-block">{{ Auth::user()->name }}</a>
         </div>
      </div>

      @php
         $admins_role = Auth::user()->role_id;
         $route = Route::current();
         $routename = $route->getName();
      @endphp

      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-open">
               @if($admins_role != '4')
                  <a href="#" class="nav-link active">
                     <i class="nav-icon fas fa-tachometer-alt"></i>
                     <p>
                        Web Portal
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
               @endif

               <ul class="nav nav-treeview">
                  @if(!in_array($admins_role, [4,6,7,8,9,10]))
                     <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link @if($routename =='admin.users.index') active @endif">
                           <i class="nav-icon fas fa-users"></i>
                           <p>Users</p>
                        </a>
                     </li>
                  @endif

                  @if(!in_array($admins_role, [4,6,7,8,9]))
                     <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link @if($routename =='admin.users.index') active @endif">
                           <i class="nav-icon fas fa-users"></i>
                           <p>NaMO Cycling Cub data</p>
                        </a>
                     </li>
                  @endif

                  @if(!in_array($admins_role, [4,6,7,8,9,10]))
                     <li class="nav-item">
                        <a href="{{ route('admin.youths.index') }}" class="nav-link @if($routename =='admin.youths.index') active @endif">
                           <i class="nav-icon fas fa-user-friends"></i>
                           <p>Youth Club Certificates</p>
                        </a>
                     </li>
                  @endif

                  @if(!in_array($admins_role, [4,7,8,9,10]))
                     <li class="nav-item">
                        <a href="{{ route('admin.starratings.index') }}" class="nav-link @if($routename =='admin.starratings.index') active @endif">
                           <i class="nav-icon fa fa-star" aria-hidden="true"></i>
                           <p>School Certificates</p>
                        </a>
                     </li>
                  @endif

                  @if(!in_array($admins_role, [2,3,4,6,8,9,10]))
                     <li class="nav-item">
                        <a href="{{ url('admin/gujarat-events') }}" class="nav-link">
                           <i class="nav-icon fa fa-star" aria-hidden="true"></i>
                           <p>Gujarat Events</p>
                        </a>
                     </li>
                  @endif

                  @if(!in_array($admins_role, [2,3,4,6,7,8,9,10]))
                     <li class="nav-item @if(in_array($routename, ['admin.quizorganizer','admin.quizs.index','admin.quizwinners.index'])) menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link">
                           <i class="nav-icon fas fa fa-clone"></i>
                           <p>
                              Road to Tokyo 2020 Quiz
                              <i class="fas fa-angle-left right"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="{{ route('admin.quizorganizer') }}" class="nav-link @if($routename =='admin.quizorganizer') active @endif">
                                 <i class="nav-icon fas fa-question-circle"></i>
                                 <p>Quiz Organizers</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('admin.quizs.index') }}" class="nav-link @if($routename =='admin.quizs.index') active @endif">
                                 <i class="nav-icon fas fa-users"></i>
                                 <p>Quiz Participants</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('admin.quizwinners.index') }}" class="nav-link @if($routename =='admin.quizwinners.index') active @endif">
                                 <i class="fas fa-award nav-icon"></i>
                                 <p>Quiz Winners</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                  @endif

                  <!-- More menu items follow with similar formatting -->
                  <!-- (You can continue formatting the remaining items in the same pattern) -->

               </ul>
            </li>

            @if(!in_array($admins_role, [2,3,4,6,7,8,9,10]))
               <li class="nav-item has-treeview @if(in_array($routename, ['admin.foodcharts.index','admin.foodnames.index','admin.servingquantities.index','admin.sleepcharts.index'])) menu-is-opening menu-open @endif">
                  <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-tachometer-alt"></i>
                     <p>
                        Mobile App
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{ route('admin.foodcharts.index') }}" class="nav-link @if($routename =='admin.foodcharts.index') active @endif">
                           <i class="nav-icon fas fa-cookie"></i>
                           <p>Food Charts</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ route('admin.foodnames.index') }}" class="nav-link @if($routename =='admin.foodnames.index') active @endif">
                           <i class="far fa fa-stroopwafel nav-icon"></i>
                           <p>Food Name</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ route('admin.servingquantities.index') }}" class="nav-link @if($routename =='admin.servingquantities.index') active @endif">
                           <i class="nav-icon fa fa-check" aria-hidden="true"></i>
                           <p>Serving Quantities</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ route('admin.sleepcharts.index') }}" class="nav-link @if($routename =='admin.sleepcharts.index') active @endif">
                           <i class="nav-icon fas fa-chart-pie"></i>
                           <p>Sleep Charts</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ route('admin.pushnotification.index') }}" class="nav-link @if($routename =='admin.pushnotification.index') active @endif">
                           <i class="nav-icon fas fa-chart-pie"></i>
                           <p>Push Notification</p>
                        </a>
                     </li>
                  </ul>
               </li>
            @endif
         </ul>
      </nav>
   </div>
   <!-- /.sidebar -->
</aside>

<!-- <style>
.nav-sidebar .nav-treeview .nav-item{
  padding-left:30px !important;
}
</style> -->
