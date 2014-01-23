jQuery(document).ready(function () {

    var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;

    var setImagePosition = function (img) {
        if(img.hasClass('lazyImgPosition')) {
            var imgHeight = img.height();
            var imgWidth = img.width();
            var containerHeight = img.parents('.image_container').height();
            var containerWidth = img.parents('.image_container').width();

            var offsetTop = (containerHeight - imgHeight) / 2;
            var offsetLeft = (containerWidth - imgWidth) / 2;

            img.css({
                "top": offsetTop + "px",
                "left": offsetLeft + "px"
            });
        }
        return img;
    };

    var lazyLoad = function (selector, callback) {
        selector = (selector === undefined) ? '.lazyimg' : selector;

        var file_ext = '';
        if (pixelRatio >= 2) {
            file_ext = '-hd';
        } else if (pixelRatio > 1 && pixelRatio < 2) {
            file_ext = '-mobi';
        }
//        var exp = /[\/]*[\%\]\[A-Za-z0-9\-_]*\/([\%\]\[A-Za-z0-9\-_]*)\/.*$/i;

        jQuery(selector).each(function (i, e) {

            var curImage = jQuery(e);
            var top = jQuery(window).scrollTop();
            var left = jQuery(window).scrollLeft();
            var height = jQuery(window).height();
            var width = jQuery(window).width();
            var posTop = curImage.position().top;
            var posLeft = curImage.position().left;
            var imgHeight = curImage.height();
            var imgWidth = curImage.width();
            if (
                top + (height * 2) > posTop && // Bild nach Unten
                top - (height) < posTop + imgHeight && // Bild nach Oben
                left + (width * 2) > posLeft && // Bild nach Rechts
                left - (width) < posLeft + imgWidth // Bild nach Links
            ) {
                if (curImage.attr('data-source') !== undefined) {
                    var source = curImage.attr('data-source');
                    var trigger = source.split('/');
                    curImage.attr('src', source.replace(trigger[2], trigger[2]+file_ext)).load(function () {
                        var img = jQuery(this);
                        setImagePosition(img).fadeIn(1000).removeAttr('data-source').next('noscript').remove();
                        if (typeof callback === "function") {
                            callback(this);
                        }
                    });
                }
            }
        });

        return true;
    };
    lazyLoad();

    jQuery(window).scroll(function () {
        lazyLoad();
    });
});

