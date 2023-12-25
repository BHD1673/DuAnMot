<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mt-5" data-toggle="modal" data-target="#newCategoryModal">
  Add New Category
</button>

<!-- Modal -->
<div class="modal fade" id="newCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Item Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="categoryName">Category Name:</label>
            <input type="text" class="form-control" id="categoryName" placeholder="Enter category name" required>
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" rows="3" placeholder="Enter category description"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
      </div>
    </div>
  </div>
</div>