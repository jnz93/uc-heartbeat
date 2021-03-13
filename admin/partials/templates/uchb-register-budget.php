<?php

/**
 * Provide a form for register new budget
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
<div id="modal-orcamentos" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Novo Orçamento</h2>
        </div>
        <div class="uk-modal-body">
            <form class="uk-grid-small" uk-grid>
                <div class="uk-width-1-1">
                    <label class="uk-form-label" for="uchb_budget_name">Nome do orçamento</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_budget_name" type="text" placeholder="Ex: Orçamento <nome_da_empresa>">
                    </div>
                </div>
                <div class="uk-width-1-1">
                    <label class="uk-form-label" for="uchb_budget_description">Descrição completa</label>
                    <div class="uk-form-controls">
                        <textarea name="uchb_budget_description" id="uchb_budget_description" cols="" rows="7" style="width: 100%;"></textarea>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <label class="uk-form-label" for="uchb_budget_hours">Estimativa de Horas</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_budget_hours" type="text" placeholder="Ex: 25H">
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <label class="uk-form-label" for="uchb_budget_deadline">Estimativa de Entrega</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_budget_deadline" type="date">
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <label class="uk-form-label" for="uchb_budget_price">Valor</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_budget_price" type="text" placeholder="Ex: R$1.500,00">
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_budget_client_name">Empresa / Prospect</label>
                    <div class="uk-form-controls">
                        <?php Uchb_Admin::uchb_select_list_companies();  ?>
                    </div>
                </div>
            </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="button" onclick="registerBudget('<?php echo $ajax_url; ?>')">Salvar Orçamento</button>
        </div>
    </div>
</div>

<script>
fetch('http://localhost/wp/wp-json/wp/v2/users')
    .then( response => response.json() )
    .then( data => console.log( JSON.stringify(data) ) );
</script>