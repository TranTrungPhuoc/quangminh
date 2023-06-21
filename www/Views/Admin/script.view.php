<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/ripple.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/menu-setting.min.js"></script>

<!-- chèn script data table -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/pages/data-basic-custom.js"></script>
<!-- kết thúc -->

<script src="assets/js/plugins/apexcharts.min.js"></script>
<script src="assets/js/pages/dashboard-main.js"></script>
<script>
    $(document).ready(function() {
        checkCookie();
    });
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    function checkCookie() {
        var ticks = getCookie("modelopen");
        if (ticks != "") {
            ticks++ ;
            setCookie("modelopen", ticks, 1);
            if (ticks == "2" || ticks == "1" || ticks == "0") {
                $('#exampleModalCenter').modal();
            }
        } else {
            // user = prompt("Please enter your name:", "");
            $('#exampleModalCenter').modal();
            ticks = 1;
            setCookie("modelopen", ticks, 1);
        }
    }
</script>

<script>
    function getName(id, name) {
        $('#returnName').text(name);
        $('#getId').val(id);
    }
    function script_delete() {
        const id = $('#getId').val();
        if(id){
            $.ajax({
                url: 'http://localhost/admin/user/delete',
                type: 'POST',
                data: { id },
                success: function (result) {
                    $('.alert').show();
                    if(result != ''){
                        $('.alert').addClass('alert-warning');
                        $('.alert').text(result);
                    }
                    else{
                        $('.alert').addClass('alert-success');
                        $('.alert').text('Đã xoá');
                        $('#tr_'+id).remove();
                    }
                    setTimeout(() => { $('.alert').hide() }, 5000);
                }
            })
            return false;
        }
        return;
    }
    function script_status(id) {
        const status = $('.status_'+id).prop( "checked" )
        if(id){
            $.ajax({
                url: 'http://localhost/admin/user/status',
                type: 'POST',
                data: { id, status },
                success: function (result) {
                    $('.alert').show();
                    if(result != ''){
                        $('.alert').addClass('alert-warning');
                        $('.alert').text(result);
                        setTimeout(() => { $('.alert').hide() }, 5000);
                    }
                    else{
                        $('.alert').addClass('alert-success');
                        $('.alert').text('Đã cập nhật');
                        setTimeout(() => { $('.alert').hide() }, 5000);
                    }
                }
            })
            return false;
        }
        return;
    }
</script>