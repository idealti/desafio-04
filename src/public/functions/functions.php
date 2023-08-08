<?php

// Formata a cor do background de acordo com o status da tarefa.
function getTaskBackgroundColor($status)
{
    if ($status == 'concluida') {
        return 'bg-success';
    } else {
        return 'bg-warning';
    }
}
