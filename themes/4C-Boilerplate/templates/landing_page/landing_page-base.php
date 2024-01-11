<?php
// Default Landing page template.
?>

<section style="padding-top: 192px;">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1><?php echo get_field('page_title'); ?></h1>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Hi!</h2>
                <p>This is the base landing page template file! You can customize this just like you would any block or single-page template. It comes with the default "Landing Page: Base" field set that you can modify to add fields to this page, or you can make another template in the same folder (4C-boilerplate/templates/landing_page) called "landing_page-<span style="background-color: rgba(255,255,224,1);">template-name</span>.php" and it will add it to the landing page template selectors.</p>
                <p>Keep in mind that posts (and blocks) keep acf data even if the fields are not active in the editor, so name your fields accordingly.</p>
                <p>Happy Coding!</p>
                <p>ProTip: take a look at the <a href="https://github.com/Four-Columns/4C-Boilerplate/tree/master#function-fcbp__render_acf_block" target="_blank">FCBP__render_acf_block()</a> function to build out a template of acf blocks so you only have one code base</p>
            </div>
        </div>
    </div>
</section>