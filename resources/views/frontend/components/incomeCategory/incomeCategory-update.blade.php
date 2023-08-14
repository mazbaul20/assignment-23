<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <input class="d-none" id="updateID">
                            <div class="col-12 p-1">
                                <label class="form-label">Income Category Name *</label>
                                <input type="text" class="form-control" id="incomecategoryname">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Income Category User Id *</label>
                                <input readonly type="text" class="form-control" id="incomeCategoryId">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function FillUpUpdateForm(id){
        $('#updateID').val(id);
        showLoader();
        let res=await axios.post('/incomeCategory-by-id',{id:id});
        hideLoader();
        $('#incomecategoryname').val(res.data['name']);
        $('#incomeCategoryId').val(res.data['user_id']);
    }
    async function Update(){
        let id=     $('#updateID').val();
        let name=   $('#incomecategoryname').val();
        let user_id=$('#incomeCategoryId').val();
        
        $('#update-modal-close').click();
        showLoader();
        let res = await axios.patch('/update-income-category',{
            'id':id,
            'name':name,
            'user_id':user_id
        });
        hideLoader();
        if(res.data===1){
            successToast("Income Category Updated successful");
            $('#update-form').trigger('reset');
            await getList();
        }else{
            errorToast("Requiest fail!");
        }
    }
</script>