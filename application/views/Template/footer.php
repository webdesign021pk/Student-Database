</div>
</div>
<footer class="footer" style="max-height: 200px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <i class="fas fa-copyright text-muted"></i>
                        <span class="text-muted"> Designed and Developed by:
                            <a href="http://www.webdesign021.pk" class="text-muted">WebDesign021.pk</a>
                        </span>
                    </div>
                    <div class="col-lg-6 text-center text-muted">
                        <a href="https://www.facebook.com/webdesign.021/services/" class="text-secondary" target="_blank"><i class="fab fa-facebook-square"></i>
                        Rashid M. Rafiq</a> | <i class="fas fa-envelope"></i> rashid@webdesign021.pk
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript -->

<script type="text/javascript">
    $(document).ready(function(){
        /*$("#memberTable").fancyTable({
            pagination: true,
            perPage:15,
            searchable: false
        });*/
        /*check-In 1 and 2*/
        $('form.jsform').on('submit', function(form){
            form.preventDefault();
            $.post('<?=base_url('Library/Transactions/checkIn2')?>', $('form.jsform').serialize(), function(data){
                $('div.jsError').html(data);
            });
        });
        $('form.jsformCheckIn2').on('submit', function(form){
            form.preventDefault();
            /*http://[::1]/ci3/Library/Transactions/checkIn2*/
            $.post('<?=base_url('Library/Transactions/checkIn2')?>', $('form.jsformCheckIn2').serialize(), function(data){
                location.reload();
            });
        });
        /*check-In 1 and 2*/
        /*DropDown*/
        $('#cat').change(function(){
            var cat_id = $('#cat').val();
            var methodUrl = '<?=base_url().'Library/Books/fetchSubCat'?>';
            //alert(cat_id);
            if(cat_id !=''){
                $.ajax({
                    url: '<?=base_url('Library/Books/fetchSubCat')?>',
                    method:'POST',
                    data:{cat_id:cat_id},
                    success:function(data)
                    {
                        $('#subCatId').html(data);
                    }
                })
            }
        })
    });
    /*SEARCH FIELDS*/
    function myFunction1()
    {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput1");
        filter = input.value.toUpperCase();
        table = document.getElementById("memberTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
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
    function myFunction2() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        table = document.getElementById("memberTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
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
    function myFunction3() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput3");
        filter = input.value.toUpperCase();
        table = document.getElementById("memberTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
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
    function myFunction4() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput4");
        filter = input.value.toUpperCase();
        table = document.getElementById("memberTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
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
    function myFunction5() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput5");
        filter = input.value.toUpperCase();
        table = document.getElementById("memberTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[4];
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
    /*SEARCH FIELDS*/
    let total = 0;
    [...document.getElementsByClassName('iput')].forEach(function(item) {
        item.addEventListener('change', function(e) {
            if (e.target.checked) {
                total += parseInt(e.target.value, 10)
            } else {
                total -= parseInt(e.target.value, 10)
            }
            document.getElementById('total').value = total;
            document.getElementById('changeDue').value = total;
        });
    });
</script>
</body>
</html>