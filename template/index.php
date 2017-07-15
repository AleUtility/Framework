<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 06/05/2017
 * Time: 20:36
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>A simple Framework</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <?php
    if(isset($page) && method_exists ($page, 'styles'))
        $page->styles();
    ?>
    <style>
        .page-content {
            margin-top: 50px;
            min-height: calc(100vh - 130px);
            padding: 10px;
        }
        .footer {
            height: 60px;
        }
        .footer li {
            float: left;
            list-style-type: none;
            margin: 0px 5px;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<!-- <nav class="navbar navbar-fixed-top navbar-info navbar-color-on-scroll navbar-transparent"> -->
<nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="text-white">
                <div class="navbar-brand">
                    <i class="fa fa-hashtag" aria-hidden="true"></i> Website name
                </div>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navigation-index">
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(isset($page) && method_exists ($page, 'navbar'))
                    $page->navbar();
                else {
                    ?>
                    <li>
                        <a href="/">
                            <i class="fa fa-home" aria-hidden="true"></i> Home
                        </a>
                    </li>
                <?php } ?>
                <?php if(isLogin()) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons">settings</i>
                            <b class="caret"></b>
                            <div class="ripple-container"></div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="/profile">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="/login">
                            <i class="fa fa-sign-in" aria-hidden="true"></i> Sign in
                        </a>
                    </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<!-- Bootstrap Modal -->
<div id="modal"></div>

<div class="page-content">
    <?php
    if(isset($page) && method_exists ($page, 'content'))
        $page->content();
    ?>
</div>
<footer class="footer">
    <hr>
    <div class="container">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="https://google.com">
                        Google webspace
                    </a>
                </li>
                <li>
                    <a href="#">
                        My page
                    </a>
                </li>
                <li>
                    <a href="/contact">
                        Contact me
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright pull-right">
            © 2017, made with <i class="fa fa-heart"></i> by Alessando.
        </div>
    </div>
</footer>
</body>

<!--   Core JS Files   -->
<script src="/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Custom JavaScript -->
<?php
if(isset($page) && method_exists ($page, 'javascripts'))
    $page->javascripts();
?>
<script>
    $(function() {
        $('.navbar a').not('.dropdown a').filter(function(){
            return $(this).attr('href').toLowerCase() === window.location.pathname.toLowerCase();
        }).parent().addClass('active');

        //smoothscroll
        $('[href^="#"]').on('click', function (e) {
            e.preventDefault();
            $(document).off("scroll");

            var target = $(this).attr('href');
            $('html, body').stop().animate({
                'scrollTop': $(target).offset().top - 60
            }, 500, 'swing', function () {
                // window.location.hash = target;
                $(document).on("scroll", onScroll);
            });
        });

        onScroll();
    });

    /* Scroll event */
    $(document)
        .on("scroll", onScroll);

    function onScroll(event){
        var scrollPos = $(document).scrollTop();
        $('.nav a').each(function () {
            var currLink = $(this);
            var refHref = currLink.attr("href");
            if(refHref.indexOf('#')==0) {
                var refElement = $(refHref);
                if (refElement.position() && refElement.position().top <= scrollPos + 60 && refElement.position().top + refElement.height() > scrollPos) {
                    $('.nav a').parent().removeClass("active");
                    currLink.parent().addClass("active");
                }
                else{
                    currLink.parent().removeClass("active");
                }
            }
        });
    }

    /* Auto Modal JS */
    function doModal(placementId, heading, formContent, strSubmitFunc, btnText)
    {
        html =  '<div id="modalWindow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
        html += '<div class="modal-dialog">';
        html += '<div class="modal-content">';
        html += '<div class="modal-header">';
        html += '<a class="close" data-dismiss="modal">×</a>';
        html += '<h4>'+heading+'</h4>'
        html += '</div>';
        html += '<div class="modal-body">';
        html += formContent;
        html += '</div>';
        html += '<div class="modal-footer">';
        if (btnText!='') {
            html += '<button class="btn btn-success" onClick="' + strSubmitFunc + '">';
            html += ''+btnText;
            html += '</button>';
        }
        // html += '<button class="btn btn-secondary" data-dismiss="modal">';
        // html += <?php echo "'Chiudi'"; ?>;
        // html += '</button>'; // close button
        html += '</div>';  // footer
        html += '</div>';  // content
        html += '</div>';  // dialog
        html += '</div>';  // modalWindow
        $("#"+placementId).html(html);
        $("#modalWindow").modal();
        $("#dynamicModal").modal('show');
    }

    function hideModals()
    {
        // Using a very general selector - this is because $('#modalDiv').hide
        // will remove the modal window but not the mask
        $('.modal.in').modal('hide');
    }

</script>

</html>