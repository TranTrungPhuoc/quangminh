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
    function script_changePassword() {
        const ch_password = $('#ch_password').val();
        const ch_confirm = $('#ch_confirm').val();

        if(ch_password == ''){
            alert('Please enter Password!')
            return false;
        }
        
        if(ch_confirm == ''){
            alert('Please enter Confirm Password!')
            return false;
        }
        
        if(ch_password != ch_confirm){
            alert('Password and Confirm Password must be the same!')
            return false;
        }

        $.ajax({
            url: '/admin/user/changepassword',
            type: 'POST',
            data: {password: ch_password}, // key : value {password}
            success: function name(results) {
                alert(results)
                window.location.href = "/login";
            }
        })
    }
    function getName(id, name) {
        $('#returnName').text(name);
        $('#getId').val(id);
    }
    function script_delete() {
        const id = $('#getId').val();
        if(id){
            $.ajax({
                url: '/admin/<?php echo explode('/',$_SERVER['REQUEST_URI'])[2]; ?>/delete',
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
                url: '/admin/<?php echo explode('/',$_SERVER['REQUEST_URI'])[2]; ?>/status',
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
    function updateSort(id) {
        const sort = $('#sort_'+id).val();
        $.ajax({
            url: '/admin/<?php echo explode('/',$_SERVER['REQUEST_URI'])[2]; ?>/sort',
            type: 'POST',
            data: { id, sort },
            success: function (result) {}
        })
        return false;
    }
    function to_slug(title, slug)
    {
        let str = document.getElementById(title).value;
        
        // Chuyển hết sang chữ thường
        str = str.toLowerCase();
        // xóa dấu
        str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
        str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
        str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
        str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
        str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
        str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
        str = str.replace(/(đ)/g, 'd');

        // Xóa ký tự đặc biệt
        str = str.replace(/([^0-9a-z-\s])/g, '');

        // Xóa khoảng trắng thay bằng ký tự -
        str = str.replace(/(\s+)/g, '-');

        // xóa phần dự - ở đầu
        str = str.replace(/^-+/g, '');

        // xóa phần dư - ở cuối
        str = str.replace(/-+$/g, '');

        document.getElementById(slug).value = str;

        return;
    }
</script>

<!-- // ckeditor -->
<script src="/assets/ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.config.language = 'en';
CKEDITOR.replace('content');
</script>