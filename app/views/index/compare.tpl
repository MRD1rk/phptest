<div id="compare_date_form">
    <form method="post">
        <div>
            <textarea required class="date" name="date">3.02.2015 - 5.02.2015</textarea>
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
    #compare_date_form {
        margin-top: 100px;
        width: 220px;
    }

    #compare_date_form form div {
        float: left;
    }

    button {
        display: block;
    }

    #result span{
        border: 2px solid #36d75b;
        width: 100%;
        display: inline-block;
    }
</style>
