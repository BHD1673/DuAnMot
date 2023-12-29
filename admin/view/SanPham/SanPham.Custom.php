<div class="container mt-5">
    <div class="row">
        <!-- Image on the left -->
        <div class="col-md-6">
            <img src="path/to/your/image.jpg" alt="Item Image" class="img-fluid">
        </div>
        <!-- Item details on the right -->
        <div class="col-md-6">
            <h2>Item Name</h2>
            
            <!-- Brand Choice -->
            <div class="form-group">
                <label for="brand">Brand:</label>
                <select class="form-control" id="brand" name="brand">
                    <option value="brand1">Brand 1</option>
                    <option value="brand2">Brand 2</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            
            <!-- Color -->
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" class="form-control" id="color" name="color">
            </div>
            
            <!-- Year of Manufacture -->
            <div class="form-group">
                <label for="year">Year of Manufacture:</label>
                <input type="text" class="form-control" id="year" name="year">
            </div>
            
            <!-- Malfunction Checkbox -->
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="malfunction" name="malfunction">
                <label class="form-check-label" for="malfunction">Malfunction</label>
            </div>
            
            <!-- Price -->
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
            
            <!-- Item Description -->
            <div class="form-group">
                <label for="description">Item Description:</label>
                <textarea class="form-control" id="description" name="description" rows="5"></textarea>
            </div>
            
            <!-- Convert to Quill Button -->
            <button type="button" class="btn btn-primary">Convert to Quill</button>
        </div>
    </div>
</div>
