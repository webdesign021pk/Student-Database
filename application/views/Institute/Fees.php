<!-- Body Content Start -->
<div class=" p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3><i class="fas fa-wallet"></i> Students Fee/Payments Details</h3>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4">
            <a href="<?=base_url('Institute/Students/add')?>" class="btn btn-info">
                <i class="fas fa-user-plus"></i> New Student
            </a>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="input-group mb-2 shadow-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-white border-secondary">
                        Select Class:
                    </span>
                </div>
                <select id="urlSelect" class="form-control"
                        onchange="window.location = jQuery('#urlSelect option:selected').val();">
                    <?php
                    foreach($classId as $classes){ ?>
                        <option
                            <?php if($this->uri->segment(4)==$classes->classIdPK){echo'selected';}?>
                            value="<?=base_url('Institute/Home/Fee/'.$classes->classIdPK)?>">
                            <?=$classes->className;?>
                        </option>
                    <?php } ?>
                    <option
                        <?php if($this->uri->segment(4)==0){echo'selected';}?>
                        value="<?=base_url('Institute/Home/Fee/0')?>">All Classes
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="input-group mb-2 shadow-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-white border-secondary">
                        <i class="fas fa-search"></i>&nbsp;Id:
                    </span>
                </div>
                <input type="text" class="form-control border-secondary" id="searchId" onkeyup="searchId()"
                       placeholder="By Id">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="input-group mb-2 shadow-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-white border-secondary">
                        <i class="fas fa-search"></i>&nbsp;Name:
                    </span>
                </div>
                <input type="text" class="form-control border-secondary" id="searchName" onkeyup="searchName()"
                       placeholder="By Name">
            </div>
        </div>
    </div>
    <!--Students List Table-->
    <div class="" style="overflow-x: auto">
        <table class="table table-responsive" id="memberTable">
                <thead>
                <tr class="bg-dark text-white font-weight-bold">
                    <th width="20%" class="pt-lg-4">Basic Details</th>
                    <th width="20%" class="pt-lg-4">Other Details</th>
                    <th width="60%">
                        <table class="table text-white table-borderless m-0">
                            <tr class="border-0">
                                <th width="30%" class="border-0">Payment Type</th>
                                <th width="17%" class="border-0">For Year</th>
                                <th width="17%" class="border-0">Amount</th>
                                <th width="35%" class="border-0">Status / Action</th>
                            </tr>
                        </table>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white ">
                <?=$students;?>
                </tbody>
            </table>
    </div>

    <!--End Members List Table-->
</div>
<!-- Body Content End -->
<script>
    $(document).ready(function(){
        $("#memberTable").fancyTable({
            pagination: true,
            perPage:15,
            searchable: false,
            sortable: false
        });
    });
    function searchId()
    {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchId");
        filter = input.value.toUpperCase();
        table = document.getElementById("memberTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByClassName("studentId")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function searchName()
    {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchName");
        filter = input.value.toUpperCase();
        table = document.getElementById("memberTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByClassName("studentName")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
