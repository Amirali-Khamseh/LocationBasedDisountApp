<header class="header">
            <div class="header-top">
                <div class="container">
                   
                    <div class="header-right pr-0">
                        <!-- End of Dropdown Menu -->
                        <span class="divider d-lg-show"></span>
                        <a href="contact-us.html" class="d-lg-show">Contact Us</a>
                        @if(Auth::check())
                        <a onclick="logout()" class="d-lg-show login sign-in"><i
                                class="w-icon-logout"></i>Logout</a>
                        <span class="delimiter d-lg-show"></span>
                        <a href="{{ Auth::user()->role_id == 2 ? '/user' : '/producer' }}/account" class="d-lg-show login"><i
                                class="w-icon-account"></i>Dashboard</a>
                        <span class="delimiter d-lg-show"></span>
                        @else
                        <a href="/user-auth" class="d-lg-show login "><i
                                class="w-icon-account"></i>Sign In</a>
                        <span class="delimiter d-lg-show">/</span>
                        <a href="/user-auth" class="ml-0 d-lg-show login ">Register</a>
                        @endif
                        <a href="/admin-panel/login" class="d-lg-show login "><i
                            class="w-icon-account"></i>ADMIN LOGIN PAGE</a>
                   
                    </div>
                </div>
            </div>
            <!-- End of Header Top -->

            <div class="header-middle">
                <div class="container">
                    
                    <div class="header-right ml-4">
                       <a class="wishlist label-down link d-xs-show" href="/">
                        <img src="{{asset('/images/home.png')}}" style="width :2.7rem;">
                            <span class="wishlist-label d-lg-show">Home</span>
                        </a>
                        @if(Auth::check() && Auth::user()->role_id != 3)
                        <a class="wishlist label-down link d-xs-show" href="/wishlist">
                            <i class="w-icon-heart"></i>
                            <span class="wishlist-label d-lg-show">Wishlist</span>
                        </a>
                        @endif
                         
                    </div>
                </div>
            </div>
            <!-- End of Header Middle -->

            <div class="header-bottom sticky-content fix-top sticky-header">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="header-left flex-1">
                            <div class="dropdown category-dropdown has-border" data-visible="true">
                                <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true" data-display="static"
                                    title="Browse Categories">
                                    <i class="w-icon-category"></i>
                                    <span>Browse Categories</span>
                                </a>

                                <div class="dropdown-box">
                                    <ul class="menu vertical-menu category-menu">
                                        @foreach($data['categories'] as $item)
                                        <li>
                                            <a href="#" onclick="return false;">
                                            <!-- <i class="w-icon-tshirt2"></i> -->
                                                {{$item->title}}
                                            </a>
                                            <ul class="megamenu">
                                                <li>
                                                    <ul>
                                                        @foreach($item->childs as $value)
                                                            <li><a href="{{ route('categories.index', [ 'id' => $value->id ]) }}">{{$value->title}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper ">
                               
                                <input type="text" class="form-control" id="search"
                                    placeholder="Search in..." required />
                                <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                                </button>
                                <div id="parent-search_box" class="d-none">
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <script>
        function logout(){
            var url = '/logout';
            var method = 'post';
            ajax_Func(url,method)
        }
        function ajax_Func(url,method){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: method,
                        url: url,
                        success: function(result){
                            window.location.href = '/'
                        }
                    });
                }
        </script>