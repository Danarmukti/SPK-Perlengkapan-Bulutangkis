$(document).ready(function () {
  alertify.set("notifier", "position", "top-right");
  $(document).on("click", ".increment", function () {
    var $quantityInput = $(this).closest(".qtyBox").find(".qty");
    var productId = $(this).closest(".qtyBox").find(".prodId").val();
    var currentValue = parseInt($quantityInput.val());

    if (!isNaN(currentValue)) {
      var qtyVal = currentValue + 1;
      $quantityInput.val(qtyVal);
      quantityIncDec(productId, qtyVal);
    }
  });
  $(document).on("click", ".decrement", function () {
    var $quantityInput = $(this).closest(".qtyBox").find(".qty");
    var productId = $(this).closest(".qtyBox").find(".prodId").val();
    var currentValue = parseInt($quantityInput.val());

    if (!isNaN(currentValue) && currentValue > 1) {
      var qtyVal = currentValue - 1;
      $quantityInput.val(qtyVal);
      quantityIncDec(productId, qtyVal);
    }
  });

  function quantityIncDec(prodId, qty) {
    $.ajax({
      type: "POST",
      url: "orders-code.php",
      data: {
        productIncDec: true,
        product_id: prodId,
        quantity: qty,
      },
      success: function (response) {
        var res = JSON.parse(response);
        if (res.status == 200) {
          alertify.success(res.message);
          $("#productContent").load(location.href + " #productContent>*", "");
        } else {
          alertify.error(res.message);
          $("#productContent").load(location.href + " #productContent>*", "");
        }
      },
    });
  }

  // proceed to place order button click
  $(document).on("click", ".proceedToPlace", function () {
    var payment_mode = $("#payment_mode").val();
    var customer_select = $("#customer_select").val();
    if (payment_mode == "") {
      swal("Select Payment Method", "Select Your Payment Method", "warning");
      return false;
    }
    // if (customer_select == "") {
    //   swal("Select Customer", "Select Your Customer", "warning");
    //   return false;
    // }

    var data = {
      proceedToPlaceBtn: true,
      customer_name: customer_select,
      payment: payment_mode,
    };

    $.ajax({
      type: "POST",
      url: "orders-code.php",
      data: data,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.status == 200) {
          window.location.href = "order-summary.php";
        } else if (res.status == 404) {
          swal(res.message, res.message, res.status_type, {
            buttons: {
              catch: {
                text: "Add Customer",
                value: "catch",
              },
              cancel: "Cancel",
            },
          }).then((value) => {
            switch (value) {
              case "catch":
                $("#customerModal").modal("show");
                break;
              default:
            }
          });
        } else {
          swal(res.message, res.message, res.status_type);
        }
      },
    });
  });

  $(document).on("click", ".saveCustomer", function () {
    var c_name = $("#c_name").val();
    var c_phone = $("#c_phone").val();
    var c_email = $("#c_email").val();

    if (c_name != "" && c_phone != "") {
      var data = {
        saveCustomerBtn: true,
        name: c_name,
        phone: c_phone,
        email: c_email,
      };

      $.ajax({
        type: "POST",
        url: "orders-code.php",
        data: data,
        success: function (response) {
          var res = JSON.parse(response);
          if (res.status == 200) {
            swal(res.message, res.message, res.status_type, {
              buttons: {
                catch: {
                  text: "Ok",
                  value: "Ok",
                },
              },
            }).then((value) => {
              switch (value) {
                case "Ok":
                  $("#customerModal").modal("hide");
                  window.location.href = "order-create.php";
                  break;
                default:
              }
            });
          } else if (res.status == 422) {
            swal(res.message, res.message, res.status_type);
          } else {
            swal(res.message, res.message, res.status_type);
          }
        },
      });
    } else {
      swal(res.message, res.message, res.status_type);
    }
  });

  $(document).on("click", "#saveOrderBtn", function () {
    $.ajax({
      type: "POST",
      url: "orders-code.php",
      data: {
        saveOrder: true,
      },
      success: function (response) {
        var res = JSON.parse(response);
        if (res.status == 200) {
          swal(res.message, res.message, res.status_type);
          $("#orderPlaceSuccessMessage").text(res.message);
          $("#orderSuccessModal").modal("show");
        } else {
          swal(res.message, res.message, res.status_type);
        }
      },
    });
  });
});

window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();

function downloadPDF(invoiceNo) {
  var elementHTML = document.querySelector("#myBillingArea");
  docPDF.html(elementHTML, {
    callback: function () {
      docPDF.save(invoiceNo + ".pdf");
    },
    x: 15,
    y: 15,
    width: 170,
    windowWidth: 850,
  });
}

function printMyBillingArea() {
  var divContent = document.getElementById("myBillingArea").innerHTML;
  var a = window.open("", "");
  a.document.write("<html><title> POS SYSTEM by Danar</title>");
  a.document.write(`<link href="assets/css/styles.css" rel="stylesheet" /> `);
  a.document.write(`<body style="font-family: fangsong;">`);
  a.document.write(divContent);
  a.document.write("</body></html>");
  a.document.close();
  a.print();
}
