if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

function toast({
    title = '',
    message = '',
    type = 'info',
    duration = 3000
}) {
    const main = document.getElementById('toast');
    if (main) {
        const toast = document.createElement('div');

        // auto remove toast
        const autoRemoveId = setTimeout(function () {
            main.removeChild(toast);
        }, duration + 1000);

        // remove toast when clicked
        toast.onclick = function (e) {
            if (e.target.closest('.toast__close')) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        }
        const icons = {
            success: 'fas fa-check-circle',
            info: 'fas fa-info-circle',
            warning: 'fas fa-exclamation-circle',
            error: 'fas fa-exclamation-circle',
        }
        const icon = icons[type];
        const delay = (duration / 1000);

        toast.style.animation = `slideInLeft .5s ease, fadeOut linear 1s ${delay}s forwards`;
        toast.classList.add('toast', `toast--${type}`);
        toast.innerHTML = `
                    <div class="toast__icon">
                        <i class="${icon}"></i>
                    </div>
                    <div class="toast__body">
                        <div class="toast__title">${title}</div>
                        <div class="toast__msg">${message}</div>
                    </div>
                    <div class="toast__close">
                        <i class="fas fa-times"></i>
                    </div> 
                `;
        main.appendChild(toast);
    }
}

function showSuccessToast() {
    toast({
        title: 'Thành công!',
        message: 'Đã cập nhật giỏ hàng thành công',
        type: 'success',
        duration: 3000
    });
}

function showErrorToast() {
    toast({
        title: 'Lỗi',
        message: 'Có lỗi xảy ra. Vui lòng thực hiện lại',
        type: 'error',
        duration: 3000
    });
}


$(document).ready(function () {
    //  SLIDER
    var slider = $('#slider-wp .section-detail');
    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    if ($(".list_cart_show")[0]) {
        $("#cart_null").hide();
    } else {
        $(".wp_noti").hide();
    }

    //  ZOOM PRODUCT DETAIL
    $("#zoom").elevateZoom({ gallery: 'list-thumb', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif' });

    //  LIST THUMB
    var list_thumb = $('#list-thumb');
    list_thumb.owlCarousel({
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 5], // betweem 900px and 601px
        itemsTablet: [768, 5], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  FEATURE PRODUCT
    var feature_product = $('#feature-product-wp .list-item');
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SAME CATEGORY
    var same_category = $('#same-category-wp .list-item');
    same_category.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SCROLL TOP
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#btn-top').stop().fadeIn(150);
        } else {
            $('#btn-top').stop().fadeOut(150);
        }
    });
    $('#btn-top').click(function () {
        $('body,html').stop().animate({ scrollTop: 0 }, 800);
    });

    // CHOOSE NUMBER ORDER
    var value = parseInt($('#num-order').attr('value'));
    $('#plus').click(function () {
        value++;
        $('#num-order').attr('value', value);
        // update_href(value);
    });
    $('#minus').click(function () {
        if (value > 1) {
            value--;
            $('#num-order').attr('value', value);
        }
        // update_href(value);
    });

    //  MAIN MENU
    $('#category-product-wp .list-item > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');

    //  TAB
    tab();

    //  EVEN MENU RESPON
    $('html').on('click', function (event) {
        var target = $(event.target);
        var site = $('#site');

        if (target.is('#btn-respon i')) {
            if (!site.hasClass('show-respon-menu')) {
                site.addClass('show-respon-menu');
            } else {
                site.removeClass('show-respon-menu');
            }
        } else {
            $('#container').click(function () {
                if (site.hasClass('show-respon-menu')) {
                    site.removeClass('show-respon-menu');
                    return false;
                }
            });
        }
    });

    //  MENU RESPON
    $('#main-menu-respon li .sub-menu').after('<span class="fa fa-angle-right arrow"></span>');
    $('#main-menu-respon li .arrow').click(function () {
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        } else {

            //            $('.sub-menu').slideUp();
            //            $('#main-menu-respon li').removeClass('open');
            $(this).parent('li').addClass('open');
            //            $(this).parent('li').find('.sub-menu').slideDown();
        }
    });
});

function tab() {
    var tab_menu = $('#tab-menu li');
    tab_menu.stop().click(function () {
        $('#tab-menu li').removeClass('show');
        $(this).addClass('show');
        var id = $(this).find('a').attr('href');
        $('.tabItem').hide();
        $(id).show();
        return false;
    });
    $('#tab-menu li:first-child').addClass('show');
    $('.tabItem:first-child').show();
}

$(document).ready(function () {
    $("#see_next_link").click(function () {
        $(".content_product").css({ "height": "auto" });
        $(".see_next").css({ "display": "none" });
    });
});

$(document).on('click', '.add-cart', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var qty = $('#num-order').val();
    console.log(qty);
    var data = {
        id: id, qty: qty
    };
    console.log(data);
    var list = "";
    $.ajax({
        url: '?mod=cart&action=add_cart',
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function (response) {
            // console.log(response['listCart']);
            if (response['listCart'] != null) {
                $("#cart_null").hide();
                $(".wp_noti").show();
            }
            $(".number_order").html(response['num']);
            $(".total_price_cart").html(response.total_price_cart);

            $.each(response['listCart'], function (key, value) {
                list += `<li class="clearfix list_cart list_cart_show">
                <a href="" title="" class="thumb fl-left">
                    <img src="admin/${value.product_img}" alt="">
                </a>
                <div class="info fl-right">
                    <a href="" title="" class="product-name">${value.product_title}</a>
                    <p class="price">${value.price.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + "đ"}</p>
                    <p class="qty">Số lượng: <span class="qty_header">${value.qty}</span></p>
                </div>
            </li>`;
            });
            $("#list-cart").html(list);

            Swal.fire({
                title: '<span style="font-size:20px;">Đã thêm sản phẩm vào giỏ hàng!</span>',
                icon: "success",
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "Đến giỏ hàng",
                cancelButtonText: "Tiếp tục mua sắm",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "?mod=cart";
                } else {
                    //  window.location.reload();
                }
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            console.log(thrownError);
        }
    });

});

$(document).on('click', '.btn-delete', function () {
    // alert('Đã click');
    var id = $(this).attr('data-id');
    var data = {
        id: id
    };
    // console.log(data);
    Swal.fire({
        title: "Bạn chắc chắn xoá hay không?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ok",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/cart/delete',
                method: 'POST',
                data: data,
                dataType: 'text',
                success: function (data) {
                    if (data == 0) {
                        Swal.fire({
                            title: '<span style="font-size:20px;">Đã xoá sản phẩm khỏi giỏ hàng!</span>',
                            icon: "success",
                            showCancelButton: false,
                            focusConfirm: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                    console.log(thrownError);
                }
            });
        };
    })
});

$(document).on('click', '.delete-all-cart', function () {
    // alert('Đã click');
    Swal.fire({
        title: "Bạn chắc chắn xoá hay không?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ok",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '?mod=cart&action=delete_cart_all',
                dataType: 'text',
                success: function (data) {
                    if (data == 1) {
                        Swal.fire({
                            title: '<span style="font-size:20px;">Đã xoá tất cả sản phẩm khỏi giỏ hàng!</span>',
                            icon: "success",
                            showCancelButton: false,
                            focusConfirm: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                    console.log(thrownError);
                }
            });
        };
    })
});

$(document).ready(function () {
    $(".num-order").change(function () {
        var id = $(this).attr('data-id');
        var qty = $(this).val();
        var data = { id: id, qty: qty };
        $.ajax({
            url: '?mod=cart&action=updateAjax',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $("#sub_total-" + id).html(data['sub_total']);
                $(".number_order").html(data['num']);
                $(".total-price").html(data['total']);
                // showSuccessToast();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    });
});

$(document).ready(function () {
    $("#select-province-city").change(function () {
        var optionSelected = $(this).find("option:selected");
        var valueSelected = optionSelected.val();
        var idProvinceCity = valueSelected;
        $.ajax({
            url: '?mod=checkout&action=seletctDistrict',
            method: 'POST',
            data: { idProvinceCity: idProvinceCity },
            dataType: 'json',
            success: function (response) {
                $("#district").html(response);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    });
    $("#district").change(function () {
        var optionSelected = $(this).find("option:selected");
        var valueSelected = optionSelected.val();
        var idDisTrict = valueSelected;
        $.ajax({
            url: '?mod=checkout&action=seletctCommune',
            method: 'POST',
            data: { idDisTrict: idDisTrict },
            dataType: 'json',
            success: function (response) {
                $("#commune").html(response);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    });
    function load_data(pages, url, data) {
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.tbl_data != "") {
                    $('.list_product').html(response.tbl_data);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    }
    $(".filter_price").click(function () {
        var selected = $(this).attr('id');
        $.ajax({
            url: '?mod=products&action=filtersPrice',
            method: 'GET',
            data: { selected: selected },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.tbl_data != null) {
                    $('.list_product').html(response.tbl_data);
                    $('.paging-product').html(response.paging);
                    $(".paggination_item").click(function (e) {
                        e.preventDefault();
                        if (!$(this).hasClass('active')) {
                            $('.paggination_item').removeClass('active');
                            $(this).addClass('active');
                        } else {
                            $('.paggination_item').removeClass('active-tr');
                        }
                        var page = $(this).attr('id');
                        var checked = document.querySelector('input[name="filter_price"]:checked').value;
                        var data = { checked: checked, page: page }
                        load_data(page, '?mod=products&action=filtersPrice', data);
                    });
                    $(".paggination_item_next").click(function (e) {
                        e.preventDefault();
                        var page = $('.active').attr('id');
                        page++;
                        $('.active').removeClass('active');
                        if (page == page) {
                            $('#' + page).addClass('active')
                        }
                        if (!isNaN(page)) {
                            var checked = document.querySelector('input[name="filter_price"]:checked').value;
                            var data = { checked: checked, page: page }
                            load_data(page, '?mod=products&action=filtersPrice', data);
                        }
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    });

    $(".filter_price_cat").click(function () {
        var selectedCatID = $(this).attr('id');
        var catID = $(this).attr('data-id');
        var data = { selectedCatID: selectedCatID, catID: catID };
        $.ajax({
            url: '?mod=products&action=filtersPrice',
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('.list_product').html(response.tbl_data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    });
    $('#select-option-arrange').change(function () {
        var value = $('#select-option-arrange option:selected').val();
        console.log(value);
        $.ajax({
            url: "?mod=products&action=arrange",
            method: 'GET',
            data: { value: value },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('.list_product').html(response.tbl_data);
                $('.paging-product').html(response.paging);
                $(".paggination_item").click(function (e) {
                    e.preventDefault();
                    if (!$(this).hasClass('active')) {
                        $('.paggination_item').removeClass('active');
                        $(this).addClass('active');
                    } else {
                        $('.paggination_item').removeClass('active-tr');
                    }
                    var page = $(this).attr('id');
                    var arrange = $('#select-option-arrange option:selected').val();
                    var data = { page: page, arrange: arrange };
                    load_data(page, '?mod=products&action=arrange', data);
                });
                $(".paggination_item_next").click(function (e) {
                    e.preventDefault();
                    var page = $('.active').attr('id');
                    page++;
                    $('.active').removeClass('active');
                    if (page == page) {
                        $('#' + page).addClass('active')
                    }
                    if (!isNaN(page)) {
                        var arrange = $('#select-option-arrange option:selected').val();
                        var data = { page: page, arrange: arrange };
                        load_data(page, '?mod=products&action=arrange', data);
                    }
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    });
    $('.from-search input').keyup(function(){
        var key = $(this).val();
        // console.log(key);
        $.ajax({
            url: "?mod=products&action=searchAjaxKeyUp",
            method: 'GET',
            data: { key: key },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if(response != null) {
                    $('.wp-list-product-key-search').css("display","block");
                    $('#wp-list').html(response) 
                }
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    })
    $('#btn_search').click(function(){
        $('#search-responsive').toggleClass('open-input-search');
    })
});


