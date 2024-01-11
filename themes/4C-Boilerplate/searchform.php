<form action="/" method="get">
    <label for="search">Howdy -- Edit my appearence in searchform.php</label>
    <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
    <input type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
</form>