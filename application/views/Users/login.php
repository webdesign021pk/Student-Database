<html>
<head>
    <style>
        /* Sticky footer styles
-------------------------------------------------- */
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 60px; /* Margin bottom by footer height */
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px; /* Set the fixed height of the footer here */
            line-height: 60px; /* Vertically center the text there */
            background-color: #ffffff;
        }
    </style>
    <title>Student Database Management</title>
    <link href="<?=base_url('Assets/img/favicon.ico')?>" type="image/x-icon" rel="icon"/>
    <?= link_tag("Assets/css/bootstrap.min.css")?>
    <script src="<?= base_url('Assets/fontawesome/js/all.js')?>"></script>
    <script src="<?= base_url('Assets/js/jquery-3.4.1.min.js')?>"></script>
</head>
<body class="" style="background-color: #f2f2f2 !important;">
<div class="bg-dark text-light text-center align-center" style="height: 38px">
    <a class="navbar-brand"><i class="fas fa-user-graduate"></i> Student Database Management</a>
</div>
<div class="container mt-5">
    <div class=" col-lg-6 align-center mx-auto">
        <h3 class="mb-2 mt-3 text-center">Login Form</h3>
        <?php if ($error=$this->session->flashdata('msg')) :?>
            <div class="w-100">
                <div class="alert alert-<?=$this->session->flashdata('alert')?>">
                    <?= $error; ?>
                </div>
            </div>
        <?php endif?>
        <?php echo form_open("Admin/user"); ?>
        <div class="form-group">
            <label for="userName">User Name:</label>
            <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Username','name'=>'userName','value'=>set_value('userName'),
                'id'=>'userName'])?>
            <?php echo form_error('userName')?>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <?php echo form_password(['class'=>'form-control','placeholder'=>'Enter Password','name'=>'password','value'=>set_value('password'),
                'id'=>'password'])?>
            <?php echo form_error('password')?>
        </div>
        <?php echo form_submit(['class'=>'btn btn-success','value'=>'Submit',''])?>
        <?php echo form_reset(['class'=>'btn btn-primary','value'=>'Reset',''])?>
        <a href="<?=base_url()?>login/register" style="display: none">New User/Register</a>
        <div class="border rounded p-3 mt-3">
            <h5>Login Details</h5>
            <ul>
                <li><a href="#" id="admin">Login as Admin</a></li>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#admin').click(function(){
        $('#userName').val('Admin');
        $('#password').val('admin');
    });
</script>