<?php $_SESSION['userLevel']= $userDetail->userLevel;?>
<?php $_SESSION['year']= '2020';?>
<?php $_SESSION['InstituteName']= 'Rashid\'s Coaching Center';?>
<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">    
    <title><?=$_SESSION['InstituteName'];?></title>
    <link href="<?=base_url('Assets/img/favicon.ico')?>" type="image/x-icon" rel="icon"/>
    <script src="<?=base_url('Assets/js/jquery-3.4.1.min.js')?>"></script>

    <!-- Required meta tags -->    
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website Designing and Web Application Development">
    <meta name="author" content="Rashid Rafiq">
    <meta name="robots" content="index, follow">
    <!-- Bootstrap CSS -->
    <?= link_tag("Assets/bootstrap/css/bootstrap.min.css")?>
    <?= link_tag("Assets/bootstrap/css/sticky-footer.css")?>
    <?= link_tag("Assets/fontawesome/css/all.css")?>
    <script src="<?=base_url('Assets/fontawesome/js/all.js')?>" crossorigin="anonymous"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="<?= base_url()?>Assets/bootstrap/js/bootstrap.js"></script>

    <script src="<?php echo base_url('Assets/js/jquery.flot.js')?>"></script>
    <script src="<?php echo base_url('Assets/js/fancyTable.js')?>"></script>
    <!--<script src="1https://kit.fontawesome.com/0281032158.js" crossorigin="anonymous"></script>-->
    <style>
        input:disabled, select:disabled, {
            background: #ffffff !important;
        }
        .border-light-Blue {
            border: 1px solid #17a2b8 !important;
        }
        .text-brown{
            color: #f18024 !important;
        }
        .rounded-xl{
            border-radius: 1.1em;
        }
        .font-28{
            font-size: 1.75rem; /*approx 28px*/
        }
        .font-24{
            font-size: 1.5rem; /*approx 24px*/
        }
        .opacity-80{
            opacity: 0.85 !important;
        }
        .min-h-170{
            min-height: 170px !important;
        }
        .txtedit{
            display: none;
            width: 98%;
        }
        .bg-light-brown{
            background-color: #EBC85E !important;
        }
        .bg-light-blue{
            background-color: #5AB6DF !important;
        }
        .bg-light-green{
            background-color: #65CEA7 !important;
        }
        .bg-dark-blue{
            background-color: #001c40 !important;
        }
        .alpha-Circle {
            border-radius: 50%;
            width: 36px;
            height: 36px;
            padding: 7px;
            background: #EBC85E;
            color: #ffffff;
            text-align: center;
            font: 0.8em Arial, sans-serif;
        }
        .my-custom-scrollbar {
        position: relative;
        height: 20rem;
        overflow: auto;
        }
        .table-wrapper-scroll-y {
        display: block;
        }
        .borderless td, .borderless th {
            border: none;
        }
        .table-responsive {
            display: table;
        }
        .y1LabelLayer {
            margin-bottom: 10rem;
        }

    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-blue">
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarsExample08"
                    aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-brand text-light"><i class="fas fa-user-graduate"></i> <?=$_SESSION['InstituteName'];?></span>
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                    <li class="nav-item mr-1 mb-1">
                        <a class="btn btn-light rounded-0 w-100" href="<?=base_url('Institute/Home')?>">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mr-1 mb-1">
                        <a class="btn btn-light rounded-0 w-100" href="<?=base_url('Institute/Students')?>">
                            <i class="fas fa-user-graduate"></i> Students
                        </a>
                    </li>
                    <li class="nav-item mr-1 mb-1">
                        <a class="btn btn-light rounded-0 w-100" href="<?=base_url('Institute/Home/Fee/1')?>">
                            <i class="fas fa-wallet"></i> Fee
                        </a>
                    </li>
                    <li class="nav-item dropdown pr-1">
                        <a class="btn btn-light rounded-0 dropdown-toggle w-100" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cogs"></i> Settings
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item mt-1" href="<?=base_url('Institute/Home/Classes')?>">
                                <i class="fas fa-chalkboard"></i> Classes/Sections
                            </a>
                            <!--<div class="dropdown-divider"></div>-->
                            <a class="dropdown-item" href="<?=base_url('Institute/Reports')?>">
                                <i class="fas fa-print"></i> Reports
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?=base_url('Institute/Home/profile')?>">
                                <i class="fas fa-user-circle"></i> Profile
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <span class="navbar-brand dropdown text-light">Welcome,
                <?= $userDetail->u_firstName;?>
                <a class="alpha-Circle w-100" href="javascript:void(0);" id="navbarDropdown1" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?=strtoupper($userDetail->u_firstName[0].$userDetail->u_lastName[0]);?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">
                    <a class="dropdown-item" href="<?=base_url('Admin/logout')?>">
                        <i class="fas fa-user-lock"></i> Logout
                    </a>
                </div>
            </span>
        </nav>
    <div class="bg-light h-100 container-fluid">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-12">
            <?php if ($error=$this->session->flashdata('msg')) :?>
                <div class="w-75 ml-auto mr-auto mt-1">
                    <div class="alert alert-<?=$this->session->flashdata('alert')?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?=$error;?>
                    </div>
                </div>
            <?php endif?>
        </div>
    </div>
    <div class="clearfix"></div>