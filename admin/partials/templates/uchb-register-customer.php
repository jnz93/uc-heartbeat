<?php

/**
 * Provide a form for register new customer
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
<div id="modal-clientes" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Cadastrar Cliente</h2>
        </div>
        <div class="uk-modal-body">
            <form class="uk-grid-small" uk-grid>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_client_name">Nome do Cliente</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_client_name" type="text" placeholder="Adicione o nome do cliente">
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_client_company">Nome da empresa</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_client_company" type="text" placeholder="Adicione o nome da empresa">
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_client_doc">CPF/CNPJ</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_client_doc" type="text" placeholder="Adicione o CPF ou CNPJ">
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_client_email">E-mail</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_client_email" type="email" placeholder="E-mail para contato e notificações">
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_client_telnumber">WhatsApp/Telefone</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_client_telnumber" type="text" placeholder="Whatsapp/Telefone para contato e notificações">
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_client_branch">Ramo da Empresa</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_client_branch" type="text" placeholder="Ex: Telecomunicações">
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="uchb_client_address">Endereço</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="uchb_client_address" type="text" placeholder="Ex: Av. tal, 0001 - Cidade - UF">
                    </div>
                </div>
            </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="button" onclick="registerCustomer('<?php echo $ajax_url; ?>')">Salvar Projeto</button>
        </div>
    </div>
</div>