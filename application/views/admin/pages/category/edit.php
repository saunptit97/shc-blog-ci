<form id="form-update-cat" >
	<span class="print-error-msg alert alert-danger" style="display: none"></span>
	<span class="print-success-msg alert alert-success" style="display: none"></span>
	<title>Add Category</title>
	<label>Category</label>
	<input  class ="form-control" type="hidden" value="" id="id-category" name="id-category" value=""/>
	<input  class ="form-control" type="text" value="" id="category-update" name="category" placeholder="Category" />
	<button class="btn btn-primary" id="submit-update-cat" onclick="updateCategory()">Update Category</button>
    <button class="btn btn-default back-btn">Back</button>	
</form>	