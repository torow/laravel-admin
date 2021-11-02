<style type="text/css">
    .grid-dropdown-actions ul li {
        list-style: none;
        display: inline-block;
    }

    .grid-dropdown-actions ul li a {
        color: #515a6e;
        border: 1px solid #e8eaec;
        padding: 4px 12px;
        border-radius: 4px;
    }

    .grid-dropdown-actions ul li a:hover{
        color: #57a3f3;
        border-color: #57a3f3;
    }

    .grid-dropdown-actions ul li a:active {
        -webkit-box-shadow: inset 0 3px 5px rgb(0 0 0 / 13%);
        -moz-box-shadow: inset 0 3px 5px rgba(0,0,0,0.125);
        box-shadow: inset 0 3px 5px rgb(0 0 0 / 13%);
    }
</style>
<div class="grid-dropdown-actions">
    <ul style="margin: 0; padding: 0">
        @foreach($default as $action)
            <li>{!! $action->render() !!}</li>
        @endforeach

        @if(!empty($custom))

            @if(!empty($default))
                <li class="divider"></li>
            @endif

            @foreach($custom as $action)
                <li>{!! $action->render() !!}</li>
            @endforeach
        @endif
    </ul>
</div>

@yield('child')


{{--<div class="grid-dropdown-actions dropdown">--}}
{{--    <a href="#" style="padding: 0 10px;" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--        <i class="fa fa-ellipsis-v"></i>--}}
{{--    </a>--}}
{{--    <ul class="dropdown-menu" style="min-width: 70px !important;box-shadow: 0 2px 3px 0 rgba(0,0,0,.2);border-radius:0;left: -65px;top: 5px;">--}}

{{--        @foreach($default as $action)--}}
{{--            <li>{!! $action->render() !!}</li>--}}
{{--        @endforeach--}}

{{--        @if(!empty($custom))--}}

{{--            @if(!empty($default))--}}
{{--                <li class="divider"></li>--}}
{{--            @endif--}}

{{--            @foreach($custom as $action)--}}
{{--                <li>{!! $action->render() !!}</li>--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--    </ul>--}}
{{--</div>--}}

{{--<script>--}}
{{--    $('.table-responsive').on('shown.bs.dropdown', function(e) {--}}
{{--        var t = $(this),--}}
{{--            m = $(e.target).find('.dropdown-menu'),--}}
{{--            tb = t.offset().top + t.height(),--}}
{{--            mb = m.offset().top + m.outerHeight(true),--}}
{{--            d = 20;--}}
{{--        if (t[0].scrollWidth > t.innerWidth()) {--}}
{{--            if (mb + d > tb) {--}}
{{--                t.css('padding-bottom', ((mb + d) - tb));--}}
{{--            }--}}
{{--        } else {--}}
{{--            t.css('overflow', 'visible');--}}
{{--        }--}}
{{--    }).on('hidden.bs.dropdown', function() {--}}
{{--        $(this).css({--}}
{{--            'padding-bottom': '',--}}
{{--            'overflow': ''--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

{{--@yield('child')--}}
