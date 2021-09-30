<!-- Body Content Start -->
<div class=" p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3><i class="fas fa-wallet"></i> Students Fee/Payments Details</h3>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4">
            <?php if ($paymentDue->fee_status!=1) {?>
            <button class="btn btn-info"  data-toggle="modal" data-target="#myModal">
                <i class="fas fa-file-invoice-dollar"></i> Add Payment
            </button>
            <?php } ?>
        </div>
    </div>

    <div class="row mb-4">
        <?php if($paymentDue){?>
        <div class="col-lg-4 p-0">
            <ul class="list-group list-group-horizontal list-group-flush m-0 p-0 bg-transparent">
                <li class="list-group-item bg-transparent border-0">
                    <img src="<?=base_url($paymentDue->image_path)?>" alt="image"
                         class="rounded-circle img-fluid d-block mx-auto" style="width:100px;">
                </li>
                <li class="list-group-item bg-transparent border-0">
                    <i class="fas fa-barcode"></i> <?= $paymentDue->studentIdPK;?><br />
                    <i class="fas fa-id-badge"></i> <?= $paymentDue->s_firstName.'&nbsp;'.$paymentDue->s_lastName; ?><br />
                    <i class="fas fa-chalkboard"></i> <?=$paymentDue->className; ?> [Section: <b><?= $paymentDue->sectionName;?></b>]
                </li>
            </ul>
        </div>
        <div class="col-lg-8">
            <table class="table table-responsive mt-lg-2">
                <tr class="bg-secondary text-white">
                    <td>Date/Time</td>
                    <td>Fee type</td>
                    <td>Fee Year</td>
                    <td>Status</td>
                    <td>Amount</td>
                    <td>Balance Due</td>
                </tr>
                <tr>
                    <td><?= $paymentDue->dateCreated;?></td>
                    <td><?= $paymentDue->paymentType;?></td>
                    <td><?= $paymentDue->forYear;?></td>
                    <td>
                        <?php
                        if($paymentDue->fee_status==0){
                            echo '<span class="badge badge-danger">Pending</span>';
                        }
                        elseif($paymentDue->fee_status==1){
                            echo '<span class="badge badge-success">Paid</span>';
                        }
                        elseif($paymentDue->fee_status==2){
                            echo '<span class="badge badge-warning">Partial</span>';
                        }
                        ?>
                    </td>
                    <td><span id="amount"><?= $paymentDue->amountDue;?></span></td>
                    <td><span class="text-danger" id="balanceDue"></span></td>
                </tr>
            </table>
        </div>
        <?php } else {?>
            <div class="col-12">
                <h5>No Record Found!</h5>
            </div>
        <?php }?>
    </div>
    <div class="row mb-2">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="input-group mb-2 shadow-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-white border-secondary">
                        <i class="fas fa-search"></i>&nbsp;by Date:
                    </span>
                </div>
                <input type="text" class="form-control border-secondary" id="myInput2" onkeyup="myFunction2()"
                       placeholder="By Date (yyyy-mm-dd)">
            </div>
        </div>
    </div>
    <!--Students List Table-->
    <div class="" style="overflow-x: auto">
        <table class="table table-responsive" id="memberTable" width="95%">
            <thead>
            <tr class="bg-dark text-white font-weight-bold">
                <th >Id</th>
                <th >Date</th>
                <th >Payment Type</th>
                <th >Amount Paid</th>
                <th >Notes</th>
            </tr>
            </thead>
            <tbody class="bg-white ">
            <?=$transactionDetails;?>
            </tbody>
            <tfoot class="table-dark">
            <tr>
                <td colspan="3" align="right">Total Paid:</td>
                <td><span id="subtotal"></span></td>
                <td></td>
            </tr>
            </tfoot>
        </table>
    </div>
    <!--End Members List Table-->
</div>
<!-- Body Content End -->

<!--payment modal-->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Payment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="post" class="paymentModal">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="jsError-modal"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-group m-0 p-0 bg-transparent">
                                <li class="list-group-item bg-transparent">
                                    <i class="fas fa-barcode"></i> <?= $paymentDue->studentIdPK;?><br />
                                    <i class="fas fa-id-badge"></i> <?= $paymentDue->s_firstName.'&nbsp;'.$paymentDue->s_lastName; ?><br />
                                    <i class="fas fa-chalkboard"></i> <?=$paymentDue->className; ?> [Section: <b><?= $paymentDue->sectionName;?></b>]
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-group m-0 p-0 bg-transparent">
                                <li class="list-group-item bg-transparent">
                                    <i class="fas fa-file-invoice-dollar"></i> Fee Schedule ID: <?= $paymentDue->feeScheduleIdPK;?><br />
                                    <i class="fas fa-wallet"></i> Fee/Payment Type: <?= $paymentDue->paymentType; ?><br />
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <input type="hidden" value="<?= $paymentDue->studentIdPK;?>" name="studentID">
                            <input type="hidden" value="<?= $paymentDue->feeScheduleIdPK;?>" name="feeScheduleId">
                            <input type="hidden" value="<?= $paymentDue->paymentTypeId;?>" id="paymentTypeId">
                            <div class="form-group">
                                <label for="usr">Date:</label>
                                <input type="text" class="form-control bg-white" value="<?= date('Y-m-d');?>" name="paymentDate" readonly>
                            </div>
                            <div class="form-group">
                                <label for="usr">Payment Type:</label>
                                <select class="form-control" name="paymentTypeId" required>
                                    <option>Select Payment Type</option>
                                    <?php
                                    foreach($paymentTypeList as $paymentType){?>
                                        <option
                                            value="<?=$paymentType->paymentTypeIdPK?>">
                                            <?=$paymentType->paymentType?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usr">Balance Due:</label>
                                <input type="number" class="form-control bg-white"
                                       name="amountDue" id="modalBalanceDue" readonly>
                            </div>
                            <div class="form-group">
                                <label for="usr">Amount Paid:</label>
                                <input type="number" class="form-control" id="amountPaid" min="1"
                                       name="paymentAmount" onchange="updateAmountPaid()">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="usr">Notes:</label>
                                <input type="text" class="form-control" name="notes" placeholder="Max 150 characters">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Pay</button>
                    <button type="button" class="btn btn-danger" onclick="location.reload();">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--payment modal-->

<script>
    $(document).ready(function(){

    });
    /*Balance and Due Calculations*/
    var sum = 0;
    var due = 0;
    $('.paidAmount').each(function() {
        sum += +$(this).text()||0;
    });
    var amount = $("#amount").text();
    due = amount-sum;
    $("#subtotal").text(sum);
    $("#balanceDue").text(due);
    $("#modalBalanceDue").val(due);
    $("#amountPaid").prop('max',due);
    /*Balance and Due Calculations*/

    /*Payment modal box*/
    function updateAmountPaid(){
        $("#amountPaid").val(Math.ceil(($("#amountPaid").val()) / 50) * 50);
    }
    $('form.paymentModal').on('submit', function(form){
        form.preventDefault();
        var paymentTypeId = $("#paymentTypeId").val();
        var balanceDue = $("#modalBalanceDue").val();
        if (paymentTypeId == 3) {
            if($("#amountPaid").val() == balanceDue) {
                $.post('<?=base_url("Institute/Settings/addPayment")?>', $('form.paymentModal').serialize(), function(data){
                    if(data=='1'){
                        location.reload();
                    } else {
                        $('div.jsError-modal').html(data);
                    }
                });
            } else {
                alert('Amount paid must be equal to Total Amount');
            }
        } else {
            $.post('<?=base_url("Institute/Settings/addPayment")?>', $('form.paymentModal').serialize(), function(data){
                if(data=='1'){
                    location.reload();
                } else {
                    $('div.jsError-modal').html(data);
                }
            });
        }
    });
    /*Payment modal box*/
</script>
