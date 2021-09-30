<!-- Body Content Start -->
<div class="container mt-4">
    <h3 class="modal-title">
        <i class="fas fa-edit"></i> View/Modify Student
        <small class="float-right mt-2" style="font-size: 1rem">
            <a href="<?=base_url('Institute/Students')?>">
                <i class="fas fa-angle-left"></i> Back to Students
            </a>
        </small>
    </h3>

</div>
<br />
<div class="container p-3 mb-5 border bg-white shadow-sm">
    <div class="row">
        <div class="col-lg-4">
            <form action="<?=base_url('Institute/Students/updateStudentImage')?>" method="post" enctype="multipart/form-data">
                <img src="<?=base_url($student->image_path)?>" class="img-fluid d-block mx-auto" width="95%">
                <input type="hidden" value="<?=$student->studentIdPK?>" name="studentIdPK">
                <input type="hidden" value="<?=$student->dob?>" name="dob">
                <input type="hidden" value="<?=$student->s_firstName?>" name="s_firstName">
                <br />
                <div class="form-group">
                    <label for="userfile">Student Picture:</label>
                    <input type="file" class="form-control" name="userfile" required>
                    <?php if(isset($error)){ echo $error;}?>
                </div>
                <button type="submit" class="btn btn-primary btn-sm float-right">Update Image</button>
            </form>
        </div>
        <div class="col-lg-8">
            <?php echo form_open_multipart(base_url('Institute/Students/card/'.$student->studentIdPK));?>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="s_firstName">First Name:</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter first name','name'=>'s_firstName','value'=>set_value
                        ('s_firstName', $student->s_firstName)])?>
                        <?php echo form_error('s_firstName')?>
                    </div>
                    <div class="form-group">
                        <label for="contact1">Contact 1:</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter contact','name'=>'contact1','value'=>set_value
                        ('contact1', $student->contact1)])?>
                        <?php echo form_error('contact1')?>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'eg. Flat/House#, Plot#, Block#, Area, City',
                            'name'=>'address','value'=>set_value('address', $student->address)])?>
                        <?php echo form_error('address')?>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <?php $attr3 = 'class="form-control" id="gender"'; ?>
                        <?php
                        $gender=[
                            ''=>'Select',
                            '1'=>'Male',
                            '2'=>'Female'
                        ] ?>
                        <?= form_dropdown('gender', $gender, set_value('gender', $student->gender), $attr3); ?>
                        <?php echo form_error('gender')?>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="s_lastName">Last Name:</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter last name','name'=>'s_lastName','value'=>set_value
                        ('s_lastName', $student->s_lastName)])?>
                        <?php echo form_error('s_lastName')?>
                    </div>
                    <div class="form-group">
                        <label for="contact2">Contact 2:</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter contact','name'=>'contact2','value'=>set_value('contact2', $student->contact2)])?>
                        <?php echo form_error('contact2')?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter email','name'=>'email','value'=>set_value('email', $student->email)])?>
                        <?php echo form_error('email')?>
                    </div>
                    <div class="form-group">
                        <label for="dob">DOB:</label>
                        <?php echo form_input(['class'=>'form-control','type'=>'date','placeholder'=>'Enter Date of Birth','name'=>'dob','value'=>set_value('dob', $student->dob)])?>
                        <?php echo form_error('dob')?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="classIdFK">Class:</label>
                        <select class="form-control" name="classIdFK" required>
                            <option>Select Class & Section</option>
                            <?php
                            foreach($classId as $classes){ ?>
                                <option
                                    <?php
                                    if($classes->classIdPK==$student->classIdFK){echo "selected";}
                                    ?>
                                    value="<?=$classes->classIdPK?>">
                                    <?=$classes->className;?>
                                </option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('classIdFK')?>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="sectionIdFK">Section:</label>
                        <select class="form-control" name="sectionIdFK" required>
                            <option>Select Section</option>
                            <?php
                            foreach($sections as $section){ ?>
                                <option
                                    <?php
                                    if($section->sectionIdPK==$student->sectionIdFK){echo "selected";}
                                    ?>
                                    value="<?=$section->sectionIdPK?>">
                                    <?=$section->sectionName;?>
                                </option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('sectionIdFK')?>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-danger" onclick="location.reload();">Reset</button>
            </div>
            </form>
        </div>
    </div>

<!--End Body Content -->
</div>
