<div class="scroll-bar-wrapper">
    <div class="scroll-bar">
        <div class="close-con">
            <button type="button" class="btn btn-default" style="margin-top: 5px;">
                <span><i class="fa fa-times-circle"></i></span>
            </button>
        </div>

        <div class="btn-con left-btn" onclick="handleScroll(240)">
            <button type="button" class="btn btn-default">
                <span><i class="fa fa-angle-left"></i></span>
            </button>
        </div>
        <div class="btn-con right-btn">
            <button type="button" class="btn btn-default" onclick="handleScroll(-240)">
                <span><i class="fa fa-angle-right"></i></span></button>
        </div>
        <div class="scroll-outer">
            <div class="scroll-body" style="left: 0;">
                <span class="tag-span">
                    <div class="tag tag-primary tag-dot tag-checked" data-route-item="{{ admin_url() }}">
                        <span class="tag-dot-inner"></span>
                        <span class="tag-text">{{ __('admin.menus.home') }}</span>
                    </div>

                </span>
            </div>
        </div>
    </div>
    <template>
        <div class="tag tag-primary tag-dot tag-closable tag-checked" data-route-item="{href}">
            <span class="tag-dot-inner"></span>
            <span class="tag-text">{text}</span>
            <i class="fa fa-times"></i>
        </div>
    </template>
</div>

<script type="text/javascript">
    var scrollBody = $('.scroll-body');
    var scrollOuter = $('.scroll-outer');
    var outerPadding = 4;

    $(document).ready(function () {
        $('.sidebar-menu a').each(function (i, item) {
            var url = '{{ request()->url() }}';
            if ( url !== '{{ admin_url() }}' && url.indexOf(item.href) >= 0 ) {
                var chooseTag = scrollBody.find('div[data-route-item="' + item.href + '"]');
                if (chooseTag.length <= 0) {
                    toggleTag(scrollBody.find('div.tag-primary'), 0);
                    var text = $(item).find('span').text();
                    var template = $('template').html();
                    var html = template.replace('{href}', item.href).replace('{text}', $(item).find('span').text());
                    scrollBody.find('.tag-span').append(html);
                }
            }
        });
    })

    function handleScroll(offset) {
        var outerWidth = scrollOuter[0].offsetWidth;
        var bodyWidth = scrollBody[0].offsetWidth;
        var currentBodyLeft = parseInt(scrollBody.css('left'));
        if (offset > 0) {
            scrollBody.css('left', Math.min(0, currentBodyLeft + offset) + 'px')
        } else {
            if (outerWidth < bodyWidth) {
                if (currentBodyLeft >= -(bodyWidth - outerWidth)) {
                    scrollBody.css('left', Math.max(currentBodyLeft + offset, outerWidth - bodyWidth) + 'px')
                }
            } else {
                scrollBody.css('left', '0');
            }
        }
    }

    function moveToView() {
        var tag = scrollBody.find('div.tag-primary');
        var outerWidth = scrollOuter[0].offsetWidth;
        var bodyWidth = scrollBody[0].offsetWidth;
        var currentBodyLeft = parseInt(scrollBody.css('left'));

        var tagOffsetLeft = tag[0].offsetLeft;
        var tagOffsetWidth = tag[0].offsetWidth;
        if (bodyWidth < outerWidth) {
            scrollBody.css('left', '0');
        } else if (tagOffsetLeft < -currentBodyLeft) {
            // 标签在可视区域左侧
            scrollBody.css('left', (-tagOffsetLeft + outerPadding) + 'px');
        } else if (tagOffsetLeft > -currentBodyLeft && tagOffsetLeft + tagOffsetWidth < -currentBodyLeft + outerWidth) {
            // 标签在可视区域
            scrollBody.css('left', Math.min(0, outerWidth - tagOffsetWidth - tagOffsetLeft - outerPadding) + 'px');
        } else {
            // 标签在可视区域右侧
            scrollBody.css('left', -(tagOffsetLeft - (outerWidth - outerPadding - tagOffsetWidth)) + 'px');
        }
    }

    function switchTag(tag) {
        toggleTag(tag, 1);
        $.pjax({container: '#pjax-container', url: tag.attr('data-route-item')});
    }

    function toggleTag(tag, p) {
        if (p === 1) {
            tag.addClass('tag-primary').removeClass('tag-default');
        } else {
            tag.addClass('tag-default').removeClass('tag-primary');
        }
    }

    $('.sidebar-menu a').off('click').on('click', function () {
        var href = $(this).attr('href');
        if (href.indexOf('http') < 0) {
            return true;
        }

        toggleTag(scrollBody.find('div.tag-primary'), 0);

        var chooseTag = scrollBody.find('div[data-route-item="' + href + '"]');
        if (chooseTag.length > 0) {
            toggleTag(chooseTag, 1);
        } else {
            var text = $(this).find('span').text();
            var template = $('template').html();
            var html = template.replace('{href}', href).replace('{text}', text);
            scrollBody.find('.tag-span').append(html);
        }
        moveToView();
    });

    $('.close-con').off('click').on('click', function () {
        scrollBody.find('.tag-closable').remove();
        switchTag(scrollBody.find('div.tag-default'));
    });

    $('.scroll-body .tag-span').on('click', 'div', function () {
        if ($(this).hasClass('tag-primary')) {
            return false;
        }

        toggleTag($(this).siblings('div.tag-primary'), 0);
        switchTag($(this));
        moveToView();

    }).on('click', '.fa-times', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var currentTag = $(this).parents('.tag');
        if (currentTag.hasClass('tag-primary')) {
            if (currentTag.next().length > 0) {
                switchTag(currentTag.next());
            } else {
                switchTag(currentTag.prev());
            }
        }

        currentTag.remove();
    });
</script>
