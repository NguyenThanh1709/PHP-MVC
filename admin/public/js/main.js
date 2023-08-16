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
        message: 'Đã cập nhật dữ liệu mới thành công',
        type: 'success',
        duration: 3000
    });
}

function showErrorToast(message) {
    toast({
        title: 'Lỗi',
        message: message,
        type: 'error',
        duration: 3000
    });
}

$(document).ready(function () {
    function load_data(pages) {
        var time = $('.table-order-hover tbody .active-tr').find('td').eq(1).text();
        data = { time: time, pages, pages }
        console.log(data);
        $.ajax({
            url: "?mod=order&controller=revenue&action=detailProductBuyMonth",
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.str != "") {
                    $("#list-product-buy-day").html(response.str);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    }

    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

    //  CHECK ALL
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

    // EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });

    $('.search__container__tab').click(function () {
        if (!$(this).hasClass('active')) {
            $('.search__container__tab').removeClass('active');
            $(this).addClass('active');
        }
    });

    $('#eye').click(function () {
        $(this).toggleClass('open');
        $(this).children('i').toggleClass('fa-eye-slash fa-eye');
        if ($(this).hasClass('open')) {
            $(this).prev().attr('type', 'text');
        } else
            $(this).prev().attr('type', 'password');
    });

    $('.add_new_dir').click(function () {
        $('#dir-parent').addClass('show-modal');
    });
    $('.btn-authen--cancel').click(function () {
        $('#dir-parent').removeClass('show-modal');
    });


    $('.btn-trash').click(function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Xác nhận ?',
            text: "Khi đã xoá thì không thể khôi phục dữ liệu.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Huỷ'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    });
    // Xử lý sự kiện khi nhấp vào ảnh thumb
    $('.list-thumb .thumb-item').click(function () {
        let picture_src = $(this).find('img').attr('src');
        // console.log(picture_src);
        $('.show-picture img').attr('src', picture_src);
        $('.list-thumb .thumb-item').removeClass('active')
        $(this).addClass('active');
    });
    // Xư lý nhấp vào next prev
    $('.slider-nav .next-btn').click(function () {
        // alert('Đã click next');
        if ($('.list-thumb .thumb-item:last-child').hasClass('active')) {
            $('.list-thumb .thumb-item:first-child').click();
        } else {
            $('.list-thumb .thumb-item.active').next().click();
        }
    });

    $('.slider-nav .prev-btn').click(function () {
        if ($('.list-thumb .thumb-item:first-child').hasClass('active')) {
            $('.list-thumb .thumb-item:last-child').click();
        } else {
            $('.list-thumb .thumb-item.active').prev().click();
        }
    });

    // Active phần tử thumb đầu tiên
    $('.list-thumb .thumb-item:first-child').click();

    $('.btn_view_detai_order_new').click(function () {
        var id = $(this).attr('data-id');
        var table_data = "";
        var sub_total = 0;
        var temp = 0;
        $.ajax({
            url: '?mod=home&action=detail',
            method: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.info_order_by_id_new.payment_method == "payment_home") {
                    var paymentMethod = "Thanh toán khi nhận hàng";
                } else {
                    var paymentMethod = "Thanh toán qua ngân hàng";
                }
                $('#order_id').val(response.info_order_by_id_new.order_id);
                $('#fullname_customer').val(response.info_order_by_id_new.fullname);
                $('#payment_method').val(paymentMethod);
                $('#phone_customer').val("0" + response.info_order_by_id_new.phone);
                $('#email_customer').val(response.info_order_by_id_new.email);
                $('#datetime_order').val(response.info_order_by_id_new.date_order);
                $('#address').val(response.info_order_by_id_new.address + ',' + response.name_commune.name + ',' + response.name_district.name + ',' + response.name_province_city.name);
                $('#select_option_order').val(response.info_order_by_id_new.status);
                $('#total_price_order').val(response.info_order_by_id_new.total_price.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + "đ");
                table_data += `<thead class="font-weight-bold">
                                    <tr>
                                        <th class="thead-text">STT</th>
                                        <th class="thead-text">Ảnh sản phẩm</th>
                                        <th class="thead-text">Tên sản phẩm</th>
                                        <th class="thead-text">Đơn giá</th>
                                        <th class="thead-text">Số lượng</th>
                                        <th class="thead-text">Thành tiền</th>
                                    </tr>
                                </thead>`;
                $.each(response['list_order_product_by_id_new'], function (key, value) {
                    sub_total = value.quantity * value.price;
                    temp++;
                    table_data += `<tbody>
                                        <tr>
                                            <td class="thead-text">${temp}</td>
                                            <td class="thead-text" style="width:120px; height="auto"><img src="${value.url_images}" alt="Anh San Pham"></td>
                                            <td class="thead-text">${value.name_product}</td>
                                            <td class="thead-text">${value.price.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + "đ"}</td>
                                            <td class="thead-text">${value.quantity}</td>                                           
                                            <td class="thead-text">${sub_total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',') + "đ"}</td>
                                        </tr>
                                   </tbody>`;

                }); 
                $('#table_product_new_order').html(table_data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
        $('.modal_detail_order').addClass('open');
        $('#icon_close').click(function () {
            $('.modal_detail_order').removeClass('open');
        });
    });
    //Xử lý update trạng thái tại mod=order&action=detail;
    $('#btn_update').click(function (e) {
        e.preventDefault();
        var optionSelected = $('#select_option_order').find("option:selected");
        var valueSelected = optionSelected.val();
        var statusOrder = valueSelected;
        var order_id = $('#order_id').text();
        var data = { statusOrder: statusOrder, order_id: order_id }
        console.log(order_id);
        console.log(statusOrder);
        $.ajax({
            url: '?mod=order&action=updateStatusAjax',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data == "success") {
                    showSuccessToast();
                } else {
                    showErrorToast();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    });

    $("#select-province-city").change(function () {
        var optionSelected = $(this).find("option:selected");
        var valueSelected = optionSelected.val();
        var idProvinceCity = valueSelected;
        $.ajax({
            url: '?mod=order&action=seletctDistrict',
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
            url: '?mod=order&action=seletctCommune',
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

    $("#btn_check--phone").click(function () {
        var numPhone = $("#phone").val();
        if (numPhone.length <= 0) {
            message = "Không được để trống số điện thoại";
            showErrorToast(message);
        } else if (numPhone.length < 10 || numPhone.length > 10) {
            message = "Số điện thoại không hợp lệ! Thử lại";
            showErrorToast(message);
        } 
        else {
            $.ajax({
                url: '?mod=order&action=checkCustomer',
                method: 'POST',
                data: { numPhone: numPhone },
                dataType: 'json',
                success: function (response) {
                    if (response.checkCustomer != null) {
                        $('#address').val(response.checkCustomer.address);
                        $('#fullname').val(response.checkCustomer.fullname);
                        $('#email').val(response.checkCustomer.email);
                        $('#select-province-city').html(response.select_name_province_city);
                        $('#district').html(response.select_name_district);
                        $('#commune').html(response.select_name_commune);
                    } else if (response == 'Null') {
                        message = "Không tồn tại thông tin khách hàng trong hệ thống";
                        showErrorToast(message);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                    console.log(thrownError);
                }
            });
        }
    });

    $(".btn-add-cart").click(function () {
        var id = $(this).attr('data-id');
        var qty = $("#numberOrder-" + id).val();
        var data = { id: id, qty: qty };
        var str = "";
        $.ajax({
            url: '?mod=order&action=addproductcart',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $.each(response['listCart'], function (key, value) {
                    str += `<tr>
                                <td><input type="checkbox" name="" class="checkItem" value="${value.id}" id=""></td>
                                <td>${value.product_title}</td>
                                <td>${value.price.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + "đ"}</td>
                                <td>${value.qty}</td>
                                <td>${value.sub_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + "đ"}</td>
                            </tr>`
                });
                $("#data-list-order-add").html(str);
                $("#total_price").html(response['total_price_cart']);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    });

    $('#checkAll').click(function () {
        var isCheckAll = $(this).is(':checked');
        if (isCheckAll) {
            $("#data-list-order-add tr").each(function () {
                $(this).find('input[type="checkbox"]').prop('checked', true);
            });
        } else {
            $("#data-list-order-add tr").each(function () {
                $(this).find('input[type="checkbox"]').prop('checked', false);
            });
        }
    });

    $(document).on('click', "#btn-delete-cart", function () {
        $("#data-list-order-add tr").each(function () {
            var isChecked = $(this).find('input[type="checkbox"]').is(":checked");
            if (isChecked) {
                var id = $(this).find('.checkItem').val();
                console.log(id);
                $(this).remove();
                $.ajax({
                    url: '?mod=order&action=deleteCart',
                    method: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        $("#total_price").html(data.total_price_cart);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                        console.log(thrownError);
                    }
                });
            };
        });
    });

    $('#search_product--mod-order').keyup(function () {
        var searchName = $(this).val();
        console.log(searchName);
        var str_data = "";
        $.ajax({
            url: '?mod=order&action=search',
            method: 'POST',
            data: { searchName: searchName },
            dataType: 'html',
            success: function (data) {
                console.log(data)
                $('#data-row-product-search').html(data);
                $(".btn-add-cart").click(function () {
                    var id = $(this).attr('data-id');
                    var qty = $("#numberOrder-" + id).val();
                    var data = { id: id, qty: qty };
                    var str = "";
                    $.ajax({
                        url: '?mod=order&action=addproductcart',
                        method: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            $.each(response['listCart'], function (key, value) {
                                str += `<tr>
                                            <td><input type="checkbox" name="" class="checkItem" value="${value.id}" id=""></td>
                                            <td class="name_product_order">${value.product_title}</td>
                                            <td>${value.price.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + "đ"}</td>
                                            <td>${value.qty}</td>
                                            <td>${value.sub_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + "đ"}</td>
                                        </tr>`
                            });
                            $("#data-list-order-add").html(str);
                            $("#total_price").html(response.total_price_cart);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(thrownError);
                            console.log(thrownError);
                        }
                    });
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                console.log(thrownError);
            }
        });
    });

    $("#close").click(function () {
        $("#notification").remove();
    });

    $(".table-order-hover tbody tr").click(function () {
        if (!$(this).hasClass('active-tr')) {
            $('tr').removeClass('active-tr');
            $(this).addClass('active-tr');
        } else {
            $('tr').removeClass('active-tr');
        }
        var time = $(this).find('td').eq(1).text();
        $.ajax({
            url: "?mod=order&controller=revenue&action=detailProductBuyMonth",
            method: 'POST',
            data: { time: time },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.str != "") {
                    $("#list-product-buy-day").html(response.str);
                    $("#paging").html(response.paging);
                    $(".paggination_item").click(function (e) {
                        e.preventDefault();
                        if (!$(this).hasClass('active')) {
                            $('.paggination_item').removeClass('active');
                            $(this).addClass('active');
                        } else {
                            $('.paggination_item').removeClass('active-tr');
                        }
                        var page = $(this).attr('id');
                        console.log(page);
                        load_data(page);
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
                            load_data(page);
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
});
