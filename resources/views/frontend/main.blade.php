<!DOCTYPE html>
<html lang="en">
<head>
	@include('frontend.head')
</head>
<body >
	{{--class="animsition"  --}}
	<!-- Header -->
		@include('frontend.header')
	{{-- End Header --}}


	<!-- Cart -->
	@include('frontend.cart')
	{{-- End Cart --}}

	@yield('content')

	{{-- Footer --}}
	@include('frontend.footer')
	{{-- EndFooter --}}
</body>	
</html>