@section('sidebar')
    <div id="wrapper">
        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Books</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <h6 class="dropdown-header">Books Screens:</h6>
                    <a class="dropdown-item" href="{{route('books.create')}}">Add Books</a>
                    <a class="dropdown-item" href="{{route('books.index')}}">Show Books</a>
                    <a class="dropdown-item" href="{{route('demo')}}">Add Demo Book</a>


                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <h6 class="dropdown-header">Pages:</h6>
                    <a class="dropdown-item" href="{{route('aboutus')}}">Footer Info</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    <span>Users</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <h6 class="dropdown-header">All Users</h6>
                    <a class="dropdown-item" href="{{route('admins.create')}}">Add Users</a>
                    <a class="dropdown-item" href="{{route('admins.index')}}">Show User</a>
                    <a class="dropdown-item" href="{{route('fake.vendor')}}">Fake Vendor</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-folder-open"></i>
                    <span>Category</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <h6 class="dropdown-header">All Category</h6>
                    <a class="dropdown-item" href="{{route('main.category')}}">Add Main-Category</a>
                    <a class="dropdown-item" href="{{route('sub.category')}}">Add Sub-Category</a>
                    <a class="dropdown-item" href="{{route('minii.category')}}">Add Mini-Category</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span>Home Section</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="{{route('role')}}">Add Role</a>
                    <a class="dropdown-item" href="{{route('icon')}}">Add Icon</a>
                    <a class="dropdown-item" href="{{route('title')}}">Add Title</a>
                    <a class="dropdown-item" href="{{route('banner')}}">Add Banner</a>
                    <a class="dropdown-item" href="{{route('section')}}">Add Section</a>
                    <a class="dropdown-item" href="{{route('section.show')}}">Show Section</a>


                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span>Contact Info</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">


                    <a class="dropdown-item" href="{{route('contact.info')}}">Contact-info</a>
                    <a class="dropdown-item" href="{{route('contact.show')}}">Show Contact-info</a>
                    <a class="dropdown-item" href="{{route('contact.message')}}">Messages</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span>Customer</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="{{route('customer')}}">Customers</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span>Vendor</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="{{route('vendor')}}">Add vendor Section</a>
                    <a class="dropdown-item" href="{{route('vendor.section.show')}}">Show vendor Section</a>


                </div>
            </li>

            <li  class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>logout</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">

                    <a  class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="waves-effect"><i class="fas fa-sign-out-alt"></i> logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>



        </ul>

  @endsection
