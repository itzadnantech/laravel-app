<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<style>
    body {
        padding-top: 4.2rem;
        padding-bottom: 4.2rem;
        background: rgba(0, 0, 0, 0.76);
    }

    a {
        text-decoration: none !important;
    }

    h1,
    h2,
    h3 {
        font-family: 'Kaushan Script', cursive;
    }

    .myform {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        padding: 1rem;
        -ms-flex-direction: column;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 1.1rem;
        outline: 0;
        max-width: 500px;
    }

    .tx-tfm {
        text-transform: uppercase;
    }

    .mybtn {
        border-radius: 50px;
    }

    .login-or {
        position: relative;
        color: #aaa;
        margin-top: 10px;
        margin-bottom: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .span-or {
        display: block;
        position: absolute;
        left: 50%;
        top: -2px;
        margin-left: -25px;
        background-color: #fff;
        width: 50px;
        text-align: center;
    }

    .hr-or {
        height: 1px;
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }

    .google {
        color: #666;
        width: 100%;
        height: 40px;
        text-align: center;
        outline: none;
        border: 1px solid lightgrey;
    }

    form .error {
        color: #ff0000;
    }

    #second {
        display: none;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="myform form ">
                    <div class="logo mb-3">
                        <div class="col-md-12 text-center">
                            <h1>Admin Login</h1>
                        </div>
                    </div>
                    <form class="submit-form" action="{{ url('/admin/login-request') }}" name="login">
                        <div class="alert alert-danger" role="alert" style="display: none;">

                        </div>
                        <div class="alert alert-success" role="alert" style="display: none;">

                        </div>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" id="password" class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <p class="text-center">Back to welcome page<a href="{{ url('/') }}"> Home</a></p>
                        </div>
                        <div class="col-md-12 text-center ">
                            <button type="submit" id="loginbtn" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        $("#signin").click(function() {
            $("#second").fadeOut("fast", function() {
                $("#first").fadeIn("fast");
            });
        });




        $('.submit-form').submit(function(e) {

            e.preventDefault();
            e.stopPropagation();
            var form = $(this).serialize();
            var url = $(this).attr('action');

            $(".error").remove();

            $.ajax({
                type: 'POST',
                url: url,
                data: form,
                dataType: 'html',
                beforeSend: function() {
                    $('#loginbtn').text('Please Wait...');
                    $('#loginbtn')
                },
                success: function(data) {
                    let res = JSON.parse(data);
                    switch (res.code) {
                        case 'success':

                            $('.alert-success').css('display', 'block');
                            $('.alert-success').html(res.message);
                            setTimeout(function() {
                                window.location.href = res.redirect_url;
                            }, 2500)
                            break;

                        case 'warning':
                            $('.alert-danger').css('display', 'block');
                            $('.alert-danger').html(res.message);
                            setTimeout(function() {
                                $('.alert-danger').css('display', 'none');
                            }, 10000)
                            break;
                        case 'errors':
                            res.message.forEach(function(error) {
                                $('[name=' + error[0] + ']').parent().append('<span style="color:red; font-size:11px" class="error">' + error[1] + '</span>');
                            })
                            break;
                    }
                }
            });

        });
    </script>

</body>