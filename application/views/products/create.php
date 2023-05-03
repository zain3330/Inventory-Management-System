<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Add Product</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('products/create') ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label for="product_name">Product name</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                  placeholder="Enter product name" autocomplete="off" />
              </div>



              <div class="form-group">
                <label for="qty">Qty</label>
                <input type="text" class="form-control" id="qty" name="qty" value=1 placeholder="Enter Qty"
                  autocomplete="off" />
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter 
                  description" autocomplete="off">
                  </textarea>
              </div>

              <div class="form-group">
                <label for="category">Add Raw Material</label>
                <button type="button" class="btn btn-primary form-control " id="addRawMaterial">Add Raw
                  Material</button>
              </div>
              <div class="toast" id="toast">
                <i class="fa fa-sharp fa-solid fa-check"></i>
                <p class="toast-text">Record Added Successfully</p>
                <i class="fa fa-close" id="close"></i>
              </div>

              <!-- <button type="button" >Open</button> -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Material Category</th>
                    <th scope="col">Material Name</th>
                    <th scope="col">Material Quantity</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="raw_material_table">
                </tbody>
              </table>

              <div class="form-group">
                <label for="actual_price">Actual Price</label>
                <input type="text" class="form-control" id="actual_price" name="actual_price"
                  placeholder="Product's Actual Price" autocomplete="off" readonly />
              </div>

              <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter price"
                  autocomplete="off" />
              </div>

              <input type="hidden" name="data_list" id="data_list_input">
              <div class="form-group">
                <label for="store">Availability</label>
                <select class="form-control" id="availability" name="availability">
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="formSubmit" onclick="addMaterial()" data-toggle="modal"
                data-target="#exampleModal">Save
                Changes</button>
              <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
            </div>
          </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--Add RAW Metrial modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Category</h4>
      </div>

      <form id="rawMaterialForm">
        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name">Category Name</label>
            <select class="form-control" id="category_name" name="active" required>
            </select>
          </div>

          <div class="form-group">
            <label for="active">Raw Material</label>
            <select class="form-control" id="material" name="active" required>
            </select>
          </div>
          <div class="form-group">
            <label for="active">Add Quantity</label>
            <input type="number" class="form-control" id="material_quantity" name="material_quantity"
              placeholder="Enter Quantity" autocomplete="off" required />
          </div>

        </div>

    </div>

    <div class="modal-footer">
      <button type="button" id="modal-close" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary" id="open">Add Raw
        Material</button>
    </div>
    </form>
  </div>
</div>
</div>

<!--Edit  RAW Metrial modal -->
<!-- <div class="modal fade" id="editModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Raw Metrial</h4>
      </div>

      <form id="rawMaterialForm">
        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name">Category Name</label>
            <select class="form-control" id="category_name" name="active" required>
            </select>
          </div>

          <div class="form-group">
            <label for="active">Raw Material</label>
            <select class="form-control" id="material" name="active" required>
            </select>
          </div>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="form-group">
            <label for="active">Add Quantity</label>
            <input type="number" class="form-control" id="material_quantity" name="material_quantity"
              placeholder="Enter Quantity" autocomplete="off" required />
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="open">Add Raw
            Material</button>
        </div>
      </form>
    </div>
  </div>
</div> -->



<style>
  .toast {
    position: fixed;
    top: 55px;
    right: 25px;
    width: 375px;
    background: white;
    padding: 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    /*   gap: 20px; */
    border-radius: 12px;
    border-left: 3px solid lightgreen;
    overflow: hidden;
    transform: translateX(calc(100% + 25px));
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
    z-index: 1100;
  }

  .toast.active {
    transform: translateX(0);
  }

  .toast i:first-child {
    color: lightgreen;
    font-size: 20px;
  }

  .toast-text {
    margin: 0;
    font-size: 1.6rem;
    text-transform: uppercase;
  }

  .toast i:last-child {
    color: black;
    cursor: pointer;
    transition: 350ms;
  }

  .toast i:last-child:hover {
    color: #333;
  }
</style>


<script type="text/javascript">
  var api_response = null;
  var actual_price = 0;
  var data_list = [];
  var table_list = [];
  var base_url = "<?php echo base_url(); ?>";

  var openBtn = document.getElementById("rawMaterialForm");
  var toast = document.getElementById("toast");
  var closeBtn = document.getElementById("close");

  $(document).ready(function () {
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#addRawMaterial").click(function () {
      // OPEN MODAL
      $("#myModal").modal();

      // CALL CATEGORY API FOR DATAl
      if ($('#category_name option').length === 0) {
        $.ajax({
          url: `${base_url}/category/fetchCategoryDataForDropDown/`,
          type: "GET",
          dataType: 'json',
          success: function (response) {
            $("#material option").remove()

            $("#material").append("<option value='' selected>--Select--</option>");
            $("#category_name").append("<option value='' selected>--Select--</option>");
            response.forEach((res) => {
              $("#category_name").append(`<option value=${res.id}>${res.name}</option>`)
            })
          }
        })
      }
    });
    $("#editRawMaterial").click(function () {
      // showModal  
      $("#editModal").modal();
    });

    var checkMaterialQuantity = 0;
    var totalProductCodeUsingMaterials = 0;
    $('input[name=qty]').change(function () {
      const materialQuantity = Number($('#material_quantity').val());
      const productQuantity = Number($('#qty').val());
      console.log("HERERE");
      if (materialQuantity && checkMaterialQuantity) {
        if (productQuantity * materialQuantity > checkMaterialQuantity) {
          alert("Limit Reached")
        }
      }
    });

    // POPULATE PRODUCT FORM TABLE WITH SELECTED RAW MATERIALS
    $("#rawMaterialForm").submit(function (event) {
      event.preventDefault();
      const productQuantity = Number($('#qty').val());
      const materialQuantity = Number($('#material_quantity').val());
      const materialId = Number($('#material option:selected').val());

      $.ajax({
        url: `${base_url}/attributes/fetchAttributeDataById/` + materialId,
        type: "GET",
        dataType: 'json',
        success: function (response) {
          checkMaterialQuantity = response?.quantity;
          if (productQuantity * materialQuantity > response?.quantity) {
            alert("Limit Reachedddd")
          }
          else {
            submitForm(event);
            totalProductCodeUsingMaterials += Number(response?.price) ?? 0;

            let table = genrateTable();

            document.getElementById("raw_material_table").innerHTML = table;
            return true;
            $("#mainProductNav").addClass('active');
            $("#addProductNav").addClass('active');
          }
        }
      })
    });
  });

  $("#category_name").change(function () { // Run this function when option selected
    let position = this.value;

    $.ajax({
      url: `${base_url}/attributes/fetchAttributeDataByCategoryID/` + position,
      type: "GET",
      dataType: 'json',
      success: function (response) {
        api_response = response;
        $("#material option").remove()
        $("#material").append("<option value='' selected>--Select--</option>");
        response.forEach((res) => {
          $("#material").append(`<option value=${res.id}>${res.name}</option>`)
        })
        // if ($('#material option').length === 0) {
        //   response.forEach((res) => {
        //     $("#material").append(`<option value=${res.id}>${res.name}</option>`)
        //   })
        // }
        // else {
        //   // response.forEach((res) => { console.log(res.id, "==", res.name) })
        //   $("#material option").remove()
        //   response.forEach((res) => {
        //     $("#material").append(`<option value=${res.id}>${res.name}</option>`)

        //   })
        // }
      }
    })
  });

  function calculateActualPrice(material_obj) {
    for (i = 0; i < api_response.length; i++) {
      if (material_obj.material_id == api_response[i].id) {
        actual_price += (api_response[i].price * material_obj.material_quantity);
      }
    }
    $("#actual_price:text").val(actual_price);
  }
  function submitForm(e) {
    e.preventDefault()
    var data_obj = {
      materal_category: $("#category_name option:selected").val(),
      material_id: $("#material option:selected").val(),
      material_quantity: $("#material_quantity").val()
    }
    var table_obj = {
      materal_category: $("#category_name option:selected").text(),
      material_id: crypto.randomUUID(),
      raw_material_id: $("#material option:selected").val(),
      material_name: $("#material option:selected").text(),
      material_quantity: $("#material_quantity").val()
    }
    data_list.push(data_obj);
    table_list.push(table_obj);
    // console.log("Material:", data_list, table_list)

    calculateActualPrice(data_obj);
  }

  openBtn.addEventListener("submit", () => {
    toast.classList.add("active");
    setTimeout(() => {
      toast.classList.remove("active");
    }, 3000)
  })

  closeBtn.addEventListener("click", () => {
    toast.classList.remove("active");
  })

  function addMaterial() {
    if (table_list == 0) {
      alert('Add Raw Material ');
      return false;
    }
    $('#data_list_input').val(JSON.stringify(data_list));
  }
  function genrateTable() {
    var table = "";
    for (var i in table_list) {
      table += "<tr id='" + table_list[i].material_id + "'>";
      table += "<td>"
        + (parseInt(i) + 1) + "</td>"
        + "<td>" + table_list[i].materal_category + "</td>"
        + "<td>" + table_list[i].material_name + "</td>"
        + "<td>" + table_list[i].material_quantity + "</td>"
        + "<td>" +
        '<button type="button" onclick="deleteRow(' + i + ')" >' +
        '<i class="fa fa-trash">' +
        '</i>' +
        '</button>'
        + "</td>";
      table += "</tr>";
    }
    return table;
  }

  function deleteRow(id) {
    if (id > -1) {
      $.ajax({
        url: `${base_url}/attributes/fetchAttributeDataById/` + table_list[id].raw_material_id,
        type: "GET",
        dataType: 'json',
        success: function (response) {
          // console.log("Response:", response)

          let price = response;;
          // console.log("Price:", price)
          price = Number($('#actual_price').val()) - (Number(price.price) * Number(table_list[id].material_quantity))

          $('#actual_price').prop('readonly', false);
          $('#actual_price').val(price);
          $('#actual_price').prop('readonly', true);
          delete data_list[id];
          delete table_list[id];
          let table = genrateTable();
          document.getElementById("raw_material_table").innerHTML = table;
        }
      })

    }
  }

  const form = document.querySelector('#rawMaterialForm');
  const closeModalResetForm = document.querySelector('#modal-close');
  closeModalResetForm.addEventListener('click', (event) => {
    event.preventDefault();
    form.reset();
    $("#material option").remove()
    $("#material").append("<option value='' selected>--Select--</option>");

  })


  // reset the form after submission
  // form.addEventListener('submit', (event) => {
  //   event.preventDefault();
  //   form.reset();
  // })

</script>