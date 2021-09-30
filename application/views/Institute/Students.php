<!-- Body Content Start -->
<div class=" p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3><i class="fas fa-list"></i> Students List</h3>
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
                            value="<?=base_url('Institute/Students/index/'.$classes->classIdPK)?>">
                            <?=$classes->className;?>
                        </option>
                    <?php } ?>
                    <option
                        <?php if($this->uri->segment(4)==0){echo'selected';}?>
                        value="<?=base_url('Institute/Students/index/0')?>">All Classes
                    </option>
                </select>
            </div>
        </div>
    </div>
    <!--Students List Table-->
    <div class="" style="overflow-x: auto">
        <table class="table table-responsive table-bordered" id="memberTable">
            <thead>
            <tr class="bg-dark text-white">
                <th>Basic Info</th>
                <th>Contact Details</th>
                <th>Other Details</th>
            </tr>
            <tr class="bg-white">
                <th class="">
                    <input type="text" class="form-control-sm w-100 border-secondary" id="myInput1" onkeyup="myFunction1()"
                           placeholder="Search by Name, ID, DOB">
                </th>
                <th>
                    <input type="text" class="form-control-sm w-100 border-secondary" id="myInput2" onkeyup="myFunction2()"
                           placeholder="Search by Address, Contact">
                </th>
                <th>
                    <input type="text" class="form-control-sm w-100 border-secondary" id="myInput3" onkeyup="myFunction3()"
                           placeholder="Search by Section, Fees">
                </th>
            </tr>
            </thead>
            <tbody class="bg-white">
            <?=$students?>
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
</script>
