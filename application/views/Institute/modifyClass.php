<!-- Body Content Start -->
<div class="container">
    <div class="row pt-3">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <h3><i class="fas fa-edit"></i> Modify Class</h3>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <a href="<?=base_url('Institute/Home/Classes')?>" class="btn btn-info float-right mx-1" >
                <i class="fas fa-chalkboard"></i> View Classes
            </a>
            <a href="<?=base_url('Institute/Home/Sections')?>" class="btn btn-info float-right mx-1">
                <i class="fas fa-eye"></i> View Sections
            </a>
        </div>
        <br />
        <br />
        <div class="col-6 mx-auto">
            <form action="<?=base_url('Institute/Home/modifyClass/'.$classes->classIdPK)?>" method="post">
                <div class="form-group">
                    <input type="hidden" name="classNameConfirm" value="<?=$classes->className?>">
                    <label for="class">Class Name:</label>
                    <input type="text" value="<?=set_value('className', $classes->className)?>" name="className"
                           class="form-control" placeholder="Enter class name" id="class">
                    <?php echo form_error('className')?>
                </div>
                <div class="form-group">
                    <label for="class">Registration Fee:</label>
                    <input type="text"  value="<?=set_value('registrationFees', $classes->registrationFees)?>" name="registrationFees"
                           class="form-control" placeholder="Enter Registration Fee" id="class">
                    <?php echo form_error('registrationFees')?>
                </div>
                <div class="form-group">
                    <label for="class">Yearly Tuition Fees:</label>
                    <input type="text"  value="<?=set_value('yearlyTuitionFees', $classes->yearlyTuitionFees)?>" name="yearlyTuitionFees"
                           class="form-control" placeholder="Enter Yearly Tuition Fee" id="class">
                    <?php echo form_error('yearlyTuitionFees')?>
                </div>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>

        </div>
    </div>
</div>
<!-- Body Content End -->

<script type="text/javascript">
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
</script>