<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label">Income Category Name *</label>
                                    <input type="text" class="form-control" id="incomeCategoryName">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>

<script>
    async function Save(){
        let name=$('#incomeCategoryName').val();
        
        if(name.length===0){
            errorToast("Income Category Required!")
        }else{
            document.getElementById('modal-close').click();

            showLoader();
            let url = "{{url('/create-income-category')}}";
            const res = await axios.post(url,{'name':name});
            hideLoader();
            if(res.status===201){
                successToast('Income Category created successful');
                $('#save-form').trigger('reset');
                await getList();
            }else{
                errorToast("Request fail!");
            }
        }
    }
</script>