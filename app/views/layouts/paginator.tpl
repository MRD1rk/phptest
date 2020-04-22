{$previous_page = ($current_page==1)?1:$current_page-1}
{$next_page = ($current_page >= $total_pages) ? $current_page: ($current_page +1)}
{$mid_range = floor($limit/2)}
{$range_start = ((($current_page - $mid_range)< 1))?1:((($current_page + $mid_range)>$total_pages)?
((($total_pages-$limit+1)<1)?1:($total_pages-$limit+1)):$current_page - $mid_range)}
{$range_end = ((($current_page + $mid_range) > $total_pages)) ?
$total_pages : ((($current_page - $mid_range) < 1) ? (($total_pages < $limit) ? $total_pages : $limit) : ($current_page + $mid_range))}
<nav id="paginator" aria-label="Page navigation" class="pull-right">
    <ul class="pagination justify-content-center">
        <li class="page-item {if $current_page == $previous_page}disabled{/if}">
            <a class="page-link" href="#" data-page="1" aria-label="Previous"
               data-params='{$params|default:'{}'}'>
                <span aria-hidden="true">«</span></a>
        </li>
        <li class="page-item {if $current_page == $previous_page}disabled{/if}">
            <a class="page-link" href="#" data-page="{$previous_page}" aria-label="Previous"
               data-params='{$params|default:'{}'}'>
                <span aria-hidden="true">‹</span></a></li>
        {for $i=$range_start to $range_end}
            <li class="page-item {if $current_page == $i} active{/if}">
                <a data-page="{$i}"
                   class="page-link"
                   href="#"
                   data-params='{$params|default:'{}'}'>{$i}
                </a>
            </li>
        {/for}
        <li class="page-item {if $current_page == $next_page}disabled{/if}">
            <a class="page-link" href="#" data-page="{$next_page}" aria-label="Next"
               data-params='{$params|default:'{}'}'>
                <span aria-hidden="true">›</span></a>
        </li>
        <li class="page-item {if $current_page == $total_pages}disabled{/if}">
            <a class="page-link" href="#" data-page="{$total_pages}" aria-label="Next"
               data-params='{$params|default:'{}'}'>
                <span aria-hidden="true">»</span></a>
        </li>
    </ul>
</nav>