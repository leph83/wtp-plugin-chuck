<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */


// Output Block
function wtp_render_callback_block( $attributes, $innerblocks ){
	$class = $attributes['className'] ?? false;
	$align = $attributes['align'] ?? false;
	$class_align = '';

	switch ($align) {
		case 'wide':
			$class_align = 'lc  lc--2';
			break;
		case 'full':
			break;
		default:
			$class_align = 'lc  lc--3';
			break;
	}


    return '<div class="block  ' . $class . ' ' . $class_align .'">' . $innerblocks . '</div>';
}

// Output Block Media
function wtp_render_callback_block_media( $attributes, $innerblocks ){
    return '<div class="block__media">' . $innerblocks . '</div>';
}

// Output Block Content
function wtp_render_callback_block_content( $attributes, $innerblocks ){
    return '<div class="block__content">' . $innerblocks . '</div>';
}

// Output Block Heading
function wtp_render_callback_block_heading( $attributes, $innerblocks ){
	$class = $attributes['className'] ?? false;
    return '<header class="block__heading">' . $innerblocks . '</header>';
}

// Output Block Description
function wtp_render_callback_block_description( $attributes, $innerblocks ){
	$class = $attributes['className'] ?? false;
    return '<div class="block__description  description">' . $innerblocks . '</div>';
}

// Output Block Links
function wtp_render_callback_block_links( $attributes, $innerblocks ){
	$class = $attributes['className'] ?? false;
    return '<div class="block__links">' . $innerblocks . '</div>';
}

// Output Block Section
function wtp_render_callback_section( $attributes, $innerblocks ){
	$class = $attributes['className'] ?? false;
	$align = $attributes['align'] ?? false;
	$class_align = '';

	switch ($align) {
		case 'wide':
			$class_align = 'lc  lc--1';
			break;
		case 'full':
			break;
		default:
			$class_align = 'lc  lc--2';
			break;
	}


    return '<div class="section '.$class_align.'">' . $innerblocks . '</div>';
}

function wtp_block_assets() { // phpcs:ignore

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * you can override this in the theme to remove styles by just copying the register_block_type
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */

	 // block
	 register_block_type(
		'wtp/block', array(
			// 'style'         => 'wtp_style-css',
			// 'editor_style'  => 'wtp_block-editor-css',
			'editor_script' => 'wtp_block-js',
			'render_callback' => 'wtp_render_callback_block',
		)
	);

	// block media
	register_block_type(
		'wtp/block-media', array(
			// 'style'         => 'wtp_block-media-style-css',
			// 'editor_style'  => 'wtp_block-media-editor-css',
			'editor_script' => 'wtp_block-media-js',
			'render_callback' => 'wtp_render_callback_block_media',
		)
	);

	// block content
	register_block_type(
		'wtp/block-content', array(
			// 'style'         => 'wtp_block-content-style-css',
			// 'editor_style'  => 'wtp_block-content-editor-css',
			'editor_script' => 'wtp_block-content-js',
			'render_callback' => 'wtp_render_callback_block_content',
		)
	);

	// block heading
	register_block_type(
		'wtp/block-heading', array(
			// 'style'         => 'wtp_block-heading-style-css',
			// 'editor_style'  => 'wtp_block-heading-editor-css',
			'editor_script' => 'wtp_block-heading-js',
			'render_callback' => 'wtp_render_callback_block_heading',
		)
	);

	// block description
	register_block_type(
		'wtp/block-description', array(
			// 'style'         => 'wtp_block-description-style-css',
			// 'editor_style'  => 'wtp_block-description-editor-css',
			'editor_script' => 'wtp_block-description-js',
			'render_callback' => 'wtp_render_callback_block_description',
		)
	);

	// block links
	register_block_type(
		'wtp/block-links', array(
			// 'style'         => 'wtp_block-links-style-css',
			// 'editor_style'  => 'wtp_block-links-editor-css',
			'editor_script' => 'wtp_block-links-js',
			'render_callback' => 'wtp_render_callback_block_links',
		)
	);

	// block section
	register_block_type(
		'wtp/section', array(
			// 'style'         => 'wtp_block-links-style-css',
			// 'editor_style'  => 'wtp_block-links-editor-css',
			'editor_script' => 'wtp_block-links-js',
			'render_callback' => 'wtp_render_callback_section',
		)
	);




	// Register block editor script for backend.
	wp_register_script(
		'wtp_block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// Register block styles for both frontend + backend.
	wp_register_style(
		'wtp_style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		is_admin() ? array( 'wp-editor' ) : null, // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);

	// Register block editor styles for backend.
	wp_register_style(
		'wtp_block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `wtpGlobal` object.
	wp_localize_script(
		'wtp_block-js',
		'wtpGlobal', // Array containing dynamic data for a JS Global.
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
			// Add more data here that you want to access from `wtpGlobal` object.
		]
	);
}



// Hook: Block assets.
add_action( 'init', 'wtp_block_assets' );
