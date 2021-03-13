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

		// Register post types function
		add_action('init', array($this, 'uchb_create_post_types'));

		// Register taxonomies
		add_action('init', array($this, 'uchb_create_taxonomies'));


		// Ajax actions
		add_action('wp_ajax_uchb_create_project', array($this, 'uchb_create_project_by_ajax')); // executed when logged in
		add_action('wp_ajax_uchb_register_customer', array($this, 'uchb_register_customer_by_ajax')); // executed when logged in
		add_action('wp_ajax_uchb_register_budget', array($this, 'uchb_register_budget_by_ajax')); // executed when logged in
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
		
		// Outputs
		echo $card_buttons;

		// include templates
		require_once plugin_dir_path( __FILE__ ) . 'partials/templates/uchb-register-project.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/templates/uchb-register-customer.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/templates/uchb-register-budget.php';
	}

	/**
	 * Register post types
	 * 
	 * @since 1.0.0
	 */
	public function uchb_create_post_types()
	{
		// Post type: Projetos
		register_post_type('uchb_projects',
			array(
				'labels'      => array(
					'name'          => __( 'Projetos', 'textdomain' ),
					'singular_name' => __( 'Projeto', 'textdomain' ),
				),
				'public'      => true,
				'has_archive' => true,
				'rewrite'     => array( 'slug' => 'projects' ),
			)
		);

		// Post type: Orçamento
		register_post_type( 'uchb_budgets',
		array(
			'labels' 		=> array(
				'name'			=> __( 'Orçamentos', 'textdomain' ),
				'singular_name'	=> __( 'Orçamento', 'textdomain' ),
			),
			'public'		=> true,
			'has_archive' 	=> true,
			'rewrite'		=> array( 'slug', 'budgets' ),
		));
	}

	/**
	 * Register taxonomies
	 * 
	 * @since 1.0.0
	 */
	public function uchb_create_taxonomies()
	{
		// Status do projeto (uchb_projects)
		$tax_status_name = 'Status';
		$tax_status_sing_name = 'Status';
		$labels = array(
			'name'              => _x( $tax_status_name, 'taxonomy general name', 'textdomain' ),
			'singular_name'     => _x( $tax_status_sing_name, 'taxonomy singular name', 'textdomain' ),
			'search_items'      => __( 'Procurar ' . $$tax_status_name, 'textdomain' ),
			'all_items'         => __( 'Todos '. $tax_status_name , 'textdomain' ),
			'parent_item'       => __( $tax_status_sing_name . ' Pai', 'textdomain' ),
			'parent_item_colon' => __( $tax_status_sing_name . ' Pai:', 'textdomain' ),
			'edit_item'         => __( 'Editar ' . $tax_status_sing_name, 'textdomain' ),
			'update_item'       => __( 'Atualizar ' . $tax_status_sing_name, 'textdomain' ),
			'add_new_item'      => __( 'Adicionar novo ' . $tax_status_sing_name, 'textdomain' ),
			'new_item_name'     => __( 'Novo nome de ' . $tax_status_sing_name, 'textdomain' ),
			'menu_name'         => __( $tax_status_name, 'textdomain' ),
		);
	 
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'status' ),
		);	 
		register_taxonomy( 'project_status', array( 'uchb_projects' ), $args );

		// Limpar variaveis
		unset($labels);
		unset($args);
		
		// Tipos de projeto (uchb_projects)
		$tax_status_name = 'Categorias de projetos';
		$tax_status_sing_name = 'Categoria de projeto';
		$labels = array(
			'name'              => _x( $tax_status_name, 'taxonomy general name', 'textdomain' ),
			'singular_name'     => _x( $tax_status_sing_name, 'taxonomy singular name', 'textdomain' ),
			'search_items'      => __( 'Procurar ' . $$tax_status_name, 'textdomain' ),
			'all_items'         => __( 'Todos '. $tax_status_name , 'textdomain' ),
			'parent_item'       => __( $tax_status_sing_name . ' Pai', 'textdomain' ),
			'parent_item_colon' => __( $tax_status_sing_name . ' Pai:', 'textdomain' ),
			'edit_item'         => __( 'Editar ' . $tax_status_sing_name, 'textdomain' ),
			'update_item'       => __( 'Atualizar ' . $tax_status_sing_name, 'textdomain' ),
			'add_new_item'      => __( 'Adicionar novo ' . $tax_status_sing_name, 'textdomain' ),
			'new_item_name'     => __( 'Novo nome de ' . $tax_status_sing_name, 'textdomain' ),
			'menu_name'         => __( $tax_status_name, 'textdomain' ),
		);
	 
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'project-type' ),
		);	 
		register_taxonomy( 'project_type', array( 'uchb_projects' ), $args );

		// Limpar variaveis
		unset($labels);
		unset($args);
	}


	/**
	 * Create project via ajax
	 * Recebe os dados do formulário via ajax, faz o tratamento e cria um novo projeto.
	 * 
	 * @since 1.0.0
	 */
	public function uchb_create_project_by_ajax()
	{
		$data_received = $_POST['data'];
		$data = explode('||', $data_received);
		
		$postarr = array(
			'post_title'	=> $data[0],
			'post_excerpt'	=> $data[1],
			'post_content'	=> $data[2],
			'post_status'	=> 'publish',
			'post_type'		=> 'uchb_projects',
		);
		$post_id = wp_insert_post( $postarr );
		
		if (!is_wp_error($post_id)) :
			wp_set_post_terms( $post_id, $data[4], 'project_type');
			wp_set_post_terms( $post_id, $data[10], 'project_status');

			update_post_meta( $post_id, 'uchb_project_details', $data[3] );
			update_post_meta( $post_id, 'uchb_project_customer', $data[5] );
			update_post_meta( $post_id, 'uchb_project_proposal', $data[6] );
			update_post_meta( $post_id, 'uchb_project_deadline', $data[7] );
			update_post_meta( $post_id, 'uchb_project_hours', $data[8] );
			update_post_meta( $post_id, 'uchb_project_price', $data[9] );

		endif;
		die();
	}

	/**
	 * Register new customer
	 * Recebe os dados do formulário via ajax, faz o tratamento e cria um novo cliente.
	 * 
	 * @since 1.0.0
	 */
	public function uchb_register_customer_by_ajax()
	{
		$data_received = $_POST['data'];
		$data = explode('||', $data_received);

		$username 	= $data[3];
		$password 	= '000000';
		$email 		= $data[3];

		$user_id = wp_create_user( $username, $password, $email );

		if(is_wp_error($user_id)) :
			update_user_meta( $user_id, 'uchb_customer_company', $data[1] );
			update_user_meta( $user_id, 'uchb_customer_doc', $data[2] );
			update_user_meta( $user_id, 'uchb_customer_phone', $data[4] );
			update_user_meta( $user_id, 'uchb_customer_branch', $data[5] );
			update_user_meta( $user_id, 'uchb_customer_address', $data[6] );
		endif;
		die();
	}

	/**
	 * Register new budget
	 * Recebe os dados do formulário via ajax, faz o tratamento e cria um novo cliente.
	 * 
	 * @since 1.0.0
	 */
	public function uchb_register_budget_by_ajax()
	{
		$data_received = $_POST['data'];
		$data = explode('||', $data_received);

		$postarr = array(
			'post_title'	=> $data[0],
			'post_content'	=> $data[1],
			'post_status'	=> 'publish',
			'post_type'		=> 'uchb_budgets',
		);
		$post_id = wp_insert_post( $postarr );

		if(!is_wp_error($post_id)):
			update_post_meta( $post_id, 'uchb_budget_hours', $data[2] );
			update_post_meta( $post_id, 'uchb_budget_deadline', $data[3] );
			update_post_meta( $post_id, 'uchb_budget_price', $data[4] );
			update_post_meta( $post_id, 'uchb_budget_client_name', $data[5] );
		endif;
		die();
	}

	/**
	 * Return select with companies registered
	 * 
	 * @since v1.0.1
	 */
	public function uchb_select_list_companies()
	{
		$users = get_users( array( 'role__in' => array( 'subscriber' ) ) );

		if ( ! empty( $users ) ) :
			echo '<select class="uk-select" id="uchb_budget_client_name"><option value="0" selected>Selecionar Cliente</option>';
			foreach ( $users as $user ) :

				$u_id 	= $user->ID;
				$u_name = $user->user_nicename;
				
				echo '<option value="'. $u_id .'">'. $u_name .'</option>';

			endforeach;
			echo '</select>';
		endif;
		
	}
}
