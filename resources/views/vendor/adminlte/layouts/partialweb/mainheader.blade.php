
<div class="header agileits w3layouts" id="home" >
	<!-- Navbar -->
	<nav class="navbar navbar-default w3l aits">
		<div class="container">
			<div class="navbar-header agileits w3layouts">
				<button type="button" class="navbar-toggle agileits w3layouts collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
					<span class="sr-only agileits w3layouts">Toggle navigation</span>
					<span class="icon-bar w3l"></span>
					<span class="icon-bar aits"></span>
					<span class="icon-bar w3laits"></span>
				</button>
				<a class="navbar-brand agileits w3layouts" href="{{ url('/') }}">Bulbul Homestay</a>
			</div>
			<div id="navbar" class="navbar-collapse agileits w3layouts navbar-right collapse">
				<ul class="nav agileits w3layouts navbar-nav">
					<li class="active"><a href="{{ url('/') }}">BERANDA</a></li>
					<li><a href="{{ url('/#DaftarHomestay') }}">DAFTAR HOMESTAY</a></li>
					<li><a href="{{ url('/#Lokasi') }}">LOKASI</a></li>
					<!-- <li><a href="gallery.html">PROFILE</a></li> -->
					@if (Auth::guest())
<li><a href="{{ url('/daftar') }}"> DAFTAR </a></li>
					<li><a href="{{ url('/login') }}"> MASUK </a></li>

					@else
					<!-- User Account Menu -->



						@if(Auth::user()->role=="Customer")
							<li><a href="{{ url('customerHistory') }}">History</a></li>

						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<!-- The user image in the navbar-->
								{{--<img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>--}}
								<!-- hidden-xs hides the username on small devices so only the image appears. -->
								@if(Auth::user()->role=="Customer")
								<span class="hidden-xs">{{ Auth::user()->name }}</span>
								@else
								<li><a href="{{url('home')}}">{{Auth::user()->name}}</a></li>
								@endif
							</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								{{--<img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />--}}
								<p>
									<img src="/img/{{ Auth::user()->foto }}" class="img-circle" alt="User Image" />
								</p>
							</li>
							<!-- Menu Body -->

							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="{{ url('customerProfile') }}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
								</div>
								<div class="pull-right">
									<a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									{{ trans('adminlte_lang::message.signout') }}
								</a>

								<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
									<input type="submit" value="logout" style="display: none;">
								</form>

							</div>
						</li>
					</ul>
			<!--baru-->
					@elseif(Auth::user()->role=="Owner")
					<li >
						<!-- Menu Toggle Button -->
							<!-- The user image in the navbar-->
							{{--<img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>--}}
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							@if(Auth::user()->role=="Customer")
							<span class="hidden-xs">{{ Auth::user()->name }}</span>
							@else
							<li><a href="{{url('home')}}">{{Auth::user()->name}}</a></li>
							@endif
					</li>

					@elseif(Auth::user()->role=="DinasPariwisata")
					<li >
						<!-- Menu Toggle Button -->
							<!-- The user image in the navbar-->
							{{--<img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>--}}
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							@if(Auth::user()->role=="Customer")
							<span class="hidden-xs">{{ Auth::user()->name }}</span>
							@else
							<li><a href="{{url('home')}}">{{Auth::user()->name}}</a></li>
							@endif
					</li>

					@endif
				</li>
				@endif

			</ul>
		</ul>
	</div>
</div>
</nav>
<!-- //Navbar -->
<div class="clearfix" style="margin-bottom: 15px;"></div>
</div>
