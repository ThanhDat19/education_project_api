$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    swal({
        title: "Bạn có chắc muốn xóa?",
        text: "Nếu xóa, dữ liệu không thể khôi phục!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'DELETE',
                    datatype: 'JASON',
                    data: { id },
                    url: url,
                    success: function (result) {
                        if (result.error == false) {
                            swal(result.message)
                            .then(() => {
                                location.reload(true);
                                tr.hide();
                            });
                        }
                        else {
                            swal("Xóa lỗi vui lòng Thử lại", {
                                icon: "warning",
                            })
                            .then(() => {
                                location.reload(true);
                                tr.hide();
                            });
                        }
                    }
                })

            } else {
                swal("Dữ liệu của bạn đã an toàn!");
            }
        })
}
function allowPost(id, url) {
    swal({
        title: "Bạn Muốn Duyệt Bài?",
        text: "Hãy kiểm tra kỹ thao tác!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    data: { id },
                    url: url,
                    success: function (result) {
                        if (result.error == false) {
                            swal(result.message)
                            .then(() => {
                                location.reload(true);
                                tr.hide();
                            });
                        }
                        else {
                            swal("Lỗi vui lòng Thử lại", {
                                icon: "warning",
                            })
                            .then(() => {
                                location.reload(true);
                                tr.hide();
                            });
                        }
                    }
                })

            } else {
                swal("Bạn đã hủy thao tác!");
            }
        })
}
function followPost(user, post, url) {
    $.ajax({
        type: "POST",
        data: { user, post },
        url: url,
        success: function (result) {
            if (result.error == false) {
                swal({
                    title: "Thông báo!",
                    text: result.message,
                    type: "success",
                    timer: 3000
                })
                .then(() => {
                    location.reload(true);
                    tr.hide();
                });

            }
            else {
                swal({
                    title: "Thông báo!",
                    text: "Đã có lỗi xảy ra",
                    type: "error",
                    timer: 3000
                })
                .then(() => {
                    location.reload(true);
                    tr.hide();
                });
            }
        }
    });
}
// Upload file
$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0])
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        datatype: 'JSON',
        data: form,
        url: '/upload/services',
        success: function (results) {
            if (results.error == false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank"><img src="' + results.url + '" width="400px"></a>')
                $('#image').val(results.url)
            }
            else {
                alert('Tải ảnh lỗi!')
            }
        }
    })
})
