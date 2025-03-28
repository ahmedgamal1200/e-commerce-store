<!-- Start Topbar -->
<section>
<div class="topbar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="top-left">
                    <ul class="menu-top-link">
                        <li>
                            <div class="select-position">
                                <select id="select4">
                                    <option value="0" selected>$ USD</option>
                                    <option value="1">€ EURO</option>
                                    <option value="2">$ CAD</option>
                                    <option value="3">₹ INR</option>
                                    <option value="4">¥ CNY</option>
                                    <option value="5">৳ BDT</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="select-position">
                                <select id="select5">
                                    <option value="0" selected>English</option>
                                    <option value="1">Español</option>
                                    <option value="2">Filipino</option>
                                    <option value="3">Français</option>
                                    <option value="4">العربية</option>
                                    <option value="5">हिन्दी</option>
                                    <option value="6">বাংলা</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="top-middle">
                    <ul class="useful-links">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="top-end">
                    @auth
                        <div class="user">
                            <i class="lni lni-user"></i>
                            Hello, {{ Auth::user()->name }}
                        </div>
                        <ul class="user-login">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout').submit()">Sign out</a>
                            </li>
                            <form action="{{ route('logout') }} " id="logout" method="post" style="display: none">
{{--                                @method('post')--}}
                                @csrf

                            </form>
                        </ul>
                    @else
                        <div class="user">
                            <i class="lni lni-user"></i>
                            Hello, Guest
                        </div>
                        <ul class="user-login">
                            <li>
                                <a href="{{ route('login') }}">Sign In</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- End Topbar -->
