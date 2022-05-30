<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@livewireStyles
<script src="{{ asset('js/app.js') }}" defer></script>
@push('script')
    <script src="{{ asset('js/portals/portal.js') }}"></script>
@endPush
@stack('script')
