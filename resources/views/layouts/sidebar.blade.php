<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <li> <a class="waves-effect waves-dark" href="{{url('dashboard')}}" aria-expanded="false"><i
                            class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>

                </li>
                <li> <a class="waves-effect waves-dark" href="{{route('vehicle-name.index')}}" aria-expanded="false"><i
                            class="fas fa-heading"></i><span class="hide-menu">Name</span></a>

                </li>
                <li> <a class="waves-effect waves-dark" href="{{route('make.index')}}" aria-expanded="false"><i
                            class="fa fa-list"></i><span class="hide-menu">Make</span></a>

                </li>
                <li> <a class="waves-effect waves-dark" href="{{route('modal.index')}}" aria-expanded="false"><i
                            class="fas fa-taxi"></i><span class="hide-menu">Modal</span></a>

                </li>
                <li> <a class="waves-effect waves-dark" href="{{route('vehicle.index')}}" aria-expanded="false"><i
                            class="fa fa-car"></i><span class="hide-menu">Vehicle</span></a>

                </li>
                <li> <a class="waves-effect waves-dark" href="{{route('page.index')}}" aria-expanded="false"><i
                            class="fa fa-file"></i><span class="hide-menu">Page</span></a></li>

                <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        aria-expanded="false"><i class="far fa-circle text-success"></i><span class="hide-menu">Log
                            Out</span></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                        {{ csrf_field() }}

                    </form>
                </li>



            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>