<?php //phpcs:ignore
declare( strict_types=1 );

namespace Automattic\WordpressMcp\Tools;

use Automattic\WordpressMcp\Core\RegisterMcpTool;

/**
 * Class for managing MCP Lessons Tools functionality.
 */
class McpLessonsTools {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wordpress_mcp_init', array( $this, 'register_tools' ) );
	}

	/**
	 * Register the tools.
	 */
	public function register_tools(): void {
		new RegisterMcpTool(
			array(
				'name'        => 'wp_lessons_search',
				'description' => 'Search and filter WordPress lessons with pagination',
				'type'        => 'read',
				'rest_alias'  => array(
					'route'  => '/wp/v2/lessons',
					'method' => 'GET',
				),
			)
		);

		new RegisterMcpTool(
			array(
				'name'        => 'wp_get_lesson',
				'description' => 'Get a WordPress lesson by ID',
				'type'        => 'read',
				'rest_alias'  => array(
					'route'  => '/wp/v2/lessons/(?P<id>[\d]+)',
					'method' => 'GET',
				),
			)
		);

		new RegisterMcpTool(
			array(
				'name'        => 'wp_add_lesson',
				'description' => 'Add a new WordPress lesson',
				'type'        => 'create',
				'rest_alias'  => array(
					'route'                   => '/wp/v2/lessons',
					'method'                  => 'POST',
					'inputSchemaReplacements' => array( // this will replace the defined elements in the default input schema with the new ones.
						'properties' => array(
							'title'   => array(
								'type' => 'string',
							),
							'content' => array(
								'type'        => 'string',
								'description' => 'The content of the lesson in a valid Gutenberg block format',
							),
							'excerpt' => array(
								'type' => 'string',
							),
						),
						'required'   => array(
							'title',
							'content',
						),
					),
				),
			),
		);

		new RegisterMcpTool(
			array(
				'name'        => 'wp_update_lesson',
				'description' => 'Update a WordPress lesson by ID',
				'type'        => 'update',
				'rest_alias'  => array(
					'route'  => '/wp/v2/lessons/(?P<id>[\d]+)',
					'method' => 'PUT',
				),
			)
		);

		new RegisterMcpTool(
			array(
				'name'        => 'wp_delete_lesson',
				'description' => 'Delete a WordPress lesson by ID',
				'type'        => 'delete',
				'rest_alias'  => array(
					'route'  => '/wp/v2/lessons/(?P<id>[\d]+)',
					'method' => 'DELETE',
				),
			)
		);
	}
}
