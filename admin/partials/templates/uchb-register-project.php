<?php

/**
 * Provide a form for create new project
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       unitycode.tech
 * @since      1.0.0
 *
 * @package    Uchb
 * @subpackage Uchb/admin/partials/templates/
 */
$ajax_url = admin_url('admin-ajax.php');
?>
<div id="modal-projetos" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Cadastrar Projeto</h2>
        </div>
        <div class="uk-modal-body">
            <form class="uk-grid-small" uk-grid>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_project_name">Nome do projeto</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_project_name" type="text" placeholder="Adicione um nome para o projeto">
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_project_description">Descrição do projeto</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_project_description" type="text" placeholder="Adicione uma descrição rápida">
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_project_specs">Especificações</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-input" id="uchb_project_specs"></textarea>
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_project_details">Detalhes</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-input" id="uchb_project_details"></textarea>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <label class="uk-form-label" for="uchb_project_types">Tipo do projeto</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="uchb_project_types">
                            <option>Option 01</option>
                            <option>Option 02</option>
                        </select>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <label class="uk-form-label" for="uchb_project_customer">Cliente</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="uchb_project_customer">
                            <option>Option 01</option>
                            <option>Option 02</option>
                        </select>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <label class="uk-form-label" for="uchb_project_proposal">Proposta Unitycode</label>
                    <div class="uk-form-controls">
                        <input type="file" class="uk-input" id="uchb_project_proposal">
                    </div>
                </div>
                <div class="uk-width-1-4">
                    <label class="uk-form-label" for="uchb_project_deadline">Previsão de entrega</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_project_deadline" type="date">
                    </div>
                </div>
                <div class="uk-width-1-4">
                    <label class="uk-form-label" for="uchb_project_hours">Orçamento em Horas</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_project_hours" type="number" placeholder="Ex: 10">
                    </div>
                </div>
                <div class="uk-width-1-4">
                    <label class="uk-form-label" for="uchb_project_price">Valor do projeto</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_project_price" type="number" placeholder="Ex: 1800,00">
                    </div>
                </div>
                <div class="uk-width-1-4">
                    <label class="uk-form-label" for="uchb_project_status">Status</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="uchb_project_status">
                            <option>Proposta enviada</option>
                            <option>Em Andamento</option>
                            <option>Parado</option>
                            <option>Cancelado</option>
                            <option>Concluído</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="button" onclick="registerProject('<?php echo $ajax_url; ?>')">Salvar Projeto</button>
        </div>
    </div>
</div>