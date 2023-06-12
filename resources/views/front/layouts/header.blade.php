<header>
    <div class="container">
        <div class="row">
            <div class="header_main-block">
                <a class="header_phone" href="tel: . {!! config('app.first_number') !!}">{!! config('app.first_number') !!}</a>
                <div><img src="{{ asset('booking/img/hotel_header_logo.png') }}"></div>
                <a href="{{ route('/') }}" class="btn header_btn">забронювати</a>
            </div>
            <hr class="header_end">
        </div>
    </div>

</header>
