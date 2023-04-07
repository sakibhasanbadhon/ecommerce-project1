<div class="ibox">
    <div class="ibox-body px-3 py-2 d-flex align-item-center justify-content-between">

        @isset($breadcrumb)
            <ul class="mb-0 pl-0 breadcrumb-nav">
                @foreach ($breadcrumb as $key=>$value )
                    <li class="{{ $loop->last ? '' : 'active' }}"> @if ($loop->last) {{ $key }} @else <a href="{{ $value }}"> {{ $key }} </a> @endif</li>
                @endforeach
            </ul>
        @endisset


        <div class="action-btn">
            @yield('action')
        </div>
    </div>
</div>
