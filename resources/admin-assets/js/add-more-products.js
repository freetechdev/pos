$(".addMoreOrder").on("click", function () {
    var product = $(".product_id").html();
    var noOfRows = $(".addMoreProductDisplay tr").length - 0 + 1;
    var tr =
        '<tr><td class"no"">' + noOfRows +
        "</td>" +
        '<td><select class="form-control product_id" name="product_id[]">' + product +
        "</select></td>" +
        '<td><input type="number" name="quantity[]" id="quantity" class="form-control quantity"></td>' +
        '<td><input type="number" name="unit_price[]" id="unit_price" class="form-control unit_price"></td>' +
        '<td><input type="number" name="discount[]" id="discount" class="form-control discount"></td>' +
        '<td><input type="number" name="amount[]" id="amount" class="form-control amount"></td>' +
        '<td><a class="btn btn-danger btn-sm deleteOrder"><i class="fa fa-trash"></i></a></td></tr>';
    $(".addMoreProductDisplay").append(tr);
});

$(".addMoreProductDisplay").delegate(".deleteOrder", "click", function () {
    $(this).parent().parent().remove();
});

function totalAmount() {
    var total = 0;
    $(".amount").each(function (i, e) {
        var amount = $(this).val() - 0;
        total += amount;
    });
    console.log('OverAll Total:'+Math.round((total),2));
    $(".total").html(total);
}

$(".addMoreProductDisplay").delegate(".product_id", "change", function () {
    var tr = $(this).parent().parent();
    var unit_price = tr.find(".product_id option:selected").attr("data-price");
    tr.find(".unit_price").val(unit_price);
    var quantity = tr.find(".quantity").val() - 0;
    var discount = tr.find(".discount").val() - 0;
    var unit_price = tr.find(".unit_price").val() - 0;
    var product_price = quantity * unit_price;
    var discount_amount = (product_price * discount)/100;
    var amount = Math.round((product_price - discount_amount),2);
    tr.find(".amount").val(amount);
    console.log('Product Total:'+amount);
    totalAmount();
});

$(".addMoreProductDisplay").delegate(
    ".quantity,.discount",
    "keyup",
    function () {
        var tr = $(this).parent().parent();
        var quantity = tr.find(".quantity").val() - 0;
        var discount = tr.find(".discount").val() - 0;
        var unit_price = tr.find(".unit_price").val() - 0;
        var product_price = quantity * unit_price;
        var discount_amount = (product_price * discount)/100;
       var amount = Math.round((product_price - discount_amount),2);
        tr.find(".amount").val(amount);
       console.log('Product Total:'+amount);
        totalAmount();
    }
);

$('#paid_amount').keyup(function (e) {
    var total = $(".total").html();
    var paid_amount = $(this).val();
    var return_amount = Math.round((paid_amount-total),2);
    $('#balance').val(return_amount);
});
