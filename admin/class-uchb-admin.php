<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       unitycode.tech
 * @since      1.0.0
 *
 * @package    Uchb
 * @subpackage Uchb/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Uchb
 * @subpackage Uchb/admin
 * @author     jnz93 <contato@unitycode.tech>
 */
class Uchb_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Adc menu item
		add_action('admin_menu', array($this, 'create_admin_page'));

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uchb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uchb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uchb-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'uikit', plugin_dir_url( __FILE__ ) . 'css/uikit.min.css', array(), '3.5.9', 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uchb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uchb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/uchb-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'uikit', plugin_dir_url( __FILE__ ) . 'js/uikit.min.js', array(), '3.5.9', false );
		wp_enqueue_script( 'uikit-icons', plugin_dir_url( __FILE__ ) . 'js/uikit-icons.min.js', array(), '3.5.9', false );

	}

	/**
	 * Create page admin of plugin
	 * 
	 * @since 1.0.0
	 */
	public function create_admin_page()
	{
		$page_title = 'Unitycode Heartbeat';
		$menu_title = 'UC Heartbeat';
		$menu_slug 	= 'uchb';
		$capability = 10;
		$icon_url 	= 'dashicons-store';
		$position 	= 10;

		add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($this, 'construct_admin_page'), $icon_url, $position);
	}

	/**
	 * Construct page admin function
	 * 
	 * @since 1.0.0
	 */
	public function construct_admin_page()
	{
		$buttons = '<p uk-margin>
						<button class="uk-button uk-button-default uk-button-large" uk-toggle="target: #modal-projetos">Projetos</button>
						<button class="uk-button uk-button-default uk-button-large" uk-toggle="target: #modal-orcamentos">Orçamentos</button>
						<button class="uk-button uk-button-default uk-button-large" uk-toggle="target: #modal-clientes">Clientes</button>
						<button class="uk-button uk-button-default uk-button-large" uk-toggle="target: #modal-financas">Finanças</button>
					</p>';

		$card_buttons = '<div class="uk-child-width-1-2@s uk-grid-match" uk-grid>
							<div>
								<div class="uk-card uk-card-default uk-card-body">
									<h3 class="uk-card-title">Menu Principal</h3>
									'. $buttons .'
								</div>
							</div>
						</div>';

	
		// Modal cadastro projeto
		$modal_projetos = '<div id="modal-projetos" class="uk-modal-container" uk-modal>
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
											<div class="uk-width-1-2">
												<label class="uk-form-label" for="uchb_project_types">Tipo do projeto</label>
												<div class="uk-form-controls">
													<select class="uk-select" id="uchb_project_types">
														<option>Option 01</option>
														<option>Option 02</option>
													</select>
												</div>
											</div>
											<div class="uk-width-1-2">
												<label class="uk-form-label" for="uchb_project_customer">Cliente</label>
												<div class="uk-form-controls">
													<select class="uk-select" id="uchb_project_customer">
														<option>Option 01</option>
														<option>Option 02</option>
													</select>
												</div>
											</div>
											<div class="uk-width-1-1">
												<label class="uk-form-label" for="uchb_project_proposal">Proposta Unitycode</label>
												<div class="uk-form-controls">
													<textarea class="uk-input" id="uchb_project_proposal"></textarea>
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
										<button class="uk-button uk-button-primary" type="button">Salvar Projeto</button>
									</div>
								</div>
							</div>'; 

		// Modal cadastrar clientes
		$modal_cliente = '<div id="modal-clientes" class="uk-modal-container" uk-modal>
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
											<label class="uk-form-label" for="uchb_client_type">Tipo Cliente</label>
											<div class="uk-form-controls">
												<select class="uk-select" id="uchb_project_type">
													<option>Option 01</option>
													<option>Option 02</option>
													<option>Option 03</option>
													<option>Option 04</option>
													<option>Option 05</option>
												</select>
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
									<button class="uk-button uk-button-primary" type="button">Salvar Projeto</button>
								</div>
							</div>
						</div>';

		
		// Outputs
		echo $card_buttons;
		echo $modal_projetos;
		echo $modal_cliente;
	}
}
