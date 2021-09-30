<!-- Body Content Start -->
<div class="container">
    <div class="row pt-3">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <h3><i class="fas fa-list"></i> Sections List</h3>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <a href="javascript:void(0);" class="btn btn-info float-right mx-1" data-toggle="modal" data-target="#addSection">
                <i class="fas fa-user-plus"></i> New Section
            </a>
            <a href="<?=base_url('Institute/Home/classes')?>" class="btn btn-info float-right mx-1">
                <i class="fas fa-arrow-left"></i> Back to Classes
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
                        <th>Section Name</th>
                        <th>Action</th>
                    </tr>
                    <tr class="bg-white">
                        <th class="">
                            <input type="text" class="form-control-sm w-100 border-secondary" id="myInput1" onkeyup="myFunction1()"
                                   placeholder="Search by Section Name">
                        </th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    <?php
                    if($sections){
                        foreach($sections as $section){?>
                            <tr>
                                <td>
                                    <span class=""><?=$section->sectionName?></span>
                                    <input type='text' class='txtedit' data-id='<?=$section->sectionIdPK?>'
                                           data-field='sectionName' id='nametxt_<?=$section->sectionName?>'
                                           value='<?=$section->sectionName?>' >
                                </td>
                                <td>
                                    <button value="<?=$section->sectionIdPK; ?>"
                                            class="enable btn btn-warning">
                                        <i class="fas fa-edit"></i> Modify
                                    </button>
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
<div class="modal" id="addSection">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Section</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="jsError"></div>
                <form action="#" method="post" class="addNewSection">
                    <div class="form-group">
                        <label for="sectionName">Section Name:</label>
                        <input type="text" name="sectionName" class="form-control" placeholder="Enter section name" id="sectionName">
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
    /*add new Section*/
    $('form.addNewSection').on('submit', function(form){
        form.preventDefault();
        $.post('<?=base_url("Institute/Settings/addSection")?>', $('form.addNewSection').serialize(), function(data){
            if(data=='1'){
                location.reload();
            } else {
                $('div.jsError').html(data);
            }
            /*$('div.jsError').html(data);*/
        });
    });
    /*add new Section*/

    /*Modify Section Name*/
    // On text click
    $('.enable').click(function(){
        $(this).closest('tr').find('span').addClass("edit");
        var r = confirm("Do you want to edit Section Name?");
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
        if (!/^[A-Za-z -]+$/.test(value)) {
            alert("Class Name must be Alphabets only");
            return false;
        } else {
            // Hide Input element
            $(this).hide();
            // Update viewing value and display it
            $(this).prev('.edit').show();
            $(this).prev('.edit').text(value);
            // Send AJAX request
            $.ajax({
                url: '<?= base_url("Institute/Settings/modifySection") ?>',
                type: 'post',
                data: { field:fieldname, value:value, id:edit_id },
                success:function(response){
                    if(response='1'){
                        alert('Section Modified Successfully');
                    }
                    //console.log(response);
                }
            });
        }
    });
    /*Modify Section Name*/
</script>