jQuery(document).ready(function(){
    $("body").append("<div id='modal-popup'></div>");
    $(".js-show-modal1").click(function(){
        let productId = $(this).data("id");
        $.ajax({
            url: `/product/show-modal-detail/${productId}`,
            dataType: "json",
            success: function(response){
                $("#modal-popup").append(response.content);
                $("#modal-popup .wrap-modal1").addClass("show-modal show-modal1");
                // Đóng modal khi bấm vào overlay hoặc nút đóng
                $(".js-hide-modal1").click(function(){
                    $("#modal-popup .wrap-modal1").removeClass("show-modal show-modal1");
                })
                $('#modal-popup .gallery-lb').each(function() { // the containers for all your galleries
                    $(this).magnificPopup({
                        delegate: 'a', // the selector for gallery item
                        type: 'image',
                        gallery: {
                            enabled:true
                        },
                        mainClass: 'mfp-fade'
                    });
                });
            },
            error: function(xhr) {
                Swal.fire({
                    title: "Cảnh báo!",
                    text: "Có lỗi trong quá trình hiển thị",
                    icon: "warning"
                  });
            }
        });
    })
});

$(document).on("click", ".js-addcart-detail", function(){
    let productId = $(this).data("id");
    let sizeId = $(".size-button").data("size-id");
    let sizeName = $("#selected-size-name").data("size");
    let quantity = $(".num-product").val();

    if (!sizeId) {
        Swal.fire({
            title: "Chưa chọn size!",
            text: "Vui lòng chọn size trước khi thêm vào giỏ hàng.",
            icon: "warning"
        });
        return;
    }

    $.ajax({
        url: "/cart/add",
        type: "POST",
        data: {
            id: productId,
            size_id: sizeId,
            size_name: sizeName,
            quantity: quantity
        },
        success: function(response) {
            Swal.fire({
                title: "Thành công!",
                text: "Sản phẩm đã được thêm vào giỏ hàng.",
                icon: "success"
            });

            $(".icon-header-noti").attr("data-notify", response.total_items);
        },
        error: function(){
            if (xhr.status === 401) { // Lỗi 401: Chưa đăng nhập
                Swal.fire({
                    title: "Lỗi!",
                    text: "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Đăng nhập",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/login"; // Chuyển hướng đến trang đăng nhập
                    }
                });
            } else {
                Swal.fire({
                    title: "Lỗi!",
                    text: "Có lỗi xảy ra, vui lòng thử lại.",
                    icon: "error"
                });
            }
        }
    });
});
jQuery(document).ready(function() {
    // Bấm chọn size
    $(".size-button").click(function() {
        if ($(this).hasClass("disabled")) return; // Không làm gì nếu size không có sẵn

        $(".size-button").removeClass("active"); // Xóa active khỏi tất cả
        $(this).addClass("active"); // Đánh dấu size đã chọn

        let sizeId = $(this).data("size-id");
        let sizeName = $(this).data("size-name");

        $("#selected-size-id").val(sizeId);
        $("#selected-size-name").val(sizeName);
    });

    // Thêm vào giỏ hàng
    
});


