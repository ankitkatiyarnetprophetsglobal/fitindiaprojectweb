<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) @php $admins_role = Auth::user()->role_id; @endphp-->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/mobileapplogo.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          {{-- <a href="#" class="d-block">{{ Auth::user()->name }}</a> --}}
          <a href="{{ url('admin/home') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
      @php $admins_role = Auth::user()->role_id;  $route = Route::current(); $routename = $route->getName(); @endphp
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
                @if(!in_array($admins_role, array(4,6,7,8,9,10)))
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link @if($routename =='admin.users.index') {{ 'active' }} @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                        </a>
                    </li>
                @endif
                @if(!in_array($admins_role, array(4,6,7,8,9)))
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link @if($routename =='admin.users.index') {{ 'active' }} @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>NaMO Cycling Cub data</p>
                        </a>
                    </li>
                @endif
                @if(!in_array($admins_role, array(4,6,7,8,9,10)))
                    <li class="nav-item">
                        <a href="{{ route('admin.youths.index') }}" class="nav-link @if($routename =='admin.youths.index') {{ 'active' }} @endif">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Youth Club Certificates  </p>
                        </a>
                    </li>
                @endif
                @if(!in_array($admins_role, array(4,7,8,9,10)))
                    <li class="nav-item">
                        <a href="{{ route('admin.starratings.index') }}" class="nav-link @if($routename =='admin.starratings.index') {{ 'active' }} @endif">
                        <i class="nav-icon fa fa-star" aria-hidden="true"></i>
                        <p>School Certificates</p>
                        </a>
                    </li>
                @endif
                @if(!in_array($admins_role, array(2,3,4,6,8,9,10)))
                    <li class="nav-item">
                        <a href="{{ url('admin/gujarat-events') }}" class="nav-link">
                        <i class="nav-icon fa fa-star" aria-hidden="true"></i>
                        <p>Gujarat Events</p>
                        </a>
                    </li>
                @endif
                @if(!in_array($admins_role, array(2,3,4,6,7,8,9,10)))
                    <li class="nav-item @if(($routename =='admin.quizorganizer')||($routename =='admin.quizs.index')||($routename =='admin.quizwinners.index')) {{ 'menu-is-opening menu-open' }} @endif">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa fa-clone"></i>
                        <p>
                            Road to Tokyo 2020 Quiz
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                            <a href="{{ route('admin.quizorganizer') }}" class="nav-link @if($routename =='admin.quizorganizer') {{ 'active' }} @endif">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>Quiz Organizers</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.quizs.index') }}" class="nav-link @if($routename =='admin.quizs.index') {{ 'active' }} @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Quiz Participants</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.quizwinners.index') }}" class="nav-link @if($routename =='admin.quizwinners.index') {{ 'active' }} @endif">
                            <i class="fas fa-award nav-icon"></i>
                            <p>Quiz Winners</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                @endif


                @if(!in_array($admins_role, array(2,3,4,6,7,8,9,10)))
                    <li class="nav-item @if(($routename =='admin.events.index')||($routename =='admin.eventcats.index')||($routename =='admin.eventarchive.index')) {{ 'menu-is-opening menu-open' }} @endif">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p> Events <i class="fas fa-angle-left right"></i> </p>
                        </a>
                @endif

                    <ul class="nav nav-treeview">
                        @if(!in_array($admins_role, array(4,6,7,8,9,10)))
                            <li class="nav-item">
                                <a href="{{ route('admin.events.index') }}" class="nav-link @if($routename =='admin.events.index') {{ 'active' }} @endif">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Events</p>
                                </a>
                            </li>
                        @endif

                        @if(!in_array($admins_role, array(2,3,4,6,7,8,9,10)))
                            <li class="nav-item">
                                <a href="{{ route('admin.eventcats.index') }}" class="nav-link @if($routename =='admin.eventcats.index') {{ 'active' }} @endif">
                                <i class="nav-icon fas fa fa-cogs"></i>
                                <p> Event Category </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.eventarchive.index') }}" class="nav-link @if($routename =='admin.eventarchive.index') {{ 'active' }} @endif">
                                <i class="nav-icon fas fa fa-archive" aria-hidden="true"></i>
                                <p> Event Archive </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                @if(!in_array($admins_role, array(2,3,4,6,7,8,9,10)))
                    <li class="nav-item @if(($routename =='admin.states.index')||($routename =='admin.districts.index')||($routename =='admin.blocks.index')) {{ 'menu-is-opening menu-open' }} @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa fa-clone"></i>
                            <p>
                                General
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.states.index') }}" class="nav-link @if($routename =='admin.states.index') {{ 'active' }} @endif">
                                <i class="nav-icon fas fa fa-flag"></i>
                                <p>State</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.districts.index') }}" class="nav-link @if($routename =='admin.districts.index') {{ 'active' }} @endif">
                                <i class="nav-icon fas fa fa-sitemap"></i>
                                <p>District</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.blocks.index') }}" class="nav-link @if($routename =='admin.blocks.index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Block</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        <p> Freedomrun
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('admin.freedomrun-individual.index') }}" class="nav-link @if($routename =='admin.freedomrun-individual.index') {{ 'active' }} @endif">
                                <i class="nav-icon fa fa-newspaper" aria-hidden="true"></i>
                                <p>Individual</p>
                            </a>
                            </li>

                            <li class="nav-item">
                            <a href="{{ url('admin/freedomrun-partner') }}" class="nav-link @if($routename ==request()->is('admin/freedomrun-partner')) {{ 'active' }} @endif">
                            <i class="nav-icon fas fa-star"></i>
                                <p>Partner </p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ url('admin/freedomrun-organizer') }}" class="nav-link @if($routename ==request()->is('admin/freedomrun-organizer')) {{ 'active' }} @endif">
                            <i class="nav-icon fas fa-star"></i>
                                <p>Organizers </p>
                            </a>
                            </li>
                        </ul>
                    </li>

                @endif

                @if(!in_array($admins_role, array(2,3,6,7,8,9,10)))
                    <li class="nav-item">
                        <a href="{{ route('admin.bulletin.index') }}" class="nav-link @if($routename =='admin.bulletin.index') {{ 'active' }} @endif">
                        <i class="nav-icon fas fa-star"></i>
                            <p> Bulletin </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ambassadors.index') }}" class="nav-link @if($routename =='admin.ambassadors.index') {{ 'active' }} @endif">
                        <i class="nav-icon fas fa-star"></i>
                            <p> Ambassadors </p>
                        </a>
                    </li>
                @endif

                @if(!in_array($admins_role, array(2,3,6,7,8,9,10)))
                    <li class="nav-item">
                        <a href="{{ route('admin.champions.index') }}" class="nav-link @if($routename =='admin.champions.index') {{ 'active' }} @endif">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p> Champions</p>
                        </a>
                    </li>
                @endif
                <?php
                    /*@if(!in_array($admins_role, array(2,3,6)))
                        <li class="nav-item">
                        <a href="{{ url('admin/panchayatlist') }}" class="nav-link @if($routename == request()->is('admin/panchayatlist')) {{ 'active' }} @endif">
                        <i class="nav-icon fas fa-star"></i>
                            <p>Gram Panchayat Ambassadors </p>
                        </a>
                        </li>
                    @endif*/
                ?>
                @if(!in_array($admins_role, array(2,3,6,7,8,9,10)))

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-sticky-note"></i>
                          <p> Influencer
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/preraklist') }}" class="nav-link @if($routename ==request()->is('admin/preraklist')) {{ 'active' }} @endif">
                           <i class="nav-icon fas fa-star"></i>
                            <p>Social Media Specialist </p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ url('admin/enthusiastlist') }}" class="nav-link @if($routename ==request()->is('admin/enthusiastlist')) {{ 'active' }} @endif">
                          <i class="nav-icon fas fa-star"></i>
                            <p>Fitness Event Specialist </p>
                          </a>
                        </li>
                        </ul>
                    </li>

                    {{-- <li class="nav-item">
                    <a href="{{ url('admin/panchayatlist') }}" class="nav-link">
                    <i class="nav-icon fas fa-star"></i>
                        <p>Gram Panchayat Ambassadors </p>
                    </a>
                    </li> --}}

                    {{-- <li class="nav-item">
                    <a href="{{ url('admin/localbodylist') }}" class="nav-link @if($routename ==request()->is('admin/localbodylist')) {{ 'active' }} @endif">
                    <i class="nav-icon fas fa-star"></i>
                        <p>Local Body Ambassadors </p>
                    </a>
                    </li> --}}

                    {{-- <li class="nav-item">
                        <a href="{{ route('admin.corporate.index') }}" class="nav-link @if($routename =='admin.corporate.index') {{ 'active' }} @endif">
                        <i class="nav-icon fas fa-warehouse"></i>
                            <p> Corporate </p>
                        </a>
                    </li> --}}

                        <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        <p> Rewards
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('admin.webreward.create') }}" class="nav-link @if($routename =='admin.webreward.create') {{ 'active' }} @endif">
                                <i class="nav-icon fa fa-newspaper" aria-hidden="true"></i>
                                <p>Add Reward</p>
                            </a>
                            </li>

                            <li class="nav-item">
                            <a href="{{ route('admin.webreward.index') }}" class="nav-link @if($routename == 'admin.webreward.index') {{ 'active' }} @endif">
                            <i class="nav-icon fas fa-star"></i>
                                <p>Reward List </p>
                            </a>
                            </li>

                        </ul>
                    </li>
                @endif

                @if(!in_array($admins_role, array(2,3,4,6,7,10)))
                    <li class="nav-item @if(($routename =='admin.posts.index')||($routename =='admin.category.index')) {{ 'menu-is-opening menu-open' }} @endif">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        <p> Posts
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.posts.index') }}" class="nav-link @if($routename =='admin.posts.index') {{ 'active' }} @endif">
                                    <i class="nav-icon fas fa-tasks" aria-hidden="true"></i>
                                    <p>Posts</p>
                                </a>
                            </li>
                            @if(!in_array($admins_role, array(2,3,4,6,7,8,10)))
                                <li class="nav-item">
                                    <a href="{{ route('admin.category.index') }}" class="nav-link @if($routename =='admin.category.index') {{ 'active' }} @endif">
                                        <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                        <p>Post Category</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                        @if(!in_array($admins_role, array(2,3,4,6,7,8,10)))
                            <li class="nav-item">
                                <a href="{{ route('admin.userimages.index') }}" class="nav-link @if($routename =='admin.announcement.index') {{ 'active' }} @endif">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                <p> User Image </p>
                                </a>
                            </li>
                        @endif
                    </li>
                @endif

                @if(!in_array($admins_role, array(2,3,4,6,7,8,9)))
                    <li class="nav-item @if(($routename =='admin.posts.index')||($routename =='admin.category.index')) {{ 'menu-is-opening menu-open' }} @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-sticky-note"></i>
                            <p> SOC
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.soc-events.index') }}" class="nav-link @if($routename =='admin.soc-events.index') {{ 'active' }} @endif">
                                    <i class="nav-icon fas fa-tasks" aria-hidden="true"></i>
                                    <p>Upload SOC venue data</p>
                                </a>
                            </li>
                        </ul>
                         <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.socadminwrite') }}" class="nav-link @if($routename =='admin.socadminwrite') {{ 'active'  }} @endif">
                                    <i class="nav-icon fas fa-tasks" aria-hidden="true"></i>
                                    <p>SOC Admin(Mobile) Permission</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('admin.image_index') }}" class="nav-link @if($routename =='admin.image_index') {{ 'active'  }} @endif">
                                    <i class="nav-icon fas fa-tasks" aria-hidden="true"></i>
                                    <p>Manage Images Status </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(!in_array($admins_role, array(2,3,4,6,7,8,9)))
                    <li class="nav-item @if(($routename =='admin.posts.index')||($routename =='admin.category.index')) {{ 'menu-is-opening menu-open' }} @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-sticky-note"></i>
                            <p> Report
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.nemoclubdata') }}" class="nav-link @if($routename =='admin.nemoclubdata') {{ 'active'  }} @endif">
                                    <i class="nav-icon fas fa-tasks" aria-hidden="true"></i>
                                    <p>Kit dispatch data</p>
                                </a>
                            </li>
                        </ul>
                        {{-- <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.socadminwrite') }}" class="nav-link @if($routename =='admin.socadminwrite') {{ 'active'  }} @endif">
                                    <i class="nav-icon fas fa-tasks" aria-hidden="true"></i>
                                    <p>SOC Admin(Mobile) Permission</p>
                                </a>
                            </li>
                        </ul> --}}
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard-tiles.index') }}" class="nav-link @if($routename =='admin.socadminwrite') {{ 'active'  }} @endif">
                                    <i class="nav-icon fas fa-tasks" aria-hidden="true"></i>
                                    <p>Manage Dashboard Cards</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(!in_array($admins_role, array(2,3,4,6,7,8,9,10)))

                <li class="nav-item">
                    <a href="{{ route('admin.announcement.index') }}" class="nav-link @if($routename =='admin.announcement.index') {{ 'active' }} @endif">
                      <i class="fa fa-bullhorn" aria-hidden="true"></i>
                      <p> Announcements</p>
                    </a>
                 </li>

                 @endif
            </ul>
          </li>
            @if(!in_array($admins_role, array(2,3,4,6,7,8,9,10)))
              <li class="nav-item  has-treeview @if(($routename =='admin.foodcharts.index')||($routename =='admin.foodnames.index')||($routename =='admin.servingquantities.index')||($routename =='admin.sleepcharts.index')) {{ 'menu-is-opening menu-open' }} @endif">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                        Mobile App
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <!--    <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cloud-meatball"></i>
                    <p>
                    Food Manage
                    <i class="fas fa-angle-left right"></i>
                    </p>
                    </a> -->
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.foodcharts.index') }}" class="nav-link @if($routename =='admin.foodcharts.index') {{ 'active' }} @endif">
                            <i class="nav-icon fas fa-cookie"></i>
                            <p>Food Charts</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.foodnames.index') }}" class="nav-link @if($routename =='admin.foodnames.index') {{ 'active' }} @endif">
                            <i class="far fa fa-stroopwafel nav-icon"></i>
                            <p>Food Name</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.servingquantities.index') }}" class="nav-link @if($routename =='admin.servingquantities.index') {{ 'active' }} @endif">
                            <i class="nav-icon fa fa-check" aria-hidden="true"></i>
                            <p>Serving Quantities</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.sleepcharts.index') }}" class="nav-link @if($routename =='admin.sleepcharts.index') {{ 'active' }} @endif">
                            <i class="nav-icon  fas fa-chart-pie"></i>
                            <p>Sleep Charts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pushnotification.index') }}" class="nav-link @if($routename =='admin.pushnotification.index') {{ 'active' }} @endif">
                            <i class="nav-icon  fas fa-chart-pie"></i>
                            <p>Push Notification</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
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
