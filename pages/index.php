<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 15/07/2017
 * Time: 08:54
 */
?>
<?php
    class Page {
        function content()
        { ?>
            <div class="container">
                <h1>A Warm Welcome!</h1>
                <p>This is a simple content page. To edit open</p>
                <pre>../pages/index.php</pre>
                <p>To create a subpath like this:</p>
                <pre>/contact</pre>
                <p>create a new folder named <b>contact</b> in</p>
                <pre>../pages</pre>
                <p>and create a new file named <b>index.php</b> in</p>
                <pre>../pages/contact</pre>
                <p>This is an example of <b>index.php</b>:</p>
<pre>
    <code>
    class Page
    {
        function content()
        { ?&gt;
            &lt;div class="row"&gt;
                &lt;div class="container"&gt;
                    &lt;div class="col-md-12"&gt;
                        &lt;p&gt;
                            This is the content of the webpage
                        &lt;/p&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;?php }

        function styles()
        { ?&gt;
            &lt;style&gt;
                /* This is an example of custom CSS */
                html {
                    background-color: mediumseagreen;
                }
            &lt;/style&gt;
        &lt;?php }

        function javascripts()
        { ?&gt;
            &lt;script&gt;
                /* This is an example of custom JavaScript code */
                console.log("I'm working!");
            &lt;/script&gt;
        &lt;?php }
    }
    </code>
</pre>
                <p>Here the example: <a href="/example">click me</a></p>
            </div>
        <?php }
    }
?>