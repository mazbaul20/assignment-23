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
                            <!-- id -->
                            <input class="d-none" id="updateID">
                            <div class="col-12 p-1">
                                <label class="form-label">Income Name *</label>
                                <input type="text" class="form-control" id="updateincomeName" placeholder="income name">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Amount *</label>
                                <input type="number" class="form-control" id="updateincomeAmount" placeholder="income Amount">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-floating">Description *</label>
                                <textarea class="form-control" id="updateincomeDescription" placeholder="Description here..."></textarea>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Date *</label>
                                <input type="date" class="form-control" id="updateincomeDate">
                            </div>
                            <div class="col-12 p-1">
                                <select class="form-select" aria-label="Default select example" id="CategoryId">
                                    <option selected disabled>select Income Category Id</option>

                                </select>
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
        let getres = await axios.post('/income-by-id',{id:id});
        let response = await axios.get('/getincome-category-id');
        hideLoader();
        $('#updateincomeName').val(getres.data['name']);
        $('#updateincomeAmount').val(getres.data['amount']);
        $('#updateincomeDescription').val(getres.data['desc']);
        $('#updateincomeDate').val(getres.data['date']);

        $('#CategoryId').empty();
        let getcatid = $('#CategoryId');
        response.data.forEach(function(item){
            let row=(`
                <option value="${item['id']}">${item['id']}-${item['name']}</option>
            `)
            getcatid.append(row)
        });

        $('#CategoryId').val(getres.data['income_category_id']);
    }
    async function Update(){
        let id=$('#updateID').val();
        let name=$('#updateincomeName').val();
        let amount=$('#updateincomeAmount').val();
        let desc=$('#updateincomeDescription').val();
        let date=$('#updateincomeDate').val();
        let income_category_id=$('#CategoryId').val();

        $('#update-modal-close').click();
        showLoader();
        let res = await axios.patch('/update-income',{
            'id':id,
            'name':name,
            'amount':amount,
            'desc':desc,
            'date':date,
            'income_category_id':income_category_id
        });
        hideLoader();
        if(res.data===1){
            successToast("Category Updated successful");
            $('#update-form').trigger('reset');
            await getList();
        }else{
            errorToast("Requiest fail!");
        }
    }
</script>