</div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/bappi.min.js"></script>
<script src="../../dist/js/demo.js"></script>
<script src="../../assets/js/wow.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script>
    new WOW().init();
    $("#toast-container").fadeOut(3000)
    $("#UpdatePass").validate({
        rules:{
            password:{
                required: true,
                minlength:6
            },
            repass:{
                required: true,
                minlength:6,
                equalTo:"#password"
            }
        },

        messages:{
            password:{
                required: "Please provide a strong password",
                minlength:" Password should be above 5 characters "
            },
            repass:{
                required: "Please provide a confirm password",
                minlength:"Password should be above 5 characters ",
                equalTo:"Confirm Password Should be same to Password"
            }
        }
    });


</script>
</body>
</html>