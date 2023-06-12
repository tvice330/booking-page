<footer>
    <div class="container">
        <div class="row">
            <div class="footer_main-block">
                <div><img src="{{ asset('booking/img/hotel_footer_logo.png') }}"></div>
                <a href="{{ route('/') }}" class="btn footer_btn">забронювати</a>
                <div class="contact-info">
                    <a href="tel: . {!! config('app.first_number') !!}">{!! config('app.first_number') !!}</a>
                    <a href="tel: . {!! config('app.second_number') !!}">{!! config('app.second_number') !!}</a>
                    <p>{!! config('app.address') !!}</p>
                </div>
            </div>
        </div>
    </div>

</footer>
