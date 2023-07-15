<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'Layout/head.view.php'; ?>
</head>
<body>
    <?php include 'Layout/nav.view.php' ?>
    <?php include 'Layout/header.view.php' ?>
    <?php include $this->view; ?>
    <?php  include 'Layout/footer.view.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/vendor-all.min.js"></script>
    <script src="../../assets/js/scripts.js"></script>
    <script>
        $(document).ready(function(){
            $('#script_comment').on('submit', function(e){
                e.preventDefault();
                const fullname = $('#fullname').val()
                const content = $('#content').val()
                const postid = $('#postid').val()
                $.ajax({
                    url: '/admin/comment/insert',
                    type: 'POST',
                    data: {title: fullname, content, postid},
                    success: function name(results) {
                        alert(results);
                        $('#fullname').val('')
                        $('#content').val('')
                    }
                })
            })
        })
    </script>
</body>
</html>