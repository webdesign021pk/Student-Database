<!-- Body Content Start -->
<div class="container">
    <div class="row pt-3">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <h3><i class="fas fa-list"></i> Classes List</h3>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <a href="javascript:void(0);" class="btn btn-info float-right mx-1" data-toggle="modal" data-target="#addClass">
                <i class="fas fa-user-plus"></i> New Class
            </a>
            <a href="<?=base_url('Institute/Home/Sections')?>" class="btn btn-info float-right mx-1">
                <i class="fas fa-eye"></i> View Sections
            </a>
        </div>
        <br />
        <br />
        <div class="col-12">
            <!--Classes List Table-->
            <div class="" style="overflow-x: auto">
                <table class="table table-responsive table-bordered" id="memberTable">
                    <thead>
                    <tr class="bg-dark text-white">
                        <th>Class Name</th>
                        <th>Registration Fee</th>
                        <th>Yearly Tuition Fee</th>
                        <th>Action</th>
                    </tr>
                    <tr class="bg-white">
                        <th>
                            <input type="text" class="form-control-sm w-100 border-secondary" id="myInput1" onkeyup="myFunction1()"
                                   placeholder="Search by Class Name">
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    <?php
                    if($classes){
                        foreach($classes as $class){?>
                            <tr>
                                <td>
                                    <span class="" ><?=$class->className?></span>
                                </td>
                                <td>
                                    <span class="" ><?=$class->registrationFees?></span>
                                </td>
                                <td>
                                    <span class="" ><?=$class->yearlyTuitionFees?></span>
                                </td>
                                <td>
                                    <a  href="<?=base_url('Institute/Home/modifyClass/').$class->classIdPK; ?>"
                                            class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Modify
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!--End Classes List Table-->
        </div>
    </div>
</div>
<!-- Body Content End -->
<!-- The Modal -->
<div class="modal" id="addClass">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Class</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="jsError"></div>
                <form action="#" method="post" class="addNewClass">
                    <div class="form-group">
                        <label for="class">Class Name:</label>
                        <input type="text" value="<?=set_value('className')?>" name="className"
                               class="form-control" placeholder="Enter class name" id="class">
                        <?php echo form_error('className')?>
                    </div>
                    <div class="form-group">
                        <label for="class">Registration Fee:</label>
                        <input type="text"  value="<?=set_value('registrationFees')?>" name="registrationFees"
                               class="form-control" placeholder="Enter Registration Fee" id="class">
                        <?php echo form_error('registrationFees')?>
                    </div>
                    <div class="form-group">
                        <label for="class">Yearly Tuition Fees:</label>
                        <input type="text"  value="<?=set_value('yearlyTuitionFees')?>" name="yearlyTuitionFees"
                               class="form-control" placeholder="Enter Yearly Tuition Fee" id="class">
                        <?php echo form_error('yearlyTuitionFees')?>
                    </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#memberTable").fancyTable({
            pagination: true,
            perPage:5,
            searchable: false
        });
    });
    /*add new Class*/
    $('form.addNewClass').on('submit', function(form){
        form.preventDefault();
        $.post('<?=base_url("Institute/Settings/addClass")?>', $('form.addNewClass').serialize(), function(data){
            if(data=='1'){
                location.reload();
            } else {
                $('div.jsError').html(data);
            }
            /*$('div.jsError').html(data);*/
        });
    });
    /*add new Class*/
    /*Modify Class Name*/
    // On text click
    $('.enable').click(function(){
        $(this).closest('tr').find('span').addClass("edit");
        var r = confirm("Do you want to edit Class Name?");
        if(r == true){
            $('.edit').click(function(){
                // Hide input element
                $('.txtedit').hide();
                // Show next input element
                $(this).next('.txtedit').show().focus();
                // Hide clicked element
                $(this).hide();
                $(this).prev('.edita').hide();
            });
        }

    });

    // Focus out from a textbox
    $('.txtedit').focusout(function(){
        // Get edit id, field name and value
        var edit_id = $(this).data('id');
        var fieldname = $(this).data('field');
        var value = $(this).val();
        if (!/^[A-Za-z0-9 -]+$/.test(value)) {
            alert("Class Name must be Alphabets/Numbers only");
            return false;
        } else {
            // Hide Input element
            $(this).hide();
            // Update viewing value and display it
            $(this).prev('.edit').show();
            $(this).prev('.edit').text(value);
            // Send AJAX request
            $.ajax({
                url: '<?= base_url("Institute/Settings/modifyClass") ?>',
                type: 'post',
                data: { field:fieldname, value:value, id:edit_id },
                success:function(response){
                    if(response='1'){
                        alert('Class Modified Successfully');
                    }
                    //console.log(response);
                }
            });
        }
    });
    /*Modify Class Name*/
</script>