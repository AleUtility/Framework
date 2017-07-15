<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 15/07/2017
 * Time: 20:08
 */
class Page
{
    function content()
    { ?>
        <div class="row">
            <div class="container">
                <div class="col-md-12">
                    <p>
                        This is the content of the webpage
                    </p>
                </div>
            </div>
        </div>
    <?php }

    function styles()
    { ?>
        <style>
            /* This is an example of custom CSS */
            body {
                background-color: mediumseagreen;
            }
        </style>
    <?php }

    function javascripts()
    { ?>
        <script>
            /* This is an example of custom JavaScript code */
            console.log("I'm working!");
        </script>
    <?php }
}