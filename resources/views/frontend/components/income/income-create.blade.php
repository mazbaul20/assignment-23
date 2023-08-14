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
                                    <label class="form-label">Income Name *</label>
                                    <input type="text" class="form-control" id="incomeName" placeholder="income name">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">Amount *</label>
                                    <input type="number" class="form-control" id="incomeAmount" placeholder="income Amount">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-floating">Description *</label>
                                    <textarea class="form-control" placeholder="Description here..." id="incomeDescription"></textarea>
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">Date *</label>
                                    <input type="date" class="form-control" id="incomeDate">
                                </div>
                                <div class="col-12 p-1">
                                    <select class="form-select" aria-label="Default select example" id="incomeCategoryId">
                                        <option selected disabled>select Income Category Id</option>
                                        
                                    </select>
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
    getCategoryId();
    async function getCategoryId(){
        showLoader();
        const response = await axios.get('/getincome-category-id');
        hideLoader();

        let ul = $('#incomeCategoryId');

        response.data.forEach(function(item){
            let row=(`
                <option value="${item['id']}">${item['name']}-${item['id']}</option>
            `)
            ul.append(row)
        });
    }

    async function Save(){
        let name=$('#incomeName').val();
        let amount=$('#incomeAmount').val();
        let desc=$('#incomeDescription').val();
        let date=$('#incomeDate').val();
        let income_category_id =$('#incomeCategoryId').val();
        
        if(name.length===0){
            errorToast("Income name is Required!")
        }else if(amount.length===0){
            errorToast("Income amount is Required!")
        }else if(desc.length===0){
            errorToast("Income description is Required!")
        }else if(date.length===0){
            errorToast("Income date is Required!")
        }else if(!income_category_id){
            errorToast("Please select Income category")
        }else{
            $('#modal-close').click();

            showLoader();
            let url = "{{url('/create-income')}}";
            const res = await axios.post(url,{
                name:name,
                amount:amount,
                desc:desc,
                date:date,
                income_category_id:income_category_id
            });
            hideLoader();
            if(res.status===201){
                successToast('Income created successful');
                document.getElementById('save-form').reset();
                await getList();
            }else{
                errorToast("Request fail!");
            }
        }
    }
</script>