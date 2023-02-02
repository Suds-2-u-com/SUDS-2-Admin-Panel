var APP_URL = 'https://suds-2-u.com'

$("body").on("click", ".signuptoday", function() {
    $("html, body").animate({ scrollTop: "0px" }, 300);
});

function confirmDelete(id) {
    swal({
        title: "Are you sure?",
        text: "If you delete this post all associated comments also deleted permanently.",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
    }).then(function() {
        setTimeout(function() {
            var url = APP_URL + "/delete-user";
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: url,
                data: { id: id },
                dataType: "json",
                beforeSend: function() {
                    $("#global-loader").fadeIn(300);
                },
                success: function(result) {
                    $("#global-loader").fadeOut(300);
                    location.reload();
                },
            });
        }, 50);
    });
}

$("body").on("click", ".chnagestatus", function() {
    var url = APP_URL + "/changestatus";
    var id = $(this).attr("data-id");
    var status = $(this).attr("data-status");
    var thi = $(this);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id, status: status },
        dataType: "json",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            if (data.success == true) {
                if (status == "1") {
                    thi.html("Approved");
                    thi.attr("data-status", "0");
                    thi.removeClass("btn ripple btn-danger chnagestatus");
                    thi.addClass("btn ripple btn-success chnagestatus");
                } else {
                    thi.attr("data-status", "1");
                    thi.html("Disapproved ");
                    thi.removeClass("btn ripple btn-success chnagestatus");
                    thi.addClass("btn ripple btn-danger chnagestatus");
                }
            }
        },
    });
});
$("body").on("click", ".chnagestatusnew", function() {
    var url = APP_URL + "/changestatus";
    var id = $(this).attr("data-id");
    var status = $(this).attr("data-status");
    var thi = $(this);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id, status: status },
        dataType: "json",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            if (data.success == true) {
                if (status == "1") {
                    thi.html("Approved");
                    thi.attr("data-status", "0");
                } else {
                    thi.attr("data-status", "1");
                    thi.html("Disapproved ");
                }
            }
        },
    });
});

$("body").on("click", ".showDetails", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/show-details";
    $("#changeContent").text(" ");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#changeContent").text("View User Details");
            $("#usermodel").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

$("body").on("click", ".showBankDetails", function() {
    var id = $(this).attr("data-id");
    $("#changeContent").text(" ");
    var url = APP_URL + "/show-bank-details";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#changeContent").text("Bank Details");
            $("#usermodel").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

$("body").on("click", ".showDoc", function() {
    var id = $(this).attr("data-id");

    var url = APP_URL + "/show-document-details";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#userdocmodel").html(data);
            $("#docmodel").modal("show");
        },
    });
});

$("body").on("click", ".showVehicle", function() {
    var id = $(this).attr("data-id");
    $("#changeContent").text(" ");
    var url = APP_URL + "/show-vehicle-details";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#changeContent").text("Vehicle Details");
            $("#usermodel").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

/*function confirmDeleteEntry(id,tablename,idname) {
swal({
  title: "Are you sure?",
  text: "If you delete this post all associated comments also deleted permanently.",
  type: "warning",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel!",
}).then(function() {
  setTimeout(function() {


    var url=APP_URL+'/delete-entry';
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
   $.ajax({
           type: "POST",
           url: url,
           data:{'id':id,'tablename':tablename,'idname':idname}, 
           dataType:'json',
         
           success: function(result)
           {
             
             location.reload();
          }
         }).done(function() {
            setTimeout(function(){
            $("#overlay").fadeOut(300);
            },500);

            });



  }, 50);
 
});
}*/

$("body").on("click", ".editDetails", function() {
    $("#viewAddonsModal").modal("hide");

    $("#changeContent").text("Edit Details");
    var id = $(this).attr("data-id");
    var urlname = $(this).attr("data-url");

    var url = APP_URL + "/" + urlname;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#usermodel").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

function checkAll(ele) {
    var checkboxes = $('input[name="action_id[]"]');
    if (ele.checked) {
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == "checkbox") {
                checkboxes[i].checked = true;
            }
        }
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
            console.log(i);
            if (checkboxes[i].type == "checkbox") {
                checkboxes[i].checked = false;
            }
        }
    }
}
$(document).on("click", "#send_emails", function() {
    var checkboxes = $('input[name="action_id[]"]');
    //   if(checkboxes.length==0){
    //       console.log(checkboxes.length);
    //       alert('Please select checkbox...');
    //   }else{
    $("#modal-44").modal("show");
    // }
});

$(document).on("click", "#send_notification", function() {
    var checkboxes = $('input[name="action_id[]"]');
    //   if(checkboxes.length==0){
    //       console.log(checkboxes.length);
    //       alert('Please select checkbox...');
    //   }else{
    $("#changeContent").text("Send Notification To Selected Users");
    $("#save").attr("name", "notification");
    $("#save").attr("value", "Send Notification");
    $("#modal-44").modal("show");
    // }
});
$("body").on("click", ".editroleuser", function() {
    var id = $(this).attr("data-id");

    var url = APP_URL + "/editrole";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#usermodel").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

function confirmDeleteEntry(id, tablename, idname) {
    $("#viewAddonsModal").modal("hide");
    $("#showPackagesModel").modal("hide");

    swal({
        title: "Are you sure ??",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var url = APP_URL + "/delete-entry";
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: url,
                data: { id: id, tablename: tablename, idname: idname },
                dataType: "json",

                success: function(result) {
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                    location.reload();
                },
            }).done(function() {
                setTimeout(function() {
                    $("#overlay").fadeOut(300);
                }, 500);
            });
        } else {
            swal("Your imaginary file is safe!");
        }
    });
}

function confirmAcceptEntry(id, tablename, idname) {
    swal({
        title: "Are you sure ??",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var url = APP_URL + "/accept-entry";
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: url,
                data: { id: id, tablename: tablename, idname: idname },
                dataType: "json",

                success: function(result) {
                    swal("Poof! Your imaginary file has been approved!", {
                        icon: "success",
                    });
                    location.reload();
                },
            }).done(function() {
                setTimeout(function() {
                    $("#overlay").fadeOut(300);
                }, 500);
            });
        } else {}
    });
}

function confirmRejectEntry(id, tablename, idname) {
    swal({
        title: "Are you sure ??",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var url = APP_URL + "/accept-reject";
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: url,
                data: { id: id, tablename: tablename, idname: idname },
                dataType: "json",

                success: function(result) {
                    swal("Poof! Your imaginary file has been approved!", {
                        icon: "success",
                    });
                    location.reload();
                },
            }).done(function() {
                setTimeout(function() {
                    $("#overlay").fadeOut(300);
                }, 500);
            });
        } else {}
    });
}

$("body").on("click", ".showBooking", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/show-booking";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#userbookingmodel").html(data);
            $("#bookingmodel").modal("show");
        },
    });
});

$("body").on("click", ".plusCat", function() {
    var category_price = $(this)
        .parents(".form-group")
        .find("#category_price")
        .val();

    $(".append").append(
        '<label class="areas mr-2 removetest"><span class="area-label">' +
        category_price +
        '<input type="hidden" name="category_price[]" value="' +
        category_price +
        '"></span><span class="area-label-delete deletecat" ><i class="fas fa-times"></i></span></label>'
    );
    $(this).parents(".form-group").find("#category_price").val(" ");
});

$("body").on("click", ".deletecat", function() {
    $(this).parent("label").remove();
});

$("body").on("change", "#category_id", function() {
    var category = $(this).children("option:selected").val();
    var url = APP_URL + "/sub-category";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { category_id: category }, // serializes the form's elements.
        dataType: "html",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#subcategory_id").html(data);
        },
    });
});

$("body").on("change", "#category_id", function() {
    var category = $(this).children("option:selected").val();
    if (category == 1) {
        $("#subcategory_id").removeAttr("required");
    } else if (category == 6) {
        $("#subcategory_id").removeAttr("required");
    } else if (category == 7) {
        $("#subcategory_id").removeAttr("required");
    } else if (category == 4) {
        $("#subcategory_id").removeAttr("required");
    } else if (category == 5) {
        $("#subcategory_id").removeAttr("required");
    } else {
        $("#subcategory_id").prop("required", true);
    }
    var url = APP_URL + "/addons";
    var thi = $(this);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { category_id: category }, // serializes the form's elements.
        dataType: "html",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            thi.parents("form").find("#muladdons").html(data);
        },
    });
});
$("body").on("click", ".showPayform", function() {
    var id = $(this).attr("data-id");

    var url = APP_URL + "/show-showPayform-details";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#userpaymodel").html(data);
            $("#showpaymodel").modal("show");
        },
    });
});

$("body").on("click", ".showpayout", function() {
    var id = $(this).attr("data-id");

    var url = APP_URL + "/show-payout";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#paymentmodel").html(data);
            $("#payoutmodel").modal("show");
        },
    });
});

$("body").on("click", ".showpayoutcreate", function() {
    var id = $(this).attr("data-id");

    var url = APP_URL + "/show-payout-create";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#paymentcreatemodel").html(data);
            $("#payoutcreatemodel").modal("show");
        },
    });
});

$("body").on("click", ".payment", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/payment-done";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        dataType: "JSON",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            alert("Payment Done Successfully!");
            $("#payoutmodel").modal("hide");
        },
    });
});

$("body").on("click", ".requestSubmit", function() {
    var url = APP_URL + "/request-send";
    if ($("#fname").val() != "") {
        $(".fname_err").text(" ");
    }
    if ($("#lname").val() !== "") {
        $(".lname_err").text(" ");
    }
    if ($("#email").val() != "") {
        $(".email_err").text(" ");
    }
    if ($("#phone").val() != "") {
        $(".phone_err").text(" ");
    }
    if ($("#service").val() !== "") {
        $(".service_err").text(" ");
    }
    if ($("#state").val() != "") {
        $(".state_err").text(" ");
    }
    if ($("#city").val() != "") {
        $(".city_err").text(" ");
    }

    if ($("#zip_code").val() != "") {
        $(".zip_code_err").text(" ");
    }
    if ($("#address").val() != "") {
        $(".address_err").text(" ");
    }
    if ($("#payment_method").val() != "") {
        $(".payment_method_err").text(" ");
    }
    if ($("#how_many").val() != "") {
        $(".how_many_err").text(" ");
    }
    if ($("#property_type").val() != "") {
        $(".property_type_err").text(" ");
    }

    $.ajax({
        type: "POST",
        url: url,
        data: $("#requestfrm").serialize(), // serializes the form's elements.
        dataType: "JSON",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                $("#requestfrm")[0].reset();
                $("#overlay").fadeOut(300);
                $("#success").scrollTop(0);
                // swal("Someone is gonna be contacting you soon!!", {
                //       icon: "success",
                //     });
                $("#freedetailsrequest").modal("show");

                // $('#successmsg').html('<div class="alert alert-success">' +
                //   '<span class="glyphicon glyphicon-ok"></span>' +
                //   'Form Submit Successfully' +
                //   '</div>');
                $(".form-group")
                    .removeClass("has-error")
                    .removeClass("has-success");
                $(".text-danger").remove();

                // close the message after seconds
                $(".alert-success")
                    .delay(500)
                    .show(10, function() {
                        $(this)
                            .delay(3000)
                            .hide(10, function() {
                                $(this).remove();
                            });
                    });
                // alert(data.success);
            } else {
                printErrorMsg(data.error);
            }
        },
    });
});

function printErrorMsg(msg) {
    $("#overlay").fadeOut(300);
    $.each(msg, function(key, value) {
        $("." + key + "_err").text(value);
    });
}

$("body").on("change", "#state", function() {
    var id = $("#state option:selected").val();

    var url = APP_URL + "/cityy";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        dataType: "html",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#city").html(data);
        },
    });
});
$("body").on("change", "#statehome", function() {
    var id = $("#statehome option:selected").val();
    var url = APP_URL + "/cityy";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        dataType: "html",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#cityhome").html(data);
        },
    });
});

$("body").on("click", ".resetbtn", function() {
    $("#requestfrm")[0].reset();
});

$("body").on("click", "#getappbtn", function() {
    var url = APP_URL + "/app-request-send";

    $.ajax({
        type: "POST",
        url: url,
        data: $("#getapp").serialize(), // serializes the form's elements.
        dataType: "JSON",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                $("#getapp")[0].reset();
                $("#overlay").fadeOut(300);
                // $('#successmsg').html('<div class="alert alert-success">' +
                //   '<span class="glyphicon glyphicon-ok"></span>' +
                //   'Form Submit Successfully' +
                //   '</div>');
                //  swal("Someone is gonna be contacting you soon!!", {
                //       icon: "success",
                //     });
                $("#getapprequest").modal("show");
                $(".form-group")
                    .removeClass("has-error")
                    .removeClass("has-success");
                $(".text-danger").remove();

                // close the message after seconds
                $(".alert-success")
                    .delay(500)
                    .show(10, function() {
                        $(this)
                            .delay(3000)
                            .hide(10, function() {
                                $(this).remove();
                            });
                    });
                // alert(data.success);
            } else {
                printErrorMsg(data.error);
            }
        },
    });
});

$("body").on("change", "#country", function() {
    var id = $("#country option:selected").val();
    var url = APP_URL + "/state";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        dataType: "html",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#state").html(data);
        },
    });
});

$("body").on("change", "#state", function() {
    var id = $("#state option:selected").val();
    var url = APP_URL + "/cityy";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        dataType: "html",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#city").html(data);
        },
    });
});

$("body").on("click", ".onsitebtn", function() {
    var url = APP_URL + "/on-site-request";
    if ($("#first_name").val() != "") {
        $(".first_name_err").text(" ");
    }
    if ($("#last_name").val() !== "") {
        $(".last_name_err").text(" ");
    }
    if ($("#email").val() != "") {
        $(".email_err").text(" ");
    }
    if ($("#phone_number").val() != "") {
        $(".phone_number_err").text(" ");
    }
    if ($("#property_type").val() !== "") {
        $(".property_type_err").text(" ");
    }
    if ($("#type_of_wash").val() != "") {
        $(".type_of_wash_err").text(" ");
    }
    if ($("#state").val() != "") {
        $(".state_err").text(" ");
    }
    if ($("#city").val() != "") {
        $(".city_err").text(" ");
    }
    if ($("#address").val() != "") {
        $(".address_err").text(" ");
    }
    if ($("#zip_code").val() != "") {
        $(".zip_code_err").text(" ");
    }

    if ($("#payment_method").val() != "") {
        $(".payment_method_err").text(" ");
    }

    var payment_method = $("#payment_method").val();

    if (payment_method == "Fleet_Card") {
        alert("NOT accepting fleet cards");
        return false;
    }

    $.ajax({
        type: "POST",
        url: url,
        data: $("#requestonsiteid").serialize(), // serializes the form's elements.
        dataType: "JSON",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                $("#requestonsiteid")[0].reset();
                $("#overlay").fadeOut(300);
                // $('#successmsg').html('<div class="alert alert-success">' +
                //   '<span class="glyphicon glyphicon-ok"></span>' +
                //   'Form Submit Successfully' +
                //   '</div>');
                //   swal("Someone is gonna be contacting you soon!!", {
                //       icon: "success",
                //     });
                $("#freedetailsrequest").modal("show");
                $(".form-group")
                    .removeClass("has-error")
                    .removeClass("has-success");
                $(".text-danger").remove();

                // close the message after seconds
                $(".alert-success")
                    .delay(500)
                    .show(10, function() {
                        $(this)
                            .delay(3000)
                            .hide(10, function() {
                                $(this).remove();
                            });
                    });
                // alert(data.success);
            } else {
                printErrorMsg(data.error);
            }
        },
    });
});

$("body").on("click", ".resetonsite", function() {
    $("#requestonsiteid")[0].reset();
});

$("body").on("click", ".submitwasher", function() {
    var url = APP_URL + "/add-become-a-washer";
    if ($("#first_name").val() != "") {
        $(".first_name_err").text(" ");
    }
    if ($("#last_name").val() !== "") {
        $(".last_name_err").text(" ");
    }
    if ($("#email").val() != "") {
        $(".email_err").text(" ");
    }
    if ($("#mobile").val() != "") {
        $(".mobile_err").text(" ");
    }
    //   if($('#country').val()!==''){
    //     $('.country_err').text(' ');
    //   }
    //   if($('#state').val()!=''){
    //     $('.state_err').text(' ');
    //   }
    if ($("#city").val() != "") {
        $(".city_err").text(" ");
    }
    //   if($('#language').val()!=''){
    //     $('.language_err').text(' ');
    //   }
    if ($("#suds_account").val() !== "") {
        $(".suds_account_err").text(" ");
    }
    if ($("#company").val() != "") {
        $(".company_err").text(" ");
    }
    if ($("#password").val() != "") {
        $(".password").text(" ");
    }
    if ($("#confirm_password").val() != "") {
        $(".confirm_password").text(" ");
    }
    $.ajax({
        type: "POST",
        url: url,
        data: $("#becomeid").serialize(), // serializes the form's elements.
        dataType: "JSON",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                $("#becomeid")[0].reset();
                $("#overlay").fadeOut(300);
                // $('#successmsg').html('<div class="alert alert-success">' +
                //   '<span class="glyphicon glyphicon-ok"></span>' +
                //   'Form Submit Successfully' +
                //   '</div>');
                //  swal("Someone is gonna be contacting you soon!!", {
                //       icon: "success",
                //     });
                $("#freedetailsrequest").modal("show");
                $(".form-group")
                    .removeClass("has-error")
                    .removeClass("has-success");
                $(".text-danger").remove();

                // close the message after seconds
                $(".alert-success")
                    .delay(500)
                    .show(10, function() {
                        $(this)
                            .delay(3000)
                            .hide(10, function() {
                                $(this).remove();
                            });
                    });
                // alert(data.success);
            } else {
                printErrorMsg(data.error);
            }
        },
    });
});

$("body").on("click", ".submitpressrequest", function() {
    var url = APP_URL + "/add-press-request";
    if ($("#name").val() != "") {
        $(".name_err").text(" ");
    }
    if ($("#email").val() !== "") {
        $(".email_err").text(" ");
    }
    if ($("#message").val() != "") {
        $(".message_err").text(" ");
    }
    $.ajax({
        type: "POST",
        url: url,
        data: $("#pressid").serialize(), // serializes the form's elements.
        dataType: "JSON",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                $("#pressid")[0].reset();
                $("#overlay").fadeOut(300);
                // $('#successmsg').html('<div class="alert alert-success">' +
                //   '<span class="glyphicon glyphicon-ok"></span>' +
                //   'Form Submit Successfully' +
                //   '</div>');
                // swal("Someone is gonna be contacting you soon!!", {
                //       icon: "success",
                //     });
                $("#freedetailsrequest").modal("show");
                $(".form-group")
                    .removeClass("has-error")
                    .removeClass("has-success");
                $(".text-danger").remove();

                // close the message after seconds
                $(".alert-success")
                    .delay(500)
                    .show(10, function() {
                        $(this)
                            .delay(3000)
                            .hide(10, function() {
                                $(this).remove();
                            });
                    });
                // alert(data.success);
            } else {
                printErrorMsg(data.error);
            }
        },
    });
});

$("body").on("click", ".showPayoutDetails", function() {
    var user_id = $(this).attr("data-user_id");
    var id = $(this).attr("data-id");
    var url = APP_URL + "/show-payout";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id, user_id: user_id }, // serializes the form's elements.
        dataType: "html",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#userpayoutmodel").html(data);
            $("#showpayoutmodel").modal("show");
        },
    });
});

$("body").on("click", ".payoutbtn", function() {
    var url = APP_URL + "/add-payout";
    if ($("#bank_account").val() != "") {
        $(".bank_account").text(" ");
    }
    if ($("#transaction_id").val() !== "") {
        $(".transaction_id").text(" ");
    }
    if ($("#transaction_time").val() != "") {
        $(".transaction_time").text(" ");
    }
    if ($("#transaction_amount").val() != "") {
        $(".transaction_amount").text(" ");
    }
    if ($("#transaction_date").val() != "") {
        $(".transaction_date").text(" ");
    }

    if (confirm("Are you sure you want to submit this details")) {
        $.ajax({
            type: "POST",
            url: url,
            data: $("#payoutid").serialize(),
            dataType: "JSON",
            beforeSend: function() {
                $("#overlay").fadeIn(300);
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    $("#payoutid")[0].reset();
                    $("#overlay").fadeOut(300);
                    $("#successmsg").html(
                        '<div class="alert alert-success">' +
                        '<span class="glyphicon glyphicon-ok"></span>' +
                        "Form Submit Successfully" +
                        "</div>"
                    );
                    $(".form-group")
                        .removeClass("has-error")
                        .removeClass("has-success");
                    $(".text-danger").remove();

                    // close the message after seconds
                    $(".alert-success")
                        .delay(500)
                        .show(10, function() {
                            $(this)
                                .delay(3000)
                                .hide(10, function() {
                                    $(this).remove();
                                });
                        });
                    window.location.href = APP_URL + "/Booking-Transactions";
                } else {
                    printErrorMsg(data.error);
                }
            },
        });
    }
});
$("body").on("click", ".empDesiName", function() {
    var value = $(this).attr("data-name");
    var id = $(this).attr("data-id");
    $("#search").val(value);
    $("#city").val(id);
    $("#hiddensearch").val(id);
    $(".searchclass").hide();
});

$("body").on("click", ".empDesiNamen", function() {
    var value = $(this).attr("data-name");
    var id = $(this).attr("data-id");
    var status = $(this).attr("data-status");
    $("#searchn").val(value);
    //   swal("Congratulations!! Suds2U is in your town.", {
    //                           icon: "success",
    //                         });

    if (parseInt(status) == 1) {
        $("#citypop").modal("show");
    } else {
        $("#cityNopop").modal("show");
        $('.cityRpt').attr('data-status', status)
        $('.cityRpt').attr('data-id', id)
    }
    $("#hiddensearch").val(id);
    $(".searchclass").hide();
});

$("body").on('click', '.cityRpt', function() {
    var id = $(this).attr("data-id");
    var status = $(this).attr("data-status");
    var url = APP_URL + "/city-inquiry";

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "post",
        url: url,
        data: { id: id, status: status },
        dataType: "json",
        success: function(response) {
            console.log('response : ', response)
            $("#cityNopop").modal("hide");
            $("#findCity").modal("show");
        },
    });
})

$("body").on("keyup click", "#search", function() {
    var term = $(this).val();
    var url = APP_URL + "/city";
    if (term == "") {
        $(".searchclass").hide();
    } else {
        $(".searchclass").show();
    }
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "post",
        url: url,
        data: { search: term },
        dataType: "json",
        success: function(response) {
            var re = response.data;

            // console.log(response.data);
            if (re.length > 0) {
                var x = "<ul>";

                $.each(response.data, function(key, value) {
                    x +=
                        `<li><a href="javascript:void(0);"  class="empDesiName" data-name="` +
                        value["name"].replace(/'/g, "") +
                        `" data-id="` +
                        value["id"] +
                        `"> ` +
                        value["name"] +
                        `</a></li>`;
                });
                x += `</ul>`;
            } else {
                var x = "<ul><li>No Data found</li></ul>";
            }
            $(".dumpSearch").html(x);
        },
        complete: function(data) {
            $(".docLoader").hide();
            //   $(button_id).attr("disabled", false);
        },
        error: function(reject) {
            if (reject.status == 422) {}
        },
    });
});

$("body").on("keyup click", "#searchn", function() {
    var term = $(this).val();
    var url = APP_URL + "/city";
    if (term == "") {
        $(".searchclass").hide();
    } else {
        $(".searchclass").show();
    }
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "post",
        url: url,
        data: { search: term },
        dataType: "json",
        success: function(response) {
            var re = response.data;

            // console.log(response.data);
            if (re.length > 0) {
                var x = "<ul>";

                $.each(response.data, function(key, value) {
                    console.log('value : ', value)
                    x +=
                        `<li><a href="javascript:void(0);"  class="empDesiNamen" data-name="` +
                        value["name"].replace(/'/g, "") +
                        `" data-id="` +
                        value["id"] +
                        `" data-status="` +
                        value["status"] + `"> ` +
                        value["name"] +
                        `</a></li>`;
                });
                x += `</ul>`;
            } else {
                var x = "<ul><li>No Data found</li></ul>";
            }
            $(".dumpSearch").html(x);
        },
        complete: function(data) {
            $(".docLoader").hide();
            //   $(button_id).attr("disabled", false);
        },
        error: function(reject) {
            if (reject.status == 422) {}
        },
    });
});

$("#keywords").keypress(function(e) {
    if (e.which == 13) {
        $("#serarchfrm").attr("target", "");
        var term = $(this).val();
        var url = APP_URL + "/google";
        if (term == "") {
            $(".searchclass").hide();
        } else {
            $(".searchclass").show();
        }
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "post",
            url: url,
            data: { search: term },
            success: function(response) {
                var re = response;

                // if(re.length>0){
                //   var x = '<ul>';

                //         $.each(response.data, function (key, value) {

                //             x += `<li><a href="javascript:void(0);"  class="empDesiNamen" data-name="`+value['name'].replace(/'/g, '')+`" data-id="`+ value['id']+`"> ` + value['name'] + `</a></li>`;
                //         });
                //     x +=`</ul>`;
                // }else{
                //   var x='<ul><li>No Data found</li></ul>';
                // }
                $(".dumpSearch").html(response);
            },
            complete: function(data) {
                $(".docLoader").hide();
                //   $(button_id).attr("disabled", false);
            },
            error: function(reject) {
                if (reject.status == 422) {}
            },
        });
    }
});

$("body").on("click", ".googlesearch", function() {
    var term = $("#keywords").val();
    var url = APP_URL + "/google";
    if (term == "") {
        $(".searchclass").hide();
    } else {
        $(".searchclass").show();
    }
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "post",
        url: url,
        data: { search: term },
        dataType: "JSON",
        success: function(response) {
            if (response.response == true) {
                var re = response;

                // if(re.length>0){
                //   var x = '<ul>';

                //         $.each(response.data, function (key, value) {

                //             x += `<li><a href="javascript:void(0);"  class="empDesiNamen" data-name="`+value['name'].replace(/'/g, '')+`" data-id="`+ value['id']+`"> ` + value['name'] + `</a></li>`;
                //         });
                //     x +=`</ul>`;
                // }else{
                //   var x='<ul><li>No Data found</li></ul>';
                // }
                $(".dumpSearch").html(response.html);
            } else {
                swal("Not available", {
                    icon: "warning",
                });
            }
        },
        complete: function(data) {
            $(".docLoader").hide();
            //   $(button_id).attr("disabled", false);
        },
        error: function(reject) {
            if (reject.status == 422) {}
        },
    });
});

$("body").on("click", ".submitmail", function() {
    var url = APP_URL + "/submitmail";
    if ($("#name").val() != "") {
        $(".name_err").text(" ");
    }
    if ($("#email").val() !== "") {
        $(".email_err").text(" ");
    }
    if ($("#city").val() != "") {
        $(".city_err").text(" ");
    }

    if ($("#city").val() != "") {
        $(".city_err").text(" ");
    }
    if ($("#mobile").val() != "") {
        $(".mobile_err").text(" ");
    }
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: $("#sumidmail").serialize(), // serializes the form's elements.
        dataType: "JSON",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                $("#sumidmail")[0].reset();
                $("#overlay").fadeOut(300);
                $("#success").scrollTop(0);
                // $('#successmsg').html('<div class="alert alert-success">' +
                //   '<span class="glyphicon glyphicon-ok"></span>' +
                //   'Form Submit Successfully' +
                //   '</div>');
                //   swal("Someone is gonna be contacting you soon!!", {
                //       icon: "success",
                //     });
                $("#freedetailsrequest").modal("show");
                $(".form-group")
                    .removeClass("has-error")
                    .removeClass("has-success");
                $(".text-danger").remove();

                // close the message after seconds
                $(".alert-success")
                    .delay(500)
                    .show(10, function() {
                        $(this)
                            .delay(3000)
                            .hide(10, function() {
                                $(this).remove();
                                location.reload();
                            });
                    });
                // alert(data.success);
            } else {
                printErrorMsg(data.error);
            }
        },
    });
});

$("body").on("click", ".editpro", function() {
    var id = $(this).attr("data-id");
    var urlname = $(this).attr("data-url");
    var url = APP_URL + "/" + urlname;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#usermodelp").html(data);
            $("#showpromotion").modal("show");
        },
    });
});

$("body").on("click", ".editUserPackage", function() {
    $("#showPackagesModel").modal("hide");

    var id = $(this).attr("data-id");

    var url = APP_URL + "/edit-user-package";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#usermodel").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

$("body").on("click", ".viewDetailsonsite", function() {
    var id = $(this).attr("data-id");

    var url = APP_URL + "/viewDetailsOnSiteRequest";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#usermodel").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

$("body").on("click", ".showrequest", function() {
    var id = $(this).attr("data-id");

    var url = APP_URL + "/viewrequestwasher";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#userpaymodel1").html(data);
            $("#showpaymodel1").modal("show");
        },
    });
});

$("body").on("click", ".showpersentage", function() {
    var id = $(this).attr("data-id");

    var url = APP_URL + "/adjustpersentage";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#userdocmodelper").html(data);
            $("#docmodelper").modal("show");
        },
    });
});

$("body").on("click", ".editservice", function() {
    var id = $(this).attr("data-id");

    var url = APP_URL + "/editservice";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#usermodel").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

$("body").on("click", ".showbasicDetails", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/show-details-basic";
    $("#changeContent").text(" ");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#changeContent").text("View User Details");
            $("#usermodel").html(data);
            $("#usermodels1").html(data);
            $("#showusermodel").modal("show");
        },
    });
});
$("body").on("click", ".edituser", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/edit-user";
    $("#changeContent").text(" ");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#changeContent").text("Edit User Details");
            $("#usermodel").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

$("body").on("click", ".editwasher", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/edit-washer";
    $("#changeContent").text(" ");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#changeContent").text("Edit User Details");
            $("#usermodels1").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

$("body").on("click", ".shoebackgroundcheck", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/show-background";
    $("#changeContent").text(" ");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#changeContent").text("Edit User Details");
            $("#showbackground").html(data);
            $("#showBackgroundodel").modal("show");
        },
    });
});

$("body").on("click", ".VehicleInsurance", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/show_vehicle_insurance";
    $("#changeContent").text(" ");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#VehicleInsuranceid").html(data);
            $("#VehicleInsuranceshow").modal("show");
        },
    });
});

$("body").on("click", ".VehicleRegistration", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/show_vehicle_registration";
    $("#changeContent").text(" ");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#Vehicleregisid").html(data);
            $("#Vehicleregistrationshow").modal("show");
        },
    });
});

$("body").on("click", ".editCoupon", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/edit-coupon-show";
    $("#changeContent").text(" ");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#usermodel").html(data);
            $("#showusermodel").modal("show");
        },
    });
});

$("body").on("click", ".showpermission", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/edit-showpermission";

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);

            $("#showpermission").html(data);
            $("#permission").modal("show");
        },
    });
});

// chnageBackgroupStatus
$("body").on("click", ".chnageBackgroupStatus", function() {
    var url = APP_URL + "/chnageBackgroupStatus";
    var id = $(this).attr("data-id");
    var status = $(this).attr("data-status");
    var thi = $(this);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id, status: status },
        dataType: "json",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            if (data.success == true) {
                if (status == 0) {
                    thi.html("Approved");
                    thi.attr("data-status", "1");
                    thi.removeClass("btn ripple btn-danger chnageBackgroupStatus");
                    thi.addClass("btn ripple btn-success chnageBackgroupStatus");
                } else {
                    thi.attr("data-status", "0");
                    thi.html("Disapproved ");
                    thi.removeClass("btn ripple btn-success chnageBackgroupStatus");
                    thi.addClass("btn ripple btn-danger chnageBackgroupStatus");
                }
            }
        },
    });
});

// changeVehicleInsurStatus
$("body").on("click", ".changeVehicleInsurStatus", function() {
    var url = APP_URL + "/changeVehicleInsurStatus";
    var id = $(this).attr("data-id");
    var status = $(this).attr("data-status");
    var thi = $(this);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id, status: status },
        dataType: "json",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            if (data.success == true) {
                if (status == 0) {
                    thi.html("Approved");
                    thi.attr("data-status", "1");
                    thi.removeClass("btn ripple btn-danger changeVehicleInsurStatus");
                    thi.addClass("btn ripple btn-success changeVehicleInsurStatus");
                } else {
                    thi.attr("data-status", "0");
                    thi.html("Disapproved ");
                    thi.removeClass("btn ripple btn-success changeVehicleInsurStatus");
                    thi.addClass("btn ripple btn-danger changeVehicleInsurStatus");
                }
            }
        },
    });
});

// changeVehicleRegStatus
$("body").on("click", ".changeVehicleRegStatus", function() {
    var url = APP_URL + "/changeVehicleRegStatus";
    var id = $(this).attr("data-id");
    var status = $(this).attr("data-status");
    var thi = $(this);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id, status: status },
        dataType: "json",
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            if (data.success == true) {
                if (status == 0) {
                    thi.html("Approved");
                    thi.attr("data-status", "1");
                    thi.removeClass("btn ripple btn-danger changeVehicleRegStatus");
                    thi.addClass("btn ripple btn-success changeVehicleRegStatus");
                } else {
                    thi.attr("data-status", "0");
                    thi.html("Disapproved ");
                    thi.removeClass("btn ripple btn-success changeVehicleRegStatus");
                    thi.addClass("btn ripple btn-danger changeVehicleRegStatus");
                }
            }
        },
    });
});

// view-add-ons
$("body").on("click", ".view-add-ons", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/view-add-ons";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#view-add-ons-list").html(data);
            $("#viewAddonsModal").modal("show");
        },
    });
});

$("body").on("click", ".showBookingDetails", function() {
    var id = $(this).attr("data-id");
    var url = APP_URL + "/showBookingDetails";
    // var url = "http://localhost:8888/Suds/Laravel_Suds/showBookingDetails"
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#showbookingDetails").html(data);
            $("#showbookingDetailsModel").modal("show");
        },
    });
});

$("body").on("click", ".showPackages", function() {
    var id = $(this).attr("data-id");
    // var url = APP_URL + "/showPackages";
    var url = APP_URL + "/showPackages"
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id }, // serializes the form's elements.
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        success: function(data) {
            $("#overlay").fadeOut(300);
            $("#showPackages").html(data);
            $("#showPackagesModel").modal("show");
        },
    });
});

$("body").on("click", ".citiesStatusChanges", function() {
    var url = APP_URL + "/changeCitiesStatus"
    var id = $(this).attr('data-id')
    var status = $(this).attr('data-status')
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: url,
        data: { id: id, status: status }, // serializes the form's elements.
        success: function(data) {
            //    console.log('data : ', data)
            $("#changeStatus").css('display', 'block');
            setTimeout(() => {
                $("#changeStatus").css('display', 'none');
            }, 5000);
        },
    });
});

$(document).on('click','.editRequest',function(){
      var request_id = $(this).attr('data-id');
      $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: APP_URL + "/edit-requests",
        type: 'POST',
        data:{id : request_id},
        success:function(response){
            $('#requestmodal').html(response);
            $('#requestedit').modal('show');
        }
    });
});
$(document).on('click','.editOnSiteRequest',function(){
      var request_id = $(this).attr('data-id');
      $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: APP_URL + "/edit-On-Site-Request",
        type: 'POST',
        data:{id : request_id},
        success:function(response){
            $('#onsiterequestmodal').html(response);
            $('#onsiterequestedit').modal('show');
        }
    });
});
$(document).on('click','.editPressRequest',function(){
      var request_id = $(this).attr('data-id');
      $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: APP_URL + "/edit-Press-Request",
        type: 'POST',
        data:{id : request_id},
        success:function(response){
            $('#pressrequestmodal').html(response);
            $('#pressrequestedit').modal('show');
        }
    });
});