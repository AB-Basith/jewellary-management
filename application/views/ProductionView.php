<?php include('header.php');?>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Production</li>
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
                    <h6 class="text-white text-capitalize m-0">Production</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductionModal">
                    <i class="fas fa-plus"></i> Add Production
                    </button>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table id="ProductionData" class="table align-items-center mb-0">
                  <thead> 
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
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

<div class="modal fade" id="addProductionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProductionModalLabel">Add New Production</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addProductionForm" action="<?= base_url('ProductionController/AddProductionData'); ?>" method="POST" enctype="multipart/form-data">
          
          <div class="mb-3">
            <label for="new_category_name" class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
              <option value="">Select Category</option>
              <?php if (!empty($category_name)): ?>
                  <?php foreach ($category_name as $cat): ?>
                      <option value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                  <?php endforeach; ?>
              <?php else: ?>
                  <option value="">No Categories Available</option>
              <?php endif; ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="new_product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="new_product_name" name="product_name" required>
          </div>

          <div class="mb-3">
            <label for="new_description" class="form-label">Description</label>
            <textarea class="form-control" id="new_description" name="description"></textarea>
          </div>

          <div class="mb-3">
            <label for="new_price" class="form-label">Image</label>
             <input type="file" name="image" class="form-control" id="new_imageInput" required>
             <img id="previewImage" src="#" alt="Image Preview" style="display: none; max-width: 200px; margin-top: 10px; border: 1px solid #ccc; padding: 5px;">
          </div>         

          <div class="mb-3">
            <label for="new_price" class="form-label">Price</label>
            <input type="number" class="form-control" id="new_price" name="price" required>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Production</button>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editProductionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProductionModalLabel">Edit Production</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editProductionForm" action="<?= base_url('ProductionController/AddProductionData'); ?>" method="POST" enctype="multipart/form-data">
          
          <div class="mb-3">
            <label for="edit_product_id" class="form-label">Product Id</label>
            <input type="text" class="form-control" id="edit_product_id" name="id" readonly>
          </div>

          <div class="mb-3">
              <label for="edit_category_name" class="form-label">Category</label>
              <select id="edit_category_id" name="category_id" class="form-control" required>
                  <option value="">Select Category</option>
                  <?php if (!empty($category_name)): ?>
                      <?php foreach ($category_name as $cat): ?>
                         <option value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <option value="">No Categories Available</option>
                  <?php endif; ?>
              </select>
          </div>

          <div class="mb-3">
            <label for="edit_product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="edit_product_name" name="product_name" required>
          </div>

          <div class="mb-3">
            <label for="edit_description" class="form-label">Description</label>
            <textarea class="form-control" id="edit_description" name="description"></textarea>
          </div>

          <div class="mb-3">
            <label for="edit_imageInput" class="form-label">Image</label>
             <input type="file" name="image" class="form-control" id="edit_imageInput" required>
             <img id="preview-image" src="#" alt="Image Preview" style=" max-width: 200px; margin-top: 10px; border: 1px solid #ccc; padding: 5px;">
          </div>

          <div class="mb-3">
            <label for="edit_new_price" class="form-label">price</label>
            <input type="number" class="form-control" id="edit_new_price" name="price" required>
          </div>

          <div class="mb-3">
            <label for="edit_new_created_date" class="form-label">Created Date</label>
            <input type="text" class="form-control" id="edit_new_created_date" name="created_at" readonly>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Edit Production</button>
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
        $('#ProductionData').DataTable({
            "processing": true,
            "ajax": "<?php echo base_url('GetAllProductionRecords'); ?>",
            "columns": [
                { "data": 0 },
                { "data": 1 },
                { "data": 2 },
                {
                    "data": 3,
                    "render": function(data, type, row, meta) {
                        if (data) {
                            return '<img src="<?= base_url("uploads/"); ?>' + data + '" alt="Product Image" width="100">';
                        } else {
                            return 'No Image';
                        }
                    }
                },
                { "data": 4 },
                { "data": 5 },
                {
                    "data": 7,
                    "orderable": false,
                    "searchable": false
                }
            ]
        });
    });

    $(document).on('click', '.editProduction', function() {
          console.log($(this).closest("tr").find("td:nth-child(1)").html(), "htmllllllllllllllllll")
          // let id = $(this).data('id');
          let id = $(this).closest("tr").find("td:nth-child(1)").html();
          let category_id = $(this).data('category_id');
          let product_name = $(this).closest("tr").find("td:nth-child(2)").html();
          let description = $(this).closest("tr").find("td:nth-child(3)").html();
          let image = $(this).closest("tr").find("td:nth-child(4)").html();
          let temp = $('<div>').html(image);
          let imageSrc = temp.find('img').attr('src');
          console.log(image);
          let price = $(this).closest("tr").find("td:nth-child(5)").html();
          let created_date = $(this).closest("tr").find("td:nth-child(6)").html();
          let formattedDate = formatDateTime(created_date);

          // $('#Production_id').val(id);
          $('#edit_product_id').val(id);
          $('#edit_category_id').val(category_id);
          $('#edit_product_name').val(product_name);
          $('#edit_description').val(description);
          $('#preview-image').attr('src', imageSrc).show(); 
          $('#edit_new_price').val(price);
          $('#edit_new_created_date').val(formattedDate);
          // $('#ProductionModal').modal('show');
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
    $(document).on('click', '.deleteProduction', function() {
        let ProductionId = $(this).data('id');

        if (confirm('Are you sure you want to delete this Production item?')) {
            $.ajax({
                url: "<?= base_url('ProductionController/DeleteProductionData'); ?>",
                type: "POST",
                data: { id: ProductionId },
                success: function(response) {
                    let response_msg = JSON.parse(response);
                    console.log("Server Response:", response_msg.status);

                    if (response_msg.status === 'success') {
                        alert(response_msg.message);
                        $('#ProductionData').DataTable().ajax.reload(); 
                    } else {
                        alert('Error: ' + response_msg.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Error deleting Production');
                }
            });
        }
    });
});
</script>

    <?php include('footer.php');?>