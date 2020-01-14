
function setupDynamicModel(modal_id_str, hide) {
  
  /*
   * When both the Category and Manufacturer dropdowns are set load in a new list of models with ajax.
   * (and call selectize on the list so it matches)
   */
  function tryUpdateModelList(modal_id_str, hide) {
    //$("select[name='categoryselect']").on("change", function (){console.log('value changed');});
    function replace(response) {
        let $model_drop = $(modal_id_str + " select[name='modelselect']");

        $model_drop.selectize()[0].selectize.destroy();
        $model_drop.replaceWith(response);
        $(modal_id_str + " select[name='modelselect']").selectize();
    }

    let cat_val = $(modal_id_str + " select[name='categoryselect']").selectize()[0].selectize.getValue();
    let man_val = $(modal_id_str + " select[name='manufacturerselect']").selectize()[0].selectize.getValue();

    let url = "../include/asset_form_ajax.php?model_list";
    if (hide) {
        url = "../include/asset_form_ajax.php?model_list_hide";
    }

    if (cat_val !== 0 && man_val !== 0) {
        $.get(url+"&cat="+cat_val+"&man="+man_val, function (data) {
            replace(data);
        });
    }
  }
  $(modal_id_str + " select[name='categoryselect']").add(modal_id_str + " select[name='manufacturerselect']").on("change", function () {tryUpdateModelList(modal_id_str, hide);});
}

function generateRegexOr(values) {
    let or_list = "";
    if (values.charAt(0) == "@") {
        or_list = "^" + values.substring(1) + "$";
    } else {
        or_list = values.trim().split(" ").map(search => search).join("|").replace(/[.*+?^${}()[\]\\]/g, '\\$&');
    }
    return "(" + or_list + ")";
}


$(function () {

  setupDynamicModel("#addAssetModal", true);


  $("#addAssetModal select").selectize();

  $('#asset_table tfoot th').each(function () {
    var title = $(this).text();
    $(this).html( '<input title="to search an exact string prepend the search with @" type="text" placeholder="' + title + '" />' );
  });

  let the_table = $("#asset_table").DataTable({
    ajax: '../include/get_asset_table.php',
    deferLoading: true,
    dom: "lB<'#surplus_toggle'>frtip",
    buttons: [
        {
            extend: 'csv',
            filename: 'report',
            exportOptions: {
                columns: ":not(.no-export)"
            }
        }
    ],
    autoWidth: false,
    lengthMenu: [[10, 25, 50, 100, -1],["10", "25", "50", "100", "All"]],
    "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": true,
                "searchable": true
            },
            {
                "targets": [-1],
                "sortable": false,
                "className": "no-export"
            },
            {
                "targets": [-2],
                "sortable": true,
                "className": "no-export",
                "visible": false
            }
    ]
  });
  the_table.column(-2).search("0").draw();

  the_table.columns().every(function () {
    let that = this;

    $("input", this.footer()).on("keyup change clear", function () {
        if ( that.search() !== generateRegexOr(this.value) ) {
                that
                    .search( generateRegexOr(this.value), true )
                    .draw();
            }
    });
  });


  let $surplus_toggle = $("<input type='checkbox'>");
  $("#surplus_toggle").append("<span title='unchecked: show all non-surplus items, checked: show only surplus items'>Show Surplus </span>").append($surplus_toggle);
  $surplus_toggle.on("change", function () {
    if (this.checked) {
      the_table.column(-2).search("1").draw();
    } else {
      the_table.column(-2).search("0").draw();
    }
  });

  function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
  }

  if (window.location.hash != "") {
    let $model_search = $("#asset_table input[placeholder='Model']");
    $model_search.val(decodeURIComponent(window.location.hash.replace("#", "")));
    $model_search.trigger("change");
  } else if (getUrlVars()['search'] === 'warranty') {
    let $model_warranty = $("#asset_table input[placeholder='WarrantyEnd']");
    $model_warranty.val("-");
    $model_warranty.trigger("change");
  }


  $("#download_report").on("click", function () {
    $("#asset_table_container .buttons-csv").click();
  });

  //resetAddForm();

        $("#manu_table, #cate_table").DataTable({
            "dom": "rtip",
            "columnDefs": [
                { "width": "64px", "targets": 1},
                { "orderable": false, "targets": 1}
            ],
            "autoWidth": false,
            "pagingType": "simple",
            "language": {
                "paginate": {
                    "next": ">",
                    "previous": "<"
                },
                "info": "(_START_ - _END_) of _TOTAL_"
            }
        });

});

/*
 *  Reset the add form by clearing all the inputs.
 */
function resetAddForm() {
    $("#asset_add_form").trigger("reset"); 

    let selects = $("#addAssetModal select").selectize();
    
    for (let i = 0; i < selects.length; i++ ) {
        selects[i].selectize.setValue(0);
    }
}


/*
 * Submit the asset add modal and reset the form.
 */
function doAssetAdd(form, event) {
    event.preventDefault();
    $.post("../include/asset_form_ajax.php", "insert&" + $("#asset_add_form").serialize(), function (result) {
        if (result.type === "error") {
            doError(result.message);
            console.log(result);
        } else if (result.type === "success") {
            doMessage(result.message);
            $("#addAssetModal").modal("hide");
            $("#asset_table").DataTable().ajax.reload(function () {console.log('reloaded table');}, false);

            // Reset the form.
            resetAddForm();
        }
    }, "json").fail(function (result){doError("An error occured contacting the server. Please check your internet connection or reload the page."); console.log(result);});
}

function doAssetUpdate(form, event, id) {

    event.preventDefault();
    $.post("../include/asset_form_ajax.php", "update&" + $("#asset_update_form").serialize(), function (result) {
        if (result.type === "error") {
            doError(result.message);
            console.log(result.message);
        } else if (result.type === "success") {
            doMessage(result.message);
            $("#editAssetModal").modal("hide");
            $("#asset_table").DataTable().ajax.reload(null, false);
        }
    }, "json").fail(function (result){doError("An error occured contacting the server. Please check your internet connection or reload the page."); console.log(result);});
}


/*
 *  Open the edit modal and populate it.
 */
function doAssetEdit(id) {
    // Load data from server and insert into update modal
    $.get("../include/get_asset_update_form.php?id=" + id, function (result) {
        let $editModal = $("#editAssetModal");
        $editModal.html(result);
        $editModal.find("select").selectize();
        //add event handlers to Category and Manufacturer selects
        setupDynamicModel("#editAssetModal", false);
        
        $editModal.modal("show");
    }).fail(function (result){doError("An error occured contacting the server. Please check your internet connection or reload the page."); console.log(result);});
}

/*
 * Open the delete modal.
 */
function doAssetDelete(id) {
    $("#deleteModal").modal("show");
    // set the hidden field
    $('#deleteid').val(id);
    // add event listener to button
    $("#deleteModal button[type='submit']").off();
    $("#deleteModal button[type='submit']").on("click", function (event) {
        event.preventDefault();
        $.post("../include/asset_form_ajax.php", "delete&" + $("#asset_delete_form").serialize(), function (result) {
            if (result.type === "error") {
                doError(result.message);
            } else if (result.type === "success") {
                doMessage(result.message);
                $("#deleteModal").modal("hide");
                $("#asset_table").DataTable().ajax.reload(null, false);
            }
        }, "json").fail(function (result){doError("An error occured contacting the server. Please check your internet connection or reload the page."); console.log(result);});
    });
}

function showCheckoutForm(serial) {
    let checkout = confirm("Loan asset with serial: " + serial + " ?");
    
    if (checkout) {
        window.location = "rform.php?serial=" + encodeURI(serial);
    }
}
