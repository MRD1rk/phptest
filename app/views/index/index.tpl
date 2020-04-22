<div id="index-index" class="content">
    {if $tasks}
        <h1 class="text-center">Список задач</h1>
        {include file="tasks/tasks-sort.tpl"}
        {include file="tasks/tasks-list.tpl"}
    {else}
        <div class="text-center">
            <h4>Задач пока нет</h4>
            <a class="btn btn-success" href="/task/add">Добавить новую задачу</a>
        </div>
    {/if}
</div>
