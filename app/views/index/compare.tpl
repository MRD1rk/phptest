<div id="compare_date_form">
    <form method="post">
        <div>
            <textarea required class="date" name="date"></textarea>
        </div>
        <div class="w-25">
            <button>POST</button>
            <button type="button" class="ajax_send_date">AJAX</button>
        </div>
    </form>
    <div id="result">
        {if isset($result)}
            <span>Результат:&nbsp;{$result}&nbsp;дня</span>
        {/if}
    </div>
</div>
<style>
</style>
