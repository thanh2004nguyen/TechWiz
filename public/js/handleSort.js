// $(".btn--to__submit").on("change", () => {
//     console.log($(this));
//     var checkboxValue = $(this).val();
//     var checkboxName = $(this).attr("name");
//     console.log("Checkbox Name:", checkboxName);
//     console.log("Checkbox Value:", checkboxValue);
//     // },
//     // $.ajax({
//     //     url: "http://localhost:8000/product/sort-product",
//     //     type: "GET",
//     // success: function (response) {
//     // var rows =
//     //     "<thead class='thead-dark'><tr><th>Image</th><th>DishID</th><th>Name</th><th>Total orders</th><th>Total cost</th></tr></thead><tbody>";
//     // if (response.length > 0) {
//     //     $.each(response[1], function (index, dish) {
//     //         rows += "<tr>";
//     //         rows += `<td>  <img width="50px" src="${dish.info.dishimages[0].imageurl}" alt="">  </td>`;
//     //         rows += "<td>" + dish.info.dishid + "</td>";
//     //         rows += "<td>" + dish.info.dishname + "</td>";
//     //         rows += "<td>" + dish.totalorder + "</td>";
//     //         rows +=
//     //             "<td>" +
//     //             parseFloat(dish.totalcost).toFixed(2) +
//     //             "</td>";
//     //         rows += "</tr>";
//     //     });
//     // } else {
//     //     rows += '<tr><td colspan="6">No results found.</td></tr>';
//     // }
//     //         // $("#search-results").html(rows);
//     //     },
//     //     error: function (xhr, status, error) {
//     //         console.log(error);
//     //     },
//     // });
// });

$(document).ready(function () {
    var providerchecked = [];
    var typechecked = [];

    $(".btn--to__submit").on("change", function () {
        if ($(this).attr("name") === "provider") {
            if ($(this).is(":checked")) {
                providerchecked.push($(this).val());
            } else {
                var index = providerchecked.indexOf($(this).val());
                if (index !== -1) {
                    providerchecked.splice(index, 1);
                }
            }
        }

        if ($(this).attr("name") === "type") {
            if ($(this).is(":checked")) {
                typechecked.push($(this).val());
            } else {
                var index = typechecked.indexOf($(this).val());
                if (index !== -1) {
                    typechecked.splice(index, 1);
                }
            }
        }

        console.log(typechecked, providerchecked);
    });
});
