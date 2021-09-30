<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-2">
        <div class="col-md-10">
            <h3><i class="far fa-file-alt"></i> Reports</h3>
        </div>
    </div>
    <div class="row p-3 border bg-white shadow-sm rounded-xl">
        <div class="col-lg-2 col-md-12 col-sm-12">
            <p class="mt-2 text-info">Students List</p>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 mt-auto mb-auto">
            <span class="font-28 text-info">
                <form class="form-inline printMembers" method="post" action="#">
                    <div class="input-group mb-3 border-dark">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent text-dark">By Class: </span>
                        </div>
                        <select name="order" class="form-control" id="status" required>
                            <?php
                            foreach($classId as $classes){ ?>
                                <option value="<?=$classes->classIdPK?>">
                                    <?=$classes->className;?>
                                </option>
                            <?php } ?>
                            <option value="0">All Classes</option>
                        </select>
                        <button type="submit" class="btn btn-success rounded ml-2">Print <i class="fas fa-print"></i></button>
                    </div>
                </form>
            </span>
        </div>
        <div class="col-lg-2 text-left">
            <div class="jsError"></div>
        </div>
    </div>
    <br />
    <div class="row p-3 border bg-white shadow-sm rounded-xl">
        <div class="col-lg-2 col-md-12 col-sm-12">
            <p class="mt-2 text-info">Identity Card</p>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 mt-auto mb-auto">
            <span class="font-28 text-info">
                <form class="form-inline printIdCards" method="post" action="#">
                    <div class="input-group mb-3 border-dark">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent text-dark">Student ID: </span>
                        </div>
                        <input class="form-control" name="id" type="number" min="1" max="9999"  required>
                        <button type="submit" class="btn btn-success rounded ml-2">Print <i class="fas fa-print"></i></button>
                    </div>
                </form>
            </span>
        </div>
        <div class="col-lg-2 text-left">
            <div class="jsError"></div>
        </div>
    </div>
    <br />
    <div class="row p-3 border bg-white shadow-sm rounded-xl">
        <div class="col-lg-2 col-md-12 col-sm-12">
            <p class="mt-2 text-info">Student Statement</p>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 mt-auto mb-auto">
            <span class="font-28 text-info">
                <form class="form-inline printStatement" method="post" action="#">
                    <div class="input-group mb-3 border-dark">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent text-dark">Student ID: </span>
                        </div>
                        <input class="form-control" name="id" type="number" min="1" max="9999" required>
                        <button type="submit" class="btn btn-success rounded ml-2">Print <i class="fas fa-print"></i></button>
                    </div>
                </form>
            </span>
        </div>
        <div class="col-lg-2 text-left">
            <div class="jsError"></div>
        </div>
    </div>
    <br />
</div>
<!-- Body Content End -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#memberTable").fancyTable({
            pagination: true,
            perPage:15,
            searchable: false
        });

        $('form.printMembers').on('submit', function(form){
            form.preventDefault();
            $.post('<?=base_url('Institute/Reports/printMembers')?>', $('form.printMembers').serialize(), function(data){
                var myWindow = window.open("", "MsgWindow", "width=550,height=650");
                myWindow.document.write(data);
            });
        });
        $('form.printIdCards').on('submit', function(form){
            form.preventDefault();
            $.post('<?=base_url('Institute/Reports/printIdCards')?>', $('form.printIdCards').serialize(), function(data){
                var myWindow = window.open("", "MsgWindow", "width=550,height=650");
                myWindow.document.write(data);
            });
        });
        $('form.printStatement').on('submit', function(form){
            form.preventDefault();
            $.post('<?=base_url('Institute/Reports/printStatement')?>', $('form.printStatement').serialize(), function(data){
                var myWindow = window.open("", "MsgWindow", "width=550,height=650");
                myWindow.document.write(data);
            });
        });
    });
    function print() {
        window.print();
    }
</script>