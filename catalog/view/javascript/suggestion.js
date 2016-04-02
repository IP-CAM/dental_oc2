$(document).ready(function () {
    $('#search_bar').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "index.php?route=product/search_json",
                dataType: "json",
                data: {
                    keyword: request.term,
                    category_id: 0
                },
                success: function (data) {
                    response($.map(data.result, function (item) {
                        return {
                            label: item.name,
                            desc: item.price,
                            value: item.href
                        }
                    }));
                }
            });
        },
        focus: function (event, ui) {
            return false;
        },
        select: function (event, ui) {
            if (ui.item.value == "") {
                return false;
            } else {
                location.href = ui.item.value;
                return false;
            }
        },
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            $('.ui-autocomplete').css("z-index", "99");
        },
        close: function () {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    }).data("autocomplete")._renderItem = function (ul, item) {
        return $("<li></li>")
                .data("item.autocomplete", item)
                .append('<a href="' + item.value + '">' + item.label + "  -  " + item.desc + "</a>")
                .appendTo(ul);
    };
})