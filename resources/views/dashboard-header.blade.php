<h1>Welcome, <span>{{ $id = Auth::user()->name;}}</span></h1>
<ul class="pghd-breadcrumbs no-icon">
<li><a href="{{url('/edit-profile')}}">Edit Profile</a></li>
<li><a href="{{route('profile.password')}}">Change Password</a></li>
<li><a href="{{url('/logouts')}}">Logout</a></li>
</ul>