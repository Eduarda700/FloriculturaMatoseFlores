$(document).ready(function () {
    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;
    var dataCon;

    createHeadTable();
    createForm();
    createEditForm();
    manageData();

    $("#filtro").on('input', function () {
        page = 1;
        getPageData();
    });

    function manageData() {
        $.ajax({
            dataType: 'json',
            url: 'getFornecedor.php',
            data: { page: page }
        }).done(function (data) {
            total_page = Math.ceil(data.total / 10);
            current_page = page;

            $('#pagination').twbsPagination({
                totalPages: total_page,
                visiblePages: 5,
                onPageClick: function (event, pageL) {
                    page = pageL;
                    getPageData();
                }
            });

            manageRow(data.data);
            is_ajax_fire = 1;
        });
    }

    function getPageData() {
        var filtro = $("#filtro").val();
        $.ajax({
            dataType: 'json',
            url: 'getFornecedor.php',
            data: { page: page, filtro: filtro }
        }).done(function (data) {
            manageRow(data.data);
        });
    }

    function manageRow(data) {
        dataCon = data;
        var rows = '';
        var i = 0;

        $.each(data, function (key, value) {
            rows += '<tr>';
            rows += '<td>' + value.fornecedor + '</td>';
            rows += '<td>' + value.email + '</td>';
            rows += '<td>' + value.telefone + '</td>';
            rows += '<td>' + value.cnpj_fornecedor + '</td>';
            rows += '<td>' + value.cidade_fornecedor + '</td>';
            rows += '<td data-index="' + i + '">';
            rows += '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Editar</button> ';
            rows += '<button class="btn btn-danger remove-item">Deletar</button>';
            rows += '</td>';
            rows += '</tr>';
            i++;
        });

        $("#fornecedores-tbody").html(rows);
    }

    function createHeadTable() {
        var rows = '<tr>';
        rows += '<th>Nome</th>';
        rows += '<th>Email</th>';
        rows += '<th>Telefone</th>';
        rows += '<th>CNPJ</th>';
        rows += '<th>Cidade</th>';
        rows += '<th width="200px">Ação</th>';
        rows += '</tr>';
        $("thead").html(rows);

        $("#filtro").attr("placeholder", "Buscar fornecedor por nome");
    }

    function createForm() {
        var html = `
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="fornecedor" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control" required />
            </div>
            <div class="form-group">
                <label>CNPJ</label>
                <input type="text" name="cnpj_fornecedor" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Cidade</label>
                <input type="text" name="cidade_fornecedor" class="form-control" required />
            </div>
            <div class="form-group">
                <button type="submit" class="btn crud-submit btn-success">Salvar</button>
            </div>
        `;
        $("#create-item").find("form").html(html);
    }

    function createEditForm() {
        var html = `
            <input type="hidden" name="idfornecedor" class="edit-idfornecedor">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="fornecedor" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control" required />
            </div>
            <div class="form-group">
                <label>CNPJ</label>
                <input type="text" name="cnpj_fornecedor" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Cidade</label>
                <input type="text" name="cidade_fornecedor" class="form-control" required />
            </div>
            <div class="form-group">
                <button type="submit" class="btn crud-submit-edit btn-success">Salvar</button>
            </div>
        `;
        $("#edit-item").find("form").html(html);
    }

    $(".crud-submit").click(function (e) {
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");
        var data = {
            fornecedor: $("input[name='fornecedor']").val(),
            email: $("input[name='email']").val(),
            telefone: $("input[name='telefone']").val(),
            cnpj_fornecedor: $("input[name='cnpj_fornecedor']").val(),
            cidade_fornecedor: $("input[name='cidade_fornecedor']").val()
        };

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: data
        }).done(function (data) {
            $("#create-item").find("input").val('');
            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg || "Fornecedor cadastrado com sucesso!", 'Sucesso');
        });
    });

    $("body").on("click", ".edit-item", function () {
        var index = $(this).closest("td").data("index");
        var item = dataCon[index];

        $("#edit-item").find("input[name='idfornecedor']").val(item.idfornecedor);
        $("#edit-item").find("input[name='fornecedor']").val(item.fornecedor);
        $("#edit-item").find("input[name='email']").val(item.email);
        $("#edit-item").find("input[name='telefone']").val(item.telefone);
        $("#edit-item").find("input[name='cnpj_fornecedor']").val(item.cnpj_fornecedor);
        $("#edit-item").find("input[name='cidade_fornecedor']").val(item.cidade_fornecedor);
    });

    $(".crud-submit-edit").click(function (e) {
        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");

        var data = {
            idfornecedor: $("input[name='idfornecedor']").val(),
            fornecedor: $("input[name='fornecedor']").val(),
            email: $("input[name='email']").val(),
            telefone: $("input[name='telefone']").val(),
            cnpj_fornecedor: $("input[name='cnpj_fornecedor']").val(),
            cidade_fornecedor: $("input[name='cidade_fornecedor']").val()
        };

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form_action,
            data: data
        }).done(function (data) {
            getPageData();
            $(".modal").modal('hide');
            toastr.success(data.msg || "Fornecedor atualizado com sucesso!", 'Sucesso');
        });
    });

    $("body").on("click", ".remove-item", function () {
        var index = $(this).closest("td").data("index");
        var idfornecedor = dataCon[index].idfornecedor;

        if (confirm("Tem certeza que deseja deletar este fornecedor?")) {
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: 'deleteFornecedor.php',
                data: { idfornecedor: idfornecedor }
            }).done(function (data) {
                toastr.success(data.msg || "Fornecedor removido com sucesso!", 'Sucesso');
                getPageData();
            }).fail(function (jqXHR, textStatus, errorThrown) {
                toastr.error("Erro ao remover o fornecedor: " + errorThrown, "Erro");
            });
        }
    });
});
