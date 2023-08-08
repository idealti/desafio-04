
$(document).ready(function () {
    // Adicione um evento de clique para os botões com a classe "btn-concluir"
    $(".btn-concluir").click(function () {
        var button = $(this);
        var taskId = button.data("task-id");
        var action = button.data("action");
        var badge = button.closest(".list-group-item").find(".span-status");

        // Desabilitar o botão para evitar cliques repetidos
        button.prop("disabled", true);
        button.find(".spinner-border").removeClass("d-none");

        // Faça a chamada AJAX para marcar ou desmarcar a tarefa
        $.ajax({
            url: "./tasks/mark_task.php", // Substitua pelo arquivo PHP que irá processar a requisição
            type: "POST",
            data: { task_id: taskId, action: action }, // Envie o ID da tarefa e a ação para o servidor
            success: function (response) {
                console.log("Tarefa " + action + " com sucesso!");

                // Atualize o status da tarefa no front-end
                var completed = (action === "concluir");
                button.data("action", completed ? "desmarcar" : "concluir");

                // Remova a classe "btn-danger" e adicione a classe "btn-danger" se desmarcar a tarefa
                if (!completed) {

                    // Se concluir a tarefa, remova a classe "btn-danger" e adicione a classe "btn-success"
                    button.removeClass("btn-danger").addClass("btn-success");

                    // Se concluir a tarefa, remova a classe "btn-danger" e adicione a classe "btn-success"
                    badge.removeClass("bg-primary").addClass("bg-warning");

                    // Alterar o texto do span para "pendente".
                    badge.text("pendente");

                } else {
                    // Se concluir a tarefa, remova a classe "btn-danger" e adicione a classe "btn-danger"
                    button.removeClass("btn-danger").addClass("btn-danger");

                    // Se concluir a tarefa, remova a classe "btn-danger" e adicione a classe "btn-danger"
                    badge.removeClass("bg-warning").addClass("bg-success");

                    // Altera a cor do texto do span para branco.
                    badge.css("color", "white");

                    // Alterar o texto do span para "concluída".
                    badge.text("concluída");
                }

                // Alterne o texto do botão
                button.text(completed ? "Desmarcar" : "Concluir");

                // Reabilite o botão
                button.prop("disabled", false);
            },
            error: function (xhr, status, error) {
                console.error("Erro ao marcar/desmarcar tarefa:", error);
                // Em caso de erro, reabilite o botão
                button.prop("disabled", false);
            }
        });
    });

    // Adicione um evento de clique para os botões com a classe "btn-excluir"
    $(".btn-excluir").click(function () {
        var button = $(this);
        var taskId = button.data("task-id");

        // Desabilitar o botão para evitar cliques repetidos
        button.prop("disabled", true);
        button.find(".spinner-border").removeClass("d-none");

        // Faça a chamada AJAX para excluir a tarefa
        $.ajax({
            url: "./tasks/delete_task.php", // Substitua pelo arquivo PHP que irá processar a requisição
            type: "POST",
            data: { task_id: taskId }, // Envie o ID da tarefa para o servidor
            success: function (response) {
                console.log("Tarefa excluída com sucesso!");

                // Remova o <li> da tarefa excluída.
                button.closest(".list-group-item").remove();

                // Adiciona uma mensagem de sucesso usando o SweetAlert2 e recarregue a página.
                Swal.fire({
                    title: "Sucesso!",
                    text: "Tarefa excluída com sucesso!",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(function () {
                    location.reload();
                }
                );
            },
            error: function (xhr, status, error) {
                console.error("Erro ao excluir tarefa:", error);
                // Em caso de erro, reabilite o botão
                button.prop("disabled", false);
            }
        });
    });
});
