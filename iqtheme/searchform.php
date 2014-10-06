<?php if(!get_search_query() == '') :
    $query = get_search_query();
else :
    $query = "''";
endif; ?>
<div class="search-form">
<form action="<?php bloginfo('siteurl'); ?>" method="get">
    <input type="search" results="5" value=<?php echo $query ?> placeholder="Search" name="s" class="s" />
    <button type="submit"><i class="icon-search"></i> Search</button>
</form>
</div>