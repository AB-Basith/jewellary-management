<?php include('header.php');?>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoices</li>
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
                    <h6 class="text-white text-capitalize m-0">Invoices</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInvoicesModal">
                    <i class="fas fa-plus"></i> Add Invoices
                    </button>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table id="InvoicesData" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Invoice Number</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Amount</th>
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

<div class="modal fade" id="addInvoicesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addInvoicesModalLabel">Add New Invoices</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addInvoicesForm" action="<?= base_url('InvoicesController/AddInvoicesData'); ?>" method="POST">

          <div class="mb-3">
            <label for="invoice_number" class="form-label">Invoice Number</label>
            <input type="text" class="form-control" id="invoice_number" name="invoice_number" required>
          </div>

          <div class="mb-3">
            <label for="new_customer_name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="new_customer_name" name="customer_name" required>
          </div>

          
          <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" class="form-control" id="total_amount" name="total_amount" required>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Invoices</button>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editInvoicesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addInvoicesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editInvoicesModalLabel">Edit Invoices</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editInvoicesForm" action="<?= base_url('InvoicesController/AddInvoicesData'); ?>" method="POST">
          
          <div class="mb-3">
            <label for="edit_item_name" class="form-label">Item Id</label>
            <input type="text" class="form-control" id="edit_item_id" name="id" required>
          </div>

          <div class="mb-3">
            <label for="edit_invoice_number" class="form-label">Invoice Number</label>
            <input type="text" class="form-control" id="edit_invoice_number" name="invoice_number" required>
          </div>

          <div class="mb-3">
            <label for="edit_customer_name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="edit_customer_name" name="customer_name" required>
          </div>

          
          <div class="mb-3">
            <label for="edit_total_amount" class="form-label">Total Amount</label>
            <input type="number" class="form-control" id="edit_total_amount" name="total_amount" required>
          </div>

          <div class="mb-3">
            <label for="edit_new_created_date" class="form-label">Created Date</label>
            <input type="text" class="form-control" id="edit_new_created_date" name="created_at" required>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Edit Invoices</button>
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
        $('#InvoicesData').DataTable({
            "processing": true,
            //"serverSide": true,
            "ajax": "<?php echo base_url('GetAllInvoicesRecords'); ?>", 
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

    $(document).on('click', '.editInvoices', function() {
          console.log($(this).closest("tr").find("td:nth-child(2)").html(), "htmllllllllllllllllll")
          // let id = $(this).data('id');
          let id = $(this).closest("tr").find("td:nth-child(1)").html();
          let invoice_number = $(this).closest("tr").find("td:nth-child(2)").html();
          let customer_name = $(this).closest("tr").find("td:nth-child(3)").html();
          let total_amount = $(this).closest("tr").find("td:nth-child(4)").html();
          let created_date = $(this).closest("tr").find("td:nth-child(5)").html();
          let formattedDate = formatDateTime(created_date);

          // $('#Invoices_id').val(id);
          $('#edit_item_id').val(id);
          $('#edit_invoice_number').val(invoice_number);
          $('#edit_customer_name').val(customer_name);
          $('#edit_total_amount').val(total_amount);
          $('#edit_new_created_date').val(formattedDate);
          // $('#InvoicesModal').modal('show');
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
    $(document).on('click', '.deleteInvoices', function() {
        let InvoicesId = $(this).data('id');

        if (confirm('Are you sure you want to delete this Invoices item?')) {
            $.ajax({
                url: "<?= base_url('InvoicesController/DeleteInvoicesData'); ?>",
                type: "POST",
                data: { id: InvoicesId },
                success: function(response) {
                    let response_msg = JSON.parse(response);
                    console.log("Server Response:", response_msg.status);

                    if (response_msg.status === 'success') {
                        alert(response_msg.message);
                        $('#InvoicesData').DataTable().ajax.reload(); 
                    } else {
                        alert('Error: ' + response_msg.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Error deleting Invoices');
                }
            });
        }
    });
});
</script>

    <?php include('footer.php');?>