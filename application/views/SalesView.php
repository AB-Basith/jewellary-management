<?php include('header.php');?>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Sales</li>
          </ol>
        </nav>        
      </div>
    </nav>
    <!-- End Navbar -->
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                    <h6 class="text-white text-capitalize m-0">Sales</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSalesModal">
                    <i class="fas fa-plus"></i> Add Sales
                    </button>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table id="SalesData" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Price</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created Date</th>
                      <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div> 
        </div> 
    </div> 
</div> 
</div>

<div class="modal fade" id="addSalesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSalesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSalesModalLabel">Add New Sales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addSalesForm" action="<?= base_url('SalesController/AddSalesData'); ?>" method="POST">
          
          <div class="mb-3">
            <label for="new_product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="new_product_name" name="product_name" required>
          </div>

          <div class="mb-3">
            <label for="new_quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="new_quantity" name="quantity" required>
          </div>
          
          <div class="mb-3">
            <label for="total_price" class="form-label">Total Price</label>
            <input type="number" class="form-control" id="total_price" name="total_price" required>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Sales</button>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editSalesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSalesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSalesModalLabel">Edit Sales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editSalesForm" action="<?= base_url('SalesController/AddSalesData'); ?>" method="POST">
          
          <div class="mb-3">
            <label for="edit_product_id" class="form-label">Item Id</label>
            <input type="text" class="form-control" id="edit_product_id" name="id" readonly>
          </div>

          <div class="mb-3">
            <label for="edit_product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="edit_product_name" name="product_name" required>
          </div>

          <div class="mb-3">
            <label for="edit_new_quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="edit_new_quantity" name="quantity" required>
          </div>

          <div class="mb-3">
            <label for="edit_new_total_price" class="form-label">Total Price</label>
            <input type="number" class="form-control" id="edit_new_total_price" name="total_price" required>
          </div>

          <div class="mb-3">
            <label for="edit_new_created_date" class="form-label">Created Date</label>
            <input type="text" class="form-control" id="edit_new_created_date" name="created_at" readonly>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Edit Sales</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>    
<script type="text/javascript">
    $(document).ready(function() {
        $('#SalesData').DataTable({
            "processing": true,
            //"serverSide": true,
            "ajax": "<?php echo base_url('GetAllSalesRecords'); ?>", 
            "language": {
                "paginate": {
                    "first": '<i class="fa fa-step-backward"></i>',
                    "last": '<i class="fa fa-step-forward"></i>',
                    "next": '<i class="fa fa-forward"></i>',
                    "previous": '<i class="fa fa-backward"></i>'
                }
            }
        });
    });

    $(document).on('click', '.editSales', function() {
          console.log($(this).closest("tr").find("td:nth-child(2)").html(), "htmllllllllllllllllll")
          // let id = $(this).data('id');
          let id = $(this).closest("tr").find("td:nth-child(1)").html();
          let product_name = $(this).closest("tr").find("td:nth-child(2)").html();
          let quantity = $(this).closest("tr").find("td:nth-child(3)").html();
          let total_price = $(this).closest("tr").find("td:nth-child(4)").html();
          let created_date = $(this).closest("tr").find("td:nth-child(5)").html();
          let formattedDate = formatDateTime(created_date);

          // $('#Sales_id').val(id);
          $('#edit_product_id').val(id);
          $('#edit_product_name').val(product_name);
          $('#edit_new_quantity').val(quantity);
          $('#edit_new_total_price').val(total_price);
          $('#edit_new_created_date').val(formattedDate);
          // $('#SalesModal').modal('show');
      });

      function formatDateTime(dateStr) {
        let date = new Date(dateStr);
        if (isNaN(date.getTime())) return dateStr;

        let year = date.getFullYear();
        let month = String(date.getMonth() + 1).padStart(2, '0');
        let day = String(date.getDate()).padStart(2, '0');
        let hours = String(date.getHours()).padStart(2, '0');
        let minutes = String(date.getMinutes()).padStart(2, '0');
        let seconds = String(date.getSeconds()).padStart(2, '0');

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

$(document).ready(function() {
    $(document).on('click', '.deleteSales', function() {
        let SalesId = $(this).data('id');

        if (confirm('Are you sure you want to delete this Sales item?')) {
            $.ajax({
                url: "<?= base_url('SalesController/DeleteSalesData'); ?>",
                type: "POST",
                data: { id: SalesId },
                success: function(response) {
                    let response_msg = JSON.parse(response);
                    console.log("Server Response:", response_msg.status);

                    if (response_msg.status === 'success') {
                        alert(response_msg.message);
                        $('#SalesData').DataTable().ajax.reload();
                    } else {
                        alert('Error: ' + response_msg.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Error deleting Sales');
                }
            });
        }
    });
});
</script>

    <?php include('footer.php');?>